<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'user_id' => 'foobar',
            'name' => 'john doe',
            'email' => 'example@gmail.com',
            'password' => bcrypt('john'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

    }
}
