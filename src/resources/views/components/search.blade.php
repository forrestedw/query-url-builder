<form method="GET" action="{{ QueryUrl::build() }}">
    <div class="input-group">
        <input type="text" class="form-control" name="filter[{{$filter}}]"
               value="{{ $_GET['filter'][$filter] ?? '' }}">
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </div>
</form>
@if(isset($_GET['filter'][$filter]) && $_GET['filter'][$filter] != '')
    <p class="small text-muted mt-2">
        Showing results for <strong>{{ $_GET['filter'][$filter] }}</strong>.
        <a href="{{ QueryUrl::removeFilter($filter)->build() }}">Show all</a>
    </p>
@endif
