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
            'user_id' => 1
        ]);

        Cart::create([
            'user_id' => 2
        ]);
    }
}
