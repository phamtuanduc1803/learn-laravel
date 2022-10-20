<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<3;$i++) {
            $category = new Category;
            $category->name = 'Category'.($i+1);
            $category->save();
        }
    }
}
