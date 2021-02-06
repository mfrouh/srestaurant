<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Setting::create(['name'=>'your website name','description'=>'your website description','logo'=>'images/logo/1.png']);
                \App\Models\User::factory(10)->create();
                \App\Models\Category::factory(10)->create();
                \App\Models\Menu::factory(10)->create();
                \App\Models\Coupon::factory(10)->create();
                \App\Models\Product::factory(100)->create();




    }
}
