<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create first user as admin
        factory(User::class)->make([
            'name' => 'Admin',
            'email' => 'admin@email.com'
        ])->save();

        // make fake users
        factory(User::class, 4)->create();
    }
}
