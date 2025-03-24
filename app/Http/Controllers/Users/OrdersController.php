<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->with('cart_detail.book')->get();

        return view('users.order', compact('user', 'cart'));
    }

    public function create_order(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|max:255',
            'phone'   => 'required|regex:/^0[0-9]{9}$/',
            'address' => 'required|string|max:255'
        ], [
            'name.required'    => 'Vui lòng nhập họ tên',
            'name.max'         => 'Tên quá dài',
            'phone.required'   => 'Vui lòng nhập số điện thoại',
            'phone.regex'      => 'Số điện thoại không hợp lệ',
            'address.required' => 'Vui lòng nhập địa chỉ',
            'address.max'      => 'Địa chỉ quá dài'
        ]);

        $user = Auth::user();

        $cart = Cart::where('user_id', $user->id)
            ->with('cart_detail.book')
            ->first();

        if (!$cart) {
            return redirect()->route('home')->with('error', 'Giỏ hàng trống.');
        }

        foreach ($cart->cart_detail as $detail) {
            if ($detail->book->quantity < $detail->quantity) {
                return redirect()->route('home')->with('success', 'Sản phẩm "' . $detail->book->title . '" không đủ hàng.');
            }
        }

        $totalPrice = $cart->total_price;

        $order = Order::create([
            'user_id'     => $user->id,
            'receiver_name'    => $data['name'],
            'receiver_phone'   => $data['phone'],
            'receiver_address' => $data['address'],
            'total_price' => $totalPrice,
            'status'      => 'Chờ xử lý',
            'note'        => $request->note ?? null,
        ]);

        foreach ($cart->cart_detail as $detail) {
            $order->order_details()->create([
                'book_id'  => $detail->book->id,
                'quantity' => $detail->quantity,
                'price'    => $detail->price,
            ]);

            $book = $detail->book;
            if ($book->quantity >= $detail->quantity) {
                $book->quantity -= $detail->quantity;
            } else {
                $book->quantity = 0;
            }
            $book->save();
        }

        Cart::where('user_id', $user->id)->delete();

        // if ($request->payment_method == 'vnpay') {
        //     return redirect()->route('vnpay.payment', ['order_id' => $order->id]);
        // } elseif ($request->payment_method == 'momo') {
        //     return redirect()->route('momo.payment', ['order_id' => $order->id]);
        // } else {

        // }

        return redirect()->route('home')->with('success', 'Đặt hàng thành công');
    }

    public function my_order()
    {
        $orders = Order::where('user_id', Auth::id())
            ->whereIn('status', ['Chờ xử lý', 'Đang xử lý', 'Đang giao hàng'])
            ->orderBy('created_at', 'desc')
            ->get();


        return view('users.order_detail', compact('orders'));
    }

    public function order_detail($id)
    {
        $order = Order::where('user_id', Auth::id())->where('id', $id)->firstOrFail();

        return view('users.order_detail_view', compact('order'));
    }


    public function history_order()
    {
        $historyOrders = Order::where('user_id', Auth::id())
            ->whereIn('status', ['Hoàn thành', 'Đã hủy'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('users.history_order_detail', compact('historyOrders'));
    }
}
