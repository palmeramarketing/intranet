<?php

namespace App\Http\Controllers;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Storage;
use App\Notifications\NewProductAdded;
use App\User;

class ProductsController extends Controller
{
    public function index()
    {   $users = USer::get();
        $products = Product::orderBy('id', 'DESC')->paginate(15);
        return view('products.products', compact('products', 'users'));
    }
    public function indexHome()
    {
        //
        $products = Product::orderBy('id', 'DESC')->paginate(20);
        return view('home.home', compact('products'));
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required', 'description' => 'required', 'price' => 'required', 'img' => 'required']);
        $img = $request->file('img');
        $img_name = $img->getClientOriginalName();
        $img->move('uploads', $img_name);
        $product = Product::create([
            'name'=>$request->input('name'),
            'description'=>$request->input('description'),
            'price'=>$request->input('price'),
            'admin'=> $request->input('admin'),
            'img'=> $img_name,
        ]);
        $users = User::all();
        foreach ($users as $user) {
            $user->notify(new NewProductAdded($product));
        }
        return \Redirect::back()->with('success','productCS');
    }
    public function show($id)
    {
        //
        $product = Product::where('id', $id)->first();
        return view('products.productPage', compact('product'));
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, ['name' => 'required', 'description' => 'required', 'price' => 'required',]);
        $imgC = $request->input('img');
        $img = $request->file('img');
        if (is_null($img))
        {
             Product::find($id)->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'admin'=> $request->input('admin'),
                'price' => $request->input('price'),
    
            ]);   
        }
        else
        {
            $img = $request->file('img');
            $img_name = $img->getClientOriginalName();
            $img->move('uploads', $img_name);
            Product::find($id)->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'admin'=> $request->input('admin'),
                'price' => $request->input('price'),
                'img' => $img_name,
            ]);
        }   
               
        
        return redirect('https://palmera.marketing/tokens/products#anchorPoint')->with('success','productUpS');
    }
    public function destroy($id)
    {
        Product::find($id)->delete();
        return redirect('https://palmera.marketing/tokens/products#anchorPoint')->with('danger','productDelS');
    }
}
