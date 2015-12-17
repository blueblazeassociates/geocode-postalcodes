<?php

namespace BlueBlazeAssociates\Geocoding;

/**
 * @author Ed Gifford
 */
class GeocodingException extends \Exception {
  /**
   * @param string $message
   * @param number $code
   * @param Exception $previous
   */
  public function __construct($message = null, $code = 0, \Exception $previous = null) {
    parent::__construct( $message, $code, $previous );
  }
}
