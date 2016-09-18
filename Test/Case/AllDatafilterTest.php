<?php
/**
 * All Datafilter plugin tests
 */
class AllDatafilterTest extends CakeTestCase {

/**
 * Suite define the tests for this plugin
 *
 * @return void
 */
	public static function suite() {
		$suite = new CakeTestSuite('All Datafilter test');

		$path = CakePlugin::path('Datafilter') . 'Test' . DS . 'Case' . DS;
		$suite->addTestDirectoryRecursive($path);

		return $suite;
	}

}
