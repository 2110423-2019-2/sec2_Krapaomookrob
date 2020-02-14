<?php

use Illuminate\Database\Seeder;
use App\User;

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

        User::create([
            'email' => 'Somchang' .'@gmail.com',
            'name' => 'Somchang Kserasew',
            'image' => 'https://graph.facebook.com/v3.3/2685763254794575/picture?type=normal',
            'password' => bcrypt(rand(1000, 9999)),
            'role' => 'tutor',
            'education_level' => 'Chula Engineering',
            'nickname' => 'Somchang'
        ]);

        User::create([
            'email' => 'Somry' .'@gmail.com',
            'name' => 'Somry Reswaeq',
            'image' => 'https://graph.facebook.com/v3.3/2685763254794575/picture?type=normal',
            'password' => bcrypt(rand(1000, 9999)),
            'role' => 'tutor',
            'education_level' => 'Chula Engineering',
            'nickname' => 'Somry'
        ]);

        User::create([
            'email' => 'Somwan' .'@gmail.com',
            'name' => 'Somrwan Asedseo',
            'image' => 'https://graph.facebook.com/v3.3/2685763254794575/picture?type=normal',
            'password' => bcrypt(rand(1000, 9999)),
            'role' => 'tutor',
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
    }
}
