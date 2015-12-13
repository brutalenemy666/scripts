<?php

//  uncomment for WP
/*
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
*/

class Crb_Exception extends Exception {

	protected static $index = 0;

	public static function fire( $exception_message='', $write_to_log=false ) {
		if ( empty($exception_message) ) {
			return;
		}

		$exception_message = self::sanitize_message($exception_message);

		if ( $write_to_log ) {
			self::write_to_log($exception_message);
		}

		$exception = new self($exception_message);

		throw $exception;
	}

	public static function write_to_log( $message_to_write ) {
		$message_type = 3;
		$destination = self::get_log_directory();

		$file_name = $destination . 'log-' . date('Y-m-d') . '.log';

		$message_to_write = self::sanitize_message($message_to_write);

		$backtrace = self::get_backtrace(true);

		// write to log
		$log_msg = "\n\n----------------------------------------------------------------\n";
		$log_msg .= "----------------------------------------------------------------\n";
		$log_msg .= 'Date ::: ' . date('Y-m-d H:i:s') . "\n";
		$log_msg .= "Trace ::: \n";
		$log_msg .= "{$backtrace} \n";
		$log_msg .= "Message ::: \n";
		$log_msg .= $message_to_write . "\n";

		error_log($log_msg, $message_type, $file_name);
	}

	protected static function sanitize_message( $message ) {
		if ( is_string($message) && is_numeric($message)  ) {
			return $message;
		}

		return print_r($message, true);
	}

	protected static function get_log_directory() {
		$directory = dirname(__FILE__);
		if ( defined('CRB_EXEPTION_DIRECTORY') ) {
			$directory = CRB_EXEPTION_DIRECTORY;
		}

		if ( !preg_match('~\/$~', $directory) ) {
			$directory .= DIRECTORY_SEPARATOR;
		}

		return $directory;
	}

	protected static function numerate_array_values( $array_value ) {
		self::$index++;

		return "#" . self::$index . " - {$array_value}";
	}

	protected static function get_backtrace( $return_string=false ) {
		$backtrace = debug_backtrace();
		$return = array();

		foreach ($backtrace as $trace) {
			$txt = '';

			if ( !empty($trace['class']) ) {
				$txt .= $trace['class'];

				if ( !empty($trace['type']) ) {
					$txt .= $trace['type'];
				} else {
					$txt .= '->';
				}
			}

			if ( !empty($trace['function']) ) {
				$txt .= $trace['function'] . '()';
			}

			if ( !empty($trace['line']) ) {
				$txt .= ' on line ' . $trace['line'];
			}

			if ( !empty($trace['file']) ) {
				$txt .= ' - ' . $trace['file'];
			}

			$return[] = $txt;
		}

		$return = array_map(array(__CLASS__, 'numerate_array_values'), $return);
		self::$index = 0; // reset

		if ( !$return_string ) {
			return $return;
		}

		return implode("\n", $return);
	}
}
