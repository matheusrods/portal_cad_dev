<?php

class Http {

	static function getBody( $url, $cookie = '', $method = "GET") {
		$ch = curl_init();
		
		if ( $cookie ) {
			curl_setopt( $ch, CURLOPT_COOKIE, $cookie );
		}
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false );
		curl_setopt( $ch, CURLOPT_URL, $url );

		if($method != "GET"){
			curl_setopt( $ch, CURLOPT_POST, 1);
			curl_setopt( $ch, CURLINFO_HEADER_OUT, true);
			curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json', 'Content-Length: 0'));
		}

		$body = curl_exec( $ch );
		if ( $body ) {
			$code = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
			if ( $code == '200' ) {
				return $body;
			}
		}
		return '';
	}

	static function getQuery() {
		$query = '';
		if ( $_SERVER['QUERY_STRING'] > ' ' ) {
			$query = urlencode( "?{$_SERVER['QUERY_STRING']}" );
		} elseif ( isset( $_SERVER['PATH_INFO'] ) && $_SERVER['PATH_INFO'] > ' ' ) {
			$query = urlencode( $_SERVER['PATH_INFO'] );
		}
		return $query;
	}

	static function getScript() {
		$url = 'http';
		$port = '80';
		if ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] == 'on' ) {
			$url .= 's';
			$port = '443';
		}
		if ( $port == $_SERVER['SERVER_PORT'] ) {
			$port = '';
		} else {
			$port = ":{$_SERVER['SERVER_PORT']}";
		}
		$url .= "://{$_SERVER['HTTP_HOST']}{$port}{$_SERVER['SCRIPT_NAME']}";
		return $url;
	}
	
	static function redirect( $url ) {
		header( 'HTTP/1.1 303 See other' );
		header( 'Content-Type: text/html; charset=utf-8' );
		header( "Location: $url" );
		exit();
	}

}
