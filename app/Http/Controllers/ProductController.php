<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller

{

    public function index()

    {
        // $items = TravelPackage::all();
        $products = Product::latest()->paginate(10);

        return view('pages.admin.product.index', compact('products'));

    }

    public function create()
    {
        return view('pages.admin.product.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required',
            'quantity'     => 'required',
            'description'   => 'required',
            'price'   => 'required',
            'image'     => 'required|image|mimes:png,jpg,jpeg',
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/products', $image->hashName());

        $product = Product::create([
            'name'     => $request->name,
            'quantity'   => $request->quantity,
            'description'   => $request->description,
            'price'   => $request->price,
            'image'     => $image->hashName(),
        ]);

        if($product){
            //redirect dengan pesan sukses
            return redirect()->route('product.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('product.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }



    public function show()

    {
        

    }

  

    /**

     * Write code on Method

     *

     * @return response()

     */

    public function cart()

    {

        return view('cart');

    }

  

    /**

     * Write code on Method

     *

     * @return response()

     */

    public function addToCart($id)

    {

        $product = Product::findOrFail($id);

          

        $cart = session()->get('cart', []);

  

        if(isset($cart[$id])) {

            $cart[$id]['quantity']++;

        } else {

            $cart[$id] = [

                "name" => $product->name,

                "quantity" => 1,

                "price" => $product->price,

                "image" => $product->image

            ];

        }

          

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');

    }

  

    /**

     * Write code on Method

     *

     * @return response()

     */

    public function update(Request $request)

    {

        if($request->id && $request->quantity){

            $cart = session()->get('cart');

            $cart[$request->id]["quantity"] = $request->quantity;

            session()->put('cart', $cart);

            session()->flash('success', 'Cart updated successfully');

        }

    }

  

    /**

     * Write code on Method

     *

     * @return response()

     */

    public function remove(Request $request)

    {

        if($request->id) {

            $cart = session()->get('cart');

            if(isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);

            }

            session()->flash('success', 'Product removed successfully');

        }

    }

}