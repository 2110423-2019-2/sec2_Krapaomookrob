<?php

use Illuminate\Database\Seeder;
use App\Message;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $m1 = Message::create([
          'content' => 'asda32',
          'sender_id' => '1',
          'receiver_id' => '6'
        ]);

        $m2 = Message::create([
          'content' => '34424234',
          'sender_id' => '1',
          'receiver_id' => '6'
        ]);

        $m3 = Message::create([
          'content' => '!@#!@$#$^%$^',
          'sender_id' => '6',
          'receiver_id' => '1'
        ]);

        $m4 = Message::create([
          'content' => '(&*($%^$%^$%^))',
          'sender_id' => '6',
          'receiver_id' => '1'
        ]);
    }
}
