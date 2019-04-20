<?php

namespace App\Http\Controllers\Blog\Admin;

use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Http\Requests\BlogCategoryCreateRequest;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = BlogCategory::paginate(5);
        return view('blog.admin.categories.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param BlogCategory $category
     * @return \Illuminate\Http\Response
     */
    public function create(BlogCategory $category)
    {
        /*$category = new BlogCategory;*/
        $categories = BlogCategory::all();
        return view('blog.admin.categories.create', compact('category', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BlogCategoryCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCategoryCreateRequest $request)
    {
        $data = $request->input();

        // TODO: generate slug before validation in Requests
        if(empty($data['slug'])){
            $data['slug'] = str_slug($data['title']);
        }

        $category = BlogCategory::create($data);

        return $category ? $this->index() : back()->with('danger', "Database saving in database");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogCategory $category
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogCategory $category)
    {
        /* Get categories for parent category selection list */
        $categories = BlogCategory::where('id', '<>', $category->id)->get(['id', 'title']);
        return view('blog.admin.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\BlogCategoryUpdateRequest $request
     * @param BlogCategory $category
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategoryUpdateRequest $request, BlogCategory $category)
    {
        $data = $request->input();

        // TODO: generate slug before validation in Requests
        if(empty($data['slug'])){
            $data['slug'] = str_slug($data['title']);
        }

        $category->update($data);

        //TODO: Handle Db update Error

        return back()->with("success", "Category was updated");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogCategory $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function show(BlogCategory $blogCategory)
    {
        dd(__METHOD__);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogCategory $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogCategory $blogCategory)
    {
        //
    }
}
