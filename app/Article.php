<?php

namespace App;

use App\Traits\ResourceableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Rutorika\Sortable\SortableTrait;

class Article extends Model implements SluggableInterface
{
    use SluggableTrait, SortableTrait, ResourceableTrait;

    protected $table = 'articles';

    protected $fillable = ['name', 'slug', 'text', 'title', 'keywords', 'description'];

    protected $sluggable = [
        'build_from' => 'name',
        'save_to'    => 'slug',
    ];
}
