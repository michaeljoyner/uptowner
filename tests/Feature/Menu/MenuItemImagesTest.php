<?php


namespace Tests\Feature\Menu;


use App\Menu\MenuItem;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MenuItemImagesTest extends TestCase
{
    use DatabaseMigrations;

    public function tearDown()
    {
        Storage::disk('test_media_dir')->deleteDirectory('media');
        Storage::disk('test_media_dir')->makeDirectory('media');
    }

    /**
     *@test
     */
    public function an_image_can_be_uploaded_and_attached_to_an_image()
    {
        $this->disableExceptionHandling();
        $item = factory(MenuItem::class)->create();

        $response = $this->asLoggedInUser()->json('POST', '/admin/menu/items/' . $item->id . '/image', [
            'image' => UploadedFile::fake()->image('foodpic.jpg')
        ]);
        $response->assertStatus(200);

        $this->assertCount(1, $item->fresh()->getMedia());
    }
}