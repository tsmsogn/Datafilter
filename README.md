# Datafilter

Applies a filter for given field(s)

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

	public function foo() {
		// Applies strtoupper() for all values
		/*
		$this->request->data looks like:
		Array
		(
			[Post] => Array
			(
				[key] => value
			)
		)
		*/

		$this->Datafilter->applyFilter('__ALL__', 'strtoupper');

		/*
		$this->request->data looks like:
		Array
		(
			[Post] => Array
			(
				[key] => VALUE
			)
		)
		*/
	}

	public function bar() {
		// Applies strtoupper() for specific field(s)
		/*
		$this->request->data looks like:
		Array
        (
            [Post] => Array
            (
                [key1] => value1
                [key2] => value2
            )
        )
        */

		$this->Datafilter->applyFilter('Post.key1', 'strtoupper');

		/*
        $this->request->data looks like:
        Array
        (
            [Post] => Array
            (
                [key1] => VALUE1
                [key2] => value2
            )
        )
        */
	}

	public function baz() {
	    // Applies user function for specific field(s) with {}'s
	    /*
		$this->request->data looks like:
	    Array
        (
            [Post] => Array
            (
                [key1] =>  value1
            )
            [Tag] => Array
            (
                [0] => Array
                (
                    [name] => value2
                )
                [1] => Array
                (
                    [name] => value3
                )
            )
        )
        */

		$this->Datafilter->applyFilter(array('Tag.{n}.name'), function($value) {
		    return 'prefix_' . $value;
		});

	    /*
		$this->request->data looks like:
	    Array
        (
            [Post] => Array
            (
                [key1] => value1
            )
            [Tag] => Array
            (
                [0] => Array
                (
                    [name] => prefix_value2
                )
                [1] => Array
                (
                    [name] => prefix_value3
                )
            )
        )
        */
	}

}
```

## License

The MIT License (MIT) tsmsogn
