<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
                    'name' => 'Edwin Rudy Quisbert Montalvo',
                    'email' => 'edwinquisbert.m@umss.edu',
                    'password' => bcrypt('panda199131')
                ]);
        
        $user->assignRole('administrador');

        // User::factory(99)->create();
    }
}
