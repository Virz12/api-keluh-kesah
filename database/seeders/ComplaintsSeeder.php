<?php

namespace Database\Seeders;

use App\Models\Complaint;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
      $user->complaint()->create([
        'title' => 'Keluhan dari ' . $user->name,
        'content' => 'Isi keluhan...',
        'can_comment' => true
      ]);
    }
  }
}
