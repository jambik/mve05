<?php

namespace App\Traits;

use DB;
use File;

trait ImageableTrait
{
    /**
     * Boot events
     */
    public static function bootImageableTrait()
    {
        static::saved(function (self $model) {
            $model->saveImage();
        });

        static::deleted(function (self $model){
            $model->deleteImage();
        });
    }

    /**
     * Get Image url path attribute
     *
     * @return string
     */
    public function getImgUrlAttribute()
    {
        return $this->imageUrl();
    }

    /**
     * Save Item Image
     *
     * @return void
     * @throws \Symfony\Component\HttpFoundation\File\Exception\FileException
     * @throws \InvalidArgumentException
     */
    public function saveImage()
    {
        if (request()->hasFile('image'))
        {
            $imageName      = strtolower(class_basename($this)) . '-' . $this->id;
            $imageExtension = strtolower(request()->file('image')->getClientOriginalExtension());

            $file = request()->file('image')->move($this->imagePath(), $imageName . "." . $imageExtension);
            $this->image = $file->getFilename();

            DB::table($this->getTable())
              ->where('id', $this->id)
              ->update(['image' => $this->image]);
        }
    }

    /**
     * Delete Image
     *
     * @param bool $clearAttribute  Clear 'image' attribute
     * @return bool
     */
    public function deleteImage($clearAttribute = false)
    {
        $this->deleteImageFile();

        if ($clearAttribute){
            $this->clearImageAttribute();
        }

        return true;
    }

    /**
     * Delete image file
     *
     * @return bool
     */
    public function deleteImageFile()
    {
        return File::delete($this->imagePath() . DIRECTORY_SEPARATOR . $this->image);
    }

    /**
     * Clear image attribute
     *
     * @return mixed
     */
    public function clearImageAttribute()
    {
        $this->image = '';
        return $this->save();
    }

    /**
     * Get Image directory path
     *
     * @return string
     */
    public function imagePath()
    {
        return storage_path('images') . DIRECTORY_SEPARATOR . $this->getTable();
    }

    /**
     * Get Image url path
     *
     * @return string
     */
    public function imageUrl()
    {
        return $this->getTable() . '/';
    }

}
