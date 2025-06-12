<?php
/**
 * openam.class.php
 *
 * Dependence: http.class.php
 * 
 * @author Alexandre Porto da Silva
 * @licence GNU General Public Licence 2.0 or later
 * @version 0.2.1
 * @date 2014-07-31
 * @url	https://wiki.bb.com.br/index.php/OpenAM/C%C3%B3digos_prontos/PHP/openam.class.php
 */

require_once 'http.class.php';


class Openam {

	## URLs/cookie/realm
	private $urlOpenam, $urlDistAuth, $urlIdentity;
	private $cookie = 'iPlanetDirectoryPro';
	private $realm = '';
	function setUrlOpenam( $urlOpenam = '' ) {
		$this->urlOpenam = $urlOpenam;
	}
	function setUrlDistAuth( $urlDistAuth = '' ) {
		$this->urlDistAuth = $urlDistAuth;
	}
	function setUrlIdentity( $urlIdentity = '' ) {
		$this->urlIdentity = $urlIdentity;
	}
	function setCookieName( $cookie = 'iPlanetDirectoryPro' ) {
		$this->cookie = $cookie;
	}
	function setRealm( $realm = '' ) {
		if ( $realm ) {
			$this->realm = "realm={$realm}&";
		} else {
			$this->realm = '';
		}
	}

	## uid/groupsName
	private $uid = 'uid';
	private $groupsName = '';
	function setUidKey( $uid ) {
		$this->uid = $uid;
	}
	function setGroupsName( $groupsName ) {
		$this->groupsName = $groupsName;
	}

	## token/body
	private $token = '';
	private function getToken() {
		if ( !$this->token ) {
			$this->token = isset( $_COOKIE[$this->cookie] ) ? $_COOKIE[$this->cookie] : '';
		}
		return $this->token;
	}
	private function getBody( $url, $method = 'GET' ) {
		
		$body = '';
		$token = $this->getToken();
		if ( $token ) {

			$body = Http::getBody( $url, "{$this->cookie}={$token}; path=/", $method  );
			 
		}
		return $body;
	}

	# isTokenValid
	private $tokenValid = false;
	private function isTokenValid() {
		if ( $this->tokenValid ) {
			return true;
		}

		# loop
		if ( session_id() == '' ) {
			session_start();
		}
		$cookieLoop = "{$this->cookie}_LOOP";

		##$body = $this->getBody( "{$this->urlIdentity}/isTokenValid" );
		$body = $this->getBody( $this->urlOpenam . 'json/sessions?tokenId='. $this->getToken() .'&_action=validate', "POST" );

		if ( $body ) {
			// value will be of the form boolean=true
			if ( substr( trim( $body ), 8 ) == 'true' ) {
				$_SESSION[$cookieLoop] = 0;
				$this->tokenValid = true;
				return true;
			}else{
				if( is_string($body) && (is_object(json_decode($body)) || is_array(json_decode($body))) )
				{
					$objBodyJson =  json_decode($body);
					if ($objBodyJson->valid){
						$_SESSION[$cookieLoop] = 0;
						$this->tokenValid = true;
						return true;
					}
				}
			}
		}

		## prevent infinite redirect loop
		if ( isset( $_SESSION[$cookieLoop] ) ) {
			$loop = $_SESSION[$cookieLoop];
		} else {
			$loop = 0;
		}
		$loop += 1;
		$_SESSION[$cookieLoop] = $loop;
		if ( $loop > 3 ) {
			return false;
		}

		## redirect for login
		$login = "{$this->urlDistAuth}/Login?{$this->realm}goto=";
		$login .= urlencode( Http::getScript() );
		$login .= urlencode( Http::getQuery() );
		Http::redirect( $login );

		return false;
	}

	# attributes => ldapEntries
	function getAttributes() {
		$attributes = '';
		if ( $this->isTokenValid()) {
			$attributes = $this->getBody( "{$this->urlIdentity}/attributes" );
		}
		return $attributes;
	}
	## ldap compatibility
	function attributes2ldapEntries( $body, $token = '' ) {
		if ( !$body ) {
			return array();
		}
		$lines = explode( "\n", $body );
		$val = explode( '=', $lines[0], 2 );
		$var = explode( '.', $val[0], 3 );
		if ( !isset( $var[1] ) || $var[1] != 'token'
			|| ( $token && ( !isset($val[1]) || $token != trim( $val[1] ) ) )
		) {
			return array();
		}
		array_shift( $lines );

		$uid = $this->uid;
		$groupsName = $this->groupsName;
		$attributes = $groups = array();

		foreach ( $lines as $line ) {
			$val = explode( '=', $line, 2 );
			$var = explode( '.', $val[0], 3 );
			if ( isset( $val[1] ) && isset( $var[1] ) ) {
				switch ( $var[1] ) {
					case 'attribute':
						if ( isset( $var[2] ) ) {
							switch ( $var[2] ) {
								case 'name':
									$name = trim( $val[1] );
									break;
								case 'value':
									$attributes[$name][] = trim( $val[1] );
									break;
							}
						}
						break;
					case 'role':
						$groups[] = trim( $val[1] );
						break;
				}
			}
		}

		if ( !isset( $attributes[$uid][0] ) || !$attributes[$uid][0] ) {
			return array();
		}

		if ( $groupsName && $groups ) {
			$attributes[$groupsName] = $groups;
		}

		//start-ldap compatibility: ldap_get_entries()
		$dn = '';
		$ldapEntries = array();
		$ldapEntries['count'] = 1;
		foreach ( $attributes as $key => $val ) {
			if ( strlen( $key ) == 2 && strtoupper( $key ) == 'DN' ) {
				$dn = $val[0];
			} else {
				$ldapEntries[0][$key]['count'] = count( $val );
				$ldapEntries[0][$key] += $val;
				$ldapEntries[0][] = $key;
			}
		}
		$ldapEntries[0]['count'] = count( $attributes );
		$ldapEntries[0]['dn'] = $dn;
		//end-ldap compatibility: ldap_get_entries()
		return $ldapEntries;
	}
	function getLdapEntries() {
		$body = $this->getAttributes();
		$token = $this->getToken();
		$ldapEntries = self::attributes2ldapEntries( $body, $token );
		
		return $ldapEntries;
	}
}
