<?php

namespace Database\Seeders;

use App\Models\Users;
use App\Models\Subscription;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Users::factory(10)
        ->create()
        ->each(function (User $user): void {
            $user->subscriptions()->saveMany(
                Subscription::factory(5)->make()
            );
        });
    }

}
