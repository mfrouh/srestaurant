<?php

namespace Database\Seeders;

use App\Cart\Cart;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

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
                $roles=['سوبر ادمن','مالك','مشرف','كاشير','طباخ','أمن','عامل توصيل'];
                foreach ($roles as $key => $role) {Role::create(['name'=>$role]);}
                \App\Models\User::factory(10)->create();
                \App\Models\Category::factory(10)->create();
                \App\Models\Menu::factory(10)->create();
                \App\Models\Coupon::factory(10)->create();
                \App\Models\Product::factory(500)->create();





    }
}
