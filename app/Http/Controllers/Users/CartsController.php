<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Cart;
use App\Models\CartDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function showCart(){
        if (!Auth::check()) {
            return redirect()->route('form_login')->with('error', 'Vui lòng đăng nhập để xem giỏ hàng.');
        }

        $user = Auth::user();
        $carts = Cart::where('user_id', $user->id)->with('cart_detail.book')->get();

        $cartEmpty = $carts->isEmpty() || $carts->every(fn($cart) => $cart->cart_detail->isEmpty());

        return view('users.cart', compact('carts', 'cartEmpty'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('form_login')->with('error', 'Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng.');
        }

        $user = Auth::user();
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        $book = Book::findOrFail($request->book_id);
        $price = $book->price * $request->quantity;

        $cartDetail = CartDetail::where('cart_id', $cart->id)
            ->where('book_id', $request->book_id)
            ->first();

        if ($cartDetail) {
            $cartDetail->quantity += $request->quantity;
            $cartDetail->price += $price;
            $cartDetail->save();
        } else {
            CartDetail::create([
                'cart_id' => $cart->id,
                'book_id' => $request->book_id,
                'quantity' => $request->quantity,
                'price' => $price,
            ]);
        }

        $cart->increment('total_price', $price);

        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cartDetail = CartDetail::findOrFail($id);

        $cart = $cartDetail->cart;

        if ($cart) {
            $cart->total_price -= $cartDetail->book->price * $cartDetail->quantity;
            $cart->save();
        }

        $cartDetail->delete();

        return redirect()->route('user.cart')->with('success', 'Xóa sản phẩm thành công');
    }
}
