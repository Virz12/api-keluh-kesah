<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class ComplaintsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users
        $users = User::all();

        // Create complaints
        foreach ($users as $user) {
            $user->complaints()->create([
                'content' => 'Isi keluhan...'.$user->name,
                'can_comment' => true,
            ]);
        }
    }
}
