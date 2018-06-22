<?php

use Illuminate\Database\Seeder;
use App\User;

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
            'group_id' => 1,
            'name' => 'admin',
            'email' => 'admin@renome.ua',
        ];

        $user = User::firstOrNew($data);
        if ( ! $user->exists) {
            $user->password = 'smartrV0815';
        }
        $user->save();
    }
}
