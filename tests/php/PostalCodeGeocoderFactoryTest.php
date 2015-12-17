<?php

namespace BlueBlazeAssociates\Geocoding\Tests;

use BlueBlazeAssociates\Geocoding\PostalCodes\Providers\GoogleMapsProvider;
use BlueBlazeAssociates\Geocoding\PostalCodes\Geocoders\PostalCodeGeocoderFactory;
use BlueBlazeAssociates\Geocoding\GeocodingException;
use BlueBlazeAssociates\Geocoding\GeocodingProviders;
use BlueBlazeAssociates\Geocoding\CountryCodes;

/**
 * @author Ed Gifford
 */
class PostalCodeGeocoderFactoryTest extends \PHPUnit_Framework_TestCase {
  private static $expected_provider = '\BlueBlazeAssociates\Geocoding\PostalCodes\Providers\GoogleMapsProvider';
  private static $expected_geocoder = '\BlueBlazeAssociates\Geocoding\PostalCodes\Geocoders\USPostalCodeGeocoder';
  private static $package_exception = '\BlueBlazeAssociates\Geocoding\GeocodingException';

  /*
   * Test createGeocodingProvider()
   */

  /**
   * Test default createGeocodingProvider()
   */
  public function testProviderDefault() {
    // Arrange.

    // Act.
    $geocoding_provider = PostalCodeGeocoderFactory::createGeocodingProvider();

    // Assert
    $this->assertInstanceOf( static::$expected_provider, $geocoding_provider );
  }

  /**
   * Test createGeocodingProvider() for Google Maps.
   */
  public function testProviderGoogleMaps() {
    // Arrange.

    // Act.
    $geocoding_provider = PostalCodeGeocoderFactory::createGeocodingProvider( GeocodingProviders::GOOGLE_MAPS );

    // Assert
    $this->assertInstanceOf( static::$expected_provider, $geocoding_provider );
  }

  /**
   * Test createGeocodingProvider() invalid code.
   */
  public function testProviderUnknown() {
    $this->setExpectedException( static::$package_exception );

    // Arrange.

    // Act.
    $geocoding_provider = PostalCodeGeocoderFactory::createGeocodingProvider( 'UNKNOWN' );

    // Assert
    // Let it go to parent class.
  }

  /*
   * Test createGeocoder()
   */

  /**
   * Test createGeocoder() defaults.
   */
  public function testGeocoderDefaults() {
    // Arrange.

    // Act.
    $geocoder = PostalCodeGeocoderFactory::createGeocoder();

    // Assert
    $this->assertInstanceOf( static::$expected_geocoder, $geocoder );
  }

  /**
   * Test createGeocoder() with US and default provider.
   */
  public function testGeocoderUSWithDefaultProvider() {
    // Arrange.

    // Act.
    $geocoder = PostalCodeGeocoderFactory::createGeocoder( CountryCodes::US );

    // Assert
    $this->assertInstanceOf( static::$expected_geocoder, $geocoder );
  }

  /**
   * Test createGeocoder() with US and Google Maps.
   */
  public function testGeocoderUSWithGoogleMaps() {
    // Arrange.

    // Act.
    $geocoder = PostalCodeGeocoderFactory::createGeocoder( CountryCodes::US, GeocodingProviders::GOOGLE_MAPS );

    // Assert
    $this->assertInstanceOf( static::$expected_geocoder, $geocoder );
  }

  /**
   * Test createGeocoder() with US and unknown provider.
   */
  public function testGeocoderUSWithUnknownProvider() {
    $this->setExpectedException( static::$package_exception );

    // Arrange.

    // Act.
    $geocoder = PostalCodeGeocoderFactory::createGeocoder( CountryCodes::US, 'UNKNOWN' );

    // Assert
    // Let it go to parent class.
  }

  /**
   * Test createGeocoder() with invalid country and default provider.
   */
  public function testGeocoderInvalidCountryWithDefaultProvider() {
    $this->setExpectedException( static::$package_exception );

    // Arrange.

    // Act.
    $geocoder = PostalCodeGeocoderFactory::createGeocoder( 'INVALID' );

    // Assert
    // Let it go to parent class.
  }

  /**
   * Test createGeocoder() with invalid country and Google Maps.
   */
  public function testGeocoderInvalidCountryWithGoogleMaps() {
    $this->setExpectedException( static::$package_exception );

    // Arrange.

    // Act.
    $geocoder = PostalCodeGeocoderFactory::createGeocoder( 'INVALID', GeocodingProviders::GOOGLE_MAPS );

    // Assert
    // Let it go to parent class.
  }

  /**
   * Test createGeocoder() with invalid country and unknown provider.
   */
  public function testGeocoderInvalidCountryWithUnknownProvider() {
    $this->setExpectedException( static::$package_exception );

    // Arrange.

    // Act.
    $geocoder = PostalCodeGeocoderFactory::createGeocoder( 'INVALID', 'UNKOWN' );

    // Assert
    // Let it go to parent class.
  }
}
