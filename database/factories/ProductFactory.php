<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id'=>Category::all()->random()->id,
            'menu_id'=>Menu::all()->random()->id,
            'name'=>$this->faker->name,
            'description'=>$this->faker->realText(200,2),
            'price'=>rand(1,200),
            'status'=>$this->faker->randomElement(['active','inactive']),
            'slug'=>str_replace(' ','_',$this->faker->name),
            'sku'=>$this->faker->name.rand(1,3),
            'image'=>$this->faker->randomElement(['images/products/1.png','images/products/2.png','images/products/3.png','images/products/4.png','images/products/5.png']),
            'video_url'=>null,
            'quantity'=>rand(1,9),
        ];
    }
}
