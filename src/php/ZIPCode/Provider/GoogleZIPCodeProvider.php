<?php

namespace BlueBlazeAssociates\Geocode\ZIPCode\Provider;

use BlueBlazeAssociates\Geocoding\GeocodingException;
use BlueBlazeAssociates\Geocoding\LatLon;

/**
 * @author Ed Gifford
 */
class GoogleZIPCodeProvider implements AbstractZIPCodeGeocodeProvider {
  /**
   * (non-PHPdoc)
   * @see \BlueBlazeAssociates\WordPress\Geocoding\ZIPCode\AbstractZIPCodeGeocodeProvider::geocode()
   */
  public function geocode( $zipcode ) {
    // Setup local variable for holding results from geocoder.
    $addressCollection = null;

    // Try to call the geocoder.
    try {
      // Set it call to geocoder...
      $curl     = new \Ivory\HttpAdapter\CurlHttpAdapter();
      $geocoder = new \Geocoder\Provider\GoogleMaps( $curl, null, null, true );

      // Geocode the zipcode...
      $addressCollection = $geocoder->geocode( $zipcode );
    } catch ( \Exception $exception ) {
      // Recover from exception by rethrowing wrapped in GeocodingException.
      throw new GeocodingException( 'An exception occurred during geocoding.', 0, $exception );
    }

    // Make sure geocode found at least one result.
    if ( ! $addressCollection->has( 0 ) ) {
      throw new GeocodingException( 'ZIP code geocode did not return any results: ' . $zipcode );
    }

    // Store first result in local variable.
    $address = $addressCollection->get( 0 );

    // Make sure this is a US zipcode.
    if ( 'US' != $address->getCountry()->getCode() ) {
      throw new GeocodingException( 'Geocoded ZIP code is outside United States: ' . $zipcode );
    }

    // Return result.
    return new LatLon( $address->getLatitude(), $address->getLongitude() );
  }
}
