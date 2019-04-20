@extends('layouts.app')
@section('content')
    <div class="row justify-content-center mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white border-0">
                    <nav class="navbar navbar-light bg-faded">
                        <a href="{{route('blog.admin.categories.create')}}"
                           class="btn btn-primary btn-sm">Add category</a>
                        {{--<a href="#" class="btn btn-primary btn-sm">Add category</a>--}}
                    </nav>
                </div>
                <div class="card-body">
                    <table class="table table-hover border-top-0">
                        <thead>
                        <tr>
                            <th class="border-top-0">#</th>
                            <th class="border-top-0">Category</th>
                            <th class="border-top-0">Parent</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            @php /** @var \App\Models\BlogCategory $item*/ @endphp
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    <a href="{{ route('blog.admin.categories.edit', $item) }}">
                                        {{ $item->title }}
                                    </a>
                                </td>
                                <td >
                                    {{ $item->parent_id }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @if($items->total() > $items->count())
                    <div class="card-footer bg-white border-top-0 d-flex justify-content-center">
                        {{ $items->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection