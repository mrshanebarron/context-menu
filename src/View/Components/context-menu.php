<?php

namespace MrShaneBarron\context-menu\View\Components;

use Illuminate\View\Component;

class context-menu extends Component
{
    public function __construct()
    {
        //
    }

    public function render()
    {
        return view('ld-context-menu::components.context-menu');
    }
}
