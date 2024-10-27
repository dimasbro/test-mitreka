<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\MenuItem;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['Role Admin'];

        foreach ($data as $dt) {
            $check = Role::where('role_name', $dt)->first();

            if (! $check) {
                $data = Role::create(['role_name' => $dt]);

                $menuItem = MenuItem::all();
                if (! empty($menuItem)) {
                    foreach ($menuItem as $mi) {
                        RolePermission::create([
                            'role_id' => $data->role_id,
                            'menu_item_id' => $mi->id,
                        ]);
                    }
                }
            }
        }


        $checkUser = User::where('name', 'admin')->first();

        if (! $checkUser) {
            User::create([
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make(12345678),
                'role_id' => 1,
            ]);
        }
    }
}
