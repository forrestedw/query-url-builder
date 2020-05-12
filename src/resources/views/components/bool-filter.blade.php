@if(! QueryUrl::hasFilter($filterAttribute))

    <a href="{{ QueryUrl::setFilter($filterAttribute, true)->build() }}">{{ $filterDisplay }} - all</a>

@elseif(QueryUrl::filter($filterAttribute) === true)

    <a href="{{ QueryUrl::setFilter($filterAttribute, false)->build() }}">{{ $filterDisplay }}</a>

@else

    <a href="{{ QueryUrl::removeFilter($filterAttribute)->build() }}">{{ $filterDisplay }}</a>

@endif
