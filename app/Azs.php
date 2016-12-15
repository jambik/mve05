<?php

namespace App;

use App\Traits\ResourceableTrait;
use Illuminate\Database\Eloquent\Model;

class Azs extends Model
{
    use ResourceableTrait;

    protected $table = 'azs';

    protected $fillable = ['name', 'description', 'location', 'address', 'lat', 'lng'];

}
