<?php

namespace App;

use App\Traits\ImageableTrait;
use App\Traits\PhotoableTrait;
use App\Traits\ResourceableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Product extends Model implements SluggableInterface
{
    use ImageableTrait, PhotoableTrait, SluggableTrait, ResourceableTrait, SearchableTrait;

    protected $table = 'products';

    protected $fillable = ['name', 'slug', 'category_id', 'price', 'material', 'brief', 'text', 'available', 'title', 'keywords', 'description', 'image'];

    protected $casts = [
        'price' => 'integer',
        'available' => 'boolean',
        'category_id' => 'int',
    ];

    protected $appends = ['img_url', 'photo_url'];

    protected $sluggable = [
        'build_from' => 'name',
        'save_to'    => 'slug',
    ];

    protected $searchable = [
        'columns' => [
            'name' => 30,
            'brief' => 20,
            'text' => 10,
        ],
    ];

    /**
     * Get product category.
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
