<?php

namespace BlueBlazeAssociates\Geocoding\Tests;

use BlueBlazeAssociates\Geocoding\LatLon;

/**
 * @author Ed Gifford
 */
class LatLonTest extends \PHPUnit_Framework_TestCase {
  private static $package_exception = '\BlueBlazeAssociates\Geocoding\GeocodingException';

  /**
   * Test normal constructor call with valid latitude value.
   */
  public function testContructorLat() {
    // Arrange.
    $lat_value = 60.0;
    $lon_value = 65.0;

    // Act.
    $latlon = new LatLon( $lat_value, $lon_value  );

    // Assert
    $this->assertEquals( $lat_value, $latlon->getLat() );
  }

  /**
   * Test normal constructor call with valid longitude value.
   */
  public function testContructorLon() {
    // Arrange.
    $lat_value = 60.0;
    $lon_value = 65.0;

    // Act.
    $latlon = new LatLon( $lat_value, $lon_value  );

    // Assert
    $this->assertEquals( $lon_value, $latlon->getLon() );
  }

  /**
   * Test exceptional constructor call with invalid latitude value.
   */
  public function testContructorLatTextException() {
    $this->setExpectedException( static::$package_exception );

    // Arrange.
    $lat_value = 'Hello';
    $lon_value = 65.0;

    // Act.
    $latlon = new LatLon( $lat_value, $lon_value  );

    // Assert
    // Let it go to parent class.
  }

  /**
   * Test exceptional constructor call with invalid longitude value.
   */
  public function testContructorLonTextException() {
    $this->setExpectedException( static::$package_exception );

    // Arrange.
    $lat_value = 60.0;
    $lon_value = 'Hello';

    // Act.
    $latlon = new LatLon( $lat_value, $lon_value  );

    // Assert
    // Let it go to parent class.
  }

  /**
   * Test exceptional constructor call with latitude value less than -90.0.
   */
  public function testContructorLatBelowRangeException() {
    $this->setExpectedException( static::$package_exception );

    // Arrange.
    $lat_value = -100.0;
    $lon_value = 65.0;

    // Act.
    $latlon = new LatLon( $lat_value, $lon_value  );

    // Assert
    // Let it go to parent class.
  }

  /**
   * Test exceptional constructor call with latitude value greater than 90.0.
   */
  public function testContructorLatAboveRangeException() {
    $this->setExpectedException( static::$package_exception );

    // Arrange.
    $lat_value = 100.0;
    $lon_value = 65.0;

    // Act.
    $latlon = new LatLon( $lat_value, $lon_value  );

    // Assert
    // Let it go to parent class.
  }

  /**
   * Test exceptional constructor call with longitude value less than -180.0.
   */
  public function testContructorLonBelowRangeException() {
    $this->setExpectedException( static::$package_exception );

    // Arrange.
    $lat_value = 60.0;
    $lon_value = -190.0;

    // Act.
    $latlon = new LatLon( $lat_value, $lon_value  );

    // Assert
    // Let it go to parent class.
  }

  /**
   * Test exceptional constructor call with latitude value greater than 180.0.
   */
  public function testContructorLonAboveRangeException() {
    $this->setExpectedException( static::$package_exception );

    // Arrange.
    $lat_value = 60.0;
    $lon_value = 190.0;

    // Act.
    $latlon = new LatLon( $lat_value, $lon_value  );

    // Assert
    // Let it go to parent class.
  }
}
