<?php


namespace Tests\Feature\Specials;


use Tests\TestCase;
use App\Specials\Special;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SpecialsImageTest extends TestCase
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
    public function an_image_can_be_attached_to_a_special()
    {
        $this->disableExceptionHandling();
        $special = factory(Special::class)->create();

        $response = $this->asLoggedInUser()->json('POST', '/admin/specials/' . $special->id . '/image', [
            'image' => UploadedFile::fake()->image('testpic.jpg')
        ]);
        $response->assertStatus(200);

        $this->assertCount(1, $special->fresh()->getMedia());
        $this->assertStringContainsString('testpic.jpg', $special->fresh()->getMedia()->first()->getPath());
    }
}