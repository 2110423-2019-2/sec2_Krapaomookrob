<?php

use Illuminate\Database\Seeder;
use App\Cart;

class CartTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Cart::create([
            'course_id' => 1,
            'payment_id' => 1
        ]);

        Cart::create([
            'course_id' => 2, 
            'payment_id' => 1
        ]);



    }
}
