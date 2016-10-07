<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    protected $table = 'headers';

    protected $fillable = ['title', 'keywords', 'description', 'caption', 'image'];

    protected $appends = ['img_url'];

    public function headerable()
    {
        return $this->morphTo();
    }

    public function getImgUrlAttribute()
    {
        return $this->getTable() . '/';
    }
}
