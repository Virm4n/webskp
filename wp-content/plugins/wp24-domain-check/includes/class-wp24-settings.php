<?php

/**
 * Class for changing settings (admin interface).
 */
class WP24_Domain_Check_Settings {

	/**
	 * @var array Options.
	 */
	private $options;

	/**
	 * @var array Limited TLDs.
	 */
	private $limited_tlds;

	/**
	 * @var array Webwhois TLDs.
	 */
	private $webwhois_tlds;

	/**
	 * @var array WooCommcerce products.
	 */
	private $woocommerce_products;

	/**
	 * Constructor.
	 * 
	 * @return void
	 */
	public function __construct() {
		$instance = WP24_Domain_Check_Options::get_instance();
		$this->options = $instance->get_options();

		// get selected tlds
		$selected_tlds = explode( ',', preg_replace( '/ |\[(.*?)\],/', '', $this->options['tlds'] ) );
		require_once( dirname( __DIR__ ) . '/assets/inc/class-whoisservers.php' );
		// get limited tlds
		$this->limited_tlds = array();
		foreach ( $selected_tlds as $tld ) {
			$whoisserver = WP24_Domain_Check_Whoisservers::get_whoisserver( $tld );
			if ( $whoisserver && isset( $whoisserver['limit_group'] ) )
				$this->limited_tlds[ $whoisserver['limit_group'] ][] = $tld;
		}
		// get webwhois tlds
		$this->webwhois_tlds = array();
		foreach ( $selected_tlds as $tld ) {
			$webwhois = WP24_Domain_Check_Whoisservers::get_webwhois( $tld );
			if ( $webwhois )
				$this->webwhois_tlds[] = $tld;
		}

		if ( ! class_exists( 'woocommerce' ) ) {
			// disable woocommerce if plugin not installed or active
			if ( $this->options['woocommerce']['enabled'] ) {
				$this->options['woocommerce']['enabled'] = false;
				update_option( 'wp24_domaincheck', $this->options );
			}
		}
		else {
			$this->woocommerce_products = array(
				0 => __( 'None', 'wp24-domain-check' )
			);
			// get all products
			add_action( 'wp_loaded', array( $this, 'get_woocommerce_products' ) );  
		}
	}

	/**
	 * Get all WooCommerce products.
	 * 
	 * @return void
	 */
	public function get_woocommerce_products() {
		$products = wc_get_products( array(
			'status' => 'publish',
			'limit' => -1
		) );
		foreach ( $products as $product ) {
			if ( '' != $product->get_price() )
				$this->woocommerce_products[ $product->get_id() ] = $product->get_name() . ' (' . $product->get_price_html() . ')';
		}
	}

	/**
	 * Init admin scripts, settings and menu.
	 * 
	 * @return void
	 */
	public function init() {
		add_action( 'plugins_loaded', array( $this, 'update_database' ) );
		add_action( 'upgrader_process_complete', array( $this, 'update_plugin' ), 10, 2 );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_filter( 'plugin_action_links_' . dirname( plugin_basename( __DIR__ ) ) . '/wp24-domain-check.php', array( $this, 'action_links' ) );
		add_action( 'admin_init', array( $this, 'init_settings' ) );
		add_action( 'admin_menu', array( $this, 'init_menu' ) );
	}

	/**
	 * Check database version and update if necessary.
	 * 
	 * @return void
	 */
	public function update_database() {
		if ( ! isset( $this->options['database_version'] ) || 
			version_compare( $this->options['database_version'], WP24_DOMAIN_CHECK_DATABASE_VERSION ) == -1 ) {
			global $wpdb;

			$charset_collate = $wpdb->get_charset_collate();
			
			$table_name = $wpdb->prefix . 'wp24_whois_queries';
			$sql[] = "CREATE TABLE $table_name (
				id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
				limit_group varchar(25) NOT NULL,
				query_time datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
				query_count smallint(5) DEFAULT 1 NOT NULL,
				PRIMARY KEY  (id)
			) $charset_collate;";

			$table_name = $wpdb->prefix . 'wp24_tld_prices_links';
			$sql[] = "CREATE TABLE $table_name (
				tld varchar(25) NOT NULL,
				price varchar(25),
				link text,
				price_transfer varchar(25),
				link_transfer text,
				PRIMARY KEY  (tld)
			) $charset_collate;";

