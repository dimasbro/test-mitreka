<?php

use Illuminate\Database\Seeder;
use App\Models\MenuItem;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['title' => 'User', 'url' => '/user'],
            ['title' => 'Role', 'url' => '/role'],
            ['title' => 'Menu Item', 'url' => '/menu-item'],
        ];

        foreach ($data as $dt) {
            $check = MenuItem::where('title', $dt['title'])->first();

            if (! $check) {
                MenuItem::create(['title' => $dt['title'], 'url' => $dt['url']]);
            }
        }
    }
}
