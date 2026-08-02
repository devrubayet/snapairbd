<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class card extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $count;
    public $link;
    public $color;
    public $icon;
    public function __construct($title, $link, $color = 'blue', $icon = null, $count = null)
    {
        $this->title = $title;
        $this->count = $count;
        $this->link = $link;
        $this->color = $color;
        $this->icon = $icon;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.card');
    }
}
