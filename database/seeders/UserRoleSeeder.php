<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $models = [
            User::ROLE_USER_ADMIN,
            User::ROLE_USER_PLACE_ADMIN,
            User::ROLE_USER_CUSTOMER
        ];

        foreach ($models as $model) {
            if (!Role::where('name', $model)->exists()) {
                Role::create(['name' => $model]);
            }
        }
    }
}
