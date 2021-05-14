<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert([
            'name' => 'Кобзарь',
            'name_id' => 1,
            'genre_id' => 1,
            'author' => 'Тарас Шевченко',
            'year' => 1997,
            'description' => "Шось так і далі",
        ]);
    }
}

//Schema::create('books', function (Blueprint $table) {
//    $table->id();
//    $table->string("name");
//    $table->integer("genre_id");
//    $table->string("author");
//    $table->integer("year");
//    $table->longText("description");
//    $table->timestamps();
//});
