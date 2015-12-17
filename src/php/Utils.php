<?php

namespace BlueBlazeAssociates\Geocoding;

/**
 * @author Ed Gifford
 */
abstract class Utils {
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
}
