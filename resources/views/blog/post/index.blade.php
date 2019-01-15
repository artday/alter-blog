@extends('layouts.app')

@section('content')
    @foreach($items as $item)
        <article>
            <header>{{$item->title}}</header>
        </article>
    @endforeach
@endsection