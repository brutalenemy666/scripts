<?php

//  uncomment for WP
/*
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
*/

/**
 * Generates an unique number and cache it for a amount of time or until the browser is closed
 * The number cache is based on a given values
 * Can be used for an invoice number in order to prevent accidentally resubmission or charge
 *
 * Usage:
 * $invoice_params = array(
 *     $card_num,
 *     $amount,
 *     $first_name,
 *     $last_name,
 *     $email
 *     ...
 * );
 * Crb_UniqueId::get( $invoice_params );
 */
class Crb_UniqueId {

	protected $session_key;

	protected $args = array();
	protected $key = '';

	/**
	 * Time to cache the generated number in seconds
	 * default: 180 seconds
	 * @var integer
	 */
	protected $duplicate_window;

	private function __construct($args, $duplicate_window=false) {
		$this->args = (array) $args;
		$this->session_key = CRB_EM_PREFIX . 'unique-numbers';

		$this->duplicate_window = intval($duplicate_window);
		if ( !$this->duplicate_window ) {
			$this->duplicate_window = 180;
		}

		$this->generate_key();
	}

	public static function get($args, $duplicate_window=false) {
		$invoice = new self( $args, $duplicate_window );

		return $invoice->get_number();
	}

	/**
	 * There might be a sensitive infromation given
	 * Make it as hard as possible for reversing
	 */
	protected function generate_key() {
		$invoice_params = $this->args;
		$invoice_params = array_map('trim', $invoice_params);
		$invoice_params = array_filter($invoice_params);
		$invoice_params = array_map('md5', $invoice_params);

		$key = md5( implode('', $invoice_params) );

		// for WP integration
		if ( function_exists('wp_salt') ) {
			$key = wp_salt($key);
		}

		$this->key = $key;
	}

	protected function get_number() {
		if ( empty($_SESSION[$this->session_key][$this->key]['number']) ) {
			return $this->create_invoice_number();
		}

		$now = time();
		$number = $_SESSION[$this->session_key][$this->key]['number'];
		$time_created = $_SESSION[$this->session_key][$this->key]['created'];

		// check if duplicate window is expired
		if ( $now - $this->duplicate_window > $time_created ) {
			return $this->create_invoice_number();
		}

		return $number;
	}

	protected function create_invoice_number() {
		$_SESSION[$this->session_key][$this->key] = array(
			'number' => uniqid(),
			'created' => time()
		);

		return $_SESSION[$this->session_key][$this->key]['number'];
	}
}
