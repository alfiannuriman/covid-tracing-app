<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderSeeder extends Seeder
{
    const MODELS = [
        [
            'id' => 1,
            'name' => 'Laki-laki'
        ],
        [
            'id' => 2,
            'name' => 'Perempuan'
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::MODELS as $model) {
            DB::table('gender')->updateOrInsert($model, $model);
        }
    }
}
