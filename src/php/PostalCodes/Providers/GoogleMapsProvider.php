<?php

namespace BlueBlazeAssociates\Geocoding\PostalCodes\Providers;

use BlueBlazeAssociates\Geocoding\LatLon;
use BlueBlazeAssociates\Geocoding\GeocodingException;

/**
 * @author Ed Gifford
 */
class GoogleMapsProvider implements PostalCodeGeocodingProvider {
  /**
   * Empty constructor.
   */
  public function __constructor() {
  }

  /**
   * @param string $postal_code
   *
   * @return LatLon
   *
   * @throws GeocodingException
   */
  public function geocode( $postal_code ) {
    // Setup local variable for holding results from geocoder.
    $addressCollection = null;

    // Try to call the geocoder.
    try {
      // Set it call to geocoder...
      $curl     = new \Ivory\HttpAdapter\CurlHttpAdapter();
      $geocoder = new \Geocoder\Provider\GoogleMaps( $curl, null, null, true );

      // Geocode the zipcode...
      $addressCollection = $geocoder->geocode( $postal_code );
    } catch ( \Exception $exception ) {
      // Recover from exception by rethrowing wrapped in GeocodingException.
      throw new GeocodingException( 'An exception occurred during geocoding.', 0, $exception );
    }

    // Make sure geocode found at least one result.
    if ( ! $addressCollection->has( 0 ) ) {
      throw new GeocodingException( 'ZIP code geocode did not return any results: ' . $postal_code );
    }

    // Store first result in local variable.
    $address = $addressCollection->get( 0 );

    // Return result.
    return new LatLon( $address->getLatitude(), $address->getLongitude() );
  }
}
