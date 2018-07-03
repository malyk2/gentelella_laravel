<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Group;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'group_id' => Group::ROOT_ID,
            'name' => User::ROOT_NAME,
            'email' => 'admin@renome.ua',
        ];

        $user = User::firstOrNew($data);
        if ( ! $user->exists) {
            $user->password = 'smartrV0815';
        }
        $user->save();
        $rootRole = Role::where('name', Role::ROOT_NAME)->first();
        $user->roles()->sync($rootRole);
    }
}
