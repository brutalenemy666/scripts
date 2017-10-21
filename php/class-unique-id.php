<?php
/**
 * Generates an unique number and caches it for an amount of time or until the browser is closed
 * The cache id is based on given values
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
 * UniqueDataId::get( $invoice_params );
 */
class UniqueDataId {

	protected $session_key;

	protected $args = [];
	protected $key = '';

	/**
	 * Cache length in seconds
	 * default: 180 seconds
	 * @var integer
	 */
	protected $duplicate_window;

	private function __construct( $args, $duplicate_window = 180 ) {
		$this->args = (array) $args;
		$this->session_key = 'unique-data-id';
		$this->duplicate_window = intval( $duplicate_window );
		$this->generateKey();
	}

	public static function get( $args, $duplicate_window = false ) {
		$self = new self( $args, $duplicate_window );
		return $self->getNumber();
	}

	/**
	 * There might be a sensitive infromation given
	 * Make it as hard as possible for reversing
	 */
	protected function generateKey() {
		$invoice_params = $this->args;
		$invoice_params = array_map( 'trim', $invoice_params );
		$invoice_params = array_filter( $invoice_params );
		$invoice_params = array_map( 'md5', $invoice_params );

		$key = md5( implode( '', $invoice_params ) );

		// for WP integration
		if ( function_exists( 'wp_salt' ) ) {
			$key = wp_salt( $key );
		}

		$this->key = $key;
	}

	protected function getNumber() {
		if ( empty( $_SESSION[ $this->session_key ][ $this->key ][ 'number' ] ) ) {
			return $this->createInvoiceNumber();
		}

		$now          = time();
		$number       = $_SESSION[ $this->session_key ][ $this->key ][ 'number' ];
		$time_created = $_SESSION[ $this->session_key ][ $this->key ][ 'created' ];

		// check if duplicate window is expired
		if ( $now - $this->duplicate_window > $time_created ) {
			return $this->createInvoiceNumber();
		}

		return $number;
	}

	protected function createInvoiceNumber() {
		$_SESSION[ $this->session_key ][ $this->key ] = array(
			'number'  => uniqid(),
			'created' => time(),
		);

		return $_SESSION[ $this->session_key ][ $this->key ][ 'number' ];
	}
}
