<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_book')->insert([
            'user_id' => 2,
            'book_id' => 10,
            'take_date' => now(),
        ]);
    }
}
