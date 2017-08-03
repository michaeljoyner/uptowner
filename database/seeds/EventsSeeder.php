<?php

use Illuminate\Database\Seeder;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Occasions\Event::class)->create([
            'event_date'  => \Carbon\Carbon::parse('+10 days'),
            'name'        => ['en' => 'Rumble in the Jungle', 'zh' => '満版復'],
            'description' => ['en' => 'Mayweather vs McGregor', 'zh' => '永門義会可際査別件村約候証民'],
            'time_of_day' => ['en' => '3am', 'zh' => '3am'],
            'published'   => true
        ]);

        factory(\App\Occasions\Event::class)->create([
            'event_date'  => \Carbon\Carbon::parse('+14 days'),
            'name'        => ['en' => 'Super Rugby Final', 'zh' => '満版復'],
            'description' => ['en' => 'The Lion vs Probably not the Sunwolves', 'zh' => '永門義会可際査別件村約候証民'],
            'time_of_day' => ['en' => '11pm', 'zh' => '11pm'],
            'published'   => true
        ]);

        factory(\App\Occasions\Event::class)->create([
            'event_date'  => \Carbon\Carbon::parse('+20 days'),
            'name'        => ['en' => 'Superbowl', 'zh' => '満版復'],
            'description' => ['en' => 'Two football teams face off', 'zh' => '永門義会可際査別件村約候証民'],
            'time_of_day' => ['en' => '4pm', 'zh' => '4pm'],
            'published'   => true
        ]);

        factory(\App\Occasions\Event::class)->create([
            'event_date'  => \Carbon\Carbon::parse('+31 days'),
            'name'        => ['en' => 'Pub Quiz', 'zh' => '満版復'],
            'description' => ['en' => 'Monthly Pub Quiz', 'zh' => '永門義会可際査別件村約候証民'],
            'time_of_day' => ['en' => '7pm', 'zh' => '7pm'],
            'published'   => true
        ]);
    }
}
