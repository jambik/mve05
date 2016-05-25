<?php

namespace App;

use App\Traits\ResourceableTrait;
use Illuminate\Database\Eloquent\Model;

class FuelFile extends Model
{
    use ResourceableTrait;

    protected $table = 'fuel_files';

    protected $fillable = [
        'file_name',
        'imported',
        'rows_imported',
        'total_rows',
        'user_id',
    ];

    protected $casts = [
        'rows_imported' => 'integer',
        'total_rows' => 'integer',
        'is_imported' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
