@extends('layouts.app')
@section('content')
    <div class="row justify-content-center mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white border-0">
                    <nav class="navbar navbar-light bg-faded">
                        <a href="{{route('blog.admin.posts.create')}}"
                           class="btn btn-primary btn-sm">Create post</a>
                    </nav>
                </div>
                <div class="card-body">
                    <table class="table table-hover border-top-0">
                        <thead>
                        <tr>
                            <th class="border-top-0">#</th>
                            <th class="border-top-0">Title</th>
                            <th class="border-top-0">Category</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $item)
                            @php /** @var \App\Models\BlogPost $item*/ @endphp
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    <a href="{{ route('blog.admin.posts.edit', $item) }}">
                                        {{ $item->title }}
                                    </a>
                                </td>
                                <td >
                                    {{ $item->category ? $item->category->title : ''}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @if($posts->total() > $posts->count())
                    <div class="card-footer bg-white border-top-0 d-flex justify-content-center">
                        {{ $posts->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection