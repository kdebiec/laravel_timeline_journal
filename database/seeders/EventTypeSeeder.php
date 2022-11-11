<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventTypeSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('event_types')->insert([
      'name' => 'Concert',
      'color' => '#FEC8DF',
    ]);

    DB::table('event_types')->insert([
      'name' => 'Conference',
      'color' => '#75CFE0',
    ]);

    DB::table('event_types')->insert([
      'name' => 'Bootcamp',
      'color' => '#F5C691',
    ]);
  }
}