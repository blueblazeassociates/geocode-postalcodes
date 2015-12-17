<?php

namespace BlueBlazeAssociates\Geocoding\PostalCodes;

use BlueBlazeAssociates\Geocoding\LatLon;
use BlueBlazeAssociates\Geocoding\GeocodingException;

/**
 * @author Ed Gifford
 */
interface PostalCodeGeocoder {
  /**
   * Validates a country specific postal code.
   *
   * @param string|integer $postal_code
   *
   * @return boolean
   */
  public static function validate_postal_code( $postal_code );

  /**
   * Normalizes a country specific postal code.
   *
   * @param string $postal_code
   *
   * @return string Returns empty string if postal code isn't valid.
   */
  public static function format_postal_code( $postal_code );

  /**
   * Turns a postal code into a latitude/longitude coordinate.
   *
   * @param string|integer $postal_code
   *
   * @return LatLon
   *
   * @throws GeocodingException Throws an exception if underlying geocoding operation fails.
   */
  public function geocode( $postal_code );
}
