<?php

namespace Database\Factories;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CouponFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Coupon::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code'=>$this->faker->name,
            'start'=>now()->addDays(1),
            'end'=>now()->addDays(7),
            'cand'=>$this->faker->randomElement(['less','more']),
            'cand_value'=>rand(1,100),
            'type'=>$this->faker->randomElement(['fixed','variable']),
            'value'=>rand(1,230),
            'message'=>'عرض التخفيض',
            'times'=>rand(1,9),
        ];
    }
}
