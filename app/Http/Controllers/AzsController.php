<?php

namespace App\Http\Controllers;

use App\Azs;

class AzsController extends FrontendController
{
    /**
     * Display the page.
     * @return Response
     * @internal param $slug
     */
    public function index()
    {
        $azs = Azs::all();

        return view('azs', compact('azs'));
    }
}
