<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $model = [
                'name' => 'Administrator',
                'email' => 'admin@local.test',
                'password' => Hash::make('admin100%')
            ];

            DB::transaction(function () use ($model) {
                if (Role::where('name', User::ROLE_USER_ADMIN)->exists()) {
                    if (!User::where('email', $model['email'])->exists()) {
                        $user = User::create($model);
    
                        if ($user) {
                            $user->assignRole(User::ROLE_USER_ADMIN);
                        }
                    }
                }
            });

        } catch (\Exception $e) {
            echo "Failed when seeding user, reason : " . $e->getMessage() . "\n";
        }
    }
}
