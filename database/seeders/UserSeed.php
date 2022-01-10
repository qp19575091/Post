<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::factory(1)->create(['name' => 'admin']);
        Role::factory(1)->create(['name' => 'user']);
        
        User::factory()
            ->count(10)
            ->hasPosts(5)
            ->create();

        Comment::factory(100)->create();
    }
}
