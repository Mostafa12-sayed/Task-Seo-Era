<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;





class DataTable extends Component
{
    public string $title;
    public string $route;
    public function __construct(string $title = 'DataTable' , string $route = '')
    {
        $this->title = $title;
        $this->route = $route;
    }

    public function render()
    {
        return view('components.data-table');
    }
}
