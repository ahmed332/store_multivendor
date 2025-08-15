<?php

namespace App\View\Components;

use App\Facades\Cart;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CartMenu extends Component
{
    public $items;
    public $total;
    public $count;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->items = Cart::get();
        $this->total=Cart::total();
        $this->count = $this->items->count();

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cart-menu');
    }
}
