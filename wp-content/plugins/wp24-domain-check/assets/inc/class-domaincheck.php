<?php

/**
 * Whois server list.
 */
include_once( 'class-whoisfunctions.php' );
include_once( 'class-whoisservers.php' );

/**
 * Class for performing whois queries.
 */
class WP24_Domain_Check_Domaincheck {

	/**
	 * @var array Domain Check Settings.
	 */
	private $options;

	/**
	 * Constructor.
	 * 
	 * @return void
	 */
	public function __construct( $options ) {
		$this->options = $options;
	}

	/**
	 * Query a whois server.
	 * 
	 * @param string $domain
	 * @param string $tld
	 * @param string $whoisserver
	 * @param string $status_free
	 * @return array Whois entry.
	 */
	private function whois( $domain, $tld, $whoisserver, $status_free ) {
		$array_result = array();
		$string = '';

		try {
			// use own error handler to handle also warnings in fsockopen
			set_error_handler( function ( $severity, $message, $file, $line ) {
				throw new ErrorException( $message, 0, $severity, $file, $line );
			});
			$fp = fsockopen( $whoisserver, 43, $errno, $errstr, 30 );
			// reset error handler function
			restore_error_handler();
			if ( ! $fp )
				$string = 'whois_query_error' . $errstr .' (' . $errno . ')';
			else {
				if ( 'de' != $tld && ! preg_match( '/^[a-zA-Z0-9-]*$/', $domain ) ) {
					// use idna class to encode idn domain
					require_once( 'class-idna-convert.php' );
					$idn = new idna_convert();
					$domain = $idn->encode( $domain );
				}
				if ( ! preg_match( '/^[a-zA-Z0-9\.]*$/', $tld ) ) {
					// use idna class to encode idn tld
					require_once( 'class-idna-convert.php' );
					$idn = new idna_convert();
					$tld = $idn->encode( $tld );
				}
				$flag = '';
				if ( 'de' == $tld )
					$flag = '-T dn ';
				fwrite( $fp, $flag . $domain . '.' . $tld . "\r\n" );
				while( ! feof( $fp ) )
					$string .= fread( $fp, 128 );
				fclose( $fp );

				$string = trim( $string );
			}
		} catch ( Exception $e ) {
			$string = 'whois_query_error' . $e->getMessage();
		} finally {
			// reset error handler function
			restore_error_handler();
		}

		if ( '' == $string || preg_match( '/whois_query_error/', $string ) ) {
			$array_result['status'] = 'error';
			$array_result['text'] = str_replace( 'whois_query_error', '', $string );
		}
		else {
			if ( preg_match( '/' . $status_free . '/i', preg_replace( '/\s\s+|\t/', ' ', $string ) ) )
				$array_result['status'] = 'available';
			else if ( preg_match( '/' . WP24_Domain_Check_Whoisservers::get_pattern_invalid() . '/i', preg_replace( '/\s\s+|\t/', ' ', $string ) ) )
				$array_result['status'] = 'invalid';
			else if ( preg_match( '/' . WP24_Domain_Check_Whoisservers::get_pattern_limit() . '/i', $string ) || 'limit exceeded' == strtolower( $string ) )
				$array_result['status'] = 'limit';
			else {
				$array_result['status'] = 'registered';
				$array_result['text'] = $string;
			}
		}

		return $array_result;
	}

	/**
	 * Query a rdap server.
	 * 
	 * @param string $domain 
	 * @param string $tld 
	 * @param string $rdapserver 
	 * @return array Whois entry.
	 */
	private function rdap( $domain, $tld, $rdapserver ) {
		$array_result = array();

		$request_url = 'https://' . $rdapserver . '/domain/' . $domain . '.' . $tld;

		// get response and http status code
		$response = wp_remote_get( $request_url );
		$http_status_code = wp_remote_retrieve_response_code( $response );

		if ( 200 != $http_status_code ) {
			// request failed
			if ( 400 == $http_status_code ) {
				// bad request
				$array_result['status'] = 'invalid';
			}
			else if ( 404 == $http_status_code ) {
				// not found
				$array_result['status'] = 'available';
			}
			else {
				$array_result['status'] = 'error';
				$array_result['text'] = 'Error ' . $http_status_code;
			}
		}
		else {
			$json = json_decode( wp_remote_retrieve_body( $response ) );

			// extract the whois data
			$string = 'Domain: ' . $json->ldhName . PHP_EOL;
			$string .= 'Status: ' . $json->status[0] . PHP_EOL;
			foreach ( $json->nameservers as $s )
				$string .= ucfirst( $s->objectClassName ) . ': ' . $s->ldhName . PHP_EOL;
			foreach ( $json->events as $s )
				$string .= ucfirst( $s->eventAction ) . ': ' . $s->eventDate . PHP_EOL;

			$array_result['status'] = 'registered';
			$array_result['text'] = $string;
		}

		return $array_result;
	}

