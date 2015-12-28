<?php
App::uses('Controller', 'Controller');
App::uses('DatafilterComponent', 'Datafilter.Controller/Component');

class TestDatafilterComponent extends DatafilterComponent {

}

class TestDatafilterController extends Controller {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Session', 'TestDatafilter');

}

/**
 * DatafilterComponent Test Case
 *
 */
class DatafilterComponentTest extends CakeTestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$CakeRequest = new CakeRequest();
		$CakeResponse = new CakeResponse();
		$this->Controller = new TestDatafilterController($CakeRequest, $CakeResponse);
		$this->Controller->Components->init($this->Controller);
		$this->Datafilter = $this->Controller->TestDatafilter;
		$this->Datafilter->startup($this->Controller);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Datafilter);

		parent::tearDown();
	}

/**
 * testApplyFilterUno method
 *
 * @expectedException Exception
 * @return void
 */
	public function testApplyFilterUno() {
		$this->Datafilter->applyFilter('Post.foo', 'not_callable_function');
	}

/**
 * testApplyFilterDos method
 *
 * @return void
 */
	public function testApplyFilterDos() {
		$this->Controller->request->data = array(
			'Post' => array(
				'foo' => ' bar '
			),
		);
		$this->Datafilter->applyFilter('__ALL__', 'trim');

		$expected = array(
			'Post' => array(
				'foo' => 'bar'
			),
		);

		$actual = $this->Controller->request->data;

		$this->assertEquals($expected, $actual);
	}

/**
 * testApplyFilterTres method
 *
 * @return void
 */
	public function testApplyFilterTres() {
		$this->Controller->request->data = array(
			'Post' => array(
				array(
					'name' => ' post '
				),
			),
			'Tag' => array(
				array(
					'name' => ' tag1 '
				),
				array(
					'name' => ' tag2 '
				),
			)
		);
		$this->Datafilter->applyFilter('Tag.{n}.name', 'trim');

		$expected = array(
			'Post' => array(
				array(
					'name' => ' post '
				),
			),
			'Tag' => array(
				array(
					'name' => 'tag1'
				),
				array(
					'name' => 'tag2'
				),
			)
		);

		$actual = $this->Controller->request->data;

		$this->assertEquals($expected, $actual);
	}

/**
 * testApplyFilterCuatro method
 *
 * @return void
 */
	public function testApplyFilterCuatro() {
		$this->Controller->request->data = array(
			'Post' => array(
				'key1' => ' value1 ',
				'key2' => ' value2 '
			)
		);
		$this->Datafilter->applyFilter(array('Post.key1'), 'trim');

		$expected = array(
			'Post' => array(
				'key1' => 'value1',
				'key2' => ' value2 ',
			)
		);

		$actual = $this->Controller->request->data;

		$this->assertEquals($expected, $actual);
	}

}
