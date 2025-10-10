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
                'title' => 'Keluhan dari '.$user->name,
                'content' => 'Isi keluhan...',
                'can_comment' => true,
            ]);
        }
    }
}
