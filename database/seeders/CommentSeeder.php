<?php

namespace Database\Seeders;

use App\Models\Complaint;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // Get all complaints
    $complaints = Complaint::all();

    foreach ($complaints as $complaint) {
      $complaint->comment()->createMany([
        [
          'user_id' => 1,
          'content' => 'Isi komentaran...',
        ],
        [
          'user_id' => 2,
          'content' => 'Isi komentar...',
        ],
      ]);
    }
  }
}
