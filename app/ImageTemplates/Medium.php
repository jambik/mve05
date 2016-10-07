<?php

namespace App\ImageTemplates;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Medium implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(240, 180, function ($constraint) {
            $constraint->aspectRatio();
        });
    }
}