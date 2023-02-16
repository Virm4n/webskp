<?php

/**
 * Class with (default) settings.
 */
class WP24_Domain_Check_Options {

	/**
	 * @var object Options instance.
	 */
	private static $instance = null;
	/**
	 * @var array Default options.
	 */
	private $options_default;

	/**
	 * Constructor.
	 * 
	 * @return void
	 */
	private function __construct() {
		// init default options
		$this->options_default = array(
			'fieldLabel'			=> 'www.',
			'fieldPlaceholder'		=> __( 'desired-domain', 'wp24-domain-check' ),
			'fieldWidth'			=> 250,
			'fieldUnit'				=> 'px',
			'fieldnameDomain'		=> 'domaincheck_domain',
			'fieldnameTld'			=> 'domaincheck_tld',
			'selectionType'			=> 'dropdown',
			'tlds'					=> 'com, net, org, info, eu, de, uk, nl, br, fr, it, ca, pl',
			'checkAll'				=> true,
			'checkAllLabel'			=> __( 'all', 'wp24-domain-check' ),
			'checkAllDefault'		=> false,
			'multicheck'			=> false,
			'textButton'			=> __( 'check', 'wp24-domain-check' ),
			'showWhois'				=> false,
			'textWhois'				=> __( 'whois', 'wp24-domain-check' ),
			'displayType'			=> 'default',
			'excludeRegistered'		=> false,
			'textNoResults'			=> __( 'No free domain found.', 'wp24-domain-check' ),
			'displayLimit'			=> 0,
			'textLoadMore'			=> __( 'more', 'wp24-domain-check' ),
			'textAvailable'			=> __( 'is available', 'wp24-domain-check' ),
			'colorAvailable'		=> '#008b00',
			'textRegistered'		=> __( 'is registered', 'wp24-domain-check' ),
			'colorRegistered'		=> '',
			'textError'				=> __( 'error', 'wp24-domain-check' ),
			'colorError'			=> '#8c0000',
			'textInvalid'			=> __( 'is invalid', 'wp24-domain-check' ),
			'colorInvalid'			=> '#8c0000',
			'textLimit'				=> __( 'query limit reached', 'wp24-domain-check' ),
			'colorLimit'			=> '#ff8c00',
			'textWhoisserver'		=> __( 'whois server unknown', 'wp24-domain-check' ),
			'colorWhoisserver'		=> '#8c0000',
			'textUnsupported'		=> __( '.[tld] is not supported', 'wp24-domain-check' ),
			'colorUnsupported'		=> '#ff8c00',
			'textTldMissing'		=> __( 'Please enter a domain extension', 'wp24-domain-check' ),
			'colorTldMissing'		=> '',
			'textEmptyField'		=> '',
			'colorEmptyField'		=> '',
			'textInvalidField'		=> '',
			'colorInvalidField'		=> '',
			'priceEnabled'			=> false,
			'priceDefault'			=> '',
			'linkEnabled'			=> false,
			'linkDefault'			=> '',
			'textPurchase'			=> __( '[link]buy now[/link] for [price]', 'wp24-domain-check' ),
			'priceTransferEnabled'	=> false,
			'priceTransferDefault'	=> '',
			'linkTransferEnabled'	=> false,
			'linkTransferDefault'	=> '',
			'textTransfer'			=> __( '[link]transfer now[/link] for [price]', 'wp24-domain-check' ),
			'prefixes'				=> '',
			'suffixes'				=> '',
			'linkRegistered'		=> false,
			'dotInSelect'			=> false,
			'useNonces'				=> false,
			'multipleUse'			=> false,
			'htmlForm'				=> true,
			'removeWhoisComments'	=> false,
			'hooksEnabled'			=> false,
			'reviewMessage'			=> true,
			'overrideWhoisservers'	=> false,
		);

		// unsupported tlds
		$this->options_default['unsupported'] = array(
			'enabled'		=> false,
			'text'			=> __( 'is probably available', 'wp24-domain-check' ),
			'color'			=> '#008b00',
			'verify'		=> false,
			'verifyText'	=> __( 'verify', 'wp24-domain-check' ),
		);

		// woocommerce options
		$this->options_default['woocommerce'] = array(
			'enabled'				=> false,
			'addToCartBehaviour'	=> 0,
			'customPageLink'		=> '',
			'addToCartText'			=> __( 'add to cart', 'wp24-domain-check' ),
			'addedToCartText'		=> __( 'added to cart', 'wp24-domain-check' ),
			'domainLabel'			=> __( 'Domain', 'wp24-domain-check' ),
			'productidPurchase'		=> 0,
			'textPurchase'			=> __( '[link]buy now[/link] for [price]', 'wp24-domain-check' ),
			'transferEnabled'		=> false,
			'productidTransfer'		=> 0,
			'textTransfer'			=> __( '[link]transfer now[/link] for [price]', 'wp24-domain-check' ),
			'suffixTransfer'		=> __( '(Transfer)', 'wp24-domain-check' ),
		);

		// recaptcha options
		$this->options_default['recaptcha'] = array(
			'type'		=> 'none',
			'siteKey'	=> '',
			'secretKey'	=> '',
			'theme'		=> 'light',
			'size'		=> 'normal',
			'position'	=> 'bottomright',
			'score'		=> 0.5,
			'text'		=> __( 'reCAPTCHA check failed', 'wp24-domain-check' ),
			'color'		=> '#8c0000',
		);

		// query limit options
		$this->options_default['query_limits'] = array(
			'centralnic'	=> 60,
		);
	}

	/**
	 * Get options instance.
	 * 
	 * @return object Options instance.
	 */
	public static function get_instance() {
		if ( null == self::$instance ) {
			self::$instance = new WP24_Domain_Check_Options();
		}
		return self::$instance;
	}

	/**
	 * Get Options.
	 * 
	 * @return array Options.
	 */
	public function get_options() {
		$options = get_option( 'wp24_domaincheck' );
		if ( '' === $options || ! is_array( $options ) )
			return $this->options_default;

		// backward compatibility with v1.8.1
		if ( ! isset( $options['woocommerce']['addToCartBehaviour'] ) && $options['woocommerce']['redirectToCart'] )
			$options['woocommerce']['addToCartBehaviour'] = 0;

		// merge options with defaults if single options missing
		return array_merge( $this->options_default, $options );
	}

}
