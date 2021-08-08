<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlaceRegistrationTypeSeeder extends Seeder
{
    const MODELS = [
        [
            'id' => 1,
            'name' => 'Check-in'
        ],
        [
            'id' => 2,
            'name' => 'Check-out'
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
            DB::table('place_registration_types')->updateOrInsert($model, $model);
        }
    }
}
