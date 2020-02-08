<?php

use Illuminate\Database\Seeder;
use App\Cart_item;

class CartItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Cart_item::create([
            'cart_id' => 1,
            'course_id' => 1
        ]);

        Cart_item::create([
            'cart_id' => 1,
            'course_id' => 2
        ]);

    }
}
