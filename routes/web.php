<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
|
*/


// ADMIN
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

// User Settings API
Route::put('account-update', 'UserSettingsController@updateAccount');
Route::put('update_plan/{id}', 'UserSettingsController@updateSubscription');
Route::post('/del-notification/{id}', 'UserSettingsController@delNotification');
Route::post('/cancel-subscription', 'UserSettingsController@cancelSubscription');
Route::post('/resume-subscription', 'UserSettingsController@resumeSubscription');
Route::post('/update-payment-details', 'UserSettingsController@updatePaymentDetails');

Route::get('/subscription_log', 'SettingsAPIController@SubscriptionLog');
Route::get('/user', 'SettingsAPIController@user');
Route::get('/invoices', 'SettingsAPIController@invoices');
Route::get('/all-tips', 'SettingsAPIController@tips');
Route::get('/all-inplay-tips', 'SettingsAPIController@inplayTips');

// Entrance
Route::get('/settings/{setting?}', 'UsersController@userSettings')->where('setting', '[\/\w\.-]*');


// AUTHENTICATION ROUTES
Auth::routes();

// PUBLIC SITE ROUTES
Route::get('/', 'PublicController@index')->name('home');
Route::get('/pre-match-tips', 'PublicController@preMatchTips')->name('pre-match-tips');
Route::get('/inplay-tips', 'PublicController@inplayTips')->name('inplay-tips');
Route::get('/specials', 'PublicController@specials')->name('specials');


// SUPPORT
Route::get('/help', 'SupportController@help');
Route::get('/contact', 'SupportController@contact');

Route::post('/contact', 'SupportController@contact');

Route::get('help/what-is-hengft', 'SupportController@whatIsHengft');
Route::get('help/hengft-free-trial', 'SupportController@aboutFreeTrial');
Route::get('help/cannot-see-pre-match-tips', 'SupportController@preMatchTipsNotVisible');
Route::get('help/cannot-see-inplay-tips', 'SupportController@inplayTipsNotVisible');
Route::get('help/account-restricted', 'SupportController@accountRestricted');
Route::get('help/not-receiving-hengft-emails', 'SupportController@notReceivingHengFTEmails');
Route::get('help/account-cancelled', 'SupportController@accountCancelled');


// LEGAL
Route::get('terms', 'LegalController@terms');
Route::get('privacy', 'LegalController@privacy');



// Stripe / Payments Handling
/** 
 *  A default Laravel controller for handling all incoming Stripe webhook requests
 *  cancelling subscriptions with too many failed charges
 *  customer updates
 *  customer deletions
 *  subscription updates
 *  credit card changes
 * 
 */
Route::post(
    'stripe/webhook',
    '\Laravel\Cashier\Http\Controllers\WebhookController@handleWebhook'
);
// A custom controller for handling extra incoming Stripe webhook requests (JC,30/07/2019)
Route::post(
    'stripe/webhook',
    '\App\Http\Controllers\WebhookController@handleWebhook'
);