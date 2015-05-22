<?php
App::uses('Component', 'Controller');

class DatafilterComponent extends Component {

/**
 * @param ComponentCollection $collection
 * @param array $settings
 */
	public function __construct(ComponentCollection $collection, $settings = array()) {
		$this->settings = Set::merge($this->settings, $settings);
		parent::__construct($collection, $this->settings);
	}

/**
 * @param Controller $controller
 */
	public function startup(Controller $controller) {
		$this->controller = $controller;
	}

/**
 * @param $elements
 * @param $filter
 * @throws Exception
 */
	public function applyFilter($elements, $filter) {
		if (!is_callable($filter)) {
			throw new Exception('Callable function dose not exist');
		}
		if (!is_array($elements)) {
			$elements = array($elements);
		}
		foreach ($elements as $element) {
			$this->controller->data = $this->_recursiveFilter($filter, $this->controller->data, $element);
		}
	}

/**
 * @param $filter
 * @param $value
 * @param $element
 * @param string $path
 * @return array|mixed
 */
	protected function _recursiveFilter($filter, $value, $element, $path = '') {
		if (is_array($value)) {
			$cleanValues = array();
			$parent = $path;
			foreach ($value as $k => $v) {
				$path = ($parent !== '') ? $parent . '.' . $k : $k;
				$cleanValues[$k] = $this->_recursiveFilter($filter, $v, $element, $path);
			}
			return $cleanValues;
		} else {
			if ($element === '__ALL__' || Set::matches($element, Set::expand(array($path => '')))) {
				return call_user_func($filter, $value);
			} else {
				return $value;
			}
		}
	}

}
