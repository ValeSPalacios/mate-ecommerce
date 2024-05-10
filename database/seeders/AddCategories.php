<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class AddCategories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Category::create([
            'name'=>'Equipos Mate'
        ]);
        Category::create([
            'name'=>'Termos y Mate'
        ]);
        Category::create([
            'name'=>'Mates'
        ]);
    }
}
