<?php


namespace Tests\Unit\Occasions;


use App\Occasions\Event;
use App\Occasions\EventsList;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class EventsListTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function an_events_list_is_returned_by_the_event_model_class()
    {
        $list = Event::upcomingList();

        $this->assertInstanceOf(EventsList::class, $list);
    }

    /**
     * @test
     */
    public function an_events_list_has_the_featured_event()
    {
        $featured = factory(Event::class)->create(['featured' => true, 'published' => true]);

        $list = Event::upcomingList();

        $this->assertEquals($featured->id, $list->featured->id);
    }

    /**
     * @test
     */
    public function the_event_list_has_a_list_of_coming_soon_events_with_up_to_three_events()
    {
        $events = factory(Event::class, 5)->create(['published' => true]);
        $events->each->setImage(UploadedFile::fake()->image('test.jpg'));

        $list = Event::upcomingList();

        $coming_soon = $list->comingSoon();

        $this->assertCount(3, $coming_soon);
    }

    /**
     * @test
     */
    public function the_coming_soon_events_are_the_three_most_immediate_that_have_images()
    {
        $eventA = factory(Event::class)->create(['published' => true, 'event_date' => Carbon::parse('+4 days')]);
        $eventB = factory(Event::class)->create(['published' => true, 'event_date' => Carbon::parse('+1 days')]);
        $eventC = factory(Event::class)->create(['published' => true, 'event_date' => Carbon::parse('+7 days')]);
        $eventD = factory(Event::class)->create(['published' => true, 'event_date' => Carbon::parse('+5 days')]);
        $eventE = factory(Event::class)->create(['published' => true, 'event_date' => Carbon::parse('+3 days')]);
        $eventF = factory(Event::class)->create(['published' => true, 'event_date' => Carbon::parse('+2 days')]);

        $eventB->setImage(UploadedFile::fake()->image('testpic.jpg'));
        $eventC->setImage(UploadedFile::fake()->image('testpic.jpg'));
        $eventF->setImage(UploadedFile::fake()->image('testpic.jpg'));

        $list = Event::upcomingList();
        $coming_soon = $list->comingSoon();

        $this->assertEquals($eventB->id, $coming_soon->first()->id);
        $this->assertEquals($eventF->id, $coming_soon[1]->id);
        $this->assertEquals($eventC->id, $coming_soon->last()->id);
    }

    /**
     * @test
     */
    public function the_upcoming_list_also_includes_all_other_upcoming_published_events()
    {
        $upcoming = factory(Event::class, 3)->create(['published' => true, 'event_date' => Carbon::parse('+2 days')]);
        $upcoming->each->setImage(UploadedFile::fake()->image('test.jpg'));
        $the_rest = factory(Event::class, 5)->create(['published' => true, 'event_date' => Carbon::parse('+4 days')]);
        $ghosts = factory(Event::class, 3)->create(['published' => false, 'event_date' => Carbon::parse('+3 days')]);

        $list = Event::upcomingList();
        $all_others = $list->restOfEvents();

        $all_others->each(function ($event) use ($upcoming, $ghosts, $the_rest) {
            $this->assertContains($event->id, $the_rest->pluck('id')->all());
            $this->assertNotContains($event->id, $upcoming->pluck('id')->all());
            $this->assertNotContains($event->id, $ghosts->pluck('id')->all());
        });
    }
    
    /**
     *@test
     */
    public function it_does_not_include_any_expired_events()
    {
        factory(Event::class, 5)->create(['published' => true, 'featured' => true, 'event_date' => Carbon::parse('-3 days')]);
        factory(Event::class, 5)->create(['published' => true, 'event_date' => Carbon::parse('-3 days')]);

        $list = Event::upcomingList();

        $this->assertNull($list->featured);
        $this->assertCount(0, $list->comingSoon());
        $this->assertCount(0, $list->restOfEvents());
    }
}