<?php


namespace Tests\Unit\Menu;


use App\Menu\Menu;
use App\Menu\MenuGroup;
use App\Menu\MenuItem;
use App\Menu\MenuPage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Tests\SetsUpOrderedMenu;
use Tests\TestCase;

class MenuTest extends TestCase
{
    use DatabaseMigrations, SetsUpOrderedMenu;

    /**
     * @test
     */
    public function the_menu_has_all_published_menu_pages()
    {
        factory(MenuPage::class, 5)->create([
            'published' => true,
            'name'      => ['en' => 'GOOD TEST PAGE', 'zh' => '満版復']
        ]);
        factory(MenuPage::class, 4)->create([
            'published' => false,
            'name'      => ['en' => 'BAD TEST PAGE', 'zh' => '満版復']
        ]);

        $this->assertCount(5, \Menu::pages());
        \Menu::pages()->each(function ($page) {
            $this->assertEquals('GOOD TEST PAGE', $page->name);
        });
    }

    /**
     * @test
     */
    public function a_menu_has_all_published_groups_in_a_page()
    {
        $page = factory(MenuPage::class)->create(['published' => true]);
        factory(MenuGroup::class, 3)->create([
            'menu_page_id' => $page->id,
            'published'    => true,
            'name'         => ['en' => 'GOOD TEST GROUP', 'zh' => '満版復']
        ]);

        factory(MenuGroup::class)->create([
            'menu_page_id' => $page->id,
            'published'    => false,
            'name'         => ['en' => 'BAD TEST GROUP', 'zh' => '満版復']
        ]);

        $this->assertCount(1, \Menu::pages());
        $groups = \Menu::pages()->first()->publishedGroups;

        $this->assertCount(3, $groups);
        $groups->each(function ($group) {
            $this->assertEquals('GOOD TEST GROUP', $group->name);
        });

    }

    /**
     * @test
     */
    public function a_menu_page_knows_how_many_images_it_has_from_all_groups()
    {
        $page = factory(MenuPage::class)->create(['published' => true]);
        $groupA = factory(MenuGroup::class)->create(['published' => true, 'menu_page_id' => $page->id]);
        $groupB = factory(MenuGroup::class)->create(['published' => true, 'menu_page_id' => $page->id]);
        $groupC = factory(MenuGroup::class)->create(['published' => true, 'menu_page_id' => $page->id]);

        $itemA = factory(MenuItem::class)->create(['menu_group_id' => $groupA->id, 'published' => true]);
        $itemB = factory(MenuItem::class)->create(['menu_group_id' => $groupB->id, 'published' => true]);
        $itemC = factory(MenuItem::class)->create(['menu_group_id' => $groupB->id, 'published' => true]);
        $itemD = factory(MenuItem::class)->create(['menu_group_id' => $groupC->id, 'published' => true]);
        $itemE = factory(MenuItem::class)->create(['menu_group_id' => $groupC->id, 'published' => true]);

        $itemB->setImage(UploadedFile::fake()->image('testpic1.jpg'));
        $itemD->setImage(UploadedFile::fake()->image('testpic2.jpg'));
        $itemE->setImage(UploadedFile::fake()->image('testpic3.jpg'));


        $this->assertCount(1, \Menu::pages());
        $images = \Menu::pages()->first()->publishedItemImages();
        $this->assertCount(3, $images);
    }

    /**
     * @test
     */
    public function the_menu_has_a_set_of_orderable_lists()
    {
        $expected_lists = $this->setUpOrderedMenu();

        $menu_ordered_lists = \Menu::orderedLists();

        $this->assertEquals($expected_lists, $menu_ordered_lists);
    }

    /**
     *@test
     */
    public function the_ordered_lists_do_not_include_groups_that_are_not_assigned_to_a_page()
    {
        $page = factory(MenuPage::class)->create(['position' => 0]);
        $groupA = factory(MenuGroup::class)->create(['menu_page_id' => $page->id, 'position' => 1]);
        $groupB = factory(MenuGroup::class)->create(['menu_page_id' => null, 'position' => 0]);

        $expected_lists = [
            [
                'parent' => ['page' => null, 'group' => null],
                'list' => [[
                    'id' => $page->id,
                    'name' => $page->name,
                    'position' => 0,
                    'child' => ['page' => $page->id, 'group' => null]
                ]]
            ],
            [
                'parent' => ['page' => $page->id, 'group' => null],
                'list' => [[
                    'id' => $groupA->id,
                    'name' => $groupA->name,
                    'position' => 1,
                    'child' => ['page' => $page->id, 'group' => $groupA->id]
                ]]
            ],
            [
                'parent' => ['page' => $page->id, 'group' => $groupA->id],
                'list' => []
            ]
        ];


        $this->assertEquals($expected_lists, \Menu::orderedLists());

    }
}