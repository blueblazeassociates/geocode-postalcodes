<?php

namespace BlueBlazeAssociates\Geocoding\PostalCodes\Geocoders;

use BlueBlazeAssociates\Geocoding\GeocodingException;
use BlueBlazeAssociates\Geocoding\PostalCodes\PostalCodeGeocoder;
use BlueBlazeAssociates\Geocoding\PostalCodes\Providers\PostalCodeGeocodingProvider;

/**
 * @author Ed Gifford
 */
abstract class BasePostalCodeGeocoder implements PostalCodeGeocoder {
  /**
   * @param PostalCodeGeocodingProvider $geocoding_provider
   *
   * @throws GeocodingException Throws exception if passed parameter is not PostalCodeGeocodingProvider.
   */
  public function __construct( $geocoding_provider ) {
    if ( ! ( $geocoding_provider instanceof PostalCodeGeocodingProvider ) ) {
      throw new GeocodingException( 'Parameter is not a PostalCodeGeocodingProvider.' );
    }

    $this->geocoding_provider = $geocoding_provider;
  }

  /**
   * @return PostalCodeGeocodingProvider
   */
  protected function getGeocodingProvider() {
    return $this->geocoding_provider;
  }

  /**
   * @var PostalCodeGeocoderProvider $provider
   */
  private $geocoding_provider = null;
}
