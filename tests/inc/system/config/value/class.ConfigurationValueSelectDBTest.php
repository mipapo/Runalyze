<?php

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2014-09-05 at 13:33:51.
 */
class ConfigurationValueSelectDBTest extends PHPUnit_Framework_TestCase {

	/**
	 * @var ConfigurationValueSelectDB
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		$this->object = new ConfigurationValueSelectDB('key', array('table' => 'table', 'column' => 'col'));
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		ConfigurationValueSelectDB::resetValues();
	}

	/**
	 * @covers ConfigurationValueSelectDB::set
	 * @covers ConfigurationValueSelectDB::allValues
	 * @covers ConfigurationValueSelectDB::resetValues
	 * @todo   Implement testAllValues().
	 */
	public function testAllValues() {
		ConfigurationValueSelectDB::resetValues();

		$this->object->set(1);
		$this->assertEquals( 1, $this->object->value() );
		$this->assertEquals( array('key' => array('value' => 1, 'table' => 'table')), ConfigurationValueSelectDB::allValues() );

		$this->object = new ConfigurationValueSelectDB('foo', array('table' => 'table', 'column' => 'col'));
		$this->object->set('bar');

		$this->assertEquals( array(
			'key' => array('value' => 1, 'table' => 'table'),
			'foo' => array('value' => 'bar', 'table' => 'table')
		), ConfigurationValueSelectDB::allValues() );

		ConfigurationValueSelectDB::resetValues();

		$this->assertEquals( array(), ConfigurationValueSelectDB::allValues() );
	}

}
