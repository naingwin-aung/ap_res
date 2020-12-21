<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $dishes = Dish::orderBy('id', 'desc')->get();
        $tables = Table::get();

        $rawstatus = config('res.order_status');
        $status = array_flip($rawstatus);
        $orders = Order::get()->filter(function ($val) {
            return $val->status == 4;
        });

        return view('order_form', compact('dishes', 'tables','orders', 'status'));
    }

    public function submit(Request $request)
    {
        $data = array_filter($request->except('_token', 'table'));
        $orderid = "#" . rand(0, 10000);

        foreach($data as $key => $val) {
            if ($val > 1) {
                for($i = 0; $i < $val ; $i++) {
                    $this->saveOrder($orderid, $key, $request);
                }
            }else {
                $this->saveOrder($orderid, $key, $request);
            }
        }

        return back()->with('order-success', "Order Submitted");
    }

    public function saveOrder($orderid, $dish_id, $request)
    {
        $order = new Order();
        $order->order_id = $orderid;
        $order->dish_id = $dish_id;
        $order->table_id = $request->table;
        $order->status = config('res.order_status.New-Order');

        $order->save();
    }

    public function serve(Order $order) 
    {
        $order->status = config('res.order_status.Done');
        $order->save();

        return redirect('/')->with('order-success', 'Order Serve to customer');
    }

    public function search(Request $request)
    {
        $searchdish  = Dish::query()->where('name', 'LIKE', "%{$request->searchkey}%")->get();
        $tables = Table::get();

        $rawstatus = config('res.order_status');
        $status = array_flip($rawstatus);
        $orders = Order::get()->filter(function ($val) {
            return $val->status == 4;
        });
        return view('order_form', compact('searchdish', 'tables','orders', 'status'));
    }
}
