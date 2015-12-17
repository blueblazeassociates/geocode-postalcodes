<?php

namespace BlueBlazeAssociates\Geocoding\PostalCodes\Geocoders;

use BlueBlazeAssociates\Geocoding\CountryCodes;
use BlueBlazeAssociates\Geocoding\GeocodingException;
use BlueBlazeAssociates\Geocoding\GeocodingProviders;
use BlueBlazeAssociates\Geocoding\PostalCodes\Providers\PostalCodeGeocodingProvider;

/**
 * @author Ed Gifford
 */
abstract class PostalCodeGeocoderFactory {
  /**
   * Creates a geocoding provider based on a set code.
   *
   * @param string $provider_code
   *
   * @return PostalCodeGeocodingProvider
   *
   * @throws GeocodingException Throws exception if geocoding provider can't be found.
   */
  public static function createGeocodingProvider( $provider_code = GeocodingProviders::GOOGLE_MAPS ) {
    if ( GeocodingProviders::GOOGLE_MAPS != $provider_code ) {
      throw new GeocodingException( 'Geocoding provider \'' . $provider_code . '\' not found.' );
    }

    return new \BlueBlazeAssociates\Geocoding\PostalCodes\Providers\GoogleMapsProvider();

    // TODO Create a map between provider keys and implementation class names.
  }

  /**
   * Create a country specific geocoder for postal codes.
   *
   * @param CountryCode $countrycode
   *
   * @return BasePostalCodeGeocoder
   *
   * @throws GeocodingException Throws exception if country code isn't supported.
   * @throws GeocodingException Throws exception if geocoding provider can't be found.
   */
  public static function createGeocoder( $country_code = CountryCodes::US, $provider_code = GeocodingProviders::GOOGLE_MAPS ) {
    if ( CountryCodes::US != $country_code ) {
      throw new GeocodingException( 'PostalCode geocoder for country \'' . $country_code . '\' not found.' );
    }

    $geocoding_provider = static::createGeocodingProvider( $provider_code );

    return new \BlueBlazeAssociates\Geocoding\PostalCodes\Geocoders\USPostalCodeGeocoder( $geocoding_provider );

    // TODO Create a map between country codes and implementation class names.
  }
}
