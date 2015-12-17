<?php

namespace BlueBlazeAssociates\Geocoding\PostalCodes\Providers;

use BlueBlazeAssociates\Geocoding\LatLon;

/**
 * @author Ed Gifford
 */
interface PostalCodeGeocodingProvider {
  /**
   * Turns a postal code into a latitude/longitude coordinate.
   *
   * @param string|integer $postal_code
   *
   * @return LatLon
   */
  public function geocode( $postal_code );
}
