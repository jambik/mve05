<?php

namespace App\Http\Controllers;

use App\Settings;

class FrontendController extends Controller
{
    protected $settings = null;

    public function __construct()
    {
        $settings   = Settings::find(1);

        $this->settings = $settings;

        view()->share('settings', $settings);
    }
}
