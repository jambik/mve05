<?php

namespace App;

use App\Traits\ResourceableTrait;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use ResourceableTrait;

    protected $table = 'photos';

    protected $fillable = [
        'name',
        'image',
        'img_url',
        'order',
    ];

    public function photoable()
    {
        return $this->morphTo();
    }
}
