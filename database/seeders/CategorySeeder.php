<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();

        $cats1 = Category::factory()
            ->count(100)
            ->create();

        foreach ($cats1 as $cat) {
            $cat->children()->saveMany(
                Category::factory()
                    ->count(10)
                    ->create()
                    ->each(function ($category2) {
                        $category2->children()->saveMany(
                            Category::factory()
                                ->count(10)
                                ->create()
                        );
                    })
            );
        }
    }
}
