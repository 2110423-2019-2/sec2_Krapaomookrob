<?php

use Illuminate\Database\Seeder;
use App\User;
use App\BankAccount;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'Somying' .'@gmail.com',
            'name' => 'Somying Anaco',
            'image' => 'https://graph.facebook.com/v3.3/2685763254794575/picture?type=normal',
            'password' => bcrypt(rand(1000, 9999)),
            'role' => 'student',
        ]);

        User::create([
            'email' => 'Somsak' .'@gmail.com',
            'name' => 'Somysak Sakoman',
            'image' => 'https://graph.facebook.com/v3.3/2685763254794575/picture?type=normal',
            'password' => bcrypt(rand(1000, 9999)),
            'role' => 'student',
        ]);

        User::create([
            'email' => 'Somchai' .'@gmail.com',
            'name' => 'Somchai Chesemanr',
            'image' => 'https://graph.facebook.com/v3.3/2685763254794575/picture?type=normal',
            'password' => bcrypt(rand(1000, 9999)),
            'role' => 'student',
        ]);

        User::create([
            'email' => 'Somchang' .'@gmail.com',
            'name' => 'Somchang Kserasew',
            'image' => 'https://graph.facebook.com/v3.3/2685763254794575/picture?type=normal',
            'password' => bcrypt(rand(1000, 9999)),
            'role' => 'tutor',
        ]);

        User::create([
            'email' => 'Somry' .'@gmail.com',
            'name' => 'Somry Reswaeq',
            'image' => 'https://graph.facebook.com/v3.3/2685763254794575/picture?type=normal',
            'password' => bcrypt(rand(1000, 9999)),
            'role' => 'tutor',
        ]);

        User::create([
            'email' => 'Somwan' .'@gmail.com',
            'name' => 'Somrwan Asedseo',
            'image' => 'https://graph.facebook.com/v3.3/2685763254794575/picture?type=normal',
            'password' => bcrypt(rand(1000, 9999)),
            'role' => 'tutor',
        ]);

        User::create([
            'email' => 'Sommah' .'@gmail.com',
            'name' => 'Sommah Masweras',
            'image' => 'https://graph.facebook.com/v3.3/2685763254794575/picture?type=normal',
            'password' => bcrypt(rand(1000, 9999)),
            'role' => 'admin',
        ]);

        User::create([
            'email' => 'EDITT_Tutor' .'@gmail.com',
            'name' => 'Superuser',
            'image' => 'https://graph.facebook.com/v3.3/2685763254794575/picture?type=normal',
            'password' => bcrypt(rand(1000, 9999)),
            'role' => 'superuser',
        ]);

        $users = User::all();

        foreach($users as $user){
            BankAccount::create([
                'account_number' => '356213245' . substr($user->id, -1),
                'account_name' => $user->name,
                'bank' =>  'Kasikorn',
                'user_id' => $user->id,
            ]);
        }
    }
}
