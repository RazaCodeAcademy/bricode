<?php

use App\Http\Controllers\Auth\ForgotPasswordController;

Route::get('/clear', function(){
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    return 'all cache has been removed and reset appliation succussfuly!';
});


/////////////////////// Frontend ////////////////////////

/////////////////////////////////////////////////////////

Route::get('/', 'Auth\LoginController@login')->name('login');
Route::post('/user-login', 'Frontend\UserController@loginuser')->name('user.login');
Route::get('/user/profile/{id}', 'Frontend\UserController@profile')->name('user-profile');
Route::get('/register', 'Frontend\UserController@create')->name('user.register.form');
Route::post('/register', 'Frontend\UserController@store')->name('user.register');
Route::get('login/{provider}', 'Frontend\SocialController@redirectToProvider');
Route::get('{provider}/callback', 'Frontend\SocialController@handleProviderCallback');
Route::get('logout','Frontend\UserController@logout')->name('user.logout');
// forget password routes
Route::get('forget-password', [ForgotPasswordController::class, 'ForgetPassword'])->name('ForgetPasswordGet');
Route::post('forget-password', [ForgotPasswordController::class, 'ForgetPasswordStore'])->name('ForgetPasswordPost');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'ResetPassword'])->name('ResetPasswordGet');
Route::post('reset-password', [ForgotPasswordController::class, 'ResetPasswordStore'])->name('ResetPasswordPost');

Route::get('/search-sponser', 'Frontend\IndexController@index')->name('sponser_search');
Route::middleware(['customer'])->prefix('user')->namespace('Frontend')->group(function () {
    Route::resource('transaction', 'TransactionController');
    Route::resource('feedback', 'FeedbackController');
    Route::resource('withdraw', 'WithdrawController');
    Route::resource('referal', 'ReferalController');
    Route::resource('wallet', 'WalletController');
    Route::resource('membership', 'MembershipController');
    Route::resource('search', 'SearchController');
    Route::get('earning-history', 'EarningController@index')->name('earning.history.index');
    Route::get('user_search', 'SearchController@search')->name('search_sponser');
    Route::get('/account_update', 'MembershipController@account_type')->name('userAccountupdate');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::match(['get','post'],'update-employee-details-page','DashboardController@updateEmployeeDetailsPage')->name('update-employee-details-page');

    // users routes
    Route::get('edit/profile', 'UserController@edit')->name('user.edit.profile');
    Route::post('update/general-information', 'UserController@general_information')->name('user.general-information');
    Route::post('update/change-password', 'UserController@change_password')->name('user.change-password');
});

/////////////////////// Admin //////////////////////

/////////////////////////////////////////////////////////

Route::prefix('admin')->namespace('Backend')->group(function (){

    Route::middleware(['admin'])->group(function () {

        Route::resource('manage-feedback', 'FeedbackController');
        Route::resource('manage-account-types', 'AccountTypeController');
        Route::resource('manage-payment-methods', 'PaymentMethodController');
        Route::resource('manage-withdraw', 'WithdrawController');

        Route::resource('manage-transaction', 'TransactionController');
        Route::resource('manage-request', 'RequestController');
        Route::get('/manage-withdraw_status/{id}', 'WithdrawController@status')->name('manage_withdraw_status');
        Route::get('dashboard', 'DashboardController@dashboard')->name('admin.dashboard');
        Route::post('filterCountry', 'DashboardController@filterCountry')->name('filterCountryDashboard');
        Route::post('profile-update', 'AuthController@adminUpdateProfile')->name('adminUpdateProfile');

        // users routes
        Route::get('manage-users/edit/profile', 'UserController@edit')->name('admin.manage-users.edit');
        Route::post('manage-users/update/general-information', 'UserController@general_information')->name('admin.manage-users.general-information');
        Route::post('manage-users/update/change-password', 'UserController@change_password')->name('admin.manage-users.change-password');

        Route::group(['prefix' => 'manage-users'], function () {
            Route::get('/', 'UserController@listAdmins')->name('listAdmins');
            Route::get('/account_type/{id}', 'UserController@account_type')->name('userAccounttype');
            Route::get('/sponser/{id}', 'UserController@earn_points')->name('earn_points');
            Route::get('/employers-list', 'UserController@listEmployers')->name('listEmployers');
            Route::get('/create', 'UserController@createUser')->name('createUser');
            Route::post('/store', 'UserController@storeUser')->name('storeUser');
            Route::get('/edit/{id}', 'UserController@editUser')->name('editUser');
            Route::get('/view/{id}', 'UserController@viewUser')->name('viewUser');
            Route::post('/update/{id}', 'UserController@updateUser')->name('updateUser');
            Route::post('/delete', 'UserController@deleteUser')->name('deleteUser');
        });
    });
});
