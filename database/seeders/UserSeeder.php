<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // User seeder
    User::insert([
      [
        'name' => 'Ellen Joe',
        'email' => 'ellen@example.com',
        'password' => Hash::make('ellen0401'),
      ],
      [
        'name' => 'Ju Fufu',
        'email' => 'fufufafa@example.com',
        'password' => Hash::make('fufu0601'),
      ]
    ]);
  }
}
