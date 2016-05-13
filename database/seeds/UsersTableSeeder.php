<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    protected $items = [

        [1, 'Джанбулат Магомаев', 'jambik@gmail.com'],

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
        $admin->display_name = 'Администратор'; // optional
        $admin->description  = ''; // optional
        $admin->save();

        $row1 = array_combine(['id', 'name', 'email'], $this->items[0]) + ['password' => bcrypt('111111'), 'api_token' => str_random(60)];
        $user1 = User::create($row1);

        $user1->attachRole($admin);
    }
}
