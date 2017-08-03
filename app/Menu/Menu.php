<?php


namespace App\Menu;


class Menu
{
    public function pages()
    {
        return MenuPage::published()->ordered();
    }

    public function orderedLists()
    {
        $pageList = [
            'parent' => ['page' => null, 'group' => null],
            'list' => MenuPage::all()->map->toOrderedListArray()->toArray()
        ];

        $groupLists = MenuPage::all()->map(function($page) {
           return [
               'parent' => ['page' => $page->id, 'group' => null],
                'list' => $page->groups->map->toOrderedListArray()->toArray()
           ];
        })->toArray();

        $itemLists = MenuGroup::all()->filter(function($group) {
            return $group->page->id ?? false;
        })->map(function($group) {
            return [
                'parent' => ['page' => $group->page->id, 'group' => $group->id],
                'list' => $group->items->map->toOrderedListArray()->toArray()
            ];
        })->toArray();

        return  $this->mergeLists($pageList, ...$groupLists, ...$itemLists);
    }

    protected function mergeLists()
    {
        return func_get_args();
    }
}