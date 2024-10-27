<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\MenuItem as MenuItemModel;

class MenuItem extends Component
{
    public $menuItem;
    public $permissions;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(MenuItemModel $menuItem, $permissions = [])
    {
        $this->menuItem = $menuItem;
        $this->permissions = $permissions;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.menu-item');
    }
}
