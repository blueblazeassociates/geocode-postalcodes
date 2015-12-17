<?php

namespace BlueBlazeAssociates\Geocoding\Tests;

use BlueBlazeAssociates\Geocoding\PostalCodes\Providers\GoogleMapsProvider;
use BlueBlazeAssociates\Geocoding\LatLon;

/**
 * @author Ed Gifford
 */
class GoogleMapsProviderTest extends \PHPUnit_Framework_TestCase {
  private static $package_exception = '\BlueBlazeAssociates\Geocoding\GeocodingException';

  /**
   * Try to force underlying libraries to throw an exception.
   *
   * The underlying \Geocoder\Provider\GoogleMaps provider does not handle IP addresses.
   */
  public function testUnderlyingException() {
    $this->setExpectedException( static::$package_exception );

    // Arrange.
    $postal_code = '192.168.1.1';
    $provider = new GoogleMapsProvider();

    // Act.
    $latlot = $provider->geocode( $postal_code );

    // Assert
    // Let it go to parent class.
  }

  /**
   * Try to force exception because zero results.
   */
  public function testNoResultsException() {
    $this->setExpectedException( static::$package_exception );

    // Arrange.
    $postal_code = '99999';
    $provider = new GoogleMapsProvider();

    // Act.
    $latlot = $provider->geocode( $postal_code );

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
    $provider = new GoogleMapsProvider();

    // Act.
    $latlot = $provider->geocode( $postal_code );

    // Assert
    $this->assertEquals( $expected, $latlot );
  }
}
