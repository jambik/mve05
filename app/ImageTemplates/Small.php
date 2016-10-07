<?php

namespace App\ImageTemplates;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Small implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(120, 120, function ($constraint) {
            $constraint->aspectRatio();
        });
    }
}