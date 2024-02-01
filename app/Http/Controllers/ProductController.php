<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        return view('products.index', ['products' => Product::latest()->paginate(5)]); //latest shows the recently added product first then others accordingly
    }

    public function create(){
        return view('products.create');
    }

    public function store(Request $request){
        //Validation
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg,gif|max:10000'
        ]);

        //Upload details
        $imageName = time().' . '.$request->image->extension();
        $request->image->move(public_path('products'), $imageName);

        $product= new Product;
        $product->image = $imageName;
        $product->name = $request->name;
        $product->description = $request->description;

        $product->save();
        return back()->withSuccess('Producted Added !!!!!');
    }

    //edit
    public function edit($id){
        $product = Product::where('id',$id)->first();

        return view('products.edit',['product' => $product]);
    }

    //update
    public function update(Request $request, $id){
        //Validation
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:png,jpg,jpeg,gif|max:10000'
        ]);

        //fetch the product to be updated
        $product = Product::where('id',$id)->first();

        if(isset($request->image)){
            //upload image
            $imageName = time().' . '.$request->image->extension();
            $request->image->move(public_path('products'), $imageName);
            $product->image = $imageName; 
        }

        $product->name = $request->name;
        $product->description = $request->description;

        $product->save();
        return back()->withSuccess('Producted Updated !!!!!');
    }

    //delete
    public function destroy($id){
        $product = Product::where('id',$id)->first();
        $product->delete();
        return back()->withSuccess('Producted Deleted !!!!!');
    }

    //show
    public function show($id){
        $product = Product::where('id',$id)->first();
        return view('products.show', ['product' => $product]);
    }
}
