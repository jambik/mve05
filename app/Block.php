<?php

namespace App;

use App\Traits\ResourceableTrait;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use ResourceableTrait;

    protected $table = 'blocks';

    protected $fillable = ['alias', 'title', 'text'];
}
