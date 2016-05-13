<?php

namespace App\Traits;

use App;
use Flash;
use Route;

trait ResourceableTrait
{
    /**
     * Boot events
     */
    public static function bootResourceableTrait()
    {
        static::created(function ($model){
            if( ! App::runningInConsole()) {
                $currentMiddlewares = Route::current()->getAction()['middleware'];
                $currentMiddlewares = is_array($currentMiddlewares) ? $currentMiddlewares : [$currentMiddlewares];
                if (in_array('admin', $currentMiddlewares)) {
                    Flash::success("Запись #{$model->id} сохранена");
                }
            }
        });

        static::updated(function ($model){
            if( ! App::runningInConsole()) {
                $currentMiddlewares = Route::current()->getAction()['middleware'];
                $currentMiddlewares = is_array($currentMiddlewares) ? $currentMiddlewares : [$currentMiddlewares];
                if (in_array('admin', $currentMiddlewares)) {
                    Flash::success("Запись #{$model->id} обновлена");
                }
            }
        });

        static::deleted(function ($model){
            if( ! App::runningInConsole()) {
                $currentMiddlewares = Route::current()->getAction()['middleware'];
                $currentMiddlewares = is_array($currentMiddlewares) ? $currentMiddlewares : [$currentMiddlewares];
                if (in_array('admin', $currentMiddlewares)) {
                    Flash::success("Запись #{$model->id} удалена");
                }
            }
        });
    }
}
