<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        {{--<li class="breadcrumb-item"><a href="#">Home</a></li>--}}
        @foreach(request()->breadcrumbs()->segments() as $segment)
            <li class="breadcrumb-item">
                <a href="{{ $segment->url() }}">{{ optional($segment->model())->title ?: $segment->name() }}</a>
            </li>
        @endforeach
    </ol>
</nav>