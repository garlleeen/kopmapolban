<div class="p-5 mx-2 my-2 max-w-md rounded border-2">
    <h1 class="text-3xl mb-2">{{ $product->product_name }} - Rp. {{ $product->product_price }}</h1>
    <p class="text-lg mb-2">{{ $product->product_desc }}</p>
    <input class="border-2 rounded" type="number" min="1" wire:model="quantity">
    <button class="btn btn-primary" wire:click="addToCart">Add To Cart</button>
</div>
