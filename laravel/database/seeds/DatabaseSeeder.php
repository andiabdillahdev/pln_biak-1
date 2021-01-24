<?php

use Illuminate\Database\Seeder;
use App\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name'=>'agung azhari',
                 'email'=>'agungazhari@gmail.com',
                 'role'=>'agent',
                 'password'=> bcrypt('admin123')
             ],
             [
                 'name'=>'agent',
                 'email'=>'andiabdilah004@gmail.com',
                 'role'=>'agent',
                 'password'=> bcrypt('qwerty123')
             ]
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
