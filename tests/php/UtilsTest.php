<?php

namespace BlueBlazeAssociates\Geocoding\Tests;

use BlueBlazeAssociates\Geocoding\Utils;

/**
 * @author Ed Gifford
 */
class UtilsTest extends \PHPUnit_Framework_TestCase {
  private static $package_exception = '\BlueBlazeAssociates\Geocoding\GeocodingException';

  /*
   * TEST validate_distance()
   */

  /**
   * Test normal call to validate_distance().
   */
  public function testValidateDistance() {
    // Arrange.
    $distance = 60;

    // Act.
    $valid = Utils::validate_distance( $distance );

    // Assert
    $this->assertEquals( true, $valid );
  }

  /**
   * Test exceptional call to validate_distance().
   */
  public function testValidateDistanceFloatInvalid() {
    // Arrange.
    $distance = 60.5;

    // Act.
    $valid = Utils::validate_distance( $distance );

    // Assert
    $this->assertEquals( false, $valid );
  }

  /**
   * Test exceptional call to validate_distance().
   */
  public function testValidateDistanceFloatText() {
    // Arrange.
    $distance = 'Hello';

    // Act.
    $valid = Utils::validate_distance( $distance );

    // Assert
    $this->assertEquals( false, $valid );
  }
}
