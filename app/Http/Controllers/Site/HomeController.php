<?php

namespace App\Http\Controllers\Site;

use App\Models\User;
use App\Models\Product;
use Darryldecode\Cart\Cart;
use Darryldecode\Cart\CartCondition;
use Darryldecode\Cart\CartCollection;
// use Darryldecode\Cart\Session\SessionInterface;
// use Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /* protected $cart;

    public function __construct(SessionInterface $session)
    {
        $this->cart = new Cart($session, 'your-user-identifier');
    } */

    public function index()
    {
        $products = Product::orderBy('id', 'desc')->limit(5)->get();
        $user = User::first();
        Auth::setUser($user);
        $user = Auth::user();
        $userId = $user->id;

        /* // Instantiate the CartCondition class with the required dependency (your pricing or discount logic)
        $cartCondition = new CartCondition(new YourPricingOrDiscountLogic());

        // Instantiate the Cart class with the required dependencies
        $cart = new Cart(
            new CartCollection(),    // CartCollection instance
            $cartCondition,          // CartCondition instance
            $yourSessionManager,     // Your session manager instance
            $yourEventDispatcher,    // Your event dispatcher instance
            'your-user-identifier'   // Unique identifier for the current user
        ); */

        $add_to_cart = [];
        // dd($products);
        foreach ($products as $key => $product) {
            $add_to_cart[] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $key + 1, //4,
                'attributes' => array(),
                'associatedModel' => $product,
            ];
            /* Cart::session($user->id)->add([
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $key+1,
                'attributes' => array(),
                'associatedModel' => $product,
            ]); */
        }
        // dd(123);
        // dd($add_to_cart);

        Cart::session($user->id)->clear();
        if (Cart::session($user->id)->isEmpty()) {
            echo 'card is empty<br>';
        }
        Cart::session($user->id)->add($add_to_cart);
        Cart::session($user->id)->update($products[0], array(
            'name' => 'New Item Name', // new item name
            'price' => 98.67, // new item price, price can also be a string format like so: '98.67'
            'quantity' => 9, // new item quantity
        ));
        $total = Cart::session($user->id)->getTotal();
        if (Cart::session($user->id)->isEmpty()) {
            echo 'card is not empty<br>';
        }
        $cart = Cart::session($userId)->getContent()->toArray();
        $cartTotalQuantity = Cart::session($userId)->getTotalQuantity();

        /* $cart = Cart::session($userId)->getContent()->toArray();
        foreach ($cart as $key => $value) {
            echo $value['name']." : ".$value['price']." : ".$value['quantity']."<br>";
        }
        dd($cart); */


        // or add multiple conditions from different condition instances
        $condition1 = new \Darryldecode\Cart\CartCondition(array(
            'name' => 'VAT 12.5%',
            'type' => 'tax',
            'target' => 'subtotal', // this condition will be applied to cart's subtotal when getSubTotal() is called.
            'value' => '12.5%',
            'order' => 2
        ));
        $c = Cart::session($userId)->condition($condition); // for a speicifc user's cart



        $sub = Cart::session($user->id)->getSubTotal();
        dd($cart, $total, $cartTotalQuantity, $sub,$c);

        // Cart::session($user->id)->add($add_to_cart);

        // Cart::session($user->id)->clear();

        // $total = Cart::session($user->id)->getTotal();
        // $cartTotalQuantity = Cart::session($userId)->getTotalQuantity();
        $items = Cart::session($userId)->getContent()->toArray();
        dd($add_to_cart, $total, $cartTotalQuantity, $items);

        return view('site.index', compact('products'));
    }
}
