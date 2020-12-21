<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\DishStoreRequest;
use App\Http\Requests\DishUpdateRequest;

class DishesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dishes = Dish::all();
        return view('Kitchen.dish', compact('dishes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('Kitchen.dish_create', compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DishStoreRequest $request)
    {
        $dish = new Dish();
        $dish->name = $request->name;
        $dish->category_id = $request->category_id;

        $imageName = date('YmdHis'). "." . $request->dish_image->getClientOriginalExtension();
        $request->dish_image->move(public_path('images'), $imageName);

        $dish->image = $imageName;
        $dish->save();

        return redirect('/dish')->with('message', "Dish Created Successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
        $categories = Category::all();
        return view('Kitchen.dish_edit', compact('dish', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DishUpdateRequest $request, Dish $dish)
    {
       $dish->name = $request->name;
       $dish->category_id = $request->category_id;

       if($request->dish_image) {
            $imageName = date('YmdHis'). "." . $request->dish_image->getClientOriginalExtension();
            $request->dish_image->move(public_path('images'), $imageName);
            $dish->image = $imageName;
       }
       $dish->save();

       return redirect('/dish')->with('message', "Dish Updated Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        $dish->delete();
        return redirect('/dish')->with('message', "Dish Remove Successfully!");
    }

    public function order() 
    {
        $rawstatus = config('res.order_status');
        $status = array_flip($rawstatus);
        $orders = Order::orderBy('created_at', 'desc')->get()->filter(function ($val) {
            return $val->status == 1 || $val->status == 2;
        });

        return view('Kitchen.order', compact('orders', 'status'));
    }
    
    public function approve(Order $order) 
    {
        $order->status = config('res.order_status.Processing');
        $order->save();

        return back()->with('message', 'Order Approve');
    }

    public function cancle(Order $order) 
    {
        $order->status = config('res.order_status.Cancle');
        $order->save();

        return back()->with('message', 'Order Reject');
    }

    public function ready(Order $order) 
    {
        $order->status = config('res.order_status.Ready');
        $order->save();

        return back()->with('message', 'Order Ready');
    }
}
