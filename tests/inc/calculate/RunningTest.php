<?php

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2013-05-11 at 22:26:28.
 */
class RunningTest extends PHPUnit_Framework_TestCase {
	protected $object;

	protected function setUp() {
	}

	protected function tearDown() {
	}

	/**
	 * Need to reset internal static value to 'false', otherwise value won't be recalculated
	 * @covers Running::getAverageMonthPace
	 */
	public function testGetAverageMonthPace() {
		$this->assertEquals( 0, Running::getAverageMonthPace() );

		$class = new ReflectionClass('Running');
		$property = $class->getProperty('AverageMonthPace');
		$property->setAccessible(true);
		$property->setValue(false);

		DB::getInstance()->insert('training', array('sportid', 'time', 's', 'distance'), array(Configuration::General()->runningSport(), time(), 360, 1) );
		$this->assertEquals( 6.0, Running::getAverageMonthPace() );

		$property->setValue(false);

		DB::getInstance()->insert('training', array('sportid', 'time', 's', 'distance'), array(Configuration::General()->runningSport(), time(), 300, 1) );
		$this->assertEquals( 5.5, Running::getAverageMonthPace() );

		$property->setValue(false);

		DB::getInstance()->insert('training', array('sportid', 'time', 's', 'distance'), array(Configuration::General()->runningSport(), 0, 300, 1) );
		$this->assertEquals( 5.5, Running::getAverageMonthPace() );

		DB::getInstance()->exec('TRUNCATE TABLE `runalyze_training`');
	}

	/**
	 * @covers Running::possibleKmInDays
	 */
	public function testPossibleKmInDays() {
		// Not possible without data in database
		$this->assertFalse( Running::possibleKmInDays(10) );
	}

	/**
	 * @covers Running::possibleKmInOneWeek
	 */
	public function testPossibleKmInOneWeek() {
		// Not possible without data in database
		$this->assertFalse( Running::possibleKmInOneWeek() );
	}

	/**
	 * @covers Running::possibleKmInOneMonth
	 */
	public function testPossibleKmInOneMonth() {
		// Not possible without data in database
		$this->assertFalse( Running::possibleKmInOneMonth() );
	}

	/**
	 * @covers Running::Km
	 */
	public function testKm() {
		$this->assertEquals( '100m', Running::Km(0.1, 0, true) );
		$this->assertEquals( '3.000m', Running::Km(3, 0, true) );
		$this->assertEquals( '3&nbsp;km', Running::Km(3, 0) );
		$this->assertEquals( '3,0&nbsp;km', Running::Km(3, 1) );
		$this->assertEquals( '3,00&nbsp;km', Running::Km(3, 2) );
	}

	/**
	 * @covers Running::PersonalBest
	 */
	public function testPersonalBest() {
		// Not possible without data in database
		$this->assertEquals( 0, Running::PersonalBest(5, true) );
		$this->assertEquals( '<em>none</em>', Running::PersonalBest(5) );
	}

	/**
	 * @covers Running::PulseString
	 */
	public function testPulseString() {
		$this->assertEquals( '', Running::PulseString(0) );

		// Used: define('CONF_PULS_MODE', 'hfmax');
		$this->assertEquals( '57&nbsp;&#37;', strip_tags(Running::PulseString(114)) );

		// TODO: other return values ... with Ajax::tooltip ...
	}

	/**
	 * @covers Running::PulseStringInBpm
	 */
	public function testPulseStringInBpm() {
		$this->assertEquals( '120&nbsp;bpm', Running::PulseStringInBpm(120) );
		$this->assertEquals( '120&nbsp;bpm', Running::PulseStringInBpm(120.3) );
	}

	/**
	 * @covers Running::PulseStringInPercent
	 */
	public function testPulseStringInPercent() {
		// Can't be tested due to CONF_PULS_MODE
		//$this->assertEquals( '25&nbsp;&#37;', Running::PulseStringInPercent(80, 200, 40) );
	}

