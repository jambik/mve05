<?php

namespace App;

use App\Traits\ResourceableTrait;
use Illuminate\Database\Eloquent\Model;

class LogAccess extends Model
{
    use ResourceableTrait;

    protected $table = 'log_access';

    protected $fillable = [
        'request_uri',
        'http_headers',
        'user_id',
    ];

    protected $casts = [
        'http_headers' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
