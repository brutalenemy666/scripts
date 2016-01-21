<?php 
if ( !session_id() ) {
	session_start();
}

//  uncomment for WP
/*
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
*/

Class Crb_Session_Datastore {
	protected static $session_key = 'crb_session_datastore';

	public static function get($key='') {
		if ( !isset($_SESSION[self::$session_key][$key]) ) {
			return;
		}
		 
		return $_SESSION[self::$session_key][$key];
	}

	public static function set($key='', $value) {
		$_SESSION[self::$session_key][$key] = $value;
	}

	public static function delete($key) {
		if ( !isset($_SESSION[self::$session_key][$key]) ) {
			return;
		}

		unset($_SESSION[self::$session_key][$key]);
	}
}