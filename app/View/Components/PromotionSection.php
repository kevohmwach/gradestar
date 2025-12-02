<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PromotionSection extends Component
{
    public $promotions;

    /**
     * Create a new component instance.
     *
     * @param array $promotions The array of promotions to display.
     * @return void
     */
    public function __construct($promotions)
    {
        $this->promotions = $promotions;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('components.promotion-section');
    }
}