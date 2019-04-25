<?php

namespace App\Http\Controllers\Blog;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use App\Repositories\Contracts\BlogPostRepository;
use App\Repositories\Contracts\BlogCategoryRepository;

use App\Repositories\Eloquent\Criteria\IsLive;
use App\Repositories\Eloquent\Criteria\ByUser;
use App\Repositories\Eloquent\Criteria\EagerLoad;
use App\Repositories\Eloquent\Criteria\LatestFirst;

class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param BlogPostRepository $posts
     * @return \Illuminate\Http\Response
     */
    public function index(BlogPostRepository $posts)
    {
        $items = $posts->withCriteria(new LatestFirst, new IsLive, new ByUser(auth()->id()))->all();
        return view('blog.posts.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function show(Request $request, BlogPost $post)
    {
        return $post->is_published ?
            view('blog.posts.show', compact('post')):
            abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogPost $blogPost
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogPost $blogPost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\BlogPost $blogPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogPost $blogPost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogPost $blogPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogPost $blogPost)
    {
        //
    }


    /**
     * @param BlogCategoryRepository $categories
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function byCategories(BlogCategoryRepository $categories)
    {
        $categories = $categories
            ->withCriteria([
                new IsLive(),
                new EagerLoad(['posts', 'posts.user',])
            ])->all();

//        $categories->load(['posts', 'posts.user']);
        return view('blog.categories.index', compact('categories'));
    }

    public function categoryPosts(BlogCategoryRepository $categories, $slug)
    {
        $category = $categories
            ->withCriteria(new EagerLoad(['posts.user']))
            ->findBySlug($slug);

        return view('blog.categories.show', compact('category'));
    }
}
