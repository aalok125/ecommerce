<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'sujab',
            'email' => 'ssujab9@gmail.com',
            'roles' => 'admin',
            'password' => bcrypt('testing1234'),
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'roles' => 'admin',
            'password' => bcrypt('testing1234'),
        ]);
    }
}
