<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            Admin::create([
                'name'           => 'admin_test',
                'email'          => 'admin@test.com',
                'password'       => Hash::make('11111111'),
                'remember_token' => Str::random(10),
                'created_at'     => now(),
                'updated_at'     => now()
            ]);

    }
}
