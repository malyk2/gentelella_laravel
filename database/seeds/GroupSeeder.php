<?php

use Illuminate\Database\Seeder;
use App\Group;
use App\Permission;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['name' => 'root'];
        $group = Group::firstOrCreate($data);

        $allPerms = Permission::get();
        $group->permissions()->sync($allPerms);
    }
}
