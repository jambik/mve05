<?php

namespace App\Traits;

use App\Photo;
use File;
use Illuminate\Http\Request;

trait PhotoableTrait
{
    /**
     * Boot events
     */
    public static function bootPhotoableTrait()
    {
        static::deleted(function (self $model){
            $model->deletePhotos();
        });
    }

    /**
     * Get Photo url path attribute
     *
     * @return string
     */
    public function getPhotoUrlAttribute()
    {
        return $this->photoUrl();
    }

    /**
     * Photos relation
     *
     * @return mixed
     */
    public function photos()
    {
        return $this->morphMany('App\Photo', 'photoable');
    }

    /**
     * Save photo
     *
     * @param Request $request
     * @return mixed
     */
    public function savePhoto(Request $request)
    {
        $imageName      = strtolower(class_basename($this)).'-'.$this->id;
        $imageExtension = strtolower($request->file('photo')->getClientOriginalExtension());

        $photoFile = $request->file('photo')->move($this->photoPath(), $imageName.'-'.uniqid().'.'.$imageExtension);

        $item = $this->photos()->create([
            'image'   => $photoFile->getFilename(),
            'img_url' => $this->photoUrl(),
        ]);

        return $item['image'];
    }

    /**
     * Delete photo
     *
     * @param Photo $photo
     */
    public function deletePhoto(Photo $photo)
    {
        $this->deletePhotoFile($photo);
        $this->deletePhotoModel($photo);
    }

    /**
     * Delete photo file
     *
     * @param Photo $photo
     * @return bool
     */
    public function deletePhotoFile(Photo $photo)
    {
        return File::delete($this->photoPath().DIRECTORY_SEPARATOR.$photo->image);
    }

    /**
     * Delete photo model
     *
     * @param Photo $photo
     * @return bool|null
     */
    public function deletePhotoModel(Photo $photo)
    {
        return $photo->delete();
    }

    /**
     * Delete all photos
     */
    public function deletePhotos()
    {
        if ($this->photos->count()) {
            foreach ($this->photos as $photo) {
                $this->deletePhoto($photo);
            }
        }
    }

    /**
     * Get Photo directory path
     *
     * @return string
     */
    public function photoPath()
    {
        return storage_path('images') . DIRECTORY_SEPARATOR . $this->getTable();
    }

    /**
     * Get Photo url path
     *
     * @return string
     */
    public function photoUrl()
    {
        return $this->getTable() . '/';
    }

}
