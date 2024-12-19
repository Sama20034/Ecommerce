<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use App\Models\product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Customauth;


class FirstController extends Controller
{

  public function MainPage()
  {

    if (Auth::user())
    session::put('usernamr',auth()->user()->name);



    $result = category::all();

    return view('welcome', ['categories' => $result]);
  }

 


  public function GetCategoryProducts($catid = null)
  {
    if ($catid) {
      $products = product::where('category_id', $catid)->paginate(9);
      return view('product', ['products' => $products]);

    } else {
      $products = product::paginate(9);
      return view('product', ['products' => $products]);
    }
    //  if($catid) {
    //    $result = product::where('category_id', $catid)->get();
    //   return view('product',['products'=>$result]);



    // } else {  
    //     $result = product::all();
    //  return view('product',['products'=>$result]);
    //   

    //  }
  }
  function GetAllCategorywithProducts()
  {
    $categories = category::all();
    $products = product::all();
    return view('category', ['products' => $products, 'categories' => $categories]);
  }

  public function Search(Request $request)
  {
   
    $products = product::where('name', 'like', '%' .$request->searchkey. '%')->paginate(9);
    return view('product', ['products' => $products]);
  }



}
