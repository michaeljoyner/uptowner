<?php

namespace Tests\Feature\ModelImages;

use App\Menu\MenuItem;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class CanClearModelImageTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_model_image_can_be_cleared_which_deletes_the_image()
    {
        $this->disableExceptionHandling();
        $item = factory(MenuItem::class)->create();
        $image = $item->setImage(UploadedFile::fake()->image('testpic.jpg'));
        $this->assertTrue($item->fresh()->hasOwnImage());

        $response = $this->asLoggedInUser()->json('DELETE', '/admin/services/media/' . $image->id);
        $response->assertStatus(200);

        $this->assertDatabaseMissing('media', ['id' => $image->id]);
        $this->assertFalse($item->fresh()->hasOwnImage());
    }
}