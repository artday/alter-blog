<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Models\BlogCategory;

use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Http\Requests\BlogCategoryCreateRequest;

use App\Repositories\Contracts\UserRepository;
use App\Repositories\Contracts\BlogCategoryRepository;

class CategoryController extends BaseController
{
    /**
     * @var BlogCategoryRepository
     */
    protected $categories;

    /**
     * @var UserRepository
     */
    protected $users;

    /**
     * CategoryController constructor.
     * @param BlogCategoryRepository $categories
     * @param UserRepository $users
     */
    public function __construct(BlogCategoryRepository $categories, UserRepository $users)
    {
        parent::__constructor();
        $this->users = $users;
        $this->categories = $categories;
    }

    /**
     * Display a list of categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = ['id', 'parent_id', 'title'];
        $categories = $this->categories->paginate(10, $columns);
        return view('blog.admin.categories.index', compact('categories'));
    }

    /**
     * Show category creating form.
     *
     * @param BlogCategory $category
     * @return \Illuminate\Http\Response
     */
    public function create(BlogCategory $category)
    {
        $columns = ['title', 'id'];
        $categories = $this->categories->all($columns);
        return view('blog.admin.categories.create', compact('category', 'categories'));
    }

    /**
     * Storing new category.
     *
     * @param  \App\Http\Requests\BlogCategoryCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCategoryCreateRequest $request)
    {
        $category = $this->categories->create($request->validated());
        return $category ? $this->index() : back()->with('danger', "Database saving error");
    }

    /**
     * Show category edit form.
     *
     * @param  \App\Models\BlogCategory $category
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogCategory $category)
    {
        $columns = ['title', 'id'];
        /* Get categories for parent category selection list */
        $categories = $this->categories->all($columns)->except($category->id);
        return view('blog.admin.categories.edit', compact('category', 'categories'));
    }

    /**
     * Updating category.
     *
     * @param  \App\Http\Requests\BlogCategoryUpdateRequest $request
     * @param BlogCategory $category
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategoryUpdateRequest $request, BlogCategory $category)
    {
        $category->update($request->validated());
        return back()->with("success", "Category was updated");
    }

    /**
     * Deleting category.
     *
     * @param BlogCategory $category
     * @return \Illuminate\Http\Response
     * @internal param BlogCategory $blogCategory
     */
    public function destroy(BlogCategory $category)
    {
        //TODO: implement deleting model
        return back()->with('danger', "Deleting not implemented yet");
    }
}
