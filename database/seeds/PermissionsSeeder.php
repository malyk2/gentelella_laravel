<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'login', 'display_name' => 'Вхід в систему', 'type' => 'Авторизація'],
            ['name' => 'users.manage', 'display_name' => 'Управління користувачами', 'type' => 'Користувачі'],
            ['name' => 'groups.manage', 'display_name' => 'Управління групами користувачів', 'type' => 'Користувачі'],
            ['name' => 'permissions.manage', 'display_name' => 'Управління доступами користувачів', 'type' => 'Користувачі'],
        ];
        foreach($data as $item) {
            $perm = Permission::firstOrCreate(['name' => $item['name']]);
            $perm->display_name = $item['display_name'];
            $perm->type = $item['type'];
            $perm->save();
        }
    }
}
