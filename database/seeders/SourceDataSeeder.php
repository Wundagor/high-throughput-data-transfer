<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SourceDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        DB::transaction(function () use ($faker) {
            foreach (range(1, 10000) as $index) {
                DB::table('source_data')->insert([
                    'name' => $faker->unique()->name,
                    'description' => $faker->text,
                    'created_at' => now()
                ]);
            }
        });
    }
}
