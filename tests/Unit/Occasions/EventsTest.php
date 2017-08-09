<?php


namespace Tests\Unit\Occasions;


use App\Occasions\Event;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class EventsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function events_have_an_upcoming_scope_that_orders_on_event_date()
    {
        $eventA = factory(Event::class)->create(['event_date' => Carbon::parse('+3 days')]);
        $eventB = factory(Event::class)->create(['event_date' => Carbon::parse('+7 days')]);
        $eventC = factory(Event::class)->create(['event_date' => Carbon::parse('+2 days')]);

        $upcoming = Event::upcoming()->get();

        $this->assertEquals($eventC->id, $upcoming->first()->id);
        $this->assertEquals($eventB->id, $upcoming->last()->id);
        $this->assertEquals($eventA->id, $upcoming[1]->id);
    }

    /**
     *@test
     */
    public function the_upcoming_scope_does_not_include_past_events()
    {
        factory(Event::class)->create(['event_date' => Carbon::parse('-3 days')]);
        factory(Event::class)->create(['event_date' => Carbon::parse('-7 days')]);
        $eventA = factory(Event::class)->create(['event_date' => Carbon::parse('+2 days')]);

        $upcoming = Event::upcoming()->get();

        $this->assertCount(1, Event::upcoming()->get());
        $this->assertEquals($eventA->id, $upcoming->first()->id);
    }

    /**
     *@test
     */
    public function upcoming_does_include_events_from_today()
    {
        factory(Event::class)->create(['event_date' => Carbon::today()]);
        $this->assertCount(1, Event::upcoming()->get());
    }

    /**
     *@test
     */
    public function an_event_can_be_set_as_the_featured_event()
    {
        $event = factory(Event::class)->create(['featured' => false]);

        Event::setFeatured($event);

        $this->assertTrue($event->fresh()->featured);
    }

    /**
     *@test
     */
    public function there_can_only_be_one_featured_event()
    {
        $eventA = factory(Event::class)->create(['featured' => true]);
        $eventB = factory(Event::class)->create(['featured' => false]);

        Event::setFeatured($eventB);

        $this->assertTrue($eventB->fresh()->featured);
        $this->assertCount(1, Event::where('featured', 1)->get());
    }

    /**
     *@test
     */
    public function it_knows_which_is_the_featured_event()
    {
        $featured = factory(Event::class)->create(['featured' => true, 'published' => true]);

        $this->assertEquals($featured->id, Event::featured()->id);
    }

    /**
     *@test
     */
    public function the_featured_event_is_not_included_if_it_is_not_published()
    {
        $featured = factory(Event::class)->create(['featured' => true, 'published' => false]);

        $this->assertNull(Event::featured());
    }

    /**
     *@test
     */
    public function if_no_event_is_marked_as_featured_the_most_soon_event_that_has_its_own_image_is_returned()
    {
        $eventA = factory(Event::class)->create([
            'featured' => false,
            'published' => true,
            'event_date' => Carbon::parse('+3 days')
        ]);
        $eventB = factory(Event::class)->create([
            'featured' => false,
            'published' => true,
            'event_date' => Carbon::parse('+3 days')
        ]);
        $eventC = factory(Event::class)->create([
            'featured' => false,
            'published' => true,
            'event_date' => Carbon::parse('+3 days')
        ]);
        $eventB->setImage(UploadedFile::fake()->image('testpic.jpg'));

        $this->assertCount(0, Event::where('featured', 1)->get());
        $this->assertFalse($eventA->hasOwnImage());
        $this->assertTrue($eventB->hasOwnImage());

        $this->assertEquals($eventB->id, Event::featured()->id);
    }

    /**
     *@test
     */
    public function an_event_can_present_itself_as_a_jsonable_array()
    {
        $event = factory(Event::class)->create([
            'name' => ['en' => 'TEST NAME', 'zh' => '満版復'],
            'description' => ['en' => 'TEST DESCRIPTION', 'zh' => '永門義会可際査別件村約候証民'],
            'event_date' => Carbon::today(),
            'time_of_day' => ['en' => 'TEST TIME', 'zh' => '満版復'],
            'published' => true,
            'featured' => false
        ]);
        $image = $event->setImage(UploadedFile::fake()->image('testpic.jpg'));
        
        $jsonable_array = $event->toJsonableArray();

        $this->assertEquals($event->id, $jsonable_array['id']);
        $this->assertEquals('TEST NAME', $jsonable_array['name']);
        $this->assertEquals('満版復', $jsonable_array['zh_name']);
        $this->assertEquals('TEST DESCRIPTION', $jsonable_array['description']);
        $this->assertEquals('永門義会可際査別件村約候証民', $jsonable_array['zh_description']);
        $this->assertEquals('TEST TIME', $jsonable_array['time_of_day']);
        $this->assertEquals('満版復', $jsonable_array['zh_time_of_day']);
        $this->assertEquals(Carbon::today()->format('Y-m-d'), $jsonable_array['event_date']);
        $this->assertTrue($jsonable_array['published']);
        $this->assertEquals($image->getUrl('thumb'), $jsonable_array['image']);
        $this->assertEquals($image->id, $jsonable_array['image_id']);
        $this->assertFalse($jsonable_array['featured']);
    }
}