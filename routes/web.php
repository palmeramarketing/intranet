<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\EvaluationHistory;
use App\Question;
use App\Icons;
//
// Home Route
//
Route::get('/home', 'ProductsController@indexHome')->name('home')->middleware('auth');
//
// Login Route
//
Route::get('/PruebaEstructuraEvaluacion', 'EvaluationController@create');
//
//
//
Route::get('/', function () {
	$_session_c = session()->get('lang');
	if(isset($_session_c))
	{

	}
	else
	{
		$_lang_put = App::getLocale(); 
		session()->put('lang', 'es');
	}
	return view('auth.login');
})->name('login');
//
// Administrator Route
//
Route::get('/administrator', function ()
{
	// $users = User::get();
	$icons = Icons::get();      
	$evaluations_historys = EvaluationHistory::orderBy('id', 'DESC')->paginate(12);	
	$questions = Question::orderBy('id', 'DESC')->paginate(6);
	return view('administrator.administrator', compact('icons', 'questions', 'evaluations_historys'));
})->name('administrator')->middleware('auth'); 
//
//
//
Route::get('question', function()
{
	//
	$icons = Icons::get();
	$questions = Question::orderBy('id', 'DESC')->paginate(6);
	return view('questions.questions', compact('icons', 'questions'));
})->name('questions');
//
// Bank Routes
//
Route::get('department', 'DepartmentController@index')->name('bank')->middleware('auth');
Route::post('/bankCreate', 'DepartmentController@store')->name('bankCreate')->middleware('auth');
Route::resource('bankUpdate', 'BankController');
Route::post('BankAndDep/{id}', 'DepartmentController@update')->name('BankAndDepUpdate');
Route::get('BankAndDepDel/{id}', 'DepartmentController@destroy')->name('BankAndDepDel');

//
// Purchase Routes
//
Route::post('purchaseRequest', 'PurchaseController@purchaseRequest')->name('purchaseRequest');
Route::post('purchaseAccepted', 'PurchaseController@purchaseAccepted')->name('purchaseAccepted');
Route::post('purchaseRejected', 'PurchaseController@purchaseRejected')->name('purchaseRejected');
//
// Products Routes
//
Route::get('/products', 'ProductsController@index')->name('products')->middleware('auth');
Route::resource('product', 'ProductsController');
//
// External Views
//
Route::get('productInfo/{id}', 'ProductsController@show')->name('productInfo')->middleware('auth');
Route::get('purchaseResponse/{id}', 'PurchaseController@show')->name('purchaseResponse')->middleware('auth');
Route::get('userRegistered/{id}', 'UserController@show')->name('userRegistered')->middleware('auth');
Route::get('rewardRequest/{id}', 'WalletController@show')->name('rewardRequest')->middleware('auth');
//
// User Routes
//
Route::resource('user', 'UserController');
Route::get('password', function ()
{
	return view('users.changePassword');
})->name('changePassword')->middleware('auth');
Route::post('changePassword/{id}', 'UserController@password')->name('CP')->middleware('auth');
Route::get('passwordReset/{id}', 'UserController@passwordReset')->name('passwordReset')->middleware('auth');
Route::post('imgChange', 'UserController@imgUpdate')->name('imgUpdate');
//
// Notifications MaskAsRead Routes
//
Route::get('maskAsRead', function ()
{
	$user = Auth::user();
	$user->unreadNotifications->markAsRead();
	return \Redirect::back()->with('success', 'notMAsR');
})->name('maskAsRead');
//
// Notifications Delete Routes
//
Route::get('deleteNotifications', function ()
{
	Auth::user()->notifications()->delete();
	return \Redirect::back()->with('danger', 'notDel');
})->name('deleteNotifications');
//
// Reward Routes
//
// Route::get('/reward', function () {
//	return view('reward.reward');
//})->name('reward'); //Debe protegerse
//
// Wallet Route
//
Route::get('/wallet', 'OperationsHistoryController@index')->name('wallet')->middleware('auth');
Route::get('/reward', 'RewardHistoryController@index')->name('reward');
//
// Pay Routes
//
Route::post('pay', 'WalletController@pay')->name('pay')->middleware('auth');
Route::post('payReward', 'WalletController@payReward')->name('payReward');
Route::post('requestReward', 'WalletController@rewardRequest')->name('requestReward');
Route::post('rejectReward', 'WalletController@rejectReward')->name('rejectAccepted');
//
// Change Lang Route
//
Route::get('lang/{lang}', function ($lang)
{
	\Session::put('lang', $lang);
	return \Redirect::back();
})->middleware('web')->name('change_lang');
//
// Groups Routes
//
Route::get('/groups', 'GroupsController@index')->name('groups');
Route::post('/groupCreate', 'GroupsController@store')->name('groupCreate');
Route::get('groupsDel/{id}', 'GroupsController@destroy')->name('groupsDel');
Route::post('groupUpdate/{id}', 'GroupsController@update')->name('groupUpdate');
//
//	Evaluations Routes
//
Route::get('/evaluate', 'EvaluationController@index')->name('evaluate');
Route::post('/evaluation', 'EvaluationController@store')->name('evaluation');
Route::get('createEvaluation', 'EvaluationController@create')->name('createEvaluation');
Route::get('destroyEvaluation', 'EvaluationController@destroy')->name('destroyEvaluation');
//
// Profil admin Routes
//
Route::get('account', 'ProfileController@index')->name('profile');
//
//	Statistics Routes
//
Route::get('/statistics', 'StatisticsController@index')->name('statistics');
//
//	Inventory Route
//
Route::resource('inventory', 'DeviceController');
//
//
//
Route::get('carousel', function()
{
	return view('slider.slider');
})->name('carousel');
//
//
//
Route::post('question', 'QuestionsController@store')->name('question');
//
//
//
Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');