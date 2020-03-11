<?php

use Illuminate\Database\Seeder;
use App\User;
use App\OmiseRecipientAccount;

class OmiseRecipientAccountsTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        OmiseRecipientAccount::create([
            'user_id' => '6',
            'recipient' => 'recp_test_5j4trft5jawtzexbsmh'
        ]);
        OmiseRecipientAccount::create([
            'user_id' => '5',
            'recipient' => 'recp_test_5j5lxj5tt13d3j4i3un'
        ]);


    }
}
