<?php

namespace App\Http\Controllers;

use  App\Models\Cart;
use App\Models\Order;
use  App\Models\product;
use App\Models\orderdetails;
use Illuminate\Http\Request;

class cartController extends Controller
{
    public function cart()
    {
        $user_id = auth()->user()->id;
        $cartProducts = Cart::with('product')->where('user_id', $user_id)->get();

        $totalPrice = 0;

    foreach ($cartProducts as $item) {
        $totalPrice += $item->quantity * $item->product->price;
    }

        return view('product.cart', [
            'cartProducts' => $cartProducts,
            'totalPrice' => $totalPrice, // Ensure $totalPrice is passed to the view
        ]);
    }

    public function completeorder()
    {
        $user_id = auth()->user()->id;
        $cartProducts = Cart::with('product')->where('user_id', $user_id)->get();

        $totalPrice = 0;

    foreach ($cartProducts as $item) {
        $totalPrice += $item->quantity * $item->product->price;
    }

        return view('product.completeorder', [
            'cartProducts' => $cartProducts,
            'totalPrice' => $totalPrice, // Ensure $totalPrice is passed to the view
        ]);
    }

    public function Previouseorder()
    {
        $user_id = auth()->user()->id;
       $result=Order::with('orderdetails')->where('user_id',$user_id)->get();

       
        return view('product.Previouseorder',['order'=>$result]);
    }

    
    
    public function StoreOrder(Request $request)
    {
        $user_id = auth()->user()->id;
        $neworder = new Order();
        $neworder->name = $request->name;
        $neworder->email = $request->email;
        $neworder->address = $request->address;
        $neworder->phone = $request->phone;
        $neworder->note = $request->note;
        $neworder->user_id =$user_id;
        $neworder->save();

       
        $cartProducts = Cart::with('product')->where('user_id', $user_id)->get();

        $totalPrice = 0;

    foreach ($cartProducts as $item) {
        $totalPrice += $item->quantity * $item->product->price;

        $neworderdatail =new  orderdetails();
        $neworderdatail->product_id=$item->prodcut_id;
        $neworderdatail->price=$item->product->price;
        $neworderdatail->quantity=$item->quantity;
        $neworderdatail->order_id=$neworder->id;
        $neworderdatail->save();

    }


    Cart::where('user_id',$user_id)->delete();
        return redirect('/');
    }
    
    

    public function ordersa()
    {
        $cartProducts = Cart::with('product')->get();

    
        return view('product.cart', [
            'cartProducts' => $cartProducts,
             // Ensure $totalPrice is passed to the view
        ]);
    }
   

    public function RemoveCart($id = null)
    {
        if ($id) {
            $currentproduct = Cart::find($id);
            $currentproduct->delete();
            return redirect('/cart');
        } else {
            abort(403);


        }
    }

 
}
