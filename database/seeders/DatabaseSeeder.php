<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call(EventTypeSeeder::class);

        // create an array of random unique dates in the format y-m-d
        $randomDates = [];
        while (count($randomDates) < 15) {
        $date = Carbon::today()->subDays(rand(0, 31))->format('Y-m-d');
        if (!in_array($date, $randomDates))
            array_push($randomDates, $date);
        }

        foreach($randomDates as $date) {
            Event::factory()->create([
                'start_date' => $date
            ]);
        }
    }
}
