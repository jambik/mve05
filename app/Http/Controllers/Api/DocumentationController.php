<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;

class DocumentationController extends ApiController
{
    public function show()
    {
        $swagger = \Swagger\scan(app_path());
        return response()->json($swagger);
    }
}
