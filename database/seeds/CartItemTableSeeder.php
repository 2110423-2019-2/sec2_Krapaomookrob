<?php

use Illuminate\Database\Seeder;
use App\CartItem;

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
        CartItem::create([
            'cart_id' => 1,
            'course_id' => 1
        ]);

        CartItem::create([
            'cart_id' => 1,
            'course_id' => 2
        ]);

    }
}
