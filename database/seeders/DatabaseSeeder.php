<?php

namespace Database\Seeders;

use App\Cart\Cart;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
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
                $roles=['سوبر ادمن','مالك','مدير','مشرف في المطبخ','مشرف عمال التوصيل','كاشير','طباخ','عامل توصيل','مستخدم'];
                foreach ($roles as $key => $role) {Role::create(['name'=>$role]);}
                $permissions=['نوع','قيمة','وظيفة','منتج','قائمة','خاصية','قسم','خصم','عرض','صلاحية'];
                foreach ($permissions as $key => $permission) {
                    Permission::create(['name'=>"انشاء $permission"]);
                    Permission::create(['name'=>"تعديل $permission"]);
                    Permission::create(['name'=>"حذف $permission"]);
                    if (in_array($permission,['منتج','قسم','قائمة'])) {Permission::create(['name'=>"تغير حالة $permission"]); }
                 }
                $permissions2=['المطبخ','كاشير','مشاهدة منتج','اعدادات الموقع','الأراء','العروض','الانواع','القيم','القوائم','المنتجات','الخصومات','الاقسام','تغير كلمة المرور','الخصائص','الصلاحيات','الوظائف','المعلومات الشخصية'];
                foreach ($permissions2 as $key => $permission) {
                    Permission::create(['name'=>"$permission"]);
                }
                  \App\Models\User::create(['name'=>'superadmin','email'=>'superadmin@example.com','password'=>bcrypt('12345678')])->assignRole('سوبر ادمن');
                  \App\Models\User::create(['name'=>'owner','email'=>'owner@example.com','password'=>bcrypt('12345678')])->assignRole('مالك');
                  for ($i=1; $i <= 1; $i++) {
                    \App\Models\User::create(['name'=>'manager','email'=>"manager$i@example.com",'password'=>bcrypt('12345678')])->assignRole('مدير');
                  }
                  for ($i=1; $i <= 2; $i++) {
                    \App\Models\User::create(['name'=>'supervisor_delivery','email'=>"supervisor_delivery$i@example.com",'password'=>bcrypt('12345678')])->assignRole('مشرف عمال التوصيل');
                  }
                  for ($i=1; $i <= 2; $i++) {
                    \App\Models\User::create(['name'=>'supervisor_kitchen','email'=>"supervisor_kitchen$i@example.com",'password'=>bcrypt('12345678')])->assignRole('مشرف في المطبخ');
                  }
                  for ($i=1; $i <= 8; $i++) {
                    \App\Models\User::create(['name'=>'cashier','email'=>"cashier$i@example.com",'password'=>bcrypt('12345678')])->assignRole('كاشير');
                  }
                  for ($i=1; $i <= 8; $i++) {
                    \App\Models\User::create(['name'=>'chef','email'=>"chef$i@example.com",'password'=>bcrypt('12345678')])->assignRole('طباخ');
                  }
                  for ($i=1; $i <= 8; $i++) {
                    \App\Models\User::create(['name'=>'delivery','email'=>"delivery$i@example.com",'password'=>bcrypt('12345678')])->assignRole('عامل توصيل');
                  }
                \App\Models\Category::factory(10)->create();
                \App\Models\Menu::factory(10)->create();
                \App\Models\Coupon::factory(10)->create();
                \App\Models\Product::factory(500)->create();

    }
}
