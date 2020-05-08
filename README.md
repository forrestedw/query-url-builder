# Easy query url manipiulation 
This package is designed to complement [spatie/laravel-query-builder](https://docs.spatie.be/laravel-query-builder). The package is helpful for the back end, but manipulating the urls for the front end for use in blade can be verbose. This package makes it very simple to change query parameters to make sorting easy.

## Basic usage
For greatest convenience, create a helper function:
```php
if(! function_exists('queryUrl')) {
    function queryUrl()
    {
        return (new \Forrestedw\QueryUrlBuilder\QueryUrl);
    }
}
```
Then use it like this:
```php 
$queryUrl = queryUrl();
```

### Sort
#### Set a sort
```php
queryUrl()->sortBy('name')->build();
// returns http://example.text/?sort=name
```

#### Access the sort
```php
// On page  http://example.text/?sort=name
queryUrl()->sort === 'name' // true
```

#### Reverse the sort
```php
// On page http://exmaple.text/?sort=name

queryUrl()->reverseSort()->build();
// returns http://example.text/?sort=-name


// On page http://exmaple.text/?sort=-name

queryUrl()->reverseSort()->build();
// returns http://example.text/?sort=name
```

#### Remove a sort
```php
// On page http://exmaple.text/?sort=name

queryUrl()->removeSort()->build();
// returns http://example.text/
```

### Filter
#### Check if a filter is set
```php
// On page http://example.text/?filter[name]=Joe

queryUrl()->hasFilter('name') // true

queryUrl()->hasFilter('email') // false
```

#### Set filters
```php
queryUrl()->setFilter('active', true)->build() //
// returns http://example.text/?filter[active]=true

queryUrl()->setFilter('active', true)->setFilter('valid', false)->setFilter('name','John')->build()

// returns http://example.test/?filter[active]=1&filter[valid]=0&filter[name]=John
```

#### Remove a filter
```php
// On page http://example.test/?filter[active]=1&filter[valid]=0&filter[name]=John

queryUrl()->removeFilter('active')->build();

// returns http://example.test/?&filter[valid]=0&filter[name]=John
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
@if(queryUrl()->sort === 'name')
    <a href="{{ queryUrl()->reserveSort()->build() }}">Name - showing A-Z</a>
@elseif(queryUrl()->sort === '-name')
    <a href="{{ queryUrl()->removeSort()->build() }}">Name - showing Z-A</a>
@else
    <a href="{{ queryUrl()->sortBy('name')->build() }}">Name - showing unsorted</a>
@endif
```
The url text shows what sort the user will currently be seeing. The link will take the user to the next sort state.

#### Filtering
A similar approach is taken for boolean value filtering, and cycling through the three states:

1. Show `true` only
2. Show `false` only
3. Show all

```php
@if(! queryUrl()->hasFilter('active'))
    <a href="{{ queryUrl()->setFilter('active', true)->build() }}">Active - showing all (no filter applied)</a>
@elseif(queryUrl()->filter('active') === true)
    <a href="{{ queryUrl()->setFilter('active', false)->build() }}">Active - showing true only</a>
@else
    <a href="{{ queryUrl()->removeFilter('active')->build() }}">Active - showing false only</a>
@endif
```


