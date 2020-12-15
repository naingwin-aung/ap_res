<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tables')->insert([
            'number' => "A-1",
        ]);

        DB::table('tables')->insert([
            'number' => "B-1",
        ]);

        DB::table('tables')->insert([
            'number' => "C-1",
        ]);

        DB::table('tables')->insert([
            'number' => "D-1",
        ]);

        DB::table('tables')->insert([
            'number' => "E-1",
        ]);
    }
}
