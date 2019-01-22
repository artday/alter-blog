@extends('layouts.app')

@section('content')
    <article>
        <header>
            <h1>{{$post->title}}</h1>
        </header>
        <section>
            {{$post->content_html}}
        </section>
    </article>
@endsection