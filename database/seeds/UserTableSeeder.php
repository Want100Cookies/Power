<?php

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
        $user = new \App\Models\User([
            'name' => 'Administrator',
            'email' => 'admin@localhost',
            'password' => \Hash::make('admin'),
        ]);

        $user->save();
    }
}
