<?php

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2014-09-09 at 14:10:24.
 */
class HeartRateUnitTest extends PHPUnit_Framework_TestCase {

	/**
	 * @var HeartRateUnit
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		$this->object = new HeartRateUnit('key');
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		
	}

	/**
	 * @covers HeartRateUnit::isBPM
	 * @covers HeartRateUnit::isHRmax
	 * @covers HeartRateUnit::isHRreserve
	 */
	public function testValues() {
		$this->assertFalse( $this->object->isBPM() );
		$this->assertTrue( $this->object->isHRmax() );
		$this->assertFalse( $this->object->isHRreserve() );

		$this->object->set( HeartRateUnit::BPM );
		$this->assertTrue( $this->object->isBPM() );
		$this->assertFalse( $this->object->isHRmax() );
		$this->assertFalse( $this->object->isHRreserve() );

		$this->object->set( HeartRateUnit::HRRESERVE );
		$this->assertFalse( $this->object->isBPM() );
		$this->assertFalse( $this->object->isHRmax() );
		$this->assertTrue( $this->object->isHRreserve() );
	}

}
