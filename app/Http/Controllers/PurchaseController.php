<?php
	namespace App\Http\Controllers;

	use Illuminate\Notifications\Notifiable;
	use Illuminate\Http\Request;

	use App\User;
	use App\Type;
	use App\Bank;
	use App\state;
	use App\Wallet;
	use App\Product;
	use App\PurchaseHistory;
	use App\Notification;

	use App\Notifications\NewRequestPurchase;
	use App\Notifications\NewPurchaseAccepted;
	use App\Notifications\NewPurchaseRejected;



	class PurchaseController extends Controller
	{
		//
	    public function purchaseRequest(Request $request)
	    {
	    	//
	    	$purchase = PurchaseHistory::create([
	    		'product_id' => $request->input('product_id'),
	    		'product_name' => $request->input('product_name'),
	    		'buyer_user' => $request->input('user_id'),
	    		'admin' => $request->input('admin'),
	    		'state' => 5,
	    	]);
	    	$user = User::where('id', $request->input('admin'))->first();
	        $user->notify(new NewRequestPurchase($purchase));
	        return redirect('https://palmera.marketing/tokens/home#anchorPoint')->with('success','requestSS');
	    }
	    //
	    public function purchaseAccepted(Request $request)
	    {
	    	//
	    	$wallet = $request->input('wallet');
	    	$bank = $request->input('bank');
	    	$notification = $request->input('notification');
	    	$product = $request->input('product');
	    	$admin = $request->input('admin');
	    	$user = $request->input('user');
	    	$price = $request->input('price');

        	$debt =  Wallet::where('id_user', $user)->first();
        	$credit = Bank::where('name', 'Presidencia')->first();

        	$debt->amount = $wallet - $price;
        	$credit->amount = ($bank + $price);

        	$debt->save();
        	$credit->save();
        	Product::destroy($product);
	    	$purchaseAccepted = Notification::destroy($notification); 
	    	$user = User::where('id', $user)->first();
	    	$user->notify(new NewPurchaseAccepted($purchaseAccepted));
	    	return \Redirect::back()->with('success','requestA');
	    }
	    //
	    public function purchaseRejected(Request $request)
	    {
	    	$purchaseRejected = Notification::destroy($request->input('notification'));

	    	$user = User::where('id', $request->input('user'))->first();
	    	$user->notify(new NewPurchaseRejected($purchaseRejected));
	    	return \Redirect::back()->with('danger','requestR');
	    }
	    public function show($id)
	    {
	        //
	        // $product = Product::where('id', $id)->first();
            return view('products.purchasePage');
	    }
	}