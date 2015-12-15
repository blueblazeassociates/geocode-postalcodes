<?php

namespace BlueBlazeAssociates\Geocode;

/**
 * @author Ed Gifford
 */
class LatLonRange {
  /**
   * Validate distance.
   *
   * Distance must be a positive integer.
   *
   * @param string|integer $distance
   *
   * @return boolean
   */
  public static function validate_distance( $distance ) {
    $valid = filter_var( $distance, FILTER_VALIDATE_INT,
        array( 'options' => array(
            'min_range' => 1,
            'max_range' => PHP_INT_MAX
        ))
        );

    return false !== $valid ? true : false;
  }

  /**
   * Normalize distance format.
   *
   * @param string distance
   *
   * @return string Returns empty string if distance isn't valid.
   */
  public static function format_distance( $distance ) {
    $valid = static::validate_distance( $distance );

    if ( false === $valid ) {
      return '';
    }

    return $distance;
  }

  /**
   * @param LatLon $latlon
   * @param string|integer $distance In miles
   *
   * @return LatLonRange
   *
   * @throws GeocodingException
   */
  public static function createFromDistance( $latlon, $distance ) {
    if ( ! ( $latlon instanceof LatLon ) ) {
      throw new GeocodingException( '$latlon parameter is not a LatLon object.' );
    }

    $distance_formated = static::format_distance( $distance );
    if ( empty( $distance_formated ) ) {
      throw new GeocodingException( 'Distance value is invalid: ' . $distance );
    }
    $distance = $distance_formated;

    // Calculate the bounding box on the globe.
    $center = \AnthonyMartin\GeoLocation\GeoLocation::fromDegrees( $latlon->getLat(), $latlon->getLon() );
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

    if ( ! ( $min->getLat() <= $max->getLat() ) ) {
      throw new GeocodingException( 'Minimum latitude is larger than maximum latitude.' );
    }
    if ( ! ( $min->getLon() <= $max->getLon() ) ) {
      throw new GeocodingException( 'Minimum longitude is larger than maximum longitude.' );
    }

    $this->min = $min;
    $this->max = $max;
  }

  /**
   * @return LatLon
   */
  public function getMin() {
    return $this->min;
  }

  /**
   * @return LatLon
   */
  public function getMax() {
    return $this->max;
  }

  private $min = null;

  private $max = null;
}
