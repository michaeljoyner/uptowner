<?php


namespace Tests\Feature\Menu;


use App\Menu\MenuPage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class MenuPagePublishingTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function an_unpublished_menu_page_can_be_published()
    {
        $this->disableExceptionHandling();
        $page = factory(MenuPage::class)->create(['published' => false]);

        $response = $this->asLoggedInUser()->json('POST', '/admin/menu/pages/' . $page->id . '/publish', [
            'publish' => true
        ]);

        $response->assertStatus(200);
        $response->assertJson(['new_status' => true]);

        $this->assertDatabaseHas('menu_pages', [
            'id' => $page->id,
            'published' => true
        ]);
    }

    /**
     *@test
     */
    public function a_published_menu_page_can_be_unpublished()
    {
        $this->disableExceptionHandling();
        $page = factory(MenuPage::class)->create(['published' => true]);

        $response = $this->asLoggedInUser()->json('POST', '/admin/menu/pages/' . $page->id . '/publish', [
            'publish' => false
        ]);

        $response->assertStatus(200);
        $response->assertJson(['new_status' => false]);

        $this->assertDatabaseHas('menu_pages', [
            'id' => $page->id,
            'published' => false
        ]);
    }
}