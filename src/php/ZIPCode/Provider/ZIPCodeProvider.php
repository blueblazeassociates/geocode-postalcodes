<?php

namespace BlueBlazeAssociates\Geocode\ZIPCode\Provider;

/**
 * @author Ed Gifford
 */
interface ZIPCodeProvider {
  /**
   * @param string $zipcode
   *
   * @return \BlueBlazeAssociates\WordPress\Geocoding\LatLon
   *
   * @throws \BlueBlazeAssociates\WordPress\Geocoding\GeocodingExcpetion
   */
  public function geocode( $zipcode );
}
