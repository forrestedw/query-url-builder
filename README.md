# Easy query url building

![Packagist Version](https://img.shields.io/packagist/v/forrestedw/query-url-builder)  [![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)  ![Test](https://github.com/forrestedw/query-url-builder/workflows/Test/badge.svg)

This packages makes it easy to make the links necessary for use in the front en with [spatie/laravel-query-builder](https://docs.spatie.be/laravel-query-builder). The package is amazing helpful for the back end, and the front end is outside of the scope of the project. Creating the links for the front end can be verbose. This package makes it easy.

## Installation
```bash
$ composer require forrestedw/query-url-builder
```


## Basic usage
For greatest convenience, use it from the facade.
```php
use Forrestedw\QueryUrlBuilder\QueryUrl;
```

### Sort
#### Set a sort
```php
QueryUrl::sortBy('name')->build(); // http://example.test/?sort=name, ie name ASC

QueryUrl::sortBy('-name')->build(); // http://example.test/?sort=-name, ie name DESC
```

#### Access the sort
```php
// On page  http://example.test/?sort=name

QueryUrl::sort === 'name' // true

QueryUrl::sort === '-name' // false
```

#### Reverse the sort
```php
// On page http://example.test/?sort=name

QueryUrl::reverseSort()->build(); // http://example.test/?sort=-name, ie ASC goes to DESC


// On page http://example.test/?sort=-name 

QueryUrl::reverseSort()->build(); // http://example.test/?sort=name, ie DESC goes to ASC
```

#### Remove a sort
```php
// On page http://example.test/?sort=name

QueryUrl::removeSort()->build(); // http://example.test/
```

### Filter
#### Check if a filter is set
```php
// On page http://example.test/?filter[name]=Joe

QueryUrl::hasFilter('name') // true

QueryUrl::hasFilter('email') // false
```

#### Set filters
```php
QueryUrl::setFilter('active', true)->build() // http://example.test/?filter[active]=1

QueryUrl::setFilter('active', false)->build() // http://example.test/?filter[active]=0

QueryUrl::setFilter('active', true)->setFilter('valid', false)->setFilter('name','John')->build() // returns http://example.test/?filter[active]=1&filter[valid]=0&filter[name]=John
```
Filters can also be set using an associative array:

```php
$filters = [
    'active' => false,
    'valid' => true,
];

QueryUrl::setFilters($filters)->build() // http://example.test/?filter[active]=0&filter[valid]=1
```

#### Remove a filter
```php
// On page http://example.test/?filter[active]=1&filter[valid]=0&filter[name]=John

QueryUrl::removeFilter('active')->build(); // http://example.test/?&filter[valid]=0&filter[name]=John
```

#### Combine various `sort` and `filter` options
```php
// On page http://example.test/?filter[active]=1&filter[valid]=0&filter[name]=John

QueryUrl::add('active', true)->sortBy('-email')->build(); // http://example.test/?&filter[active]=1&sort=-email, ie active users sorted by email DESC
```

#### forUrl()
By default, `QueryUrl` returns the new query params for the route you are already on:

```php
// On page http://example.test/

QueryUrl::setFilter('someFilter',true)->build(); // http://example.test/?filter=[someFilter]=1
```

If you need a different url, use `forUrl()`. It accepts plain urls or named routes:

```php
// On page http://example.test/

QueryUrl::forUrl('this/then/that/')->setFilter('someFilter',true)->build(); // http://example.com/this/then/that?filter=[someFilter]=1

QueryUrl::forUrl('project.show', ['project_id' => 1])->setFilter('someFilter',true)->build(); // http://example.test/projects/1?filter=[someFilter]=1
```
____


### Using in blade
Use the `queryUrl()` in your blade files like below.

#### Sorting
The following example will create a link that cycles through three states of being sorted:

1. Sorted A-Z
2. Sorted Z-A
3. Unsorted.


```php
@if(QueryUrl::getSort() === 'name')

    <a href="{{ QueryUrl::reserveSort()->build() }}">Name - showing A-Z</a>

@elseif(QueryUrl::getSort() === '-name')

    <a href="{{ QueryUrl::removeSort()->build() }}">Name - showing Z-A</a>

@else

    <a href="{{ QueryUrl::sortBy('name')->build() }}">Name - showing unsorted</a>

@endif
```
The url text shows what sort the user will currently be seeing. The link will take the user to the next sort state.

#### Filtering
A similar approach is taken for boolean value filtering, and cycling through the three states:

1. Show `true` only
2. Show `false` only
3. Show all

```php
@if(! QueryUrl::hasFilter('active'))

    <a href="{{ QueryUrl::setFilter('active', true)->build() }}">Active - all</a>

@elseif(QueryUrl::filter('active') === true)

    <a href="{{ QueryUrl::setFilter('active', false)->build() }}">Active</a> // currently showing true only

@else

    <a href="{{ QueryUrl::removeFilter('active')->build() }}">Active</a>  // currently showing true only

@endif
```

#### Blade components
For ease, the two above trios of if-else links can be outputted using the following, respectively:

```php
<x-queryUrl-sort sort="First Name"/>

<x-queryUrl-bool-filter filter="active"/>
```
Behind the scenes the `sort` or `filter` attribute is handled to snake case it for the attribute in question. For example, the sort example displays `First Name` (exactly as passed) but sorts for `first_name`.

___


