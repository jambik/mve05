<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    protected $items = [

        [1, 'Джанбулат Магомаев', 'jambik@gmail.com'],
        [2, 'Джамал', '1c@gmail.com'],
        [3, 'Ликойл общий', '001'],

    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Role();
        $admin->name         = 'admin';
        $admin->display_name = 'Администратор';
        $admin->description  = 'Администратор системы';
        $admin->save();

        $role1c = new Role();
        $role1c->name         = '1c';
        $role1c->display_name = 'Пользователь 1С';
        $role1c->description  = 'Имеет доступ к загрузке из 1С';
        $role1c->save();

        $roleAzs = new Role();
        $roleAzs->name         = 'azs';
        $roleAzs->display_name = 'Пользователь АЗС';
        $roleAzs->description  = 'Имеет доступ к Api как пользователь АЗС';
        $roleAzs->save();

        $rowAdmin = array_combine(['id', 'name', 'email'], $this->items[0]) + ['password' => bcrypt('111111')];
        $userAdmin = User::create($rowAdmin);
        $userAdmin->attachRole($admin);

        $row1c = array_combine(['id', 'name', 'email'], $this->items[1]) + ['password' => bcrypt('111111'), 'api_token' => str_random(60)];
        $user1c = User::create($row1c);
        $user1c->attachRole($role1c);

        $rowAzs = array_combine(['id', 'name', 'email'], $this->items[2]) + ['password' => bcrypt('111111'), 'api_token' => str_random(60)];
        $userAzs = User::create($rowAzs);
        $userAzs->attachRole($roleAzs);
    }
}
