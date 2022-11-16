# simple-list-formatter
Simple list formatter for UI development ease of use.

This id a package to format your collections of data based on the UI needs. You can format "laravel collection", "eloquent collection" and "array".
you can create a preset for every page of your application in the database and then just pass the data and preset to the facade and get the parsed result with
desired columns, with sortability, searchability and dynamic paging. you can also pass metadata to the preset and it will be delivered to UI with the resultint list.


For installation run:

```shell
composer require amirsadjad/simple-list-formatter
```

then publish the config file by running:
```shell
php artisan vendor:publish --tag=simple-list-formatter-config
```

to migrate the table run:
```shell
php artisan migrate
```

Basic Usage:
```php
use Amirsadjad\SimpleListFormatter\Facades\SimpleList;

// you need to start by using the function Of()
$list = SimpleList::Of($data, $preset);

// you can chain other methods
$list->search($query);
$list->sortBy($columnName, false);
$list->pageNumber($pageNumber);

// you have to run the generate() at the end to parse the data
$list->generate()
```

To interacting with presets table you can either use the Model class
```php
SimpleListPresets::find($name);
```

Or you can use the built in APIs:
https://www.getpostman.com/collections/64bcf64f6a05fc87cc8b

You can see an example of how to use this package in a project here:
https://github.com/Amirsadjad/simple-list-formatter-example

