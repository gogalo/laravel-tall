<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
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
        
        User::factory()->create([
            'name' => "Admin",
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
        ]);

        User::factory(5)->create();
    }
}
