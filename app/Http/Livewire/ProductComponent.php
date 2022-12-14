<?php

namespace App\Http\Livewire;

use App\Facades\Cart;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class ProductComponent extends Component
{
    public $product;
    public $quantity;

    /**
     * Mounts the component on the template.
     *
     * @return void
     */
    public function mount(): void
    {
        $this->quantity = 1;
    }

        /**
     * Renders the component on the browser.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        return view('livewire.product');
    }

    /**
     * Adds an item to cart.
     *
     * @return void
     */
    public function addToCart(): void
    {
        // Cart::add($this->product->product_id, $this->product->product_name, $this->product->getRawOriginal('product_price'), $this->quantity);
        Cart::add($this->product->id, $this->product->product_name, $this->product->getRawOriginal('product_price'), $this->quantity);
        $this->emit('productAddedToCart');
    }
}
