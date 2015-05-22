# Datafilter

[![Build Status](https://travis-ci.org/tsmsogn/Datafilter.svg?branch=master)](https://travis-ci.org/tsmsogn/Datafilter)

## Requirements

- CakePHP 2.x

## Installation

Put your app plugin directory as `Datafilter`.

### Enable plugin

In 2.0 you need to enable the plugin your app/Config/bootstrap.php file:

```php
<?php
CakePlugin::load('Datafilter', array('bootstrap' => false, 'routes' => false));
?>
```

## Usage

In controller:

```php
<?php
App::uses('AppController', 'Controller');

class PostsController extends Controller {

	public $components = array('Datafilter.Datafilter');

	public function add() {

		// Apply trim() to all values
		$this->Datafilter->applyFilter('__ALL__', 'trim');
		// Apply user function to specific values
		$this->Datafilter->applyFilter(array('Post.name', 'Tag.{n}.name'), function($value) {
		    return 'prefix_' . $value;
		});

	}

}
```

## License

The MIT License (MIT) tsmsogn
