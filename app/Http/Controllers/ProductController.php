<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use App\Models\product;
use App\Models\productphoto;
use App\Models\user;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
class ProductController extends Controller
{
    public function AddProduct()
    {

       
        $allcategories = category::all();
        return view('product.addproduct', ['allcategories' => $allcategories]);
    }

    
    public function ProductsTable()
    {
        $products = product::all();
        return view('product.ProductsTable', ['products' => $products]);

    }

    public function AddImages($productid)
    {
        $product = product::find($productid);

        $productImages =productphoto::where('product_id',$productid)->get();
        return view('product.AddImages', ['product' => $product ,'productImages' =>$productImages]);

    }

    public function productima($productid)
    {

        $product = product::with('Category','productphoto')->find($productid);

        $relatedima = product::where('category_id',$product->category_id)->where('id','!=',$productid)
        ->inRandomOrder()
        ->limit(3)
        ->get();
        
        return view('/productima', ['product'=>$product,'relatedima'=>$relatedima]);
    }

    

    public function removeproductimage($imageid = null)
    {
        if ($imageid) {
            $photo = productphoto::find($imageid);
            $photo->delete();
            return redirect('/ProductsTable');
        } else {
            abort(403);


        }
    }


    public function EditProducts($productid = null)
    {
        if ($productid != null) {
            $currentproduct = product::find($productid);
            if ($currentproduct == null) {
                abort("403", "can t find product");
            }
            $allcategories = category::all();

            return view('product.editproduct', ["product" => $currentproduct, 'allcategories' => $allcategories]);

        } else {
            return redirect('/addproduct');

        }
    }
    public function RemoveProducts($productid = null)
    {
        if ($productid) {
            $currentproduct = product::find($productid);
            $currentproduct->delete();
            return redirect('/product');
        } else {
            abort(403);


        }
    }
    public function StoreProduct(Request $request)
    {
        
        $validatedData = $request->validate([
            'name' => ['required', 'max:100'],
            'price' => 'required',
            'quantity' => 'required',
            'description' => 'required',
            'imagepath' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id'



        ]);
       




        if ($request->id) {
            $currentproduct = Product::find($request->id);
            $currentproduct->name = $request['name'];
            $currentproduct->price = $request['price'];
            $currentproduct->quantity = $request['quantity'];
            $currentproduct->description = $request['description'];
            $currentproduct->category_id = $request['category_id'];

            if($request->has('imagepath')){

            $image= $request-> imagepath -> move('images',
            str::uuid()->tostring(). '.' . $request->imagepath->getClientOriginalName());
    
    
            $currentproduct->imagepath = $image;
            }
       
            $currentproduct->save();
            return redirect('/');

        } else {





            $newproduct = new product();
            $newproduct->name = $validatedData['name'];
            $newproduct->price = $validatedData['price'];
            $newproduct->quantity = $validatedData['quantity'];
            $newproduct->description = $validatedData['description'];
            $newproduct->category_id = $validatedData['category_id'];
         
            $image = '';
            if($request -> has('imagepath')){
            $image= $request-> imagepath -> move('images',
            str::uuid()->tostring(). '.' . $request->imagepath->getClientOriginalName());
            }
    
            $newproduct->imagepath = $image;
            $newproduct->save();


            return redirect('/');

       // Get the authenticated user

        }

    }

    public function storeproductimage(Request $request)
    {
        
        $validatedDatai =  $request->validate([
            'imagepath' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'product_id' => 'required'
            //|exists:categories,id


        ]);
       




       
            $currentproducti = new productphoto();
            $currentproducti->product_id = $validatedDatai['product_id'];
            $image = '';
            if($request -> has('imagepath')){
            $image= $request-> imagepath -> move('images',
            str::uuid()->tostring(). '.' . $request->imagepath->getClientOriginalName());
            }
    
            $currentproducti->imagepath = $image;
            $currentproducti->save();
            return redirect('/ProductsTable');

        

    }

}
