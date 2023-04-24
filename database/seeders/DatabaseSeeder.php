<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->email = "admin@ospring.mn";
        $user->name = "Admin";
        $user->password = Hash::make("12345678");
        $user->type = 0;
        $user->save();
        // \App\Models\User::factory(10)->create();
    }
}
