<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $authors = [
            'Александр Сергеевич Пушкин',
            'Лев Толстой',
            'Ганс Христиан Андерсен'
            ,'Братья Гримм'];

        for ($i=0; $i < count($authors); $i++) {
            DB::table('authors')->insert([
                'name' => $authors[$i]
            ]);
        }
    }
}
