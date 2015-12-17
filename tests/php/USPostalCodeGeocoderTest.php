<?php

namespace BlueBlazeAssociates\Geocoding\Tests;

use BlueBlazeAssociates\Geocoding\PostalCodes\Providers\GoogleMapsProvider;
use BlueBlazeAssociates\Geocoding\LatLon;
use BlueBlazeAssociates\Geocoding\PostalCodes\Geocoders\USPostalCodeGeocoder;

/**
 * @author Ed Gifford
 */
class USPostalCodeGeocoderTest extends \PHPUnit_Framework_TestCase {
  private static $expected_class = '\BlueBlazeAssociates\Geocoding\PostalCodes\Geocoders\USPostalCodeGeocoder';
  private static $package_exception = '\BlueBlazeAssociates\Geocoding\GeocodingException';

  /*
   * Test validating Integer values.
   */

  /**
   * Validate ZIP code 11111.
   */
  public function testPostalCode_11111_Integer() {
    // Arrange.
    $postal_code = 11111;

    // Act.
    $result = USPostalCodeGeocoder::validate_postal_code( $postal_code );

    // Assert
    $this->assertEquals( true, $result );
  }

  /**
   * Validate ZIP code 99999.
   */
  public function testPostalCode_99999_Integer() {
    // Arrange.
    $postal_code = 99999;

    // Act.
    $result = USPostalCodeGeocoder::validate_postal_code( $postal_code );

    // Assert
    $this->assertEquals( true, $result );
  }

  /**
   * Test invalid ZIP code 0.
   */
  public function testPostalCode_0_IntegerInvalid() {
    // Arrange.
    $postal_code = 0;

    // Act.
    $result = USPostalCodeGeocoder::validate_postal_code( $postal_code );

    // Assert
    $this->assertEquals( false, $result );
  }

  /**
   * Test invalid ZIP code 1.
   */
  public function testPostalCode_1_IntegerInvalid() {
    // Arrange.
    $postal_code = 1;

    // Act.
    $result = USPostalCodeGeocoder::validate_postal_code( $postal_code );

    // Assert
    $this->assertEquals( false, $result );
  }

  /**
   * Test invalid ZIP code 100000.
   */
  public function testPostalCode_100000_IntegerInvalid() {
    // Arrange.
    $postal_code = 100000;

    // Act.
    $result = USPostalCodeGeocoder::validate_postal_code( $postal_code );

    // Assert
    $this->assertEquals( false, $result );
  }

  /*
   * Test validating String values.
   */

  /**
   * Validate ZIP code 00001.
   */
  public function testPostalCode_00001_String() {
    // Arrange.
    $postal_code = '00001';

    // Act.
    $result = USPostalCodeGeocoder::validate_postal_code( $postal_code );

    // Assert
    $this->assertEquals( true, $result );
  }

  /**
   * Validate ZIP code 99999.
   */
  public function testPostalCode_99999_String() {
    // Arrange.
    $postal_code = '99999';

    // Act.
    $result = USPostalCodeGeocoder::validate_postal_code( $postal_code );

    // Assert
    $this->assertEquals( true, $result );
  }

  /**
   * Test invalid ZIP code 0.
   */
  public function testPostalCode_0_StringInvalid() {
    // Arrange.
    $postal_code = '0';

    // Act.
    $result = USPostalCodeGeocoder::validate_postal_code( $postal_code );

    // Assert
    $this->assertEquals( false, $result );
  }

  /**
   * Test invalid ZIP code 1.
   */
  public function testPostalCode_1_StringInvalid() {
    // Arrange.
    $postal_code = '1';

    // Act.
    $result = USPostalCodeGeocoder::validate_postal_code( $postal_code );

    // Assert
    $this->assertEquals( false, $result );
  }

  /**
   * Test invalid ZIP code 100000.
   */
  public function testPostalCode_100000_StringInvalid() {
    // Arrange.
    $postal_code = '100000';

    // Act.
    $result = USPostalCodeGeocoder::validate_postal_code( $postal_code );

    // Assert
    $this->assertEquals( false, $result );
  }

  /*
   * Test constructor.
   */

  /**
   * Test constructor.
   */
  public function testConstructor() {
    // Arrange.
    $geocoding_provider = new GoogleMapsProvider();

    // Act.
    $us_geocoder = new USPostalCodeGeocoder( $geocoding_provider );

    // Assert
    $this->assertInstanceOf( static::$expected_class, $us_geocoder );
  }

  /**
   * Test constructor - but with wrong parameter.
   */
  public function testConstructorInvalid() {
    $this->setExpectedException( static::$package_exception );

    // Arrange.
    $stdClass = new \stdClass();

    // Act.
    $us_geocoder = new USPostalCodeGeocoder( $stdClass );

    // Assert
    // Let it go to parent class.
  }

  /**
   *
   */
  public function testGeocode() {
    // Arrange.
    $expected = new LatLon( 39.7329896, -75.6789905 );
    $postal_code = '19808';
    $geocoding_provider = new GoogleMapsProvider();
    $us_geocoder = new USPostalCodeGeocoder( $geocoding_provider );

    // Act.
    $latlot = $us_geocoder->geocode( $postal_code );

    // Assert
    $this->assertEquals( $expected, $latlot );
  }

  /**
   *
   */
  public function testGeocodeInvalid() {
    $this->setExpectedException( static::$package_exception );

    // Arrange.
    $postal_code = '1234';
    $geocoding_provider = new GoogleMapsProvider();
    $us_geocoder = new USPostalCodeGeocoder( $geocoding_provider );

    // Act.
    $latlot = $us_geocoder->geocode( $postal_code );

    // Assert
    // Let it go to parent class.
  }


  // Assert
  // Let it go to parent class.

//   /**
//    * Try to force underlying libraries to throw an exception.
//    *
//    * The underlying \Geocoder\Provider\GoogleMaps provider does not handle IP addresses.
//    */
//   public function testUnderlyingException() {
//     $this->setExpectedException( static::$package_exception );

//     // Arrange.
//     $postal_code = '192.168.1.1';
//     $provider = new GoogleMapsProvider();

//     // Act.
//     $latlot = $provider->geocode( $postal_code );

//     // Assert
//     // Let it go to parent class.
//   }

//   /**
//    * Try to force exception because zero results.
//    */
//   public function testNoResultsException() {
//     $this->setExpectedException( static::$package_exception );

//     // Arrange.
//     $postal_code = '99999';
//     $provider = new GoogleMapsProvider();

//     // Act.
//     $latlot = $provider->geocode( $postal_code );

//     // Assert
//     // Let it go to parent class.
//   }

//   /**
//    *
//    */
//   public function testGeocode() {
//     // Arrange.
//     $expected = new LatLon( 39.7329896, -75.6789905 );
//     $postal_code = '19808';
//     $provider = new GoogleMapsProvider();

//     // Act.
//     $latlot = $provider->geocode( $postal_code );

//     // Assert
//     $this->assertEquals( $expected, $latlot );
//   }
}
