<?php
class AllTestsTest extends PHPUnit_Framework_TestSuite {

/**
 * suite
 *
 * @return CakeTestSuite
 */
	public static function suite() {
		$suite = new CakeTestSuite('All Datafilter tests');
		$suite->addTestDirectoryRecursive(CakePlugin::path('Datafilter') . 'Test' . DS . 'Case' . DS);
		return $suite;
	}

}
