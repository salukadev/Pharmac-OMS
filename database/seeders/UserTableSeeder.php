<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    
    {
        \App\Models\User::factory()->count(20)->create();
        //factory(app\Models\User::class, 20)->create();
    }
}