	/**
	 * Get IP by host name.
	 * 
	 * @param string $domain 
	 * @param string $tld 
	 * @return array Availability of the domain.
	 */
	private function ip( $domain, $tld ) {
		$array_result = array();

		if ( ! preg_match( '/^[a-zA-Z0-9-]*$/', $domain ) ) {
			// use idna class to encode idn domain
			require_once( 'class-idna-convert.php' );
			$idn = new idna_convert();
			$domain = $idn->encode( $domain );
		}
		if ( ! preg_match( '/^[a-zA-Z0-9\.]*$/', $tld ) ) {
			// use idna class to encode idn tld
			require_once( 'class-idna-convert.php' );
			$idn = new idna_convert();
			$tld = $idn->encode( $tld );
		}

		if ( gethostbyname( $domain . '.' . $tld . '.' ) != $domain . '.' . $tld . '.' ) {
			// there is a IPv4 address corresponding to the host name
			$array_result['status'] = 'registered';
		}
		else {
			$array_result['status'] = 'available_probably';
			$webwhois = WP24_Domain_Check_Whoisservers::get_webwhois( $tld );
			if ( $webwhois && $this->options['unsupported']['verify'] )
				$array_result['text'] = $webwhois;
		}

		return $array_result;
	}

	/**
	 * Evaluate whois query result.
	 * 
	 * @param string $domain
	 * @param string $tld
	 * @return array Registration status.
	 */
	private function get_whois_result( $domain, $tld ) {
		$json_result = array();
		$json_result['domain'] = $domain;
		$json_result['tld'] = $tld;

		if ( ! preg_match( '/^[^_\.\/]{1,}$/', $domain ) )
			$json_result['status'] = 'invalid';
		else {
			// override enabled: check database for whois server first
			if ( $this->options['overrideWhoisservers'] ) {
				// get database object
				global $wpdb;

				// check for custom whois server
				$row = $wpdb->get_row( "SELECT host, status_free FROM {$wpdb->prefix}wp24_whois_servers WHERE tld = '" . $tld . "'" );
				if ( null !== $row ) {
					$whois_result = self::whois( $domain, $tld, $row->host, $row->status_free );
					$json_result = array_merge( $json_result, $whois_result );

					return $json_result;
				}
			}

			$whoisserver = WP24_Domain_Check_Whoisservers::get_whoisserver( $tld );
			if ( ! $whoisserver ) {
				// get database object
				global $wpdb;

				// check for custom whois server
				$row = $wpdb->get_row( "SELECT host, status_free FROM {$wpdb->prefix}wp24_whois_servers WHERE tld = '" . $tld . "'" );
				if ( null !== $row ) {
					$whois_result = self::whois( $domain, $tld, $row->host, $row->status_free );
					$json_result = array_merge( $json_result, $whois_result );
				}
				else if ( $this->options['unsupported']['enabled'] ) {
					// use ip check
					$ip_result = self::ip( $domain, $tld );
					$json_result = array_merge( $json_result, $ip_result );
				}
				else
					$json_result['status'] = 'whoisserver';
			}
			else {
				if ( isset( $whoisserver['func'] ) ) {
					// use special whois function
					$func = $whoisserver['func'] . '_whois';
					$func_result = WP24_Domain_Check_Whoisfunctions::$func( $domain, $tld );
					$json_result = array_merge( $json_result, $func_result );
				}
				else if ( isset( $whoisserver['rdap'] ) ) {
					// use rdap (registration data access protocol)
					$rdap_result = self::rdap( $domain, $tld, $whoisserver['rdap'] );
					$json_result = array_merge( $json_result, $rdap_result );
				}
				else {
					// use whois (port 43)
					$whois_result = self::whois( $domain, $tld, $whoisserver['host'], $whoisserver['free'] );
					$json_result = array_merge( $json_result, $whois_result );
				}
			}
		}
		return $json_result;
	}

