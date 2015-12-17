<?php

namespace BlueBlazeAssociates\Geocoding;

/**
 * @author Ed Gifford
 */
class LatLonRange {
  /**
   * @param LatLon $latlon
   * @param string|integer $distance In miles
   *
   * @return LatLonRange
   *
   * @throws GeocodingException
   */
  public static function create_from_distance( $latlon, $distance ) {
    if ( ! ( $latlon instanceof LatLon ) ) {
      throw new GeocodingException( '$latlon parameter is not a LatLon object.' );
    }

    if ( ! Utils::validate_distance( $distance ) ) {
      throw new GeocodingException( 'Distance value is invalid: ' . $distance );
    }
    $distance = (string) $distance;

    // Calculate the bounding box on the globe.
    $center = \AnthonyMartin\GeoLocation\GeoLocation::fromDegrees( $latlon->get_lat(), $latlon->get_lon() );
    $bounds = $center->boundingCoordinates( $distance, 'miles' );

    $min = new LatLon( $bounds[0]->getLatitudeInDegrees(), $bounds[0]->getLongitudeInDegrees() );
    $max = new LatLon( $bounds[1]->getLatitudeInDegrees(), $bounds[1]->getLongitudeInDegrees() );

    return new LatLonRange( $min, $max );
  }

  /**
   * @param LatLon $min
   * @param LatLon $max
   *
   * @throws GeocodingException
   */
  public function __construct( $min, $max ) {
    if ( ! ( $min instanceof LatLon ) ) {
      throw new GeocodingException( 'Minimum value is not a LatLon object.' );
    }
    if ( ! ( $max instanceof LatLon ) ) {
      throw new GeocodingException( 'Maximum value is not a LatLon object.' );
    }

    if ( ! ( $min->get_lat() <= $max->get_lat() ) ) {
      throw new GeocodingException( 'Minimum latitude is larger than maximum latitude.' );
    }
    if ( ! ( $min->get_lon() <= $max->get_lon() ) ) {
      throw new GeocodingException( 'Minimum longitude is larger than maximum longitude.' );
    }

    $this->min = $min;
    $this->max = $max;
  }

  /**
   * @return LatLon
   */
  public function get_min() {
    return $this->min;
  }

  /**
   * @return LatLon
   */
  public function get_max() {
    return $this->max;
  }

  private $min = null;

  private $max = null;
}
