<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Fact;

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

        $faker = Fact::create();
        for ($i1 = 1; $i1 <= 100; $i1++) {
            $categories[] = [
                'id' => $i1,
                'name' => $faker->name,
                'slug' => $faker->name,
                'parent_id' => null,
            ];
            $i2_end = $i1 * 100 + 100;
            for ($i2 = $i1 * 100 + 1; $i2 <= $i2_end; $i2++) {
                $categories[] = [
                    'id' => $i2,
                    'name' => $faker->name,
                    'slug' => $faker->name,
                    'parent_id' => $i1,
                ];
                $i3_end = $i2 * 100 + 100;
                for ($i3 = $i2 * 100 + 1; $i3 <= $i3_end; $i3++) {
                    $categories[] = [
                        'id' => $i3,
                        'name' => $faker->name,
                        'slug' => $faker->name,
                        'parent_id' => $i2,
                    ];
                }
            }
        }

        $chunk_data = array_chunk($categories, 10000);
        foreach ($chunk_data as $chunk_data_val) {
            Category::insert($chunk_data_val);
        }

    }
}
