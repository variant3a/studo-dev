<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([
            'subject_name' => 'C/C++',
            'category' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('subjects')->insert([
            'subject_name' => 'Python',
            'category' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('subjects')->insert([
            'subject_name' => 'JavaScript',
            'category' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('subjects')->insert([
            'subject_name' => 'SQL',
            'category' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('subjects')->insert([
            'subject_name' => 'C#',
            'category' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('subjects')->insert([
            'subject_name' => 'Java',
            'category' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('subjects')->insert([
            'subject_name' => 'VBA',
            'category' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('subjects')->insert([
            'subject_name' => 'HTML/CSS',
            'category' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('subjects')->insert([
            'subject_name' => 'PHP',
            'category' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('subjects')->insert([
            'subject_name' => 'VB.NET',
            'category' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('subjects')->insert([
            'subject_name' => 'COBOL',
            'category' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('subjects')->insert([
            'subject_name' => 'Visual Basic',
            'category' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('subjects')->insert([
            'subject_name' => 'Ruby',
            'category' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('subjects')->insert([
            'subject_name' => 'Perl',
            'category' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('subjects')->insert([
            'subject_name' => 'Assembly Language',
            'category' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('subjects')->insert([
            'subject_name' => 'Go',
            'category' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('subjects')->insert([
            'subject_name' => 'R',
            'category' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('subjects')->insert([
            'subject_name' => 'FORTRAN',
            'category' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('subjects')->insert([
            'subject_name' => 'TypeScript',
            'category' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('subjects')->insert([
            'subject_name' => 'Kotlin',
            'category' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('subjects')->insert([
            'subject_name' => 'Scala',
            'category' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('subjects')->insert([
            'subject_name' => 'Swift',
            'category' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
