<?php

namespace App;

use App\Traits\ResourceableTrait;
use Illuminate\Database\Eloquent\Model;
use Rutorika\Sortable\SortableTrait;

class Azs extends Model
{
    use ResourceableTrait, SortableTrait;

    protected $table = 'azs';

    protected $fillable = ['name', 'description', 'location', 'address', 'lat', 'lng'];

}
