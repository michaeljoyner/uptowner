<?php


namespace Tests;


use App\Menu\MenuGroup;
use App\Menu\MenuItem;
use App\Menu\MenuPage;

trait SetsUpOrderedMenu
{
    protected function setUpOrderedMenu()
    {
        $pageA = factory(MenuPage::class)->create(['position' => 0]);
        $pageB = factory(MenuPage::class)->create(['position' => 1]);

        $groupA = factory(MenuGroup::class)->create(['menu_page_id' => $pageA, 'position' => 0]);
        $groupB = factory(MenuGroup::class)->create(['menu_page_id' => $pageA, 'position' => 1]);
        $groupC = factory(MenuGroup::class)->create(['menu_page_id' => $pageB, 'position' => 0]);
        $groupD = factory(MenuGroup::class)->create(['menu_page_id' => $pageB, 'position' => 1]);

        $itemA = factory(MenuItem::class)->create(['menu_group_id' => $groupA, 'position' => 0]);
        $itemB = factory(MenuItem::class)->create(['menu_group_id' => $groupA, 'position' => 1]);
        $itemC = factory(MenuItem::class)->create(['menu_group_id' => $groupB, 'position' => 0]);
        $itemD = factory(MenuItem::class)->create(['menu_group_id' => $groupB, 'position' => 1]);
        $itemE = factory(MenuItem::class)->create(['menu_group_id' => $groupC, 'position' => 0]);
        $itemF = factory(MenuItem::class)->create(['menu_group_id' => $groupC, 'position' => 1]);
        $itemG = factory(MenuItem::class)->create(['menu_group_id' => $groupD, 'position' => 0]);
        $itemH = factory(MenuItem::class)->create(['menu_group_id' => $groupD, 'position' => 1]);

        $expected_lists = [
            [
                'parent' => ['page' => null, 'group' => null],
                'list'   => [
                    ['id'       => $pageA->id,
                     'name'     => $pageA->name,
                     'position' => 0,
                     'child'    => ['page' => $pageA->id, 'group' => null]
                    ],
                    ['id'       => $pageB->id,
                     'name'     => $pageB->name,
                     'position' => 1,
                     'child'    => ['page' => $pageB->id, 'group' => null]
                    ]
                ]
            ],
            [
                'parent' => ['page' => $pageA->id, 'group' => null],
                'list'   => [
                    [
                        'id'    => $groupA->id,
                        'name'  => $groupA->name,
                        'position' => 0,
                        'child' => ['page' => $pageA->id, 'group' => $groupA->id]
                    ],
                    [
                        'id'    => $groupB->id,
                        'name'  => $groupB->name,
                        'position' => 1,
                        'child' => ['page' => $pageA->id, 'group' => $groupB->id]
                    ]
                ]
            ],
            [
                'parent' => ['page' => $pageB->id, 'group' => null],
                'list'   => [
                    [
                        'id'    => $groupC->id,
                        'name'  => $groupC->name,
                        'position' => 0,
                        'child' => ['page' => $pageB->id, 'group' => $groupC->id]
                    ],
                    [
                        'id'    => $groupD->id,
                        'name'  => $groupD->name,
                        'position' => 1,
                        'child' => ['page' => $pageB->id, 'group' => $groupD->id]
                    ]
                ]
            ],
            [
                'parent' => ['page' => $pageA->id, 'group' => $groupA->id],
                'list'   => [
                    [
                        'id'    => $itemA->id,
                        'name'  => $itemA->name,
                        'position' => 0,
                        'child' => null
                    ],
                    [
                        'id'    => $itemB->id,
                        'name'  => $itemB->name,
                        'position' => 1,
                        'child' => null
                    ]
                ]
            ],
            [
                'parent' => ['page' => $pageA->id, 'group' => $groupB->id],
                'list'   => [
                    [
                        'id'    => $itemC->id,
                        'name'  => $itemC->name,
                        'position' => 0,
                        'child' => null
                    ],
                    [
                        'id'    => $itemD->id,
                        'name'  => $itemD->name,
                        'position' => 1,
                        'child' => null
                    ]
                ]
            ],
            [
                'parent' => ['page' => $pageB->id, 'group' => $groupC->id],
                'list'   => [
                    [
                        'id'    => $itemE->id,
                        'name'  => $itemE->name,
                        'position' => 0,
                        'child' => null
                    ],
                    [
                        'id'    => $itemF->id,
                        'name'  => $itemF->name,
                        'position' => 1,
                        'child' => null
                    ]
                ]
            ],
            [
                'parent' => ['page' => $pageB->id, 'group' => $groupD->id],
                'list'   => [
                    [
                        'id'    => $itemG->id,
                        'name'  => $itemG->name,
                        'position' => 0,
                        'child' => null
                    ],
                    [
                        'id'    => $itemH->id,
                        'name'  => $itemH->name,
                        'position' => 1,
                        'child' => null
                    ]
                ]
            ]
        ];

        return $expected_lists;
    }
}