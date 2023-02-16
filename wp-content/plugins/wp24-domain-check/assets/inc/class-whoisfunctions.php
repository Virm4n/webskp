<?php

/**
 * Class for special whois functions.
 */
class WP24_Domain_Check_Whoisfunctions {

	/**
	 * API whois query for .vn.
	 * 
	 * @param string $domain 
	 * @param string $tld 
	 * @return array Whois entry.
	 */
	public static function vn_whois( $domain, $tld ) {
		$array_result = array();

		$request_url = 'http://www.whois.net.vn/whois.php?domain=' . $domain . '.' . $tld;
		$response = wp_remote_retrieve_body( wp_remote_get( $request_url ) );

		switch ( intval( $response ) ) {
			case -1:
				$array_result['status'] = 'invalid';
				break;
			case 0:
				$array_result['status'] = 'available';
				break;
			case 1:
				$request_url = 'http://www.whois.net.vn/whois.php?domain=' . $domain . '.' . $tld . '&act=getwhois';
				$response = wp_remote_retrieve_body( wp_remote_get( $request_url ) );
		
				$array_result['status'] = 'registered';
				$array_result['text'] = preg_replace( '/\t+/', '', strip_tags( $response ) );
				break;
			default:
				$array_result['status'] = 'error';
				break;
		}

		return $array_result;
	}

}