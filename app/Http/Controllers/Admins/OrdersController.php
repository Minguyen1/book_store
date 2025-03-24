<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = Order::with('user')
            ->whereIn('status', ['chờ xử lý', 'đang xử lý', 'đang giao hàng'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admins.orders.index', compact('order'));
    }

    public function orderDetail($id)
    {
        $order = Order::with('order_details.book', 'user')->findOrFail($id);

        return view('admins.orders.detail', compact('order'));
    }

    public function updateOrderStatus(Request $request, $id)
{
    $order = Order::findOrFail($id);

    $validStatuses = ['Chờ xử lý', 'Đang xử lý', 'Đang giao hàng', 'Hoàn thành'];
    $currentStatus = $order->status;
    $newStatus = $request->status;

    if (!in_array($newStatus, $validStatuses) && $newStatus !== 'Đã hủy') {
        return redirect()->back()->with('error', 'Trạng thái không hợp lệ.');
    }

    if ($currentStatus === 'Đã hủy') {
        return redirect()->back()->with('error', 'Không thể thay đổi trạng thái đơn hàng đã hủy.');
    }

    $currentIndex = array_search($currentStatus, $validStatuses);
    $newIndex = array_search($newStatus, $validStatuses);

    if ($newStatus !== 'Đã hủy' && ($newIndex === false || $newIndex <= $currentIndex)) {
        return redirect()->back()->with('error', 'Không thể quay lại trạng thái trước.');
    }

    $order->update(['status' => $newStatus]);

    return redirect()->back()->with('success', 'Cập nhật trạng thái thành công!');
}


    public function orderHistory()
    {
        $orders = Order::with('user')
            ->whereIn('status', ['Hoàn thành', 'Đã hủy'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admins.orders.history', compact('orders'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
