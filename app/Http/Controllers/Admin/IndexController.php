<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BackendController;
use App\Http\Requests;

class IndexController extends BackendController
{
    public function index()
    {
        return view('admin.index');
    }
}