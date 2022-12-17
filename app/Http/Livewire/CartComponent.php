<?php

namespace App\Http\Livewire;

use App\Facades\Cart;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use App\Models\Product;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Database\QueryException;
use RealRashid\SweetAlert\Facades\Alert;
use App\Notifications\SendNotificationTelegram;
use Illuminate\Support\Facades\Notification;

class CartComponent extends Component
{
    protected $total;
    protected $content;

    protected $listeners = [
        'productAddedToCart' => 'updateCart',
    ];

    /**
     * Mounts the component on the template.
     *
     * @return void
     */
    public function mount(): void
    {
        $this->updateCart();
    }

    /**
     * Renders the component on the browser.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        return view('livewire.cart', [
            'total' => $this->total,
            'content' => $this->content,
        ]);
    }

    /**
     * Removes a cart item by id.
     *
     * @param string $id
     * @return void
     */
    public function removeFromCart(string $id): void
    {
        Cart::remove($id);
        $this->updateCart();
    }

    /**
     * Clears the cart content.
     *
     * @return void
     */
    public function clearCart(): void
    {
        Cart::clear();
        $this->updateCart();
    }

    /**
     * Updates a cart item.
     *
     * @param string $id
     * @param string $action
     * @return void
     */
    public function updateCartItem(string $id, string $action): void
    {
        Cart::update($id, $action);
        $this->updateCart();
    }

    /**
     * Rerenders the cart items and total price on the browser.
     *
     * @return void
     */
    public function updateCart()
    {
        $this->total = Cart::total();
        $this->content = Cart::content();
    }


    public function CheckOut(){
        $total_all = str_replace(',', '', Cart::total());
        // $total_all = str_replace(',', '.', $total_all);
        $total_all = floatval($total_all);

        $produk_list = Cart::content();
        
        $DataTransaksi  = [
            'status_pembayaran' => 1,
            'total_pembayaran' => $total_all,
            'nominal_uang' => $total_all,
            'nominal_kembalian' => 0
        ];
        $transaksi = Transaksi::create($DataTransaksi);
        $lastTransaksiId = $transaksi->id;



        foreach ($produk_list as $id => $item){
            $searchIDProduct = Product::find($id, ['product_id']);

            $DataTransaksiDetail  = [
                'id_transaksi' => $lastTransaksiId,
                'id_product' => $searchIDProduct->product_id,
                'price_buy' => $item->get('price'),
                'qty' => $item->get('quantity'),
                'subtotal' => $item->get('price') * $item->get('quantity')
            ];
            DetailTransaksi::create($DataTransaksiDetail);
        }


        Notification::send($total_all, new SendNotificationTelegram('test')); 

        Cart::clear();

        $this->updateCart();

        Alert::success('Congrats', 'You\'ve Successfully Checkout');

    }
}
