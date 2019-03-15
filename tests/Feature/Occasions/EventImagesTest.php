<?php


namespace Tests\Feature\Occasions;


use App\Occasions\Event;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class EventImagesTest extends TestCase
{
    use DatabaseMigrations;

    public function tearDown() :void
    {
        Storage::disk('test_media_dir')->deleteDirectory('media');
        Storage::disk('test_media_dir')->makeDirectory('media');
    }

    /**
     *@test
     */
    public function an_image_can_be_attached_to_an_event()
    {
        $this->disableExceptionHandling();
        $event = factory(Event::class)->create();
        $this->assertFalse($event->hasOwnImage());

        $response = $this->asLoggedInUser()->json('POST', '/admin/events/' . $event->id . '/image', [
            'image' => UploadedFile::fake()->image('testpic.jpg')
        ]);
        $response->assertStatus(200);

        $this->assertTrue($event->fresh()->hasOwnImage());
    }
    
    /**
     *@test
     */
    public function uploading_an_event_image_returns_the_correct_data()
    {
        $this->disableExceptionHandling();
        $event = factory(Event::class)->create();


        $response = $this->asLoggedInUser()->json('POST', '/admin/events/' . $event->id . '/image', [
            'image' => UploadedFile::fake()->image('foodpic.jpg')
        ]);
        $response->assertStatus(200);
        $image_info = $response->decodeResponseJson();

        $this->assertCount(1, $event->fresh()->getMedia());
        $image = $event->fresh()->getImage();

        $this->assertEquals([
            'image_id' => $image->id,
            'thumb_url' => $image->getUrl('thumb'),
            'web_url' => $image->getUrl('web'),
            'delete_url' => '/admin/services/media/' . $image->id
        ], $image_info);
    }
}