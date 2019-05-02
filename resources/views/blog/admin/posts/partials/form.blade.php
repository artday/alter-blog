@php
    /** @var \App\Models\BlogPost $post */
    /** @var \Illuminate\Support\Collection $categories */

    $action = $post->exists ? 'blog.admin.posts.update': 'blog.admin.posts.store';

/*dd($post->category);*/
@endphp

<form action="{{ route($action, $post->id ? $post: null ) }}" method="POST">
    @if($post->exists)
        @method('PATCH')
        <input type="hidden" name="id" value="{{ $post->id }}">
    @else @method('PUT')
    @endif
    @csrf
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs mb-4" role="tablist">
                        <li class="nav-item">
                            <a href="#maindata" class="nav-link active" data-toggle="tab" role="tab">Main</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="maindata" class="tab-pane active" role="tabpanel">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" id="title" name="title"
                                       value="{{ old('title', $post->title) }}"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="text" id="slug" name="slug"
                                       value="{{ old('slug', $post->slug) }}"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="parent_id">Parent</label>
                                <select id="parent_id" name="parent_id" class="form-control">
                                    <option value="" disabled selected>Select parent category</option>
                                    <option value="">No parent category</option>
                                    @foreach($categories as $category)
                                        @php $selected = ($post->category && ($category->id == $post->category->id))? 'selected ': ''; @endphp
                                        <option value="{{$category->id}}"{{ $selected }}>
                                            id:{{ $category->id }} || {{ $category->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description">Content raw</label>
                                <textarea rows="20" name="description" id="description"
                                          class="form-control">{{ old('description', $post->content_raw) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <input type="submit" value="Save" class="btn btn-primary">
                </div>
            </div>
            @if($post->exists)
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="form-group">
                            <p>ID:{{ $post->id }}</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="created_at">Created</label>
                            <input type="text" id="created_at" name="created_at"
                                   value="{{ $post->created_at }}"
                                   class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label for="updated_at">Updated</label>
                            <input type="text" id="updated_at" name="updated_at"
                                   value="{{ $post->updated_at }}"
                                   class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label for="deleted_at">Deleted</label>
                            <input type="text" id="deleted_at" name="deleted_at"
                                   value="{{ $post->deleted_at }}"
                                   class="form-control" disabled>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</form>