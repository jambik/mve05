<?php

namespace App\Http\Composers;

use App\Slide;
use Illuminate\View\View;

class SlidesComposer
{
    public function compose(View $view)
    {
        $slides = Slide::sorted()->get();
        $view->with('slides', $slides);
    }
}