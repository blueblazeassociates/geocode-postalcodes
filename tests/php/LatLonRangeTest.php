<?php

namespace BlueBlazeAssociates\Geocoding\Tests;

use BlueBlazeAssociates\Geocoding\LatLon;
use BlueBlazeAssociates\Geocoding\LatLonRange;

/**
 * @author Ed Gifford
 */
class LatLonRangeTest extends \PHPUnit_Framework_TestCase {
  private static $expected_class = '\BlueBlazeAssociates\Geocoding\LatLonRange';
  private static $package_exception = '\BlueBlazeAssociates\Geocoding\GeocodingException';

  /**
   * Test normal call to constructor.
   */
  public function testConstructorNormal() {
    // Arrange.
    $min = new LatLon(0, 0);
    $max = new LatLon(10, 10);

    // Act.
    $range = new LatLonRange( $min, $max );

    // Assert
    $this->assertInstanceOf( static::$expected_class, $range );
  }

  /**
   * Test exceptional call to constructor with bad object for $min parameter.
   */
  public function testConstructorMinBadTypeException() {
    $this->setExpectedException( static::$package_exception );

    // Arrange.
    $min = new \stdClass();
    $max = new LatLon(10, 10);

    // Act.
    $range = new LatLonRange( $min, $max  );

    // Assert
    // Let it go to parent class.
  }

  /**
   * Test exceptional call to constructor with bad object for $max parameter.
   */
  public function testConstructorMaxBadTypeException() {
    $this->setExpectedException( static::$package_exception );

    // Arrange.
    $min = new LatLon(0, 0);
    $max = new \stdClass();

    // Act.
    $range = new LatLonRange( $min, $max  );

    // Assert
    // Let it go to parent class.
  }

  /**
   * Test exceptional call to constructor with reversed min/max latitudes.
   */
  public function testConstructorLatReversedMinMaxException() {
    $this->setExpectedException( static::$package_exception );

    // Arrange.
    $min = new LatLon(11, 0);
    $max = new LatLon(10, 10);

    // Act.
    $range = new LatLonRange( $min, $max  );

    // Assert
    // Let it go to parent class.
  }

  /**
   * Test exceptional call to constructor with reversed min/max longitudes.
   */
  public function testConstructorLonReversedMinMaxException() {
    $this->setExpectedException( static::$package_exception );

    // Arrange.
    $min = new LatLon(0, 11);
    $max = new LatLon(10, 10);

    // Act.
    $range = new LatLonRange( $min, $max  );

    // Assert
    // Let it go to parent class.
  }

  /**
   * Test call to get_min().
   */
  public function testGetMin() {
    // Arrange.
    $min = new LatLon(0, 0);
    $max = new LatLon(10, 10);

    // Act.
    $range = new LatLonRange( $min, $max  );

    // Assert
    $this->assertEquals( $min, $range->get_min() );
  }

  /**
   * Test call to get_max().
   */
  public function testGetMax() {
    // Arrange.
    $min = new LatLon(0, 0);
    $max = new LatLon(10, 10);

    // Act.
    $range = new LatLonRange( $min, $max  );

    // Assert
    $this->assertEquals( $max, $range->get_max() );
  }

  /**
   * Test call to get_max().
   */
  public function testDistance() {
    // Arrange a hardcoded result. This may fail in the future because of rounding, etc.
    $expected = new LatLonRange( new LatLon( -0.72365777949903,-0.72365777949903 ), new LatLon( 0.72365777949903,0.72365777949903 ) );

    // Act.
    $range = LatLonRange::create_from_distance( new LatLon( 0, 0 ), 50 );

    // Assert
    $this->assertEquals( $expected, $range );
  }
}
