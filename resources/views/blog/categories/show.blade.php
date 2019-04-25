@extends('layouts.app')

@section('content')
    <h2>{{$category->title}}</h2>
    <section class="mb-5 ml-5">
        @foreach($category->posts as $item)
            <article class="mb-5">
                <header>
                    <h4>{{$item->title}}</h4>
                    <small>by {{$item->user->name}}, {{$item->created_at->diffForHumans()}}</small>
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
@endsection