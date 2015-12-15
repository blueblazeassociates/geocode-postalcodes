<?php

namespace BlueBlazeAssociates\Geocode;

/**
 * @author Ed Gifford
 */
class LatLon {
  /**
   *
   * @param string|float $lat
   * @param string|float $lon
   *
   * @throws GeocodingException
   */
  public function __construct( $lat, $lon ) {
    $lat = filter_var( $lat, FILTER_VALIDATE_FLOAT );

    if ( false === $lat || $lat > 90.0 || $lat < -90.0 ) {
      throw new GeocodingException( 'Latitude value is invalid: ' . $lat );
    }

    $this->lat = $lat;

    $lon = filter_var( $lon, FILTER_VALIDATE_FLOAT );

    if ( false === $lon || $lon > 180.0 || $lon < -180.0 ) {
      throw new GeocodingException( 'Latitude value is invalid: ' . $lon );
    }

    $this->lon = $lon;
  }

  /**
   * @return float
   */
  public function getLat() {
    return $this->lat;
  }

  /**
   * @return float
   */
  public function getLon() {
    return $this->lon;
  }

  private $lat = null;

  private $lon = null;
}
