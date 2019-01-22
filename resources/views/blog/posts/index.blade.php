@extends('layouts.app')

@section('content')
    <section class="mb-5">
        @foreach($items as $item)
            <article class="mb-5">
                <header>
                    <h4>{{$item->title}}</h4>
                </header>
                <section>
                    {{$item->excerpt}}
                </section>
                <footer class="mt-2">
                    <a class="btn btn-primary btn-sm"
                       href="{{route('blog.posts.show', $item->slug)}}">
                        read more
                    </a>
                </footer>
            </article>
        @endforeach
    </section>
    <section class="mb-5">
        {{ $items->links() }}
    </section>
@endsection