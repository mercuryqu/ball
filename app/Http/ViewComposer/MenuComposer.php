<?php

namespace App\Http\ViewComposer;

use Illuminate\Contracts\View\View;

class MenuComposer
{
    protected $menus;

    public function __construct()
    {
        $menus = require_once base_path('routes/menus.php');
        $this->menus = $menus;
    }

    // 将数据渲染到视图中
    public function compose(View $view)
    {
        // 渲染数据
        $view->with('menus', $this->menus);
    }
}
