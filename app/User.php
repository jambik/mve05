<?php

namespace App;

use App\Traits\ResourceableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

/**
 * @SWG\Definition(
 *      definition="User",
 *      required={"email"},
 *      @SWG\Property(
 *          property="name",
 *          description="Имя пользователя",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="email",
 *          description="Email пользователя",
 *          type="string"
 *      )
 * )
 */
class User extends Authenticatable
{
    use EntrustUserTrait, ResourceableTrait;

    protected $table = 'users';

    protected $fillable = ['name', 'email', 'password', 'api_token'];

    protected $hidden = ['id', 'password', 'remember_token', 'created_at', 'updated_at', 'api_token'];

    public function fuelFiles()
    {
        return $this->hasMany('App\FuelFile');
    }
}
