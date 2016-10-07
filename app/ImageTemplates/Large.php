<?php

namespace App\ImageTemplates;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Large implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(480, 360, function ($constraint) {
            $constraint->aspectRatio();
        });
    }
}