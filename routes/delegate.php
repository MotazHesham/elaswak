<?php 

Route::group(['prefix' => 'delegate', 'as' => 'delegate.', 'namespace' => 'Delegate', 'middleware' => ['auth','delegate','approved_by_admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');  

    // Orders
    Route::delete('orders/destroy', 'OrdersController@massDestroy')->name('orders.massDestroy');
    Route::post('orders/details', 'OrdersController@details')->name('orders.details');
    Route::resource('orders', 'OrdersController'); 

    // Money Request
    Route::delete('money-requests/destroy', 'MoneyRequestController@massDestroy')->name('money-requests.massDestroy');
    Route::resource('money-requests', 'MoneyRequestController');

    // Targets
    Route::delete('targets/destroy', 'TargetsController@massDestroy')->name('targets.massDestroy');
    Route::resource('targets', 'TargetsController');
    
    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
