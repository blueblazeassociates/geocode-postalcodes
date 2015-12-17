<?php

namespace BlueBlazeAssociates\Geocoding\PostalCodes\Geocoders;

use BlueBlazeAssociates\Geocoding\GeocodingException;

/**
 * Supports a basic 5 digit US ZIP code.
 *
 * TODO Add support for xxxxx-yyyy style ZIP codes.
 *
 * @author Ed Gifford
 */
class USPostalCodeGeocoder extends BasePostalCodeGeocoder {
  /**
   * {@inheritDoc}
   * @see \BlueBlazeAssociates\Geocoding\PostalCodes\Geocoders\BasePostalCodeGeocoder::__constructor()
   */
  public function __construct( $geocoding_provider ) {
    parent::__construct( $geocoding_provider );
  }

  /**
   * Validate US ZIP code.
   *
   * ZIP code must be an integer between 1 and 99999.
   *
   * @param string|integer $zipcode
   *
   * @return boolean
   */
  public static function validate_postal_code( $postal_code ) {
    $valid = preg_match( '/^\d{5}$/', $postal_code );

    return $valid;
  }

  /**
   * Turns a postal code into a latitude/longitude coordinate.
   *
   * @param string|integer $postal_code
   *
   * @return LatLon
   */
  public function geocode( $postal_code ) {
    // Format/validate ZIP code.
    if ( false == static::validate_postal_code( $postal_code ) ) {
      throw new GeocodingException( 'ZIP code value is invalid: ' . $postal_code );
    }

    // Delegate geocoding to underlying provider.
    return $this->getGeocodingProvider()->geocode( $postal_code );
  }
}
