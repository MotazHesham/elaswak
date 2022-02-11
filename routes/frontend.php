<?php



Route::group(['as' => 'frontend.', 'namespace' => 'Frontend'], function () {

    Route::get('/', 'HomeController@index')->name('home');
    
    // Register
    Route::group(['prefix' => 'register', 'as' => 'register.'], function () {
        Route::get('supplier', 'HomeController@form_supplier')->name('supplier'); 
        Route::post('supplier', 'HomeController@register_supplier')->name('supplier');

        Route::get('delegate', 'HomeController@form_delegate')->name('delegate'); 
        Route::post('delegate', 'HomeController@register_delegate')->name('delegate');

        Route::get('client', 'HomeController@form_client')->name('client'); 
        Route::post('client', 'HomeController@register_client')->name('client');

    });


    // Products 
    Route::get('products','ProductsController@products')->name("products");
    Route::get('product/{id}','ProductsController@details')->name("product");

    // Offers 
    Route::get('offers','OffersController@offers')->name("offers");
    Route::get('offer/{id}','OffersController@details')->name("offer");
    
    Route::group(['middleware' => 'auth'], function () {

        // Carts
        Route::get('carts', 'CartsController@index')->name('carts.index'); 
        Route::post('carts/store', 'CartsController@store')->name('carts.store'); 
        Route::post('carts/update', 'CartsController@update')->name('carts.update'); 
        Route::post('carts/delete', 'CartsController@delete')->name('carts.delete'); 

        // payment
        Route::any('payment/confirm', 'PaymentController@payment')->name('payment.confirm'); 
        Route::get('payment/info', 'PaymentController@index')->name('payment.index'); 

        // Orders
        Route::resource('orders', 'OrdersController'); 

        // favorites
        Route::post('favorites/ajax','FavoritesController@ajax')->name('favorites.ajax');
        Route::get('favorites','FavoritesController@index')->name('favorites.index');

        // profile
        Route::get('profile','ProfileController@profile')->name('profile');
        Route::post('profile/update','ProfileController@profile_update')->name('profile.update');
        Route::post('profile/update_password','ProfileController@update_password')->name('profile.update_password');
    });

});