	/**
	 * Perform whois query and output result as json.
	 * 
	 * @return void
	 */
	public function whois_query() {
		$post_domain = sanitize_text_field( $_POST['domain'] );
		$post_tld = sanitize_text_field( $_POST['tld'] );

		// verify ajax request
		if ( $this->options['useNonces'] && ! check_ajax_referer( 'domain_check', 'n', false ) ) {
			wp_send_json( array(
				'domain'	=> $post_domain,
				'tld'		=> $post_tld,
				'status'	=> 'unauthorized',
			) );
			wp_die();
		}

		// get database object
		global $wpdb;

		/*
		 * recaptcha
		 */
		if ( 'none' != $this->options['recaptcha']['type'] ) {
			$recaptcha = sanitize_text_field( $_POST['recaptcha'] );
			$recaptcha_error = false;
			if ( ! isset( $recaptcha ) || empty( $recaptcha ) )
				$recaptcha_error = true;
			else
			{
				$response = wp_remote_get( 'https://www.google.com/recaptcha/api/siteverify?secret=' . $this->options['recaptcha']['secretKey'] . '&response=' . $recaptcha );
				$response_json = json_decode( wp_remote_retrieve_body( $response ), true );

				if ( ! $response_json['success'] )
					$recaptcha_error = true;

				if (
					'v3' == $this->options['recaptcha']['type'] &&
					(
						empty( $response_json['action'] ) ||
						'wp24_domaincheck' != $response_json['action'] ||
						$response_json['score'] < $this->options['recaptcha']['score']
					)
				)
					$recaptcha_error = true;

				// allow timeout-or-duplicate error on check all
				if (
					$this->options['checkAll'] && ! empty( $response_json['error-codes'] ) &&
					in_array( 'timeout-or-duplicate', $response_json['error-codes'] )
				)
					$recaptcha_error = false;
			}

			if ( $recaptcha_error ) {
				wp_send_json( array(
					'domain'	=> $post_domain,
					'tld'		=> $post_tld,
					'status'	=> 'recaptcha',
				) );
				wp_die();
			}
		}

		/*
		 * rate limited whois services
		 */
		$whoisserver = WP24_Domain_Check_Whoisservers::get_whoisserver( $post_tld );
		if ( isset( $whoisserver['limit_group'] ) ) {
			// if no whois information should be shown, do a quick check
			if ( ! $this->options['showWhois'] && gethostbyname( $post_domain . '.' . $post_tld . '.' ) != $post_domain . '.' . $post_tld . '.' ) {
				// there is a IPv4 address corresponding to the host name
				$json_result = array();
				$json_result['domain'] = $post_domain;
				$json_result['tld'] = $post_tld;
				$json_result['status'] = 'registered';
				
				wp_send_json( $json_result );
				wp_die();
			}

			if ( ! isset( $this->options['query_limits'] ) ) {
				// if query limits option is missing add it
				$this->options = array(
					'query_limits' => array(
						'centralnic' => 60,
					)
				);
			}

			// set default query limit to 60 queries per hour
			if ( ! isset( $this->options['query_limits'][ $whoisserver['limit_group'] ] ) )
				$this->options['query_limits'][ $whoisserver['limit_group'] ] = 60;

			// delete expired entries and get query count
			$wpdb->query( "DELETE FROM {$wpdb->prefix}wp24_whois_queries WHERE query_time < (CURRENT_TIMESTAMP - INTERVAL 60 MINUTE)" );
			$query_count = $wpdb->get_var( "SELECT COALESCE(SUM(query_count), 0) FROM {$wpdb->prefix}wp24_whois_queries" );

			if ( $query_count >= $this->options['query_limits'][ $whoisserver['limit_group'] ] ) {
				// query limit reached
				$json_result = array();
				$json_result['domain'] = $post_domain;
				$json_result['tld'] = $post_tld;
				$json_result['status'] = 'limit';

				wp_send_json( $json_result );
				wp_die();
			}
		}

		$json_data = WP24_Domain_Check_Domaincheck::get_whois_result( $post_domain, $post_tld );

		if ( isset( $whoisserver['limit_group'] ) ) {
			if ( 'limit' == $json_data['status'] ) {
				// query limit exceeded, increment query count to maximum
				$wpdb->insert( $wpdb->prefix . 'wp24_whois_queries', array(
					'limit_group' => $whoisserver['limit_group'],
					'query_count' => $this->options['query_limits'][ $whoisserver['limit_group'] ] - $query_count
				) );
			}
			else {
				// increment query count by one
				$wpdb->insert( $wpdb->prefix . 'wp24_whois_queries', array( 'limit_group' => $whoisserver['limit_group'] ) );
			}
		}

		if ( in_array( $json_data['status'], array( 'available', 'available_probably' ) ) ) {
			if ( $this->options['woocommerce']['enabled'] ) {
				$row = $wpdb->get_row( "SELECT product_id_purchase FROM {$wpdb->prefix}wp24_tld_woocommerce WHERE tld = '" . $json_data['tld'] . "'" );
				$product_id = empty( $row->product_id_purchase ) ? $this->options['woocommerce']['productidPurchase'] : $row->product_id_purchase;
				if ( 0 != $product_id ) {
					$product = wc_get_product( $product_id );
					$json_data['price'] = $product->get_price_html();
					if ( $this->options['woocommerce']['addToCartBehaviour'] == 0 )
						$json_data['link'] = wc_get_cart_url() . '?add-to-cart=' . $product_id . '&domain=' . $json_data['domain'] . '.' . $json_data['tld'];
					else
						$json_data['link'] = $product_id;
				}
			}
			else if ( $this->options['priceEnabled'] || $this->options['linkEnabled'] ) {
				$row = $wpdb->get_row( "SELECT price, link FROM {$wpdb->prefix}wp24_tld_prices_links WHERE tld = '" . $json_data['tld'] . "'" );
				if ( $this->options['priceEnabled'] )
					$json_data['price'] = empty( $row->price ) ? $this->options['priceDefault'] : $row->price;
				if ( $this->options['linkEnabled'] )
					$json_data['link'] = empty( $row->link ) ? $this->options['linkDefault'] : $row->link;
			}
		}
		else if ( in_array( $json_data['status'], array( 'registered' ) ) ) {
			if ( $this->options['woocommerce']['enabled'] ) {
				if ( $this->options['woocommerce']['transferEnabled'] ) {
					$row = $wpdb->get_row( "SELECT product_id_transfer FROM {$wpdb->prefix}wp24_tld_woocommerce WHERE tld = '" . $json_data['tld'] . "'" );
					$product_id = empty( $row->product_id_transfer ) ? $this->options['woocommerce']['productidTransfer'] : $row->product_id_transfer;
					if ( 0 != $product_id ) {
						$product = wc_get_product( $product_id );
						$json_data['price'] = $product->get_price_html();
						if ( $this->options['woocommerce']['addToCartBehaviour'] == 0 )
							$json_data['link'] = wc_get_cart_url() . '?add-to-cart=' . $product_id . '&domain=' . $json_data['domain'] . '.' . $json_data['tld'] . '&transfer';
						else
							$json_data['link'] = $product_id;
					}
				}
			}
			else if ( $this->options['priceTransferEnabled'] || $this->options['linkTransferEnabled'] ) {
				$row = $wpdb->get_row( "SELECT price_transfer, link_transfer FROM {$wpdb->prefix}wp24_tld_prices_links WHERE tld = '" . $json_data['tld'] . "'" );
				if ( $this->options['priceTransferEnabled'] )
					$json_data['price'] = empty( $row->price_transfer ) ? $this->options['priceTransferDefault'] : $row->price_transfer;
				if (  $this->options['linkTransferEnabled'] )
					$json_data['link'] = empty( $row->link_transfer ) ? $this->options['linkTransferDefault'] : $row->link_transfer;
			}
		}

		if ( $this->options['hooksEnabled'] )
			$json_data = apply_filters( 'wp24_domaincheck_whois_result', $json_data );

		if ( $this->options['removeWhoisComments'] && isset( $json_data['text'] ) )
			$json_data['text'] = preg_replace( '/%.*\n*/', '', $json_data['text'] );

		if ( version_compare( PHP_VERSION, '7.2.0', '<' ) ) {
			// JSON_INVALID_UTF8_IGNORE needs PHP >= 7.2
			if ( isset( $json_data['text'] ) )
				$json_data['text'] = iconv( 'UTF-8', 'UTF-8//IGNORE', $json_data['text'] );
			wp_send_json( $json_data );
		}
		else
			wp_send_json( $json_data, null, JSON_INVALID_UTF8_IGNORE );
		
		wp_die();
	}

}
