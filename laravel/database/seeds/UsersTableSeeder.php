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
            'email' => 'AI' .'@gmail.com',
            'name' => 'Bot AI',
            'image' => 'https://i.imgur.com/gXIzzvq.jpg',
            'password' => bcrypt(rand(1000, 9999)),
            'role' => 'ai',
            'education_level' => 'Chula Engineering',
            'nickname' => 'AI'
        ]);

        User::create([
            'email' => 'Somying' .'@gmail.com',
            'name' => 'Somying Anaco',
            'image' => 'https://graph.facebook.com/v3.3/2685763254794575/picture?type=normal',
            'password' => bcrypt(rand(1000, 9999)),
            'role' => 'student',
            'education_level' => 'Chula Engineering',
            'nickname' => 'Somying'
        ]);

        User::create([
            'email' => 'Somchang' .'@gmail.com',
            'name' => 'Somchang Kserasew',
            'image' => 'https://youngminds.org.uk/media/1832/teacher-at-whiteboard-opt.jpg?anchor=center&mode=crop&width=2500&quality=80&heightratio=.5625&rnd=131605867010000000',
            'password' => bcrypt(rand(1000, 9999)),
            'role' => 'tutor',
            'balance' => 8000,
            'education_level' => 'Chula Engineering',
            'nickname' => 'Somchang'
        ]);

        $users = User::all();
        foreach($users as $user){
            BankAccount::create([
                'account_number' => '356213245' . substr($user->id, -1),
                'account_name' => $user->name,
                'bank' =>  'scb',
                'user_id' => $user->id,
            ]);
        }

    }
}
