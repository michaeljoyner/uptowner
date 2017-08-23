<?php


namespace Tests\Unit\Menu;


use App\Menu\MenuGroup;
use App\Menu\MenuItem;
use App\Menu\MenuPage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class MenuPagesTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_menu_page_can_un_assign_all_its_groups()
    {
        $page = factory(MenuPage::class)->create();
        $groups = factory(MenuGroup::class, 3)->create(['menu_page_id' => $page->id]);

        $page->releaseGroups();

        $groups->each(function($group) {
            $this->assertNull($group->fresh()->menu_page_id);
        });
    }

    /**
     *@test
     */
    public function a_menu_page_can_release_a_given_group()
    {
        $page = factory(MenuPage::class)->create();
        $group = factory(MenuGroup::class)->create(['menu_page_id' => $page->id]);

        $page->releaseGroup($group);

        $this->assertNotContains($group->id, $page->fresh()->groups->pluck('id'));
    }

    /**
     *@test
     */
    public function a_menu_page_can_add_a_menu_group_by_id()
    {
        $page = factory(MenuPage::class)->create();
        $group = factory(MenuGroup::class)->create(['menu_page_id' => null]);

        $page->addGroup($group->id);

        $this->assertContains($group->id, $page->fresh()->groups->pluck('id'));
    }

    /**
     *@test
     */
    public function menu_pages_have_a_published_scope()
    {
        factory(MenuPage::class, 3)->create(['published' => false]);
        factory(MenuPage::class, 2)->create(['published' => true]);

        $this->assertCount(2, MenuPage::published()->get());
        $this->assertCount(5, MenuPage::all());
    }

    /**
     *@test
     */
    public function a_menu_page_has_a_scoped_relationship_for_published_groups()
    {
        $page = factory(MenuPage::class)->create();
        factory(MenuGroup::class, 3)->create(['published' => true, 'menu_page_id' => $page->id]);
        factory(MenuGroup::class)->create(['published' => false, 'menu_page_id' => $page->id]);

        $this->assertCount(4, $page->groups);
        $this->assertCount(3, $page->publishedGroups);

        $page->publishedGroups->each(function($group) {
            $this->assertTrue($group->published);
        });
    }

    /**
     *@test
     */
    public function a_page_can_get_all_published_item_images_from_its_groups()
    {
        $page = factory(MenuPage::class)->create();
        $groupA = factory(MenuGroup::class)->create(['published' => true, 'menu_page_id' => $page->id]);
        $groupB = factory(MenuGroup::class)->create(['published' => true, 'menu_page_id' => $page->id]);

        $itemA = factory(MenuItem::class)->create(['published' => true, 'menu_group_id' => $groupA->id]);
        $itemB = factory(MenuItem::class)->create(['published' => true, 'menu_group_id' => $groupA->id]);
        $itemC = factory(MenuItem::class)->create(['published' => true, 'menu_group_id' => $groupB->id]);
        $itemD = factory(MenuItem::class)->create(['published' => false, 'menu_group_id' => $groupB->id]);

        $imageA = $itemB->setImage(UploadedFile::fake()->image('testpic1.jpg'));
        $imageB = $itemC->setImage(UploadedFile::fake()->image('testpic1.jpg'));
        $imageC = $itemD->setImage(UploadedFile::fake()->image('testpic1.jpg'));

        $images = $page->fresh()->publishedItemImages();

        $this->assertCount(2, $images);
        $this->assertContains(['src' => $imageA->getUrl('thumb'), 'alt' => $itemB->name], $images);
        $this->assertContains(['src' => $imageB->getUrl('thumb'), 'alt' => $itemC->name], $images);
    }

    /**
     *@test
     */
    public function a_page_can_present_all_its_images_padded_with_fillers_if_necessary()
    {
        $page = factory(MenuPage::class)->create();
        $groupA = factory(MenuGroup::class)->create(['published' => true, 'menu_page_id' => $page->id]);
        $groupB = factory(MenuGroup::class)->create(['published' => true, 'menu_page_id' => $page->id]);

        $itemA = factory(MenuItem::class)->create(['published' => true, 'menu_group_id' => $groupA->id]);
        $itemB = factory(MenuItem::class)->create(['published' => true, 'menu_group_id' => $groupA->id]);
        $itemC = factory(MenuItem::class)->create(['published' => true, 'menu_group_id' => $groupB->id]);
        $itemD = factory(MenuItem::class)->create(['published' => true, 'menu_group_id' => $groupB->id]);

        $imageA = $itemB->setImage(UploadedFile::fake()->image('testpic1.jpg'));
        $imageB = $itemC->setImage(UploadedFile::fake()->image('testpic1.jpg'));
        $imageC = $itemD->setImage(UploadedFile::fake()->image('testpic1.jpg'));

        $images = $page->fresh()->getFilledImageRow();

        $this->assertCount(6, $images);
        $this->assertContains(['src' => $imageA->getUrl('thumb'), 'alt' => $itemB->name], $images);
        $this->assertContains(['src' => $imageB->getUrl('thumb'), 'alt' => $itemC->name], $images);
        $this->assertContains(['src' => $imageC->getUrl('thumb'), 'alt' => $itemD->name], $images);

        $filler_images = collect($images)->filter(function($image) {
            return str_contains($image['src'], 'images/menu_fillers');
        })->all();

        $this->assertCount(3, $filler_images);
    }

    /**
     *@test
     */
    public function a_menu_page_with_less_than_three_images_has_an_empty_image_row()
    {
        $page = factory(MenuPage::class)->create();
        $groupA = factory(MenuGroup::class)->create(['published' => true, 'menu_page_id' => $page->id]);
        $groupB = factory(MenuGroup::class)->create(['published' => true, 'menu_page_id' => $page->id]);

        $itemA = factory(MenuItem::class)->create(['published' => true, 'menu_group_id' => $groupA->id]);
        $itemB = factory(MenuItem::class)->create(['published' => true, 'menu_group_id' => $groupA->id]);
        $itemC = factory(MenuItem::class)->create(['published' => true, 'menu_group_id' => $groupB->id]);
        $itemD = factory(MenuItem::class)->create(['published' => false, 'menu_group_id' => $groupB->id]);

        $itemB->setImage(UploadedFile::fake()->image('testpic1.jpg'));
        $itemC->setImage(UploadedFile::fake()->image('testpic1.jpg'));
        $itemD->setImage(UploadedFile::fake()->image('testpic1.jpg'));

        $images = $page->fresh()->getFilledImageRow();

        $this->assertCount(0, $images);
    }

    /**
     *@test
     */
    public function a_menu_page_can_present_itself_as_a_jsonable_array()
    {
        $page = factory(MenuPage::class)->create([
            'name' => ['en' => 'TEST PAGE', 'zh' => '満版復'],
        ]);
        factory(MenuGroup::class)->create([
            'name' => ['en' => 'TEST GROUP A', 'zh' => '満版復'],
            'menu_page_id' => $page->id
        ]);
        factory(MenuGroup::class)->create([
            'name' => ['en' => 'TEST GROUP B', 'zh' => '満版復'],
            'menu_page_id' => $page->id
        ]);

        $expected = [
            'name' => 'TEST PAGE',
            'zh_name' => '満版復',
            'id' => $page->id,
            'group_names' => ['TEST GROUP A', 'TEST GROUP B'],
            'published' => false
        ];

        $this->assertEquals($expected, $page->fresh()->toJsonableArray());
    }
}