<?php

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->delete();

        for ($i=1; $i <= 100; $i++) {
            Event::create([
                    'title'   => '我是活动 - '.$i,
                    'content' => 'content ' . $i,
                    'begin_time' => \Carbon\Carbon::now(),
                    'end_time' => \Carbon\Carbon::now(),
                    'user_count'    => rand(0,1000),
                    'user_id' => 1,
                ]);
        }
    }
}
