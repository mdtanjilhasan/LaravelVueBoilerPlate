<?php

use App\Models\Profile;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Jhon Deo',
            'email' => 'admin@demo.com',
            'password' => Hash::make(12345678),
            'status' => 1
        ]);

        $user->attachRole('administrator');

        $profile = new Profile();
        $profile->user_id = $user->id;
        $profile->save();
    }
}
