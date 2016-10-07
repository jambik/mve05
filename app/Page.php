<?php

namespace App;

use App\Traits\HeaderableTrait;
use App\Traits\ResourceableTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use Sluggable, ResourceableTrait, HeaderableTrait, SluggableScopeHelpers;

    protected $table = 'pages';

    protected $fillable = ['name', 'slug', 'text', 'title', 'keywords', 'description'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
