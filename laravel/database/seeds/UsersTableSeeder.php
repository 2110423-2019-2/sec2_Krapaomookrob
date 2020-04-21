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
            'education_level' => 'Chula Engineering',
            'nickname' => 'Somying'
        ]);

        User::create([
            'email' => 'Somsak' .'@gmail.com',
            'name' => 'Somysak Sakoman',
            'image' => 'https://graph.facebook.com/v3.3/2685763254794575/picture?type=normal',
            'password' => bcrypt(rand(1000, 9999)),
            'role' => 'student',
            'education_level' => 'Chula Engineering',
            'nickname' => 'Somsak'
        ]);

        User::create([
            'email' => 'Somchai' .'@gmail.com',
            'name' => 'Somchai Chesemanr',
            'image' => 'https://graph.facebook.com/v3.3/2685763254794575/picture?type=normal',
            'password' => bcrypt(rand(1000, 9999)),
            'role' => 'student',
            'education_level' => 'Chula Engineering',
            'nickname' => 'Somchai'
        ]);

        //  Tutor
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

        User::create([
            'email' => 'Somry' .'@gmail.com',
            'name' => 'Somry Reswaeq',
            'image' => 'https://tefltrainerspain.files.wordpress.com/2013/01/smiling-teacher.jpg',
            'password' => bcrypt(rand(1000, 9999)),
            'role' => 'tutor',
            'balance' => 10000,
            'education_level' => 'Chula Engineering',
            'nickname' => 'Somry'
        ]);

        User::create([
            'email' => 'Somwan' .'@gmail.com',
            'name' => 'Somrwan Asedseo',
            'image' => 'https://nationalpostcom.files.wordpress.com/2019/11/teacher.jpg?quality=80&strip=all&w=780&zoom=2',
            'password' => bcrypt(rand(1000, 9999)),
            'role' => 'tutor',
            'balance' => 5000,
            'education_level' => 'Chula Engineering',
            'nickname' => 'Somwan'
        ]);

        User::create([
            'email' => 'Sommah' .'@gmail.com',
            'name' => 'Sommah Masweras',
            'image' => 'https://graph.facebook.com/v3.3/2685763254794575/picture?type=normal',
            'password' => bcrypt(rand(1000, 9999)),
            'role' => 'admin',
            'education_level' => 'Chula Engineering',
            'nickname' => 'Sommah'
        ]);

        User::create([
            'email' => 'EDITT_Tutor' .'@gmail.com',
            'name' => 'Superuser',
            'image' => 'https://graph.facebook.com/v3.3/2685763254794575/picture?type=normal',
            'password' => bcrypt(rand(1000, 9999)),
            'role' => 'superuser',
            'education_level' => 'Chula Engineering',
            'nickname' => 'Superuser'
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
