
@if(QueryUrl::sort === $sort)

    <a href="{{ QueryUrl::reserveSort()->build() }}">{{ $sort }}, asc</a>

@elseif(QueryUrl::sort === "-{$sort}")

    <a href="{{ QueryUrl::removeSort()->build() }}">{{ $sort }}, desc</a>

@else

    <a href="{{ QueryUrl::sortBy($sort)->build() }}">{{ $sort }}</a>

@endif
