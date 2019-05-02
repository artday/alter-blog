<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Models\BlogPost;
use App\Repositories\Contracts\BlogCategoryRepository;
use App\Repositories\Eloquent\Criteria\EagerLoad;
use Illuminate\Http\Request;
use App\Repositories\Contracts\BlogPostRepository;

class PostController extends BaseController
{
    /**
     * @var BlogPostRepository
     */
    private $posts;

    /**
     * @var BlogCategoryRepository
     */
    private $categories;

    /**
     * PostController constructor.
     *
     * @param BlogPostRepository $posts
     * @param BlogCategoryRepository $categories
     */
    public function __construct(BlogPostRepository $posts, BlogCategoryRepository $categories)
    {
        parent::__construct();
        $this->posts = $posts;
        $this->categories = $categories;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = ['id', 'title', 'slug', 'category_id'];
        $posts = $this->posts
            ->withCriteria(new EagerLoad(['category']))
            ->paginate(20, $columns);
        return view('blog.admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd(__METHOD__);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd(__METHOD__);
    }

    public function show(BlogPost $post)
    {
        dd(__METHOD__);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $slug
     * @return \Illuminate\Http\Response
     */
    public function edit(/*BlogPost $post*/ $slug)
    {
        $post = $this->posts->findBySlug($slug);
        $categories = $this->categories->all(['title', 'id']);
        return view('blog.admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param BlogPost $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogPost $post)
    {
        dd(__METHOD__, $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param BlogPost $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogPost $post)
    {
        dd(__METHOD__, $post);
    }
}
