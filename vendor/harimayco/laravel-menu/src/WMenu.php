<?php

namespace Harimayco\Menu;

use App\Http\Requests;
use Harimayco\Menu\Models\Menus;
use Harimayco\Menu\Models\MenuItems;

class WMenu
{

    public function render()
    {
        $menu = new Menus();
        $menuitems = new MenuItems();
        $menulist = $menu->select(['id', 'name'])->get();
        $menulist = $menulist->pluck('name', 'id')->prepend('Select menu', 0)->all();

        if ((request()->has("action") && empty(request()->input("menu"))) || request()->input("menu") == '0') {
            return view('vendor.harimayco-menu.menu-html')->with("menulist", $menulist);
        } else {

            $menu = Menus::find(request()->input("menu"));
            $menus = $menuitems->getall(1);
            
            $data = ['menus' => $menus, 'indmenu' => $menu, 'menulist' => $menulist];
            return view('vendor.harimayco-menu.menu-html', $data);
        }

    }

    public function scripts()
    {
        return view('vendor.harimayco-menu.scripts');
    }

    public function select($name = "menu", $menulist = array())
    {
        $html = '<select name="' . $name . '">';

        foreach ($menulist as $key => $val) {
            $active = '';
            if (request()->input('menu') == $key) {
                $active = 'selected="selected"';
            }
            $html .= '<option ' . $active . ' value="' . $key . '">' . $val . '</option>';
        }
        $html .= '</select>';
        return $html;
    }

    public static function getByName($name)
    {
        $menu_id = Menus::byName($name)->id;
        return self::get($menu_id);
    }

    public static function list($menu_id)
    {
        $menuItem = new MenuItems;
        $menu_list = $menuItem->getall($menu_id);

        $roots = $menu_list->where('menu', $menu_id)->where('parent', '0');

        $items = self::tree($roots, $menu_list);
        return $items;
    }

    private static function tree($items, $all_items)
    {
        $data_arr = array();
        $i = 0;
        foreach ($items as $item) {
            $data_arr[$i] = $item->toArray();
            $find = $all_items->where('parent', $item->id);

            $data_arr[$i]['child'] = array();

            if ($find->count()) {
                $data_arr[$i]['child'] = self::tree($find, $all_items);
            }

            $i++;
        }

        return $data_arr;
    }

}
