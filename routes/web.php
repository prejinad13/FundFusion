<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('index');

Auth::routes(['verify'=>true]);

Route::get('kyc-error',function(){
    return view('new-dashboard.kyc_verify');
})->name('kyc_error')->middleware(['auth','verified']);

Route::get('dashboard/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth','verified'])->group(function () {
    Route::get('dashboard/profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});

Route::group(['prefix'=>'dashboard/','namespace'=>'App\Http\Controllers\Dashboard\\', 'as'=>'dashboard.','middleware'=>['auth','verified']],function(){
    Route::get('users/verified','UserController@verifiedUser')->name('users.verified');
    Route::get('users/unverified','UserController@unverifiedUser')->name('users.unverified');
    Route::get('my-profile','UserController@kycDetail')->name('users.myProfile');
    Route::get('profile/interests','UserController@interest')->name('users.interest');
    Route::resource('users','UserController');
    Route::resource('sectors','SectorController');
    Route::post('ideas/status-update/{id}','IdeaController@changeStatus')->name('ideas.changeStatus');
    Route::resource('ideas','IdeaController');
    Route::get('investors','InvestmentController@investorList')->name('investment.investors');
    Route::get('investor/profile/{id}','InvestmentController@investorProfile')->name('investment.investor.profile');
    Route::get('investees','InvestmentController@investeeList')->name('investment.investees');
    Route::get('investee/profile/{id}','InvestmentController@investeeProfile')->name('investment.investee.profile');
    Route::get('investment-opportunities','InvestmentController@investmentOpportunities')->name('investment.investOpportunities');
    Route::get('investment-opportunities/{idea}','InvestmentController@investmentOpportunitySingle')->name('investment.investOpportunitySingle');
});
