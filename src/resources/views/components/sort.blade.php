
@if(QueryUrl::getSort() === $sortAttribute)

    <a href="{{ QueryUrl::reserveSort()->build() }}">{{ $sortDisplay }}, asc</a>

@elseif(QueryUrl::getSort() === "-{$sortAttribute}")

    <a href="{{ QueryUrl::removeSort()->build() }}">{{ $sortDisplay }}, desc</a>

@else

    <a href="{{ QueryUrl::sortBy($sortAttribute)->build() }}">{{ $sortDisplay }}</a>

@endif
