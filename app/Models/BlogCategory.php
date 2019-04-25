<?php

namespace App\Models;

use App\Traits\Eloquent\HasLive;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
//use App\Repositories\Contracts\BlogCategoryRepository;

class BlogCategory extends Model
{
    use SoftDeletes, HasLive;

    protected $fillable = [
        'title', 'slug', 'description', 'parent_id'
    ];

    public function parent()
    {
        return $this->belongsTo(BlogCategory::class);
    }

    public function posts()
    {
        return $this->hasMany(BlogPost::class, 'category_id');
    }

    /*public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        dump(__METHOD__);
    }*/

    /*public function resolveRouteBinding($value)
    {
        return app(BlogCategoryRepository::class)
                ->resolveRouteBinding($value);
    }*/

    /*

    public function boot()
    {

    }*/

}
