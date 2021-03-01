<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User as User ;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // \App\Models\User::factory(10)->create();
        $user = new User;
        $user->name = 'Clement';
        $user->email = 'clement.dufourl@gmail.com' ;
        $user->password = 'admin' ;
        $user->save();
    }
}
