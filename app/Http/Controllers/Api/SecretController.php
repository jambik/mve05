<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SecretController extends Controller
{
    public function getSecret(Request $request)
    {
        return 'secret page';
    }
}