			$table_name = $wpdb->prefix . 'wp24_tld_woocommerce';
			$sql[] = "CREATE TABLE $table_name (
				tld varchar(25) NOT NULL,
				product_id_purchase bigint(20),
				product_id_transfer bigint(20),
				PRIMARY KEY  (tld)
			) $charset_collate;";

			$table_name = $wpdb->prefix . 'wp24_whois_servers';
			$sql[] = "CREATE TABLE $table_name (
				tld varchar(25) NOT NULL,
				host varchar(100),
				status_free varchar(200),
				PRIMARY KEY  (tld)
			) $charset_collate;";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );

			$this->options['database_version'] = WP24_DOMAIN_CHECK_DATABASE_VERSION;
			update_option( 'wp24_domaincheck', $this->options );
		}
	}

	/**
	 * After update processing.
	 * 
	 * @return void
	 */
	public function update_plugin( $upgrader_object, $options ) {
		if ( 'update' == $options['action'] && 'plugin' == $options['type'] && isset( $options['plugins'] ) ) {
			foreach ( $options['plugins'] as $plugin ) {
				if ( plugin_basename( __FILE__ ) == $plugin ) {
					// show message after update
					$this->options['updateMessage'] = true;
					update_option( 'wp24_domaincheck', $this->options );
				}
			}
		}
	}

	/**
	 * Enqueue scripts and styles.
	 * 
	 * @return void
	 */
	public function enqueue_scripts() {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );

		wp_enqueue_script(
			'admin',
			plugins_url( 'assets/js/admin.js', dirname( __FILE__ ) ),
			array( 'jquery' ),
			WP24_DOMAIN_CHECK_VERSION,
			true
		);
	}

	/**
	 * Add plugin links.
	 * 
	 * @param array $links 
	 * @return array New link array.
	 */
	public function action_links( $links ) {
		$links[] = '<a href="'. esc_url( get_admin_url( NULL, 'options-general.php?page=wp24_domaincheck_settings' ) ) .'">' . __( 'Settings', 'wp24-domain-check' ) . '</a>';
	
		return $links;
	}

	/**
	 * Init settings.
	 * 
	 * @return void
	 */
	public function init_settings() {
		// register setting and validate function
		register_setting( 'wp24_domaincheck', 'wp24_domaincheck', array( $this, 'validate' ) );

		/*
		 * general settings
		 */
		// field
		add_settings_section( 'section_general_field', __( 'Domain Name Field', 'wp24-domain-check' ), '', 'settings_general' );
		// fieldLabel
		add_settings_field(
			'fieldLabel',
			__( 'Label', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_general',
			'section_general_field',
			array(
				'name' => 'fieldLabel',
				'type' => 'textfield',
			)
		);
		// fieldPlaceholder
		add_settings_field(
			'fieldPlaceholder',
			__( 'Placeholder', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_general',
			'section_general_field',
			array(
				'name' => 'fieldPlaceholder',
				'type' => 'textfield',
			)
		);
		// textfieldWidth / textfieldUnit
		add_settings_field(
			'fieldWidth_fieldUnit',
			__( 'Width', 'wp24-domain-check' ),
			array( $this, 'compositefield' ),
			'settings_general',
			'section_general_field',
			array(
				array( 'name' => 'fieldWidth', 'type' => 'numberfield' ),
				array(
					'name' => 'fieldUnit',
					'type' => 'combobox',
					'vals' => array(
						'px'	=> __( 'Pixel' , 'wp24-domain-check' ),
						'%'		=> __( 'Percent' , 'wp24-domain-check' ),
					),
				)
			)
		);

		// tld
		add_settings_section( 'section_general_tld', __( 'Top-Level Domain (TLD) Input', 'wp24-domain-check' ), '', 'settings_general' );
		// selection type
		add_settings_field(
			'selectionType',
			__( 'Selection type', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_general',
			'section_general_tld',
			array(
				'name' => 'selectionType',
				'type' => 'radiobuttons',
				'vals' => array(
					'dropdown'	=> __( 'Drop-Down List' , 'wp24-domain-check' ) .
						' <span class="description">(' . __( 'Select the TLD from predefinded list, only TLDs listed below allowed' , 'wp24-domain-check' ) . ')</span>',
					'grouped'	=> __( 'Drop-Down Grouped' , 'wp24-domain-check' ) .
						' <span class="description">(' . __( 'Select the TLD from grouped list, only TLDs listed below allowed' , 'wp24-domain-check' ) . ')</span>',
					'freetext'	=> __( 'Free Text Limited' , 'wp24-domain-check' ) .
						' <span class="description">(' . __( 'Type the TLD into domain name field, only TLDs listed below allowed' , 'wp24-domain-check' ) . ')</span>',
					'unlimited'	=> __( 'Free Text Unlimited' , 'wp24-domain-check' ) .
						' <span class="description">(' . __( 'Type the TLD into domain name field, all available TLDs allowed' , 'wp24-domain-check' ) . ')</span>',
				),
			)
		);
		// tlds
		add_settings_field(
			'tlds',
			__( 'TLDs', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_general',
			'section_general_tld',
			array(
				'name' => 'tlds',
				'type' => 'textarea',
				'desc' => __( 'Comma separated list of testable TLDs without leading point.', 'wp24-domain-check' ) . '<span id="grouped-example"><br>' .
					__( 'Grouped example: <code>[Group 1], com, net, org, [Group 2], info, eu</code>.', 'wp24-domain-check' ) . '</span>',
			)
		);
		// multicheck
		add_settings_field(
			'multicheck',
			__( 'Multicheck', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_general',
			'section_general_tld',
			array(
				'name'	=> 'multicheck',
				'type'	=> 'checkbox',
				'label'	=> __( 'Check multiple domains separated by comma.', 'wp24-domain-check' ),
			)
		);
		// check all
		add_settings_section( 'section_general_check_all', __( 'Check All', 'wp24-domain-check' ), '', 'settings_general' );
		// checkAll
		add_settings_field(
			'checkAll',
			__( 'Check all', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_general',
			'section_general_check_all',
			array(
				'name'	=> 'checkAll',
				'type'	=> 'checkbox',
				'label'	=> __( 'Allow to check all testable TLDs simultaneously.', 'wp24-domain-check' ),
			)
		);
		// checkAllLabel
		add_settings_field(
			'checkAllLabel',
			__( 'Check all label', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_general',
			'section_general_check_all',
			array(
				'name' => 'checkAllLabel',
				'type' => 'textfield',
				'desc' => __( 'Label of option in drop-down list.', 'wp24-domain-check' ),
			)
		);
		// checkAllDefault
		add_settings_field(
			'checkAllDefault',
			__( 'Check all default', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_general',
			'section_general_check_all',
			array(
				'name'	=> 'checkAllDefault',
				'type'	=> 'checkbox',
				'label'	=> __( 'Preselect all in drop-down list.', 'wp24-domain-check' ),
			)
		);
		// button
		add_settings_section( 'section_general_button', __( 'Check Button', 'wp24-domain-check' ), '', 'settings_general' );
		// textButton
		add_settings_field(
			'textButton',
			__( 'Label', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_general',
			'section_general_button',
			array(
				'name' => 'textButton',
				'type' => 'textfield',
			)
		);
		// whois link
		add_settings_section( 'section_general_whois_link', __( 'Whois Link', 'wp24-domain-check' ), '', 'settings_general' );
		// showWhois
		add_settings_field(
			'showWhois',
			__( 'Whois link', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_general',
			'section_general_whois_link',
			array(
				'name'	=> 'showWhois',
				'type'	=> 'checkbox',
				'label'	=> __( 'Show a link to open detailed whois information if the domain is registered.', 'wp24-domain-check' ),
				'desc'	=> count( $this->limited_tlds ) > 0 ? __( 'Deactivation is recommended when using TLDs with query limit.', 'wp24-domain-check' ) : '',
			)
		);
		// textWhois
		add_settings_field(
			'textWhois',
			__( 'Whois link label', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_general',
			'section_general_whois_link',
			array(
				'name' => 'textWhois',
				'type' => 'textfield',
			)
		);
		// result settings
		add_settings_section( 'section_general_result', __( 'Result Settings', 'wp24-domain-check' ), '', 'settings_general' );
		// display type
		add_settings_field(
			'displayType',
			__( 'Display type', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_general',
			'section_general_result',
			array(
				'name' => 'displayType',
				'type' => 'radiobuttons',
				'vals' => array(
					'default'			=> __( 'Standard' , 'wp24-domain-check' ) .
						' <span class="description">(' . __( 'Show results directly under the check form' , 'wp24-domain-check' ) . ')</span>',
					'gradual_loading'	=> __( 'Gradual loading' , 'wp24-domain-check' ) .
						' <span class="description">(' . __( 'Show loading icon on search button and display results gradually' , 'wp24-domain-check' ) . ')</span>',
					'overlay'			=> __( 'Overlay' , 'wp24-domain-check' ) .
						' <span class="description">(' . __( 'Show results in an overlaying window' , 'wp24-domain-check' ) . ')</span>',
				),
			)
		);
		// excludeRegistered
		add_settings_field(
			'excludeRegistered',
			__( 'Exclude registered', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_general',
			'section_general_result',
			array(
				'name'	=> 'excludeRegistered',
				'type'	=> 'checkbox',
				'label'	=> __( 'Show free domains only.', 'wp24-domain-check' ),
			)
		);
		// textNoResults
		add_settings_field(
			'textNoResults',
			__( 'No results message', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_general',
			'section_general_result',
			array(
				'name' => 'textNoResults',
				'type' => 'textfield',
				'desc' => __( 'Message to display if all domains are already registered.', 'wp24-domain-check' ),
			)
		);
		// displayLimit
		add_settings_field(
			'displayLimit',
			__( 'Display limit', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_general',
			'section_general_result',
			array(
				'name' => 'displayLimit',
				'type' => 'numberfield',
				'desc' => __( 'Limit results to this value and show "load more" button, 0 for no limit.', 'wp24-domain-check' ),
			)
		);
		// textLoadMore
		add_settings_field(
			'textLoadMore',
			__( 'Load more label', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_general',
			'section_general_result',
			array(
				'name' => 'textLoadMore',
				'type' => 'textfield',
			)
		);

		/*
		 * advanced settings
		 */
		// unsupported tld settings
		add_settings_section( 'section_advanced_unsupported_tld', __( 'Unsupported TLD Settings', 'wp24-domain-check' ), '', 'settings_advanced' );
		// enabled
		add_settings_field(
			'unsupported_enabled',
			__( 'Unsupported TLDs', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_advanced',
			'section_advanced_unsupported_tld',
			array(
				'name'		=> 'unsupported',
				'subname'	=> 'enabled',
				'type'		=> 'checkbox',
				'label'		=> __( 'Allow checking of unsupported (no whois server available) TLDs.', 'wp24-domain-check' ),
				'desc'		=> __( 'Check result may not be a 100 percent correct.',  'wp24-domain-check' ) .
					' <a href="https://wp24.org/plugins/domain-check/faq.html">' . __( 'Read more', 'wp24-domain-check') . '</a>.',
			)
		);
		// text / color
		add_settings_field(
			'unsupported_text_unsupported_color',
			__( 'Text / Color', 'wp24-domain-check' ),
			array( $this, 'compositefield' ),
			'settings_advanced',
			'section_advanced_unsupported_tld',
			array(
				array(
					'name'		=> 'unsupported',
					'subname'	=> 'text',
					'type'		=> 'textfield',
				),
				array(
					'name'		=> 'unsupported',
					'subname'	=> 'color',
					'type'		=> 'colorfield',
				),
			)
		);
		if ( count( $this->webwhois_tlds ) > 0 ) {
			// verify
			add_settings_field(
				'unsupported_verify',
				__( 'Verification link', 'wp24-domain-check' ),
				array( $this, 'inputfield' ),
				'settings_advanced',
				'section_advanced_unsupported_tld',
				array(
					'name'		=> 'unsupported',
					'subname'	=> 'verify',
					'type'		=> 'checkbox',
					'label'		=> __( 'Show external whois page link to verify available domain.', 'wp24-domain-check' ),
					'desc'		=> __( 'Available for', 'wp24-domain-check' ) . ' ' . implode( ', ', $this->webwhois_tlds ),
				)
			);
			// verifyText
			add_settings_field(
				'unsupported_verifyText',
				__( 'Verification link text', 'wp24-domain-check' ),
				array( $this, 'inputfield' ),
				'settings_advanced',
				'section_advanced_unsupported_tld',
				array(
					'name'		=> 'unsupported',
					'subname'	=> 'verifyText',
					'type'		=> 'textfield',
				)
			);
		}

		// misc settings
		add_settings_section( 'section_advanced_misc', __( 'Misc Settings', 'wp24-domain-check' ), '', 'settings_advanced' );
		// linkRegistered
		add_settings_field(
			'linkRegistered',
			__( 'Link registered', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_advanced',
			'section_advanced_misc',
			array(
				'name'	=> 'linkRegistered',
				'type'	=> 'checkbox',
				'label'	=> __( 'Show a hyperlink instead of only text if a domain is registered.', 'wp24-domain-check' ),
			)
		);
		// dotInSelect
		add_settings_field(
			'dotInSelect',
			__( 'Dot in drop-down', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_advanced',
			'section_advanced_misc',
			array(
				'name'	=> 'dotInSelect',
				'type'	=> 'checkbox',
				'label'	=> __( 'Display the dot inside the drop-down list, instead of before it.', 'wp24-domain-check' ),
			)
		);
		// useNonces
		add_settings_field(
			'useNonces',
			__( 'Use nonces', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_advanced',
			'section_advanced_misc',
			array(
				'name'	=> 'useNonces',
				'type'	=> 'checkbox',
				'desc'	=> __( 'A nonce (number used once) additionally helps to protect from misuse.<br>(Disable when using caching or compression.)', 'wp24-domain-check' ),
			)
		);
		// multipleUse
		add_settings_field(
			'multipleUse',
			__( 'Multiple use', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_advanced',
			'section_advanced_misc',
			array(
				'name'	=> 'multipleUse',
				'type'	=> 'checkbox',
				'desc'	=> __( 'Activate when using multiple shortcodes on one page.<br>(Could cause problems when using caching or compression.)', 'wp24-domain-check' ),
			)
		);
		// removeWhoisComments
		add_settings_field(
			'removeWhoisComments',
			__( 'Whois comments', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_advanced',
			'section_advanced_misc',
			array(
				'name'	=> 'removeWhoisComments',
				'type'	=> 'checkbox',
				'label'	=> __( 'Remove comments (starting with %) from whois information.', 'wp24-domain-check' ),
			)
		);

		// alternative suggestions
		add_settings_section( 'section_advanced_suggestions', __( 'Alternative Suggestions', 'wp24-domain-check' ), '', 'settings_advanced' );
		// prefixes
		add_settings_field(
			'prefixes',
			__( 'Prefixes', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_advanced',
			'section_advanced_suggestions',
			array(
				'name' => 'prefixes',
				'type' => 'textfield',
				'desc' => __( 'Comma separated list of prefixes for alternative domain names.', 'wp24-domain-check' ),
			)
		);
		// suffixes
		add_settings_field(
			'suffixes',
			__( 'Suffixes', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_advanced',
			'section_advanced_suggestions',
			array(
				'name' => 'suffixes',
				'type' => 'textfield',
				'desc' => __( 'Comma separated list of suffixes for alternative domain names.', 'wp24-domain-check' ),
			)
		);

		// form settings
		add_settings_section( 'section_advanced_form', __( 'Form Settings', 'wp24-domain-check' ), '', 'settings_advanced' );
		// htmlForm
		add_settings_field(
			'htmlForm',
			__( 'HTML form', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_advanced',
			'section_advanced_form',
			array(
				'name'	=> 'htmlForm',
				'type'	=> 'checkbox',
				'label'	=> __( 'Use HTML form with submit button.', 'wp24-domain-check' ),
				'desc'	=> __( 'Deactivate to use a regular button without a form.', 'wp24-domain-check' ) . '<br>' .
					__( 'Use shortcode <code>[wp24_domaincheck html_form="0"]</code> to deactivate for one specific instance.', 'wp24-domain-check' ),
			)
		);
		// fieldnameDomain
		add_settings_field(
			'fieldnameDomain',
			__( 'Domain fieldname', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_advanced',
			'section_advanced_form',
			array(
				'name' => 'fieldnameDomain',
				'type' => 'textfield',
			)
		);
		// fieldnameTld
		add_settings_field(
			'fieldnameTld',
			__( 'TLD fieldname', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_advanced',
			'section_advanced_form',
			array(
				'name' => 'fieldnameTld',
				'type' => 'textfield',
			)
		);

		if ( count( $this->limited_tlds ) > 0 ) {
			// query limits
			add_settings_section( 'section_advanced_query_limits', __( 'Query limits', 'wp24-domain-check' ), '', 'settings_advanced' );
			
			if ( isset( $this->limited_tlds['centralnic'] ) ) {
				// centralnic settings
				add_settings_field(
					'query_limits_centralnic',
					'CentralNic',
					array( $this, 'inputfield' ),
					'settings_advanced',
					'section_advanced_query_limits',
					array(
						'name'		=> 'query_limits',
						'subname'	=> 'centralnic',
						'type'		=> 'combobox',
						'vals'		=> array(
							60		=> __( '60 queries per hour (untrusted source)' , 'wp24-domain-check' ),
							7200	=> __( '7,200 queries per hour (trusted source)' , 'wp24-domain-check' ),
						),
						'desc'		=> __( 'Due to technical conditions, this plugin cannot guarantee to 100% that the query limit will not be exceeded.', 'wp24-domain-check' ) . '<br>' . 
							__( 'See', 'wp24-domain-check' ) . ': <a href="https://registrar-console.centralnic.com/pub/whois_guidance">' . 
							'https://registrar-console.centralnic.com/pub/whois_guidance</a><br>' . 
							__( 'Affected TLDs', 'wp24-domain-check' ) . ' (' . count( $this->limited_tlds['centralnic'] ) . '): ' . 
							implode( ', ', $this->limited_tlds['centralnic'] ),
					)
				);
			}
		}

		// developer settings
		add_settings_section( 'section_advanced_developer', __( 'Developer Settings', 'wp24-domain-check' ), '', 'settings_advanced' );
		// hooksEnabled
		add_settings_field(
			'hooksEnabled',
			__( 'Enable hooks', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_advanced',
			'section_advanced_developer',
			array(
				'name'	=> 'hooksEnabled',
				'type'	=> 'checkbox',
				'desc'	=> __( 'See', 'wp24-domain-check' ) . ': <a href="https://wp24.org/plugins/domain-check/hooks.html">' . 
					'https://wp24.org/plugins/domain-check/hooks.html</a>',
			)
		);

		/*
		 * text and color settings
		 */
		add_settings_section( 'section_texts_colors', '', '', 'settings_texts_colors' );
		// textAvailable / colorAvailable
		add_settings_field(
			'textAvailable_colorAvailable',
			__( 'Available', 'wp24-domain-check' ),
			array( $this, 'compositefield' ),
			'settings_texts_colors',
			'section_texts_colors',
			array(
				array( 'name' => 'textAvailable', 'type' => 'textfield' ),
				array( 'name' => 'colorAvailable', 'type' => 'colorfield' ),
			)
		);
		// textRegistered / colorRegistered
		add_settings_field(
			'textRegistered_colorRegistered',
			__( 'Registered', 'wp24-domain-check' ),
			array( $this, 'compositefield' ),
			'settings_texts_colors',
			'section_texts_colors',
			array(
				array( 'name' => 'textRegistered', 'type' => 'textfield' ),
				array( 'name' => 'colorRegistered', 'type' => 'colorfield' ),
			)
		);
		// textError / colorError
		add_settings_field(
			'textError_colorError',
			__( 'Error', 'wp24-domain-check' ),
			array( $this, 'compositefield' ),
			'settings_texts_colors',
			'section_texts_colors',
			array(
				array( 'name' => 'textError', 'type' => 'textfield' ),
				array( 'name' => 'colorError', 'type' => 'colorfield' ),
			)
		);
		// textInvalid / colorInvalid
		add_settings_field(
			'textInvalid_colorInvalid',
			__( 'Invalid', 'wp24-domain-check' ),
			array( $this, 'compositefield' ),
			'settings_texts_colors',
			'section_texts_colors',
			array(
				array( 'name' => 'textInvalid', 'type' => 'textfield' ),
				array( 'name' => 'colorInvalid', 'type' => 'colorfield' ),
			)
		);
		// textLimit / colorLimit
		add_settings_field(
			'textLimit_colorLimit',
			__( 'Limit', 'wp24-domain-check' ),
			array( $this, 'compositefield' ),
			'settings_texts_colors',
			'section_texts_colors',
			array(
				array( 'name' => 'textLimit', 'type' => 'textfield' ),
				array(
					'name' => 'colorLimit',
					'type' => 'colorfield',
					'desc' => __( 'Some whois servers have an access control limit to prevent excessive use,<br>so the number of queries per network and time interval is limited.', 'wp24-domain-check' ),
				),
			)
		);
		// textUnsupported / colorUnsupported
		add_settings_field(
			'textUnsupported_colorUnsupported',
			__( 'Unsupported', 'wp24-domain-check' ),
			array( $this, 'compositefield' ),
			'settings_texts_colors',
			'section_texts_colors',
			array(
				array( 'name' => 'textUnsupported', 'type' => 'textfield' ),
				array(
					'name' => 'colorUnsupported',
					'type' => 'colorfield',
					'desc' => __( 'Only needed if selection type is free text input.<br>Use <strong>[tld]</strong> as placeholder for the TLD.', 'wp24-domain-check' ),
				),
			)
		);
		// textTldMissing / colorTldMissing
		add_settings_field(
			'textTldMissing_colorTldMissing',
			__( 'TLD missing', 'wp24-domain-check' ),
			array( $this, 'compositefield' ),
			'settings_texts_colors',
			'section_texts_colors',
			array(
				array( 'name' => 'textTldMissing', 'type' => 'textfield' ),
				array(
					'name' => 'colorTldMissing',
					'type' => 'colorfield',
					'desc' => __( 'Only needed if selection type is free text input and check all is disabled.', 'wp24-domain-check' ),
				),
			)
		);
		// textWhoisserver / colorWhoisserver
		add_settings_field(
			'textWhoisserver_colorWhoisserver',
			__( 'Whois server unknown', 'wp24-domain-check' ),
			array( $this, 'compositefield' ),
			'settings_texts_colors',
			'section_texts_colors',
			array(
				array( 'name' => 'textWhoisserver', 'type' => 'textfield' ),
				array( 'name' => 'colorWhoisserver', 'type' => 'colorfield' ),
			)
		);
		// textEmptyField / colorEmptyField
		add_settings_field(
			'textEmptyField_colorEmptyField',
			__( 'No input', 'wp24-domain-check' ),
			array( $this, 'compositefield' ),
			'settings_texts_colors',
			'section_texts_colors',
			array(
				array( 'name' => 'textEmptyField', 'type' => 'textfield' ),
				array(
					'name' => 'colorEmptyField',
					'type' => 'colorfield',
					'desc' => __( 'Leave empty to use browser specific "Please fill out this field" message.', 'wp24-domain-check' ),
				),
			)
		);
		// textInvalidField / colorInvalidField
		add_settings_field(
			'textInvalidField_colorInvalidField',
			__( 'Invalid input', 'wp24-domain-check' ),
			array( $this, 'compositefield' ),
			'settings_texts_colors',
			'section_texts_colors',
			array(
				array( 'name' => 'textInvalidField', 'type' => 'textfield' ),
				array(
					'name' => 'colorInvalidField',
					'type' => 'colorfield',
					'desc' => __( 'Leave empty to use browser specific "Please match the requested format" message.', 'wp24-domain-check' ),
				),
			)
		);

		/*
		 * prices and links settings
		 */

		// purchase
		add_settings_section( 'section_prices_links_purchase', __( 'Purchase (for available domains)', 'wp24-domain-check' ), '', 'settings_prices_links' );
		// priceEnabled
		add_settings_field(
			'priceEnabled',
			__( 'Purchase prices', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_prices_links',
			'section_prices_links_purchase',
			array(
				'name'	=> 'priceEnabled',
				'type'	=> 'checkbox',
			)
		);
		// priceDefault
		add_settings_field(
			'priceDefault',
			__( 'Default purchase price', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_prices_links',
			'section_prices_links_purchase',
			array(
				'name' => 'priceDefault',
				'type' => 'textfield',
			)
		);
		// linkEnabled
		add_settings_field(
			'linkEnabled',
			__( 'Purchase links', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_prices_links',
			'section_prices_links_purchase',
			array(
				'name'	=> 'linkEnabled',
				'type'	=> 'checkbox',
			)
		);
		// linkDefault
		add_settings_field(
			'linkDefault',
			__( 'Default purchase link', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_prices_links',
			'section_prices_links_purchase',
			array(
				'name' => 'linkDefault',
				'type' => 'textfield',
				'desc' => __( 'Use <strong>[domain]</strong> as placeholder for the domain name and <strong>[tld]</strong> as placeholder for the TLD.', 'wp24-domain-check' ),
			)
		);
		// textPurchase
		add_settings_field(
			'textPurchase',
			__( 'Purchase text', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_prices_links',
			'section_prices_links_purchase',
			array(
				'name' => 'textPurchase',
				'type' => 'textfield',
				'desc' => __( 'Use <strong>[price]</strong> as placeholder for the price and <strong>[link]</strong>linktext<strong>[/link]</strong> as placeholder for the link or <strong>[button]</strong>buttontext<strong>[/button]</strong> to use a button instead of a link.', 'wp24-domain-check' ) . '<br>' .
					__( 'Use <strong>[link newpage]</strong> or <strong>[button newpage]</strong> to open link in a new window/tab.', 'wp24-domain-check' ),
			)
		);

		// transfer
		add_settings_section( 'section_prices_links_transfer', __( 'Transfer (for registered domains)', 'wp24-domain-check' ), '', 'settings_prices_links' );
		// priceTransferEnabled
		add_settings_field(
			'priceTransferEnabled',
			__( 'Transfer prices', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_prices_links',
			'section_prices_links_transfer',
			array(
				'name'	=> 'priceTransferEnabled',
				'type'	=> 'checkbox',
			)
		);
		// priceTransferDefault
		add_settings_field(
			'priceDefault',
			__( 'Default transfer price', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_prices_links',
			'section_prices_links_transfer',
			array(
				'name' => 'priceTransferDefault',
				'type' => 'textfield',
			)
		);
		// linkTransferEnabled
		add_settings_field(
			'linkTransferEnabled',
			__( 'Transfer links', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_prices_links',
			'section_prices_links_transfer',
			array(
				'name'	=> 'linkTransferEnabled',
				'type'	=> 'checkbox',
			)
		);
		// linkTransferDefault
		add_settings_field(
			'linkTransferDefault',
			__( 'Default transfer link', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_prices_links',
			'section_prices_links_transfer',
			array(
				'name' => 'linkTransferDefault',
				'type' => 'textfield',
				'desc' => __( 'Use <strong>[domain]</strong> as placeholder for the domain name and <strong>[tld]</strong> as placeholder for the TLD.', 'wp24-domain-check' ),
			)
		);
		// textTransfer
		add_settings_field(
			'textTransfer',
			__( 'Transfer text', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_prices_links',
			'section_prices_links_transfer',
			array(
				'name' => 'textTransfer',
				'type' => 'textfield',
				'desc' => __( 'Use <strong>[price]</strong> as placeholder for the price and <strong>[link]</strong>linktext<strong>[/link]</strong> as placeholder for the link or <strong>[button]</strong>buttontext<strong>[/button]</strong> to use a button instead of a link.', 'wp24-domain-check' ) . '<br>' .
					__( 'Use <strong>[link newpage]</strong> or <strong>[button newpage]</strong> to open link in a new window/tab.', 'wp24-domain-check' ),
			)
		);

		/*
		 * woocommerce settings
		 */
		add_settings_section( 'section_woocommerce', '', '', 'settings_woocommerce' );
		// enabled
		add_settings_field(
			'woocommerce_enabled',
			__( 'Integration', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_woocommerce',
			'section_woocommerce',
			array(
				'name'		=> 'woocommerce',
				'subname'	=> 'enabled',
				'type'		=> 'checkbox',
				'label'		=> __( 'Enabled', 'wp24-domain-check' ),
				'desc'		=> __( 'If enabled prices &amp; links will be disabled.', 'wp24-domain-check' ),
			)
		);
		// addToCartBehaviour
		add_settings_field(
			'woocommerce_addToCartBehaviour',
			__( 'Add to cart behaviour', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_woocommerce',
			'section_woocommerce',
			array(
				'name'		=> 'woocommerce',
				'subname'	=> 'addToCartBehaviour',
				'type'		=> 'combobox',
				'vals'		=> array(
					0 => __( 'Redirect to cart page', 'wp24-domain-check' ),
					1 => __( 'Stay on current page (links)', 'wp24-domain-check' ),
					3 => __( 'Stay on current page (checkboxes)', 'wp24-domain-check' ),
					2 => __( 'Redirect to custom page', 'wp24-domain-check' ),
				),
			)
		);
		// customPageLink
		add_settings_field(
			'woocommerce_customPageLink',
			__( 'Custom page link', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_woocommerce',
			'section_woocommerce',
			array(
				'name' 		=> 'woocommerce',
				'subname'	=> 'customPageLink',
				'type'		=> 'textfield',
			)
		);
		// addToCartText
		add_settings_field(
			'woocommerce_addToCartText',
			__( 'Add to cart text', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_woocommerce',
			'section_woocommerce',
			array(
				'name' 		=> 'woocommerce',
				'subname'	=> 'addToCartText',
				'type'		=> 'textfield',
			)
		);
		// addedToCartText
		add_settings_field(
			'woocommerce_addedToCartText',
			__( 'Added to cart text', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_woocommerce',
			'section_woocommerce',
			array(
				'name' 		=> 'woocommerce',
				'subname'	=> 'addedToCartText',
				'type'		=> 'textfield',
				'desc'		=> __( 'Change link or button text to this text after adding domain to cart.', 'wp24-domain-check' ),
			)
		);
		// domainLabel
		add_settings_field(
			'woocommerce_domainLabel',
			__( 'Domain label', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_woocommerce',
			'section_woocommerce',
			array(
				'name' 		=> 'woocommerce',
				'subname'	=> 'domainLabel',
				'type'		=> 'textfield',
				'desc'		=> __( 'Labeling in front of the domain, under the product name in the shopping cart and the order.', 'wp24-domain-check' ),
			)
		);
		
		// purchase
		add_settings_section( 'section_woocommerce_purchase', __( 'Purchase (for available domains)', 'wp24-domain-check' ), '', 'settings_woocommerce' );
		// productidPurchase
		add_settings_field(
			'woocommerce_productidPurchase',
			__( 'Purchase product', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_woocommerce',
			'section_woocommerce_purchase',
			array(
				'name'		=> 'woocommerce',
				'subname'	=> 'productidPurchase',
				'type'		=> 'combobox',
				'vals' 		=> $this->woocommerce_products
			)
		);
		// textPurchase
		add_settings_field(
			'woocommerce_textPurchase',
			__( 'Purchase text', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_woocommerce',
			'section_woocommerce_purchase',
			array(
				'name'		=> 'woocommerce',
				'subname'	=> 'textPurchase',
				'type'		=> 'textfield',
				'desc'		=> __( 'Use <strong>[price]</strong> as placeholder for the price and <strong>[link]</strong>linktext<strong>[/link]</strong> as placeholder for the link or <strong>[button]</strong>buttontext<strong>[/button]</strong> to use a button instead of a link.', 'wp24-domain-check' ) . '<br>' .
					__( 'Use <strong>[link newpage]</strong> or <strong>[button newpage]</strong> to open link in a new window/tab.', 'wp24-domain-check' ),
			)
		);

		// transfer
		add_settings_section( 'section_woocommerce_transfer', __( 'Transfer (for registered domains)', 'wp24-domain-check' ), '', 'settings_woocommerce' );
		// transferEnabled
		add_settings_field(
			'woocommerce_transferEnabled',
			__( 'Transfer', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_woocommerce',
			'section_woocommerce_transfer',
			array(
				'name'		=> 'woocommerce',
				'subname'	=> 'transferEnabled',
				'type'		=> 'checkbox',
				'label'		=> __( 'Enabled', 'wp24-domain-check' ),
			)
		);
		// productidTransfer
		add_settings_field(
			'woocommerce_productidTransfer',
			__( 'Transfer product', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_woocommerce',
			'section_woocommerce_transfer',
			array(
				'name'		=> 'woocommerce',
				'subname'	=> 'productidTransfer',
				'type'		=> 'combobox',
				'vals' 		=> $this->woocommerce_products
			)
		);
		// textTransfer
		add_settings_field(
			'woocommerce_textTransfer',
			__( 'Transfer text', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_woocommerce',
			'section_woocommerce_transfer',
			array(
				'name'		=> 'woocommerce',
				'subname'	=> 'textTransfer',
				'type' 		=> 'textfield',
				'desc' 		=> __( 'Use <strong>[price]</strong> as placeholder for the price and <strong>[link]</strong>linktext<strong>[/link]</strong> as placeholder for the link or <strong>[button]</strong>buttontext<strong>[/button]</strong> to use a button instead of a link.', 'wp24-domain-check' ) . '<br>' .
					__( 'Use <strong>[link newpage]</strong> or <strong>[button newpage]</strong> to open link in a new window/tab.', 'wp24-domain-check' ),
			)
		);
		// suffixTransfer
		add_settings_field(
			'woocommerce_suffixTransfer',
			__( 'Transfer suffix', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_woocommerce',
			'section_woocommerce_transfer',
			array(
				'name' 		=> 'woocommerce',
				'subname'	=> 'suffixTransfer',
				'type'		=> 'textfield',
				'desc'		=> __( 'Suffix after the domain, under the product name in the shopping cart and the order.', 'wp24-domain-check' ),
			)
		);

		/*
		 * recaptcha settings
		 */
		add_settings_section( 'section_recaptcha', '', '', 'settings_recaptcha' );
		// type
		add_settings_field(
			'recaptcha_type',
			__( 'Type', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_recaptcha',
			'section_recaptcha',
			array(
				'name'		=> 'recaptcha',
				'subname'	=> 'type',
				'type'		=> 'radiobuttons',
				'desc'		=> __( 'See', 'wp24-domain-check' ) . ': <a href="https://developers.google.com/recaptcha/docs/versions">https://developers.google.com/recaptcha/docs/versions</a>',
				'vals'		=> array(
					'none'		=> __( 'None' , 'wp24-domain-check' ),
					'v2_check'	=> __( 'Version 2 ("I\'m not a robot" Checkbox)' , 'wp24-domain-check' ),
					'v2_badge'	=> __( 'Version 2 (Invisible badge)' , 'wp24-domain-check' ),
					'v3'		=> __( 'Version 3' , 'wp24-domain-check' ),
				),
			)
		);
		// site key
		add_settings_field(
			'recaptcha_siteKey',
			__( 'Site key', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_recaptcha',
			'section_recaptcha',
			array(
				'name'		=> 'recaptcha',
				'subname'	=> 'siteKey',
				'type'		=> 'textfield',
			)
		);
		// secret key
		add_settings_field(
			'recaptcha_secretKey',
			__( 'Secret key', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_recaptcha',
			'section_recaptcha',
			array(
				'name'		=> 'recaptcha',
				'subname'	=> 'secretKey',
				'type'		=> 'textfield',
			)
		);
		// theme
		add_settings_field(
			'recaptcha_theme',
			__( 'Theme', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_recaptcha',
			'section_recaptcha',
			array(
				'name'		=> 'recaptcha',
				'subname'	=> 'theme',
				'type'		=> 'radiobuttons',
				'vals'		=> array(
					'light'	=> __( 'Light', 'wp24-domain-check' ),
					'dark'	=> __( 'Dark', 'wp24-domain-check' ),
				),
			)
		);
		// size
		add_settings_field(
			'recaptcha_size',
			__( 'Size', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_recaptcha',
			'section_recaptcha',
			array(
				'name'		=> 'recaptcha',
				'subname'	=> 'size',
				'type'		=> 'radiobuttons',
				'vals'		=> array(
					'normal'	=> __( 'Normal', 'wp24-domain-check' ),
					'compact'	=> __( 'Compact', 'wp24-domain-check' ),
				),
			)
		);
		// position
		add_settings_field(
			'recaptcha_position',
			__( 'Position', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_recaptcha',
			'section_recaptcha',
			array(
				'name'		=> 'recaptcha',
				'subname'	=> 'position',
				'type'		=> 'radiobuttons',
				'vals'		=> array(
					'bottomright'	=> __( 'Bottom right', 'wp24-domain-check' ),
					'bottomleft'	=> __( 'Bottom left', 'wp24-domain-check' ),
				),
			)
		);
		// score
		add_settings_field(
			'recaptcha_score',
			__( 'Score', 'wp24-domain-check' ),
			array( $this, 'inputfield' ),
			'settings_recaptcha',
			'section_recaptcha',
			array(
				'name'		=> 'recaptcha',
				'subname'	=> 'score',
				'type'		=> 'numberfield',
				'max'		=> 1,
				'step'		=> 0.1,
				'desc'		=> __( 'Cancel request if score is lower than this value.<br>(1.0 is very likely a good interaction, 0.0 is very likely a bot.)', 'wp24-domain-check' ),
			)
		);
		// text / color
		add_settings_field(
			'recaptcha_text_recaptcha_color',
			__( 'Text / Color', 'wp24-domain-check' ),
			array( $this, 'compositefield' ),
			'settings_recaptcha',
			'section_recaptcha',
			array(
				array(
					'name'		=> 'recaptcha',
					'subname'	=> 'text',
					'type'		=> 'textfield',
				),
				array(
					'name'		=> 'recaptcha',
					'subname'	=> 'color',
					'type'		=> 'colorfield',
					'desc'		=> __( 'Text and color for message in case of failed check.', 'wp24-domain-check' ),
				),
			)
		);
	}

	/**
	 * Init settings menu.
	 * 
	 * @return void
	 */
	public function init_menu() {
		add_options_page(
			'WP24 Domain Check ' . __( 'Settings', 'wp24-domain-check' ),
			'WP24 Domain Check',
			'manage_options',
			'wp24_domaincheck_settings',
			array( $this, 'get_html' )
		);
	}

	/**
	 * Generate html for setting pages.
	 * 
	 * @return void
	 */
	public function get_html() {
		if ( ! current_user_can( 'manage_options' ) )
			wp_die( __( 'You do not have sufficient permissions to access this page.', 'wp24-domain-check' ) );

		// organize settings in tabs
		$tabs = array();
		$tabs['general'] = __( 'General Settings', 'wp24-domain-check' );
		$tabs['advanced'] = __( 'Advanced Settings', 'wp24-domain-check' );
		$tabs['texts_colors'] = __( 'Texts &amp; Colors', 'wp24-domain-check' );
		$tabs['prices_links'] = __( 'Prices &amp; Links', 'wp24-domain-check' );
		$tabs['woocommerce'] = __( 'WooCommerce', 'wp24-domain-check' );
		$tabs['whoisservers'] = __( 'Whois Servers', 'wp24-domain-check' );
		$tabs['recaptcha'] = __( 'reCAPTCHA', 'wp24-domain-check' );
		$tabs['system_info'] = __( 'System Info', 'wp24-domain-check' );
		$tabs['help'] = __( 'Help', 'wp24-domain-check' );
		$active_tab = isset( $_GET['tab'] ) ? sanitize_key( $_GET['tab'] ) : 'general';

		echo '<div class="wrap">';
		echo '<h1>' . esc_html( get_admin_page_title() ) . '</h1>';

		if ( isset( $_GET['settings-updated'] ) && 'general' == $active_tab && isset( $this->limited_tlds['centralnic'] ) ) {
			// info about query limited domains
			echo '<div class="notice notice-info is-dismissible"><p>';
			printf(
				__( '%1$s TLDs have a query limit: %2$s.', 'wp24-domain-check' ),
				count( $this->limited_tlds['centralnic'] ),
				implode( ', ', $this->limited_tlds['centralnic'] )
			);
			echo '<br>';
			printf(
				__( 'Only %1$s queries per hour overall are possible for those domains.', 'wp24-domain-check' ),
				$this->options['query_limits']['centralnic']
			);
			echo '<br>' . __( 'See', 'wp24-domain-check' );
			echo ': <a href="https://registrar-console.centralnic.com/pub/whois_guidance">https://registrar-console.centralnic.com/pub/whois_guidance</a>';
			echo '</p></div>';

			// warning for trusted sources
			if ( $this->options['query_limits']['centralnic'] == 7200 ) {
				echo '<div class="notice notice-warning is-dismissible"><p>';
				printf(
					__( 'CentralNic %1$strusted sources%2$s are those that are present on the access list of a registrar!', 'wp24-domain-check' ),
					'<strong>',
					'</strong>'
				);
				echo '</p></div>';
			}
		}

		if ( 'none' != $this->options['recaptcha']['type'] && ( empty( $this->options['recaptcha']['siteKey'] ) || empty( $this->options['recaptcha']['secretKey'] ) ) ) {
			// error for missing recaptcha site or secret key
			echo '<div class="notice notice-error is-dismissible"><p>';
			echo __( 'reCAPTCHA is enabled, but no site or secret key is set.', 'wp24-domain-check' );
			echo '</p></div>';
		}

		if ( $this->options['updateMessage'] ) {
			if ( isset( $_GET['dismiss-update-message'] ) ) {
				// dismiss message
				$this->options['updateMessage'] = false;
				update_option( 'wp24_domaincheck', $this->options );
			}
			else {
				// info about review, donate and help
				echo '<div class="notice notice-info"><p>';
				printf(
					__( 'If you like WP24 Domain Check, leave a positive <a href="%1$s">review</a>, support the development with a <a href="%2$s">donation</a>. Check the <a href="%3$s">forum</a> if you need help or have suggestions for improvements.', 'wp24-domain-check' ),
					'https://wordpress.org/support/plugin/wp24-domain-check/reviews/?rate=5#new-post',
					'https://wp24.org/donate',
					'https://wordpress.org/support/plugin/wp24-domain-check/'
				);
				echo ' <a href="' . admin_url( 'options-general.php?page=wp24_domaincheck_settings&tab=' . $active_tab ) . '&dismiss-update-message">' . __( 'Dismiss', 'wp24-domain-check' ) . '</a>.';
				echo '</p></div>';
			}
		}

		// tab navigation
		echo '<h2 class="nav-tab-wrapper">';
		foreach ( $tabs as $tab => $label ) {
			$url = admin_url( 'options-general.php?page=wp24_domaincheck_settings&tab=' . $tab );
			$active = $tab == $active_tab ? ' nav-tab-active' : '';
			echo '<a href="' . $url . '" class="nav-tab' . $active . '">' . $label . '</a>';
		}
		echo '</h2>';
		// tab pages
		switch ( $active_tab ) {
			case 'general':
				echo '<h2>Shortcode</h2>';
				echo '<p>';
				echo __( 'Simply insert this shortcode <code>[wp24_domaincheck]</code> into any post or page to display the domain check.', 'wp24-domain-check' );
				echo '<br>';
				echo __( 'Use <code>[wp24_domaincheck tlds="com, net, org"]</code> to configure TLDs differing from the settings.', 'wp24-domain-check' );
				echo '<br>';
				echo __( 'Use <code>[wp24_domaincheck mode="whois"]</code> to directly show the whois data.', 'wp24-domain-check' );
				echo '</p>';
				echo '<form action="options.php" method="post">';
				// flag for validate function
				echo '<input type="hidden" name="update_general_settings" value="1">';
				settings_fields( 'wp24_domaincheck' );
				do_settings_sections( 'settings_general' );
				submit_button();
				echo '</form>';
				break;
			case 'advanced':
				echo '<form action="options.php" method="post">';
				// flag for validate function
				echo '<input type="hidden" name="update_advanced_settings" value="1">';
				settings_fields( 'wp24_domaincheck' );
				do_settings_sections( 'settings_advanced' );
				submit_button();
				echo '</form>';
				break;
			case 'texts_colors':
				echo '<p>' . __( 'Text and colors for the different statuses returned by domain checks.', 'wp24-domain-check' ) . '</p>';
				echo '<form action="options.php" method="post">';
				settings_fields( 'wp24_domaincheck' );
				do_settings_sections( 'settings_texts_colors' );
				submit_button();
				echo '</form>';
				break;
			case 'prices_links':
				$this->prices_links();
				break;
			case 'woocommerce':
				$this->woocommerce();
				break;
			case 'whoisservers':
				$this->whoisservers();
				break;
			case 'recaptcha':
				echo '<form action="options.php" method="post">';
				settings_fields( 'wp24_domaincheck' );
				do_settings_sections( 'settings_recaptcha' );
				submit_button();
				echo '</form>';
				break;
			case 'system_info':
				$this->system_info();
				break;
			case 'help':
				$this->help();
				break;
		}
		echo '</div>';
	}

	/**
	 * Generate html for input fields.
	 * 
	 * @param array $args 
	 * @return void
	 */
	public function inputfield( $args ) {
		// get inputfield properties
		$name = $args['name'];
		$subname = isset( $args['subname'] ) ? $args['subname'] : '';
		$type = $args['type'];
		$desc = isset( $args['desc'] ) ? $args['desc'] : '';
		if ( '' !== $subname ) {
			$value = isset( $this->options[ $name ][ $subname ] ) ? $this->options[ $name ][ $subname ] : NULL;
			$subname = '[' . $subname . ']';
		}
		else
			$value = $this->options[ $name ];
		$fieldname = 'wp24_domaincheck[' . $name . ']' . $subname;

		switch ( $type ) {
			case 'textfield':
				echo '<input type="text" name="' . $fieldname . '" value="' . $value . '" class="regular-text">';
				break;
			case 'textarea':
				echo '<textarea name="' . $fieldname . '" rows="5" cols="50">' . $value . '</textarea>';
				break;
			case 'checkbox':
				$label = isset( $args['label'] ) ? $args['label'] : '';

				echo '<label for="' . $fieldname . '">';
				echo '<input type="checkbox" name="' . $fieldname . '" id="' . $fieldname . '" value="1" ' . checked( $value, 1, false ) . '>';
				echo '' != $label ? ' ' . $label : '';
				echo '</label>';
				break;
			case 'radiobuttons':
				$vals = isset( $args['vals'] ) ? $args['vals'] : '';
				foreach ( $vals as $val => $label ) {
					echo '<p>';
					echo '<input type="radio" name="' . $fieldname . '" id="' . $name . '_' . $val . '" value="' . $val . '" ' . checked( $value, $val, false ) . '>';
					echo '<label for="' . $name . '_' . $val . '">' . $label . '</label>';
					echo '</p>';
				}
				break;
			case 'combobox':
				$vals = isset( $args['vals'] ) ? $args['vals'] : '';
				echo '<select name="' . $fieldname . '" style="vertical-align: baseline">';
				foreach ( $vals as $val => $label ) {
					echo '<option value="' . $val . '"' . selected( $value, $val, false ) . '>' . $label . '</option>';
				}
				echo '</select>';
				break;
			case 'numberfield':
				$max = isset( $args['max'] ) ? ' max="' . $args['max'] . '"' : '';
				$step = isset( $args['step'] ) ? ' step="' . $args['step'] . '"' : '';

				echo '<input type="number" name="' . $fieldname . '" value="' . $value . '" min="0"' . $max . $step . ' class="small-text">';
				break;
			case 'colorfield':
				echo '<p><input type="text" name="' . $fieldname . '" value="' . $value . '" class="colorPicker"></p>';
				break;
		}

		// description text below the field
		if ( ! empty( $desc ) )
			echo '<p class="description">' . $desc . '</p>';
	}

	/**
	 * Combination of two input fields.
	 * 
	 * @param array $args 
	 * @return void
	 */
	public function compositefield( $args ) {
		foreach ( $args as $inputfield ) {
			$this->inputfield( $inputfield );
		}
	}

	/**
	 * Validate settings before saving.
	 * 
	 * @param array $input 
	 * @return array New Options.
	 */
	public function validate( $input ) {
		global $wpdb;
		require_once( dirname( __DIR__ ) . '/assets/inc/class-whoisservers.php' );

		if ( ! isset( $input ) )
			$input = array();

		// iterate options input
		foreach ( $input as $key => $val ) {
			// skip boolean fields
			if ( in_array( $key, array( 'checkAll', 'checkAllDefault', 'multicheck', 'showWhois', 'excludeRegistered', 'linkRegistered', 'dotInSelect', 'useNonces', 'multipleUse', 'removeWhoisComments', 'htmlForm', 'hooksEnabled', 'priceEnabled', 'linkEnabled', 'priceTransferEnabled', 'linkTransferEnabled' ) ) )
				continue;

			if ( 'tlds' == $key ) {
				$unsupported_tlds = array();
				// clean up input string
				$val = trim( $this->sanitize_string( $val ), ',' );
				// remove leading points and duplicates
				$val = implode( ', ', array_unique( array_map( function( $s ) {
					$s = trim( trim( $s ), '.' );
					if ( '[' !== substr( $s, 0, 1 ) )
						$s = strtolower( $s );
					return $s;
				}, explode( ',', $val ) ) ) );
				// check if a whois server exists for every tld
				$tlds = explode( ',', str_replace( ' ', '', $val ) );
				foreach ( $tlds as $tld ) {
					// ignore optgroups
					if ( '[' === substr( $tld, 0, 1 ) )
						continue;
					$whoisserver = WP24_Domain_Check_Whoisservers::get_whoisserver( $tld );
					if ( ! $whoisserver ) {
						// check custom whois servers
						$query_count = $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->prefix}wp24_whois_servers WHERE tld = '" . $tld . "'" );
						if ( $query_count == 0 )
							$unsupported_tlds[] = $tld;
					}
				}
				if ( empty( trim( $val ) ) )
					add_settings_error( 'tlds', esc_attr( 'settings_error' ), __( 'no TLDs set', 'wp24-domain-check' ) );
				else if ( ! empty( $unsupported_tlds ) ) {
					if ( ! $this->options['unsupported']['enabled'] ) {
						add_settings_error( 'tlds', esc_attr( 'settings_error' ), implode( ', ', $unsupported_tlds ) .
							' ' . __( 'not supported', 'wp24-domain-check' ) . '.<br>' .
							__( 'Hint: Enable "Unsupported TLDs" in the advanced settings.', 'wp24-domain-check' ) );
					}
					else {
						add_settings_error( 'tlds', esc_attr( 'settings_error' ), __( 'No whois server available for', 'wp24-domain-check' ) .
							' ' . implode( ', ', $unsupported_tlds ) . '.<br>' .
							__( 'Check result may not be a 100 percent correct.', 'wp24-domain-check' ) .
							' <a href="https://wp24.org/plugins/domain-check/faq.html">' . __( 'Read more', 'wp24-domain-check') . '</a>.', 'warning' );
					}
				}

				$this->options[ $key ] = $val;
				continue;
			}

			if ( is_array( $val ) ) {
				// options contains subname (multidimensional array)
				foreach ( $val as $key_sub => $val_sub ) {
					// skip boolean fields
					if ( in_array( $key_sub, array( 'enabled', 'verify', 'transferEnabled' ) ) )
						continue;
					$this->options[ $key ][ $key_sub ] = ( isset( $input[ $key ][ $key_sub ] ) ) ? $this->sanitize_string( $val_sub ) : '';
				}
			}
			else {
				$val = ( isset( $input[ $key ] ) ) ? $val : '';
				if ( 'color' == substr( $key, 0, 5 ) )
					$val = sanitize_hex_color( $val );
				else
					$val = $this->sanitize_string( $val );
				$this->options[ $key ] = $val;
			}
		}

		// submit the checkbox fields always
		if ( isset( $_POST['update_general_settings'] ) ) {
			$this->options['multicheck'] = isset( $input['multicheck'] );
			$this->options['checkAll'] = isset( $input['checkAll'] );
			$this->options['checkAllDefault'] = isset( $input['checkAllDefault'] );
			$this->options['showWhois'] = isset( $input['showWhois'] );
			$this->options['excludeRegistered'] = isset( $input['excludeRegistered'] );
		}
		else if ( isset( $_POST['update_advanced_settings'] ) ) {
			$this->options['unsupported']['enabled'] = isset( $input['unsupported']['enabled'] );
			$this->options['unsupported']['verify'] = isset( $input['unsupported']['verify'] );
			$this->options['linkRegistered'] = isset( $input['linkRegistered'] );
			$this->options['dotInSelect'] = isset( $input['dotInSelect'] );
			$this->options['useNonces'] = isset( $input['useNonces'] );
			$this->options['multipleUse'] = isset( $input['multipleUse'] );
			$this->options['htmlForm'] = isset( $input['htmlForm'] );
			$this->options['removeWhoisComments'] = isset( $input['removeWhoisComments'] );
			$this->options['hooksEnabled'] = isset( $input['hooksEnabled'] );
		}
		else if ( isset( $_POST['update_prices_links'] ) ) {
			$this->options['priceEnabled'] = isset( $input['priceEnabled'] );
			$this->options['linkEnabled'] = isset( $input['linkEnabled'] );
			$this->options['priceTransferEnabled'] = isset( $input['priceTransferEnabled'] );
			$this->options['linkTransferEnabled'] = isset( $input['linkTransferEnabled'] );
		}
		else if ( isset( $_POST['update_woocommerce'] ) ) {
			$this->options['woocommerce']['enabled'] = isset( $input['woocommerce']['enabled'] );
			$this->options['woocommerce']['transferEnabled'] = isset( $input['woocommerce']['transferEnabled'] );
		}

		return $this->options;
	}

	/**
	 * Replace illegal chars from string.
	 * 
	 * @param string $string 
	 * @return string Clean string.
	 */
	private function sanitize_string( $string ) {
		return preg_replace( "/['\";]/", '', sanitize_text_field( $string ) );
	}

	/**
	 * Prices and links page.
	 * 
	 * @return void
	 */
	private function prices_links() {
		global $wpdb;

		if ( $this->options['woocommerce']['enabled'] ) {
			echo '<p>' . __( 'WooCommerce integration enabled, disable to use prices &amp; links.', 'wp24-domain-check' ) . '</p>';
			return;
		}

		// settings
		echo '<form action="options.php" method="post">';
		// flag for validate function
		echo '<input type="hidden" name="update_prices_links" value="1">';
		settings_fields( 'wp24_domaincheck' );
		do_settings_sections( 'settings_prices_links' );
		submit_button();
		echo '</form>';

		if ( ! $this->options['priceEnabled'] && ! $this->options['linkEnabled'] &&
			 ! $this->options['priceTransferEnabled'] && ! $this->options['linkTransferEnabled'] )
			return;

		// save or delete tld
		if ( isset( $_POST['tld'] ) && ! empty( $_POST['tld'] ) ) {
			$tld = strtolower( sanitize_text_field( $_POST['tld'] ) );
			if ( isset( $_POST['save'] ) ) {
				$price = isset( $_POST['price'] ) ? sanitize_text_field( $_POST['price'] ) : '';
				$link = isset( $_POST['link'] ) ? sanitize_text_field( $_POST['link'] ) : '';
				$price_transfer = isset( $_POST['price_transfer'] ) ? sanitize_text_field( $_POST['price_transfer'] ) : '';
				$link_transfer = isset( $_POST['link_transfer'] ) ? sanitize_text_field( $_POST['link_transfer'] ) : '';

				if ( ! empty( $price ) || ! empty( $link ) || ! empty( $price_transfer ) || ! empty( $link_transfer ) ) {
					$wpdb->replace( $wpdb->prefix . 'wp24_tld_prices_links', array(
						'tld' => $tld,
						'price' => ! empty( $price ) ? $price : '',
						'link' => ! empty( $link ) ? $link : '',
						'price_transfer' => ! empty( $price_transfer ) ? $price_transfer : '',
						'link_transfer' => ! empty( $link_transfer ) ? $link_transfer : '',
					) );
				}
			}
			else if ( isset( $_POST['delete'] ) )
				$wpdb->delete( $wpdb->prefix . 'wp24_tld_prices_links', array( 'tld' => $tld ) );
		}

		echo '<h2 class="title">' . __( 'Individual TLD settings', 'wp24-domain-check' ) . '</h2>';
		echo '<form action="' . $_SERVER['REQUEST_URI'] . '" method="post">';
		echo '<table class="wp-list-table widefat striped">';
		echo '<thead><tr>';
		echo '<th>' . __( 'TLD', 'wp24-domain-check' ) . '</th>';
		if ( $this->options['priceEnabled'] || $this->options['priceTransferEnabled'] )
			echo '<th>' . __( 'Price', 'wp24-domain-check' ) . '</th>';
		if ( $this->options['linkEnabled'] || $this->options['linkTransferEnabled'] )
			echo '<th>' . __( 'Link', 'wp24-domain-check' ) . '</th>';
		echo '<th>&nbsp;</th>';
		echo '</tr></thead>';

		// edit tld
		echo '<tr>';
		echo '<td><input type="text" required name="tld" maxlength="25"></td>';
		if ( $this->options['priceEnabled'] || $this->options['priceTransferEnabled'] ) {
			echo '<td>';
			if ( $this->options['priceEnabled'] )
				echo '<div>' . __( 'Purchase price', 'wp24-domain-check' ) . ':<br><input type="text" name="price" maxlength="25"></div>';
			if ( $this->options['priceTransferEnabled'] )
				echo '<div>' . __( 'Transfer price', 'wp24-domain-check' ) . ':<br><input type="text" name="price_transfer" maxlength="25"></div>';
			echo '<p class="description">' . __( 'Leave empty to use default price.', 'wp24-domain-check' ) . '</p>';
			echo '</td>';
		}
		if ( $this->options['linkEnabled'] || $this->options['linkTransferEnabled'] ) {
			echo '<td>';
			if ( $this->options['linkEnabled'] )
				echo '<div>' . __( 'Purchase link', 'wp24-domain-check' ) . ':<br><input type="text" class="regular-text" name="link"></div>';
			if ( $this->options['linkTransferEnabled'] )
				echo '<div>' . __( 'Transfer link', 'wp24-domain-check' ) . ':<br><input type="text" class="regular-text" name="link_transfer"></div>';
			echo '<p class="description">' . __( 'Leave empty to use default link.', 'wp24-domain-check' ) . '<br>' . __( 'Use <strong>[domain]</strong> as placeholder for the domain name.', 'wp24-domain-check' ) . '</p>';
			echo '</td>';
		}
		echo '<td>';
		echo '<input type="submit" name="save" class="button button-primary" value="' . __( 'Save', 'wp24-domain-check' ) . '">';
		echo '&nbsp;';
		echo '<input type="submit" name="delete" class="button button-secondary" value="' . __( 'Delete', 'wp24-domain-check' ) . '">';
		echo '</td>';
		echo '</tr>';

		// list tlds
		$rows = $wpdb->get_results( "SELECT tld, price, link, price_transfer, link_transfer FROM {$wpdb->prefix}wp24_tld_prices_links" );
		foreach ( $rows as $row ) {
			$tld = $row->tld;
			$price = empty( $row->price ) ? $this->options['priceDefault'] : $row->price;
			$link = empty( $row->link ) ? $this->options['linkDefault'] : $row->link;
			$link = str_replace( '[tld]', $tld, $link );
			$link = str_replace( '&', '&amp;', $link );
			$price_transfer = empty( $row->price_transfer ) ? $this->options['priceTransferDefault'] : $row->price_transfer;
			$link_transfer = empty( $row->link_transfer ) ? $this->options['linkTransferDefault'] : $row->link_transfer;
			$link_transfer = str_replace( '[tld]', $tld, $link_transfer );
			$link_transfer = str_replace( '&', '&amp;', $link_transfer );

			echo '<tr>';
			echo '<td><strong>' . $tld . '</strong></td>';
			if ( $this->options['priceEnabled'] || $this->options['priceTransferEnabled'] ) {
				echo '<td>';
				if ( $this->options['priceEnabled'] )
					echo '<div>' . __( 'P', 'wp24-domain-check' ) . ': ' . ( empty( $price ) ? '<span class="dashicons dashicons-warning"></span>' : $price ) . '</div>';
				if ( $this->options['priceTransferEnabled'] )
					echo '<div>' . __( 'T', 'wp24-domain-check' ) . ': ' . ( empty( $price_transfer ) ? '<span class="dashicons dashicons-warning"></span>' : $price_transfer ) . '</div>';
				echo '</td>';
			}
			if ( $this->options['linkEnabled'] || $this->options['linkTransferEnabled'] ) {
				echo '<td>';
				if ( $this->options['linkEnabled'] )
					echo '<div>' . __( 'P', 'wp24-domain-check' ) . ': ' . ( empty( $link ) ? '<span class="dashicons dashicons-warning"></span>' : $link ) . '</div>';
				if ( $this->options['linkTransferEnabled'] )
					echo '<div>' . __( 'T', 'wp24-domain-check' ) . ': ' . ( empty( $link_transfer ) ? '<span class="dashicons dashicons-warning"></span>' : $link_transfer ) . '</div>';
				echo '</td>';
			}
			echo '<td><a href="javascript: void(0);" onclick="editTldPriceLink(\'' . $tld . '\', \'' . $price . '\', \'' . $link . '\', \'' . $price_transfer . '\', \'' . $link_transfer . '\'); return false;">' . __( 'Edit', 'wp24-domain-check' ) . '</a></td>';
			echo '</tr>';
		}
		echo '</table>';
		echo '</form>';
	}

	/**
	 * WooCommerce page.
	 * 
	 * @return void
	 */
	private function woocommerce() {
		global $wpdb;

		if ( ! class_exists( 'woocommerce' ) ) {
			echo '<p>' . __( 'WooCommerce plugin is not activated or installed.', 'wp24-domain-check' ) . '</p>';
			return;
		}

		// settings
		echo '<form action="options.php" method="post">';
		// flag for validate function
		echo '<input type="hidden" name="update_woocommerce" value="1">';
		settings_fields( 'wp24_domaincheck' );
		do_settings_sections( 'settings_woocommerce' );
		submit_button();
		echo '</form>';

		if ( ! $this->options['woocommerce']['enabled'] )
			return;

		// save or delete tld
		if ( isset( $_POST['tld'] ) && ! empty( $_POST['tld'] ) ) {
			$tld = trim( strtolower( sanitize_text_field( $_POST['tld'] ) ), '.' );
			if ( isset( $_POST['save'] ) ) {
				$product_id_purchase = isset( $_POST['product_id_purchase'] ) ? sanitize_key( $_POST['product_id_purchase'] ) : '';
				$product_id_transfer = isset( $_POST['product_id_transfer'] ) ? sanitize_key( $_POST['product_id_transfer'] ) : '';

				if ( ! empty( $product_id_purchase ) || ! empty( $product_id_transfer ) ) {
					$wpdb->replace( $wpdb->prefix . 'wp24_tld_woocommerce', array(
						'tld' => $tld,
						'product_id_purchase' => ! empty( $product_id_purchase ) ? $product_id_purchase : 0,
						'product_id_transfer' => ! empty( $product_id_transfer ) ? $product_id_transfer : 0,
					) );
				}
			}
			else if ( isset( $_POST['delete'] ) )
				$wpdb->delete( $wpdb->prefix . 'wp24_tld_woocommerce', array( 'tld' => $tld ) );
		}

		echo '<h2 class="title">' . __( 'Individual TLD settings', 'wp24-domain-check' ) . '</h2>';
		echo '<form action="' . $_SERVER['REQUEST_URI'] . '" method="post">';
		echo '<table class="wp-list-table widefat striped">';
		echo '<thead><tr>';
		echo '<th>' . __( 'TLD', 'wp24-domain-check' ) . '</th>';
		echo '<th>' . __( 'Purchase product', 'wp24-domain-check' ) . '</th>';
		if ( $this->options['woocommerce']['transferEnabled'] )
			echo '<th>' . __( 'Transfer product', 'wp24-domain-check' ) . '</th>';
		echo '<th>&nbsp;</th>';
		echo '</tr></thead>';

		// edit tld
		echo '<tr>';
		echo '<td><input type="text" required name="tld" maxlength="25"></td>';
		echo '<td>';
		echo '<select name="product_id_purchase" style="vertical-align: baseline">';
		foreach ( $this->woocommerce_products as $product_id => $product_name )
			echo '<option value="' . $product_id . '">' . $product_name . '</option>';
		echo '</select>';
		echo '</td>';
		if ( $this->options['woocommerce']['transferEnabled'] ) {
			echo '<td>';
			echo '<select name="product_id_transfer" style="vertical-align: baseline">';
			foreach ( $this->woocommerce_products as $product_id => $product_name )
				echo '<option value="' . $product_id . '">' . $product_name . '</option>';
			echo '</select>';
			echo '</td>';
		}
		echo '<td>';
		echo '<input type="submit" name="save" class="button button-primary" value="' . __( 'Save', 'wp24-domain-check' ) . '">';
		echo '&nbsp;';
		echo '<input type="submit" name="delete" class="button button-secondary" value="' . __( 'Delete', 'wp24-domain-check' ) . '">';
		echo '</td>';
		echo '</tr>';

		// list tlds
		$rows = $wpdb->get_results( "SELECT tld, product_id_purchase, product_id_transfer FROM {$wpdb->prefix}wp24_tld_woocommerce" );
		foreach ( $rows as $row ) {
			$tld = $row->tld;
			$product_id_purchase = empty( $row->product_id_purchase ) ? 0 : $row->product_id_purchase;
			$product_id_transfer = empty( $row->product_id_transfer ) ? 0 : $row->product_id_transfer;

			echo '<tr>';
			echo '<td><strong>' . $tld . '</strong></td>';
			echo '<td>' . ( empty( $product_id_purchase ) ? '<span class="dashicons dashicons-warning"></span>' : $this->woocommerce_products[ $product_id_purchase ] ) . '</td>';
			if ( $this->options['woocommerce']['transferEnabled'] )
				echo '<td>' . ( empty( $product_id_transfer ) ? '<span class="dashicons dashicons-warning"></span>' :$this->woocommerce_products[ $product_id_transfer ] ) . '</td>';
			echo '<td><a href="javascript: void(0);" onclick="editTldWooCommerce(\'' . $tld . '\', ' . $product_id_purchase . ', ' . $product_id_transfer . '); return false;">' . __( 'Edit', 'wp24-domain-check' ) . '</a></td>';
			echo '</tr>';
		}
		echo '</table>';
		echo '</form>';
	}

	/**
	 * Whois server page.
	 * 
	 * @return void
	 */
	private function whoisservers() {
		global $wpdb;
		require_once( dirname( __DIR__ ) . '/assets/inc/class-whoisservers.php' );
		$whoisservers = WP24_Domain_Check_Whoisservers::get_whoisservers();

		echo '<h2 class="title">' . __( 'Whois Servers', 'wp24-domain-check' ) . '</h2>';
		echo '<table class="form-table">';
		echo '<tr><th>' . __( 'Number of servers / TLDs', 'wp24-domain-check' ) . '</th><td>' . count( $whoisservers ) . '</td></tr>';
		echo '</table>';

		// tld search
		$tld_search = isset( $_POST['tld_search'] ) ? strtolower( sanitize_text_field( $_POST['tld_search'] ) ) : '';
		echo '<h2 class="title">' . __( 'Find', 'wp24-domain-check' ) . '</h2>';
		echo '<p>' . __( 'Enter the desired TLD and check if there is an appropriate server.', 'wp24-domain-check' ) . '</p>';
		echo '<form action="' . $_SERVER['REQUEST_URI'] . '" method="post">';
		echo '<table class="form-table">';
		echo '<tr>';
		echo '<th>' . __( 'TLD', 'wp24-domain-check' ) . '</th>';
		echo '<td>';
		echo '<input type="text" placeholder="com" required pattern="([a-zA-Z0-9-]{2,})(\.[a-zA-Z0-9]{2,})?$" name="tld_search" value="' . $tld_search . '">';
		echo '&nbsp;';
		echo '<input type="submit" class="button button-primary" value="' . __( 'Search', 'wp24-domain-check' ) . '">';
		echo '</td>';
		echo '</tr>';
		echo '</table>';
		echo '</form>';
		if ( ! empty( $tld_search ) ) {
			// search results
			echo '<p>' . __( 'Results with', 'wp24-domain-check') . ' <strong>' . $tld_search . '</strong>:</p>';
			$matches = '';
			$match_count = 0;
			foreach ( $whoisservers as $tld => $whoisserver) {
				if ( $tld_search == $tld ) {
					$matches .= '<span style="color: #0a0; font-weight: bold">' . $tld;
					if ( isset( $whoisserver['host'] ) )
						$matches .= ' (' . $whoisserver['host'] . ')';
					$matches .= '</span><br>';
					$match_count++;
				}
				else if ( preg_match( '/.*' . $tld_search . '.*/', $tld ) ) {
					$matches .= $tld;
					if ( isset( $whoisserver['host'] ) )
						$matches .= ' (' . $whoisserver['host'] . ')';
					$matches .= '<br>';
					$match_count++;
				}
			}
			echo '<p>' . $match_count . ' ' . __( 'TLDs', 'wp24-domain-check' ) . '</p>';
			echo $matches;
		}
		echo '<p><em>' . __( 'If a TLD is missing or the query returns erroneous results, feel free to contact us.', 'wp24-domain-check' ) . '</em></p>';

		// save or delete tld
		if ( isset( $_POST['tld'] ) && ! empty( $_POST['tld'] ) ) {
			$tld = trim( strtolower( sanitize_text_field( $_POST['tld'] ) ), '.' );
			if ( isset( $_POST['save'] ) ) {
				$host = isset( $_POST['host'] ) ? trim( strtolower( sanitize_text_field( $_POST['host'] ) ) ) : '';
				$status_free = isset( $_POST['status_free'] ) ? trim( strtolower( sanitize_text_field( $_POST['status_free'] ) ) ) : '';

				if ( ! empty( $host ) && ! empty( $status_free ) ) {
					$wpdb->replace( $wpdb->prefix . 'wp24_whois_servers', array(
						'tld' => $tld,
						'host' => $host,
						'status_free' => $status_free,
					) );
				}
			}
			else if ( isset( $_POST['delete'] ) )
				$wpdb->delete( $wpdb->prefix . 'wp24_whois_servers', array( 'tld' => $tld ) );
		}

		echo '<h2 class="title">' . __( 'Custom Whois Servers', 'wp24-domain-check' ) . '</h2>';
		printf(
			'<p>' . __( 'Instructions how to add a custom whois server can be found <a href="%1$s">here</a>.', 'wp24-domain-check' ) . '</p>',
			'https://wp24.org/plugins/domain-check/faq.html'
		);
		echo '<form action="' . $_SERVER['REQUEST_URI'] . '" method="post">';
		echo '<table class="wp-list-table widefat striped">';
		echo '<thead><tr>';
		echo '<th>' . __( 'TLD', 'wp24-domain-check' ) . '</th>';
		echo '<th>' . __( 'Whois server', 'wp24-domain-check' ) . '</th>';
		echo '<th>' . __( 'Status free', 'wp24-domain-check' ) . '</th>';
		echo '<th>&nbsp;</th>';
		echo '</tr></thead>';

		// edit tld
		echo '<tr>';
		echo '<td><input type="text" required name="tld" maxlength="25"></td>';
		echo '<td><input type="text" required name="host" maxlength="100" class="regular-text"></td>';
		echo '<td><input type="text" required name="status_free" maxlength="200" class="regular-text"></td>';
		echo '<td>';
		echo '<input type="submit" name="save" class="button button-primary" value="' . __( 'Save', 'wp24-domain-check' ) . '">';
		echo '&nbsp;';
		echo '<input type="submit" name="delete" class="button button-secondary" value="' . __( 'Delete', 'wp24-domain-check' ) . '">';
		echo '</td>';
		echo '</tr>';

		// list tlds
		$override_whoisservers = false;
		$rows = $wpdb->get_results( "SELECT tld, host, status_free FROM {$wpdb->prefix}wp24_whois_servers" );
		foreach ( $rows as $row ) {
			$tld = $row->tld;
			$host = $row->host;
			$status_free = $row->status_free;

			echo '<tr>';
			echo '<td>';
			echo '<strong>' . $tld . '</strong>';
			if ( isset( $whoisservers[ $tld ] ) ) {
				$override_whoisservers = true;
				echo '&nbsp;<span class="dashicons dashicons-warning" aria-hidden="true"></span>';
			}
			echo '</td>';
			echo '<td>' . $host . '</td>';
			echo '<td>' . $status_free . '</td>';
			echo '<td><a href="javascript: void(0);" onclick="editTldWhoisServers(\'' . $tld . '\', \'' . $host . '\', \'' . $status_free . '\'); return false;">' . __( 'Edit', 'wp24-domain-check' ) . '</a></td>';
			echo '</tr>';
		}
		echo '</table>';
		echo '</form>';

		if ( $override_whoisservers ) {
			echo '<p>';
			echo '<span class="dashicons dashicons-warning" aria-hidden="true"></span>&nbsp;';
			echo __( 'Default plugin settings for this TLD are overridden. Slightly slows down the check speed.', 'wp24-domain-check' );
			echo '</p>';
		}

		if ( $override_whoisservers != $this->options['overrideWhoisservers'] ) {
			$this->options['overrideWhoisservers'] = $override_whoisservers;
			update_option( 'wp24_domaincheck', $this->options );
		}
	}

	/**
	 * System info page.
	 * 
	 * @return void
	 */
	private function system_info() {
		// versions informations
		echo '<table class="form-table">';
		echo '<tr><th>WP24 Domain Check</th><td>' . WP24_DOMAIN_CHECK_VERSION . '</td></tr>';
		echo '<tr><th>' . __( 'Database', 'wp24-domain-check' ) . '</th><td>' . WP24_DOMAIN_CHECK_DATABASE_VERSION . '</td></tr>';
		echo '</table>';
		echo '<h2 class="title">' . __( 'System', 'wp24-domain-check' ) . '</h2>';
		echo '<table class="form-table">';
		echo '<tr><th>WordPress</th><td>' . $GLOBALS['wp_version'] . '</td></tr>';
		if ( class_exists( 'woocommerce' ) )
			echo '<tr><th>WooCommerce</th><td>' . WC_VERSION . '</td></tr>';
		echo '<tr><th>PHP</th><td>' . phpversion() . '</td></tr>';
		echo '</table>';

		// server requirements for whois queries
		echo '<h2 class="title">' . __( 'Requirements for whois queries', 'wp24-domain-check' ) . '</h2>';
		echo '<table class="form-table">';
		if ( function_exists( 'fsockopen' ) )
			echo '<tr><th>fsockopen</th><td><span style="color: #0a0">' . __( 'Enabled', 'wp24-domain-check' ) . '</span></td></tr>';
		else
			echo '<tr><th>fsockopen</th><td><span style="color: #a00">' . __( 'Disabled', 'wp24-domain-check' ) . '</span><p class="description">' . __( 'PHP function "fsockopen" must be enabled by your hosting provider.', 'wp24-domain-check' ) . '</p></td></tr>';
		if ( @fsockopen( 'whois.denic.de', 43, $errno, $errstr, 5 ) )
			echo '<tr><th>Port 43</th><td><span style="color: #0a0">' . __( 'Open', 'wp24-domain-check' ) . '</span></td></tr>';
		else
			echo '<tr><th>Port 43</th><td><span style="color: #a00">' . __( 'Locked', 'wp24-domain-check' ) . '</span><p class="description">' . __( 'Port 43 must be unlocked by your hosting provider.', 'wp24-domain-check' ) . '</p></td></tr>';
		echo '</table>';

		// server requirements for rdap queries
		echo '<h2 class="title">' . __( 'Requirements for RDAP queries', 'wp24-domain-check' ) . '</h2>';
		echo '<table class="form-table">';
		if ( ini_get('allow_url_fopen') )
			echo '<tr><th>allow_url_fopen</th><td><span style="color: #0a0">' . __( 'Enabled', 'wp24-domain-check' ) . '</span></td></tr>';
		else if ( function_exists('curl_init') )
			echo '<tr><th>allow_url_fopen</th><td><span style="color: #fa0">' . __( 'Disabled', 'wp24-domain-check' ) . '</span><p class="description">' . __( 'Using cURL as fallback.', 'wp24-domain-check' ) . '</p></td></tr>';
		else
			echo '<tr><th>allow_url_fopen</th><td><span style="color: #a00">' . __( 'Disabled', 'wp24-domain-check' ) . '</span></td></tr>';
		if ( function_exists('curl_init') )
			echo '<tr><th>cURL</th><td><span style="color: #0a0">' . __( 'Enabled', 'wp24-domain-check' ) . '</span></td></tr>';
		else if ( ini_get('allow_url_fopen') )
			echo '<tr><th>cURL</th><td><span style="color: #fa0">' . __( 'Disabled', 'wp24-domain-check' ) . '</span><p class="description">' . __( 'allow_url_fopen is enabled.', 'wp24-domain-check' ) . '</p></td></tr>';
		else
			echo '<tr><th>cURL</th><td><span style="color: #a00">' . __( 'Disabled', 'wp24-domain-check' ) . '</span></td></tr>';
		echo '</table>';
		
		// server requirements for recaptcha
		echo '<h2 class="title">' . __( 'Requirements for reCAPTCHA', 'wp24-domain-check' ) . '</h2>';
		echo '<table class="form-table">';
		if ( ini_get('allow_url_fopen') )
			echo '<tr><th>allow_url_fopen</th><td><span style="color: #0a0">' . __( 'Enabled', 'wp24-domain-check' ) . '</span></td></tr>';
		else if ( function_exists('curl_init') )
			echo '<tr><th>allow_url_fopen</th><td><span style="color: #fa0">' . __( 'Disabled', 'wp24-domain-check' ) . '</span><p class="description">' . __( 'Using cURL as fallback.', 'wp24-domain-check' ) . '</p></td></tr>';
		else
			echo '<tr><th>allow_url_fopen</th><td><span style="color: #a00">' . __( 'Disabled', 'wp24-domain-check' ) . '</span></td></tr>';
		if ( function_exists('curl_init') )
			echo '<tr><th>cURL</th><td><span style="color: #0a0">' . __( 'Enabled', 'wp24-domain-check' ) . '</span></td></tr>';
		else if ( ini_get('allow_url_fopen') )
			echo '<tr><th>cURL</th><td><span style="color: #fa0">' . __( 'Disabled', 'wp24-domain-check' ) . '</span><p class="description">' . __( 'allow_url_fopen is enabled.', 'wp24-domain-check' ) . '</p></td></tr>';
		else
			echo '<tr><th>cURL</th><td><span style="color: #a00">' . __( 'Disabled', 'wp24-domain-check' ) . '</span></td></tr>';
		echo '</table>';
	}

	/**
	 * Help page.
	 * 
	 * @return void
	 */
	private function help() {
		// help
		echo '<h2 class="title">' . __( 'Help', 'wp24-domain-check' ) . '</h2>';
		echo '<p>';
		printf(
			__( 'The frequently asked questions (FAQ) can be found <a href="%1$s">here</a>.', 'wp24-domain-check' ),
			'https://wp24.org/plugins/domain-check/faq.html'
		);
		echo '<br>';
		printf(
			__( 'For other questions or problems take a look at the <a href="%1$s">support forum</a>.', 'wp24-domain-check' ),
			'https://wordpress.org/support/plugin/wp24-domain-check'
		);
		echo '</p>';

		// review
		echo '<h2 class="title">' . __( 'Review', 'wp24-domain-check' ) . '</h2>';
		echo '<p>';
		printf(
			__( 'If you like WP24 Domain Check, <a href="%1$s">click here</a> to leave a positive review.', 'wp24-domain-check' ),
			'https://wordpress.org/support/plugin/wp24-domain-check/reviews/?rate=5#new-post'
		);
		echo '<br>';
		printf(
			__( 'In case you do not like it or have suggestions for improvements <a href="%1$s">click here</a> to send a feedback.', 'wp24-domain-check' ),
			'https://wordpress.org/support/plugin/wp24-domain-check/'
		);
		echo '</p>';

		// support
		echo '<h2 class="title">' . __( 'Support', 'wp24-domain-check' ) . '</h2>';
		echo '<p>';
		echo __( 'If you like this plugin, you could honor the work and support the further development with a donation.', 'wp24-domain-check' );
		echo '<br>';
		printf(
			__( 'For being listed as a <a href="%1$s">supporter</a> leave your name and URL in the corresponding field when donating.', 'wp24-domain-check' ),
			'https://wp24.org/supporters'
		);
		echo '<br><br>';
		echo '<a href="https://wp24.org/donate" class="button button-primary">' . __( 'Donate', 'wp24-domain-check' ) . '</a>';
		echo '</p>';
	}

	/**
	 * Uninstall plugin.
	 * 
	 * @return void
	 */
	public function uninstall() {
		global $wpdb;

		// drop tables
		$table_name = $wpdb->prefix . 'wp24_whois_queries';
		$sql = "DROP TABLE IF EXISTS $table_name";
		$wpdb->query( $sql );
		$table_name = $wpdb->prefix . 'wp24_tld_prices_links';
		$sql = "DROP TABLE IF EXISTS $table_name";
		$wpdb->query( $sql );
		$table_name = $wpdb->prefix . 'wp24_tld_woocommerce';
		$sql = "DROP TABLE IF EXISTS $table_name";
		$wpdb->query( $sql );
		$table_name = $wpdb->prefix . 'wp24_whois_servers';
		$sql = "DROP TABLE IF EXISTS $table_name";
		$wpdb->query( $sql );
		
		// delete all settings
		delete_option( 'wp24_domaincheck' );
	}

}
