<?php


namespace Tests\Unit\Menu;


use App\Menu\MenuItem;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\Media;
use Tests\TestCase;

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
    public function an_image_can_be_set_on_a_menu_item()
    {
        $item = factory(MenuItem::class)->create();

        $image = $item->setImage(UploadedFile::fake()->image('testpic.jpg'));

        $this->assertInstanceOf(Media::class, $image);
        $this->assertCount(1, $item->getMedia());
        $this->assertContains('testpic.jpg', $image->getPath());
    }

    /**
     *@test
     */
    public function a_menu_item_image_has_the_correct_conversions()
    {
        $item = factory(MenuItem::class)->create();
        $image = $item->setImage(UploadedFile::fake()->image('testpic.jpg'));

        $this->assertContains('.jpg', $image->getUrl('thumb'));
        $this->assertContains('.jpg', $image->getUrl('web'));
    }

    /**
     *@test
     */
    public function setting_an_image_on_the_menu_item_will_discard_any_previous_image()
    {
        $item = factory(MenuItem::class)->create();
        $image1 = $item->setImage(UploadedFile::fake()->image('testpic.jpg'));
        $item->setImage(UploadedFile::fake()->image('testpic2.jpg'));

        $this->assertCount(1, $item->getMedia());
        $this->assertContains('testpic2.jpg', $item->fresh()->getMedia()->first()->getPath());
        $this->assertDatabaseMissing('media', ['id' => $image1->id]);

    }

    /**
     *@test
     */
    public function the_image_url_for_the_menu_item_can_be_retrieved()
    {
        $item = factory(MenuItem::class)->create();
        $image = $item->setImage(UploadedFile::fake()->image('testpic.jpg'));

        $this->assertEquals($item->fresh()->imageUrl(), $image->getUrl());
        $this->assertEquals($item->fresh()->imageUrl('thumb'), $image->getUrl('thumb'));
        $this->assertEquals($item->fresh()->imageUrl('web'), $image->getUrl('web'));
    }

    /**
     *@test
     */
    public function a_menu_item_has_a_default_image()
    {
        $item = factory(MenuItem::class)->create();
        $this->assertCount(0, $item->getMedia());

        $this->assertEquals(MenuItem::DEFAULT_IMG_URL, $item->imageUrl());
        $this->assertEquals(MenuItem::DEFAULT_IMG_URL, $item->imageUrl('thumb'));
        $this->assertEquals(MenuItem::DEFAULT_IMG_URL, $item->imageUrl('web'));
    }
}