	/**
	 * @covers Running::PulseStringInPercentHRmax
	 */
	public function testPulseStringInPercentHRmax() {
		$this->assertEquals( '65&nbsp;&#37;', Running::PulseStringInPercentHRmax(130) );
		$this->assertEquals( '50&nbsp;&#37;', Running::PulseStringInPercentHRmax(80, 160) );
	}

	/**
	 * @covers Running::PulseInPercentHRmax
	 */
	public function testPulseInPercentHRmax() {
		$this->assertEquals( 60, Running::PulseInPercentHRmax(96, 160) );
	}

	/**
	 * @covers Running::PulseStringInPercentReserve
	 */
	public function testPulseStringInPercentReserve() {
		$this->assertEquals( '60&nbsp;&#37;', Running::PulseStringInPercentReserve(160, 200, 100) );
	}

	/**
	 * @covers Running::PulseInPercentReserve
	 */
	public function testPulseInPercentReserve() {
		$this->assertEquals( 60, Running::PulseInPercentReserve(160, 200, 100) );
	}

	/**
	 * @covers Running::Stresscolor
	 */
	public function testStresscolor() {
		$this->assertEquals( 'C8c8c8', Running::Stresscolor(0) );
		$this->assertEquals( 'C80000', Running::Stresscolor(100) );
	}

	/**
	 * @covers Running::DescriptionToDemandedPace
	 */
	public function testDescriptionToDemandedPace() {
		$this->assertEquals( 0, Running::DescriptionToDemandedPace('ohne Angabe') );
		$this->assertEquals( 80, Running::DescriptionToDemandedPace('400m in 1:20, 200m TP') );
		$this->assertEquals( 200, Running::DescriptionToDemandedPace('1 km in 3:20, bla blubb') );
		$this->assertEquals( 3600, Running::DescriptionToDemandedPace('10 km in 60:00 oder 15 km schneller') );
	}

	/**
	 * @covers Running::VDOTfactorOfBasicEndurance
	 */
	public function testVDOTfactorOfBasicEndurance() {
		// TODO: Needs BasicEndurance
		$this->assertEquals( 1.0, round(Running::VDOTfactorOfBasicEndurance(1), 2) );
		$this->assertEquals( 0.97, round(Running::VDOTfactorOfBasicEndurance(5), 2) );
		$this->assertEquals( 0.93, round(Running::VDOTfactorOfBasicEndurance(10), 2) );
		$this->assertEquals( 0.83, round(Running::VDOTfactorOfBasicEndurance(21.1), 2) );
		$this->assertEquals( 0.6, round(Running::VDOTfactorOfBasicEndurance(42.2), 2) );
		$this->assertEquals( 0.6, round(Running::VDOTfactorOfBasicEndurance(50), 2) );
		$this->assertEquals( 0.6, round(Running::VDOTfactorOfBasicEndurance(100), 2) );
	}

	/**
	 * @covers Running::getBEDaysForWeekKm
	 * @todo   Implement testGetBEDaysForWeekKm().
	 */
	public function testGetBEDaysForWeekKm() {
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
				'This test has not been implemented yet.'
		);
	}

	/**
	 * @covers Running::getBETargetWeekKm
	 * @todo   Implement testGetBETargetWeekKm().
	 */
	public function testGetBETargetWeekKm() {
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
				'This test has not been implemented yet.'
		);
	}

	/**
	 * @covers Running::getBETargetLongjogKmPerWeek
	 * @todo   Implement testGetBETargetLongjogKmPerWeek().
	 */
	public function testGetBETargetLongjogKmPerWeek() {
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
				'This test has not been implemented yet.'
		);
	}

	/**
	 * @covers Running::getBErealTargetLongjogKmPerWeek
	 * @todo   Implement testGetBErealTargetLongjogKmPerWeek().
	 */
	public function testGetBErealTargetLongjogKmPerWeek() {
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
				'This test has not been implemented yet.'
		);
	}

}
