<?php

namespace App;

use App\Traits\ImageableTrait;
use App\Traits\PhotoableTrait;
use App\Traits\ResourceableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model implements SluggableInterface
{
    use ImageableTrait, PhotoableTrait, SluggableTrait, ResourceableTrait;

    protected $table = 'galleries';

    protected $fillable = ['name', 'slug', 'text', 'image'];

    protected $appends = ['img_url', 'photo_url'];

    protected $sluggable = [
        'build_from' => 'name',
        'save_to'    => 'slug',
    ];
}
