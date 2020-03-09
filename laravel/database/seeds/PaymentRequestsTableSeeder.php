<?php

use Illuminate\Database\Seeder;
use App\PaymentRequest;
use App\User;
use App\BankAccount;

class PaymentRequestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::find(6);
        PaymentRequest::create([
            "amount" => 500,
            "requested_by" => $user->id,
            "bank_account" => $user->BankAccount->id,
        ]);
        PaymentRequest::create([
            "amount" => 200,
            "requested_by" => $user->id,
            "bank_account" => $user->BankAccount->id,
        ]);

        $user = User::find(5);
        PaymentRequest::create([
            "amount" => 1000,
            "requested_by" => $user->id,
            "bank_account" => $user->BankAccount->id,
        ]);
        PaymentRequest::create([
            "amount" => 400,
            "requested_by" => $user->id,
            "bank_account" => $user->BankAccount->id,
        ]);
    }
}
