<?php

use Illuminate\Support\Facades\Route;

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


Route::get('clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
});
Route::get('/clear-caches', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});
Route::get('/404','HomeController@bizonair_404')->name('bizonair-404');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::get('block-subadmin/{id}', 'AdminController@block_subadmin')->name('admin-block-subadmin');
    Route::get('unblock-subadmin/{id}', 'AdminController@unblock_subadmin')->name('admin-unblock-subadmin');

    Route::get('userss', 'Admin\UserController@index')->name('admin-get-users');
});

Route::post('change-password', 'ChangePasswordController@store')->name('change-password');
Route::get('log-in-pre', 'HomeController@log_in_pre')->name('log-in-pre');
Route::get('/forget-password', 'HomeController@getEmail')->name('forgot-password');
Route::post('/forget-password', 'HomeController@postEmail')->name('password');

Route::get('/reset-password/{token}', 'HomeController@getPassword');
Route::post('/reset-password', 'HomeController@updatePassword');

Route::get('logout', function () {
    // $user=\Auth::user();
    // $user->login_time = date('Y-m-d h:i:sa');
    // $user->save();
    session()->forget('company_id');
    \Auth::logout();
    return redirect('/');
})->name('logout');


/////////////////////////Social lite/////////////////////////////////////////
Route::post('socialite-password', 'Socialite\SocialController@savePassword')
    ->name('get-socialite-password');
Route::get('socialite-password', 'Socialite\SocialController@getPassword')
    ->name('get-socialite-password');
Route::get('google', 'Socialite\SocialController@redirectToGoogle')
    ->name('google-sign-up');
Route::get('google/callback', 'Socialite\SocialController@handleGoogleCallback')
    ->name('google-sign-up-callback');

Route::get('linkedin', 'Socialite\SocialController@redirectToLinkedin')
    ->name('linkedin-sign-up');
Route::get('linkedin/callback', 'Socialite\SocialController@handleLinkedinCallback')
    ->name('linkedin-sign-up-callback');

Route::get('facebook', 'Socialite\SocialController@redirectToFacebook')
    ->name('facebook-sign-up');
Route::get('facebook/callback', 'Socialite\SocialController@handleFacebookCallback')
    ->name('facebook-sign-up-callback');

Route::get('accept-token/{token}/{email}', 'CompanyController@acceptToken')
    ->name('accept');
////////////////////////////Social lite end///////////////////////////////////


Route::get('/', 'HomeController@index')->name('home');
Route::get('email-confirmation', 'HomeController@email_confirmation')
    ->name('email-confirmation');
Route::post('get-email-verification-code', 'HomeController@get_email_verification_code')
    ->name('get-email-verification-code');
Route::get('verify-email/{code}', 'HomeController@check_verification_code')
    ->name('verify-email');
Route::post('check-verification-code', 'HomeController@check_verification_code')
    ->name('check-verification-code');
Route::get('registeration-step/1', 'HomeController@registeration_step_1')
    ->name('registeration-step-1');
Route::post('register-user', 'HomeController@register_user')->name('register-user');
Route::get('registeration-step/2', 'CompanyController@registeration_step_2')
    ->name('registeration-step-2');
Route::post('register-member', 'CompanyController@register_member')->name('register-member');
Route::post('do-login', 'HomeController@do_login')
    ->name('user-do-login');
Route::post('do-login-pre', 'HomeController@do_login_pre')
    ->name('user-do-login-pre');
Route::post('company-images', 'CompanyController@companyImages')
    ->name('company-images');
Route::get('imageRemove/{id}', 'CompanyController@imageRemove');


    Route::group(['middleware' => 'User'], function () {
        Route::get('my-account/{id}', 'HomeController@my_account')
            ->name('my-account');
        Route::get('company-profile', 'CompanyController@companyProfile')
            ->name('company-profile');
        Route::post('company-profile-create', 'CompanyController@saveCompany')
            ->name('company-profile-create');
        Route::post('save-my-account', 'HomeController@save_my_account')
            ->name('save-my-account');
        Route::get('dashboard', 'HomeController@dashboard')
            ->name('user-dashboard');
        Route::get('company-form/{id}', 'HomeController@company_form')
            ->name('user-company-form');
        Route::post('get-sub-category', 'HomeController@get_sub_category')
            ->name('get-sub-category');
        Route::post('upload-avatar', 'CompanyController@uploadAvatar')
            ->name('upload-user-avatar');
        Route::get('my-account-detail', 'HomeController@editAccount')
            ->name('my-account-detail');
        Route::put('update-my-account', 'HomeController@updateAccount')
            ->name('update-my-account');


       // Route::resource('buy-sell', 'BuySellController');
        Route::get('buy-sells', 'BuySellController@index')->name('buy-sell.index');
        Route::post('buy-sell', 'BuySellController@store')->name('buy-sell.store');
        Route::get('create/buy-sell', 'BuySellController@create')->name('buy-sell.create');
        Route::get('buy-sell/{buy_sell}', 'BuySellController@show')->name('buy-sell.show');
        Route::put('buy-sell/{buy_sell}', 'BuySellController@update')->name('buy-sell.update');
        Route::delete('buy-sell/{buy_sell}', 'BuySellController@destroy')->name('buy-sell.destroy');
        Route::get('edit/buy-sell/{buy_sell}', 'BuySellController@edit')->name('buy-sell.edit');

        Route::post('/remove-buysell-image', 'BuySellController@remove_buysell_image')->name('remove-buysell-image');
        Route::post('/remove-buysell-sheet', 'BuySellController@remove_buysell_sheet')->name('remove-buysell-sheet');
        Route::post('archive-buysell', 'BuySellController@archive_buysell')->name('archiveBuysell');
        Route::post('restore-buysell', 'BuySellController@restore_buysell')->name('restoreBuysell');
        Route::post('upload-buysell-sheets', 'BuySellController@upload_sheet_buysell')->name('upload-buysell-sheets');
        Route::post('upload-buysell-images', 'BuySellController@upload_image_buysell')->name('upload-buysell-images');
        Route::get('get-subcategories', 'BuySellController@get_subcategories')
            ->name('get-subcategories');

        Route::group(['middleware' => 'Bizoffice'], function () {

            Route::get('my-biz-office', 'CompanyController@my_biz_office')->name('my-biz-office');
            Route::get('my-bizoffices', 'CompanyController@my_bizoffices')->name('my-bizoffices');
            Route::get('change-company/{id}', 'CompanyController@change_company')->name('change-company');
            Route::post('/remove-company', 'CompanyController@remove_company')->name('remove-company');
            Route::get('view-members', 'CompanyController@get_members')->name('view-members');
            Route::group(['middleware' => 'OfficeAdmin'], function () {
            Route::post('invite-member', 'CompanyController@inviteMember')
                ->name('invite-member-via-email');
            Route::get('/members/create-member', 'CompanyController@create')->name('create-member');
            Route::get('/members', 'CompanyController@get_members')->name('get-members');
            //
            Route::get('/bizz-offices', 'CompanyController@my_offices')->name('my-offices');
            //
            Route::post('/remove-user-from-group', 'CompanyController@company_remove_user_from_group')->name('company-remove-user-from-group');
            Route::post('/change-user-member-status', 'CompanyController@change_user_member_status')->name('company-change-user-member-status');
    //
    //            Route::get('/office-code', 'CompanyController@get_office_code')->name('company-office-code');
    //            Route::post('/change-office-code', 'CompanyController@change_office_code')->name('company-change-office-code');

            Route::get('my-company-profile/{id}', 'CompanyController@editCompany')
                ->name('my-company-profile');
            Route::put('update-company-profile', 'CompanyController@updateCompany')
                ->name('update-company-profile');


            Route::get('product-inquiries', 'InquiryController@product_index')->name('product-inquiries');
            Route::post('archive-product-inquiries', 'InquiryController@archive_product_inquiries')->name('archiveProductInquiries');
            Route::post('restore-product-inquiries', 'InquiryController@restore_product_inquiries')->name('restoreProductInquiries');
            Route::delete('inquiry/{inquiry}', 'InquiryController@destroy')->name('inquiry.destroy');


            });
            Route::post('/ajax-company-id-get', 'CompanyController@ajax_company_id_get');
            Route::get('get-sub-categories', 'ProductController@get_sub_categories')
                ->name('get-sub-categories');
            Route::resource('products', 'ProductController');
            Route::post('/remove-product-image', 'ProductController@remove_product_image')->name('remove-product-image');
            Route::post('/remove-product-sheet', 'ProductController@remove_product_sheet')->name('remove-product-sheet');
    //            Route::post('delete-product' , 'ProductController@destroy')->name('deleteProduct');
            Route::post('archive-product', 'ProductController@archive_product')->name('archiveProduct');
            Route::post('restore-product', 'ProductController@restore_product')->name('restoreProduct');
            Route::post('upload-product-sheets', 'ProductController@upload_sheet')
                ->name('upload-product-sheets');
            Route::post('upload-product-images', 'ProductController@upload_image')
                ->name('upload-product-images');

            ///////////////////Chat/////////////////////////////////

            Route::get('/group-chat', 'CompanyController@group_chat')->name('company-group-chat');
            Route::get('/fetch-messages', 'CompanyController@fetch_messages')->name('company-fetch-message');
            Route::post('/send-message', 'CompanyController@send_message')->name('company-send-message');
            Route::post('/get-user', 'CompanyController@get_user')->name('company-get-user');
            Route::get('chat/download-attachment', 'CompanyController@download_message_attachment')->name('company-chat-file-download');


            Route::get('/create-meeting', 'CompanyController@create_meeting')->name('company-create-meeting');
            Route::get('/meetings', 'CompanyController@get_meetings')->name('company-get-meetings');
            Route::post('save-meeting', 'CompanyController@save_meeting')->name('company-save-meeting');

            Route::post('/leave-office', 'CompanyController@leave_office')->name('company-leave-office');
            Route::post('/get-online-members', 'CompanyController@get_company_online_users')->name('get-online-members');
            // Route::get('/group-chat', 'CompanyController@group_chat')->name('company-group-chat');

            // Single Chat start
            Route::get('/single-chat-box', 'ChatController@index')->name('single-chat-box');

            // Single Chat start


        });

        // Jobs Management Routes Start
        Route::get('view-job-management', 'JobManagementController@get_view_job_management')->name('view-job-management');
        Route::get('view-form-job-management', 'JobManagementController@get_view_form_job_management')->name('view-form-job-management');
        Route::post('view-form-job-management/create', 'JobManagementController@store_view_job_management')->name('create-view-job-management');
        Route::get('edit-job-management/{id}', 'JobManagementController@edit_job_management')->name('edit-job-management');
        Route::post('update-view-job-management/update', 'JobManagementController@update_job_management')->name('update-view-job-management');
        Route::post('/remove-job-from-group', 'JobManagementController@company_remove_job_from_group')->name('company-remove-job-from-group');


        Route::get('view-all-cvs', 'JobManagementController@get_view_all_cvs')->name('view-all-cvs');
        Route::get('edit-cv-management/{id}', 'JobManagementController@edit_cv_management')->name('edit-cv-management');
        Route::post('update-view-cv-management/update', 'JobManagementController@update_cv_management')->name('update-view-cv-management');
        Route::get('post-ur-cv', 'JobManagementController@post_ur_cv')->name('post-ur-cv');
        Route::post('upload-cv', 'JobManagementController@store_cv')->name('upload-cv');
        Route::post('/remove-cv', 'JobManagementController@remove_cv')->name('remove-cv');

        // Jobs Management Routes end
        // Favourite Routes start
        Route::get('view-lead-favourites', 'FavouriteController@get_lead_view_favourites')->name('view-lead-favourites');
        Route::get('view-deal-favourites', 'FavouriteController@get_deal_view_favourites')->name('view-deal-favourites');
        Route::post('/remove-favourite-product', 'FavouriteController@remove_favourite_product')->name('remove-favourite-product');
        // Favourite Routes end

        // Blog News Article Events Project Routes start
        Route::get('view-blogs', 'FavouriteController@view_blogs')->name('view-blogs');
        Route::get('view-add-blogs', 'FavouriteController@view_add_blogs')->name('view-form-blog');
        Route::post('blog/create', 'FavouriteController@blog_create_form')->name('create-blog');
        Route::post('/remove-news-articles', 'FavouriteController@remove_news_articles')->name('news-articles-remove');
        Route::get('edit-article-news/{id}', 'FavouriteController@edit_article_news')->name('edit-article-news');
        Route::post('update-news-article/update', 'FavouriteController@update_news_article')->name('update-news-article');
        //Route::post('/remove-favourite-product', 'FavouriteController@remove_favourite_product')->name('remove-favourite-product');
        // Blog News Article Events Project Routes end

        // Inquiries  Routes start
        Route::post('post-inquiry', 'InquiryController@store')->name('post-inquiry');
        Route::get('buysell-inquiries', 'InquiryController@buysell_index')->name('buysell-inquiries');
        Route::get('inquiry-product/{id}', 'InquiryController@edit')->name('inquiry-product.edit');

    //    Route::post('archive-product-inquiries', 'InquiryController@archive_product_inquiries')->name('archiveProductInquiries');
    //    Route::post('restore-product-inquiries', 'InquiryController@restore_product_inquiries')->name('restoreProductInquiries');
    //    Route::delete('inquiry/{inquiry}', 'InquiryController@destroy')->name('inquiry.destroy');

        //taha inquiry chat routes start
        Route::post('get-bizdeal-inquiry-messages','InquiryController@get_bizdeal_inquiry_messages')->name('get-bizdeal-inquiry-messages');
        Route::post('reply-bizdeal-inquiry-convo', 'InquiryController@reply_bizdeal_inquiry_convo')->name('reply-bizdeal-inquiry-convo');
        Route::post('delete-bizdeal-inquiry-convo', 'InquiryController@delete_bizdeal_inquiry_convo')->name('delete-bizdeal-inquiry-convo');

        Route::post('un-favorite-bizdeal-inquiry-convo-multiple', 'InquiryController@un_favorite_bizdeal_inquiry_convo_multiple')->name('un-favorite-bizdeal-inquiry-convo-multiple');
        Route::post('favorite-bizdeal-inquiry-convo-multiple', 'InquiryController@favorite_bizdeal_inquiry_convo_multiple')->name('favorite-bizdeal-inquiry-convo-multiple');
        Route::post('favorite-bizdeal-inquiry-convo', 'InquiryController@favorite_bizdeal_inquiry_convo')->name('favorite-bizdeal-inquiry-convo');


        Route::post('un-pin-bizdeal-inquiry-convo-multiple', 'InquiryController@un_pin_bizdeal_inquiry_convo_multiple')->name('un-pin-bizdeal-inquiry-convo-multiple');
        Route::post('pin-bizdeal-inquiry-convo-multiple', 'InquiryController@pin_bizdeal_inquiry_convo_multiple')->name('pin-bizdeal-inquiry-convo-multiple');
        Route::post('pin-bizdeal-inquiry-convo', 'InquiryController@pin_bizdeal_inquiry_convo')->name('pin-bizdeal-inquiry-convo');


        Route::post('read-bizdeal-inquiry-convo-multiple', 'InquiryController@read_bizdeal_inquiry_convo_multiple')->name('read-bizdeal-inquiry-convo-multiple');
        Route::post('unread-bizdeal-inquiry-convo-multiple', 'InquiryController@unread_bizdeal_inquiry_convo_multiple')->name('unread-bizdeal-inquiry-convo-multiple');

        Route::post('delete-bizdeal-inquiry-convo-multiple', 'InquiryController@delete_bizdeal_inquiry_convo_multiple')->name('delete-bizdeal-inquiry-convo-multiple');

        Route::post('get-inbox-refresh', 'InquiryController@get_inbox_refresh')->name('get-inbox-refresh');
        Route::post('get-sent-box-refresh', 'InquiryController@get_sent_box_refresh')->name('get-sent-box-refresh');
        Route::post('get-delete-refresh', 'InquiryController@get_delete_refresh')->name('get-delete-refresh');

        Route::post('get-filtered-inquires', 'InquiryController@get_filtered_inqueries')->name('get-filter-inqueries');

        Route::post('filter-bizdeal-onetime-inquiry', 'InquiryController@filter_bizdeal_onetime_inquiry')->name('filter-bizdeal-onetime-inquiry');
        //taha inquiry chat routes end

        //lead product inquires added by taha
        Route::get('product-inquiries', 'InquiryController@product_index')->name('product-inquiries');

        Route::post('get-bizLead-inquiry-messages','InquiryController@get_bizLead_inquiry_messages')->name('get-bizLead-inquiry-messages');
        Route::post('reply-bizLead-inquiry-convo', 'InquiryController@reply_bizLead_inquiry_convo')->name('reply-bizLead-inquiry-convo');
        Route::post('delete-bizLead-inquiry-convo', 'InquiryController@delete_bizLead_inquiry_convo')->name('delete-bizLead-inquiry-convo');

        Route::post('un-favorite-bizLead-inquiry-convo-multiple', 'InquiryController@un_favorite_bizLead_inquiry_convo_multiple')->name('un-favorite-bizLead-inquiry-convo-multiple');
        Route::post('favorite-bizLead-inquiry-convo-multiple', 'InquiryController@favorite_bizLead_inquiry_convo_multiple')->name('favorite-bizLead-inquiry-convo-multiple');
        Route::post('favorite-bizLead-inquiry-convo', 'InquiryController@favorite_bizLead_inquiry_convo')->name('favorite-bizLead-inquiry-convo');


        Route::post('un-pin-bizLead-inquiry-convo-multiple', 'InquiryController@un_pin_bizLead_inquiry_convo_multiple')->name('un-pin-bizLead-inquiry-convo-multiple');
        Route::post('pin-bizLead-inquiry-convo-multiple', 'InquiryController@pin_bizLead_inquiry_convo_multiple')->name('pin-bizLead-inquiry-convo-multiple');
        Route::post('pin-bizLead-inquiry-convo', 'InquiryController@pin_bizLead_inquiry_convo')->name('pin-bizLead-inquiry-convo');


        Route::post('read-bizLead-inquiry-convo-multiple', 'InquiryController@read_bizLead_inquiry_convo_multiple')->name('read-bizLead-inquiry-convo-multiple');
        Route::post('unread-bizLead-inquiry-convo-multiple', 'InquiryController@unread_bizLead_inquiry_convo_multiple')->name('unread-bizLead-inquiry-convo-multiple');

        Route::post('delete-bizLead-inquiry-convo-multiple', 'InquiryController@delete_bizLead_inquiry_convo_multiple')->name('delete-bizLead-inquiry-convo-multiple');

        Route::post('get-inbox-refresh-bizLead', 'InquiryController@get_inbox_refresh_bizLead')->name('get-inbox-refresh-bizLead');
        Route::post('get-sent-box-refresh-bizLead', 'InquiryController@get_sent_box_refresh_bizLead')->name('get-sent-box-refresh-bizLead');
        Route::post('get-delete-refresh-bizLead', 'InquiryController@get_delete_refresh_bizLead')->name('get-delete-refresh-bizLead');

        Route::post('get-filtered-inquires-bizLead', 'InquiryController@get_filtered_inqueries_bizLead')->name('get-filter-inqueries-bizLead');

        Route::post('filter-bizLead-onetime-inquiry', 'InquiryController@filter_bizLead_onetime_inquiry')->name('filter-bizLead-onetime-inquiry');

        // Inquiries  Routes end

        Route::post('/favourite-product-ajax', 'FavouriteController@add_to_favourite');
        Route::post('/repost-buysell', 'BuySellController@repost_buysell');

        /// entered by taha for fav product management
        Route::get('/one-time-favs', 'FavouriteController@get_one_time_fav')->name('get-one-time-fav');
        Route::post('get-bizdeal-fav-messages','FavouriteController@get_bizdeal_fav_messages')->name('get-bizdeal-fav-messages');
        Route::post('reply-bizdeal-fav-convo', 'FavouriteController@reply_bizdeal_fav_convo')->name('reply-bizdeal-fav-convo');
        Route::post('delete-bizdeal-fav-convo', 'FavouriteController@delete_bizdeal_fav_convo')->name('delete-bizdeal-fav-convo');

        Route::post('un-favorite-bizdeal-fav-convo-multiple', 'FavouriteController@un_favorite_bizdeal_fav_convo_multiple')->name('un-favorite-bizdeal-fav-convo-multiple');

        Route::post('favorite-bizdeal-fav-convo-multiple', 'FavouriteController@favorite_bizdeal_fav_convo_multiple')->name('favorite-bizdeal-fav-convo-multiple');

        Route::post('favorite-bizdeal-fav-convo', 'FavouriteController@favorite_bizdeal_fav_convo')->name('favorite-bizdeal-fav-convo');


        Route::post('un-pin-bizdeal-fav-convo-multiple', 'FavouriteController@un_pin_bizdeal_fav_convo_multiple')->name('un-pin-bizdeal-fav-convo-multiple');
        Route::post('pin-bizdeal-fav-convo-multiple', 'FavouriteController@pin_bizdeal_fav_convo_multiple')->name('pin-bizdeal-fav-convo-multiple');
        Route::post('pin-bizdeal-fav-convo', 'FavouriteController@pin_bizdeal_fav_convo')->name('pin-bizdeal-fav-convo');


        Route::post('read-bizdeal-fav-convo-multiple', 'FavouriteController@read_bizdeal_fav_convo_multiple')->name('read-bizdeal-fav-convo-multiple');
        Route::post('unread-bizdeal-fav-convo-multiple', 'FavouriteController@unread_bizdeal_fav_convo_multiple')->name('unread-bizdeal-fav-convo-multiple');

        Route::post('delete-bizdeal-fav-convo-multiple', 'FavouriteController@delete_bizdeal_fav_convo_multiple')->name('delete-bizdeal-fav-convo-multiple');

        Route::post('get-inbox-refresh-fav', 'FavouriteController@get_inbox_refresh_fav')->name('get-inbox-refresh-fav');
        Route::post('get-sent-box-refresh-fav', 'FavouriteController@get_sent_box_refresh_fav')->name('get-sent-box-refresh-fav');
        Route::post('get-delete-refresh-fav', 'FavouriteController@get_delete_refresh_fav')->name('get-delete-refresh-fav');

        Route::post('get-filtered-inquires-fav', 'FavouriteController@get_filtered_inqueries_fav')->name('get-filter-inqueries-fav');

        Route::post('filter-bizdeal-onetime-inquiry-fav', 'FavouriteController@filter_bizdeal_onetime_inquiry_fav')
            ->name('filter-bizdeal-onetime-inquiry-fav');

    });

//contact Routes Start
Route::post('/create-contact-us', 'ContactUsController@create_contact_us')->name('create-contact-us');
//contact Routes end

//Career Jobs Routes Start
Route::get('/jobs-directory', 'CareerController@jobs_directory')->name('jobs-directory');
Route::get('/cv-directory', 'CareerController@cv_directory')->name('cv-directory');
Route::get('/jobs-portal', 'CareerController@jobs_portal')->name('jobs-portal');
//Route::post('upload-cv', 'CareerController@store_cv')->name('upload-cv');
Route::post('create-job', 'CareerController@store_job')->name('create-jobs');
Route::get('/jobs-detail/{id}', 'CareerController@jobs_detail')->name('jobs-detail');
Route::get('/cvs-detail/{id}', 'CareerController@cvs_detail')->name('cvc-detail');

//by haidar
Route::get('jobs-directory/jobs-search', 'CareerController@jobSearchFilter')->name('job-search');
Route::get('cv-directory/cvs-search', 'CareerController@cvSearchFilter')->name('cv-search');
//Career Jobs Routes end
//Journal Routes Start
Route::get('/journal', 'JournalController@journal')->name('journal');
Route::get('/privacy', 'JournalController@privacy_policy')->name('privacy-policy');
Route::get('/about-us', 'JournalController@about_us')->name('about-us');
Route::get('/contact-us', 'JournalController@contact')->name('contact-us');
Route::get('/terms-of-use', 'JournalController@terms')->name('terms-of-use');
Route::get('/faq', 'JournalController@faq')->name('faq');
Route::get('/journal/currency-rates', 'JournalController@currency_rates')->name('currency-rates');
Route::get('/journal/cotton-rates', 'JournalController@cotton_rates')->name('cotton-rates');
Route::get('/journal/textile-calculation', 'JournalController@calculation_formula')->name('calculation-formula');
Route::get('/journal/articles', 'JournalController@articles')->name('articles');
Route::get('/journal/events', 'JournalController@events')->name('events');
Route::get('/journal/projects', 'JournalController@projects')->name('projects');
Route::get('/journal/news', 'JournalController@news')->name('news');
Route::get('/journal/news/news-detail/{id}', 'JournalController@news_detail')->name('news-detail');
Route::get('/journal/blogs', 'JournalController@blogs')->name('blogs');
Route::get('/journal/blogs/blog-detail/{id}', 'JournalController@blog_detail')->name('blog-detail');
Route::get('/journal/journal-type/{type}/{id}', 'JournalController@journal_detail')->name('journal-detail');

Route::get('/suppliers-about-us', 'AboutUsController@about_us')->name('suppliers-about-us');
Route::get('/supplier-products', 'AboutUsController@products')->name('supplier-products');
Route::get('/suppliers-services', 'AboutUsController@services')->name('suppliers-services');
Route::get('/suppliers-contact-us', 'AboutUsController@contact_us')->name('suppliers-contact-us');
Route::post('/create-contact-us-user', 'AboutUsController@create_contact_us_user')->name('create-contact-us-user');

Route::get('/{id}/about-us-suppliers', 'ContactUsController@about_us_supplier')->name('about-us-suppliers');
Route::get('/{id}/products-suppliers', 'ContactUsController@products_supplier')->name('products-suppliers');
Route::get('/{id}/services-suppliers', 'ContactUsController@services_supplier')->name('services-suppliers');
Route::get('/{id}/contact-us-suppliers', 'ContactUsController@contact_us_supplier')->name('contact-us-suppliers');
Route::post('/save-contact-us-supplier', 'ContactUsController@save_contact_us_supplier')->name('save-contact-us-supplier');
//Journal Routes end

// Services Routes Start
Route::get('services/{category}', 'ServiceController@service_list_by_category')->name('service-products');
Route::get('services/{category}/{subcategory}/regular-service', 'ServiceController@service_list_by_subcategory_regular_service')->name('subcategory-regular-services');
Route::get('services/{category}/{subcategory}/one-time-service', 'ServiceController@service_list_by_subcategory_one_time_service')->name('subcategory-one-time-services');
Route::get('services/{category}/CompareProducts', 'ServiceController@compareServices')->name('services-compare');
Route::get('services-detail/{category?}/{subcategory?}/{prod_slug?}', 'ServiceController@serviceDetail')->name('serviceDetail');
// Services Routes End
// Product Routes Start
Route::get('business-products/{category}', 'ProductController@product_list_by_category')->name('business-products');

Route::get('business-products/{category}/{subcategory}/regular-suppliers', 'ProductController@product_supplier_list_by_subcategory')->name('suppliers-subcategory-products');
Route::get('business-products/{category}/{subcategory}/regular-buyers', 'ProductController@product_buyer_list_by_subcategory')->name('buyers-subcategory-products');
Route::get('business-products/{category}/{subcategory}/one-time-sellers', 'ProductController@one_time_seller')->name('one-time-seller');
Route::get('business-products/{category}/{subcategory}/one-time-buyers', 'ProductController@one_time_buyer')->name('one-time-buyer');

Route::get('business-products/{category}/{subcategory}/regular-suppliers/search', 'ProductController@search_supplier')->name('prod-search-supplier');
Route::get('business-products/{category}/{subcategory}/regular-buyers/search', 'ProductController@search_buyer')->name('prod-search-buyer');
Route::get('business-products/{category}/{subcategory}/one-time-sellers/search', 'ProductController@one_time_search_supplier')->name('prod-search-one-time-supplier');
Route::get('business-products/{category}/{subcategory}/one-time-buyers/search', 'ProductController@one_time_search_buyer')->name('prod-search-one-time-buyer');



Route::get('business-products/{category}/{subcategory}/{childsubcategory?}/suppliers', 'ProductController@product_supplier_list_by_childsubcategory')->name('suppliers-products');
Route::get('business-products/{category}/{subcategory}/{childsubcategory}/buyers', 'ProductController@product_buyer_list_by_childsubcategory')->name('buyers-products');
Route::get('business-products/{category}/{subcategory}/{childsubcategory}/seller-deals', 'ProductController@one_time_childsubcategory_seller')->name('one-time-seller-deals');
Route::get('business-products/{category}/{subcategory}/{childsubcategory}/buyer-deals', 'ProductController@one_time_childsubcategory_buyer')->name('one-time-buyer-deals');

Route::get('business-products/{category}/{subcategory}/{childsubcategory}/suppliers/search', 'ProductController@product_search_supplier')->name('productsup-search');
Route::get('business-products/{category}/{subcategory}/{childsubcategory}/buyers/search', 'ProductController@product_search_buyer')->name('productbuy-search');
Route::get('business-products/{category}/{subcategory}/{childsubcategory}/sellers/search/{city=city?}', 'ProductController@product_one_time_search_supplier')->name('search-otsup');
Route::get('business-products/{category}/{subcategory}/{childsubcategory}/buyyers/search/{city=city?}', 'ProductController@product_one_time_search_buyer')->name('search-otbuy');

Route::get('business-products/{category}/CompareProducts', 'ProductController@compareProducts')->name('products-compare');

Route::get('business-products/{category?}/{subcategory?}/{prod_slug?}', 'ProductController@productDetail')->name('productDetail');
Route::get('one-time-deal/{category?}/{subcategory?}/{prod_slug?}', 'ProductController@buysellDetail')->name('buysellDetail');

//Route::get('supplier-other-product/{slug}/{id}', 'ProductController@other_product_from_this_supplier')->name('other-product-this-supplier');
Route::get('business-products/{category}/{subcategory}/{comp_id}/similar-supplier', 'ProductController@similar_product_from_this_supplier')->name('similar-product-this-supplier');
Route::get('business-products/{category}/{subcategory}/{comp_id}/similar-buyer', 'ProductController@similar_product_buyer_from_this_supplier')->name('similar-product-buyer-this-supplier');

Route::get('regular-suppliers/{category}', 'ProductController@view_all_regular_supplier_by_category')->name('regular-suppliers');
Route::get('regular-buyers/{category}', 'ProductController@view_all_regular_buyer_by_category')->name('regular-buyers');
Route::get('one-time-selling-deals/{category}', 'ProductController@view_all_one_time_selling_deals')->name('one-time-selling-deals');
Route::get('one-time-buying-deals/{category}', 'ProductController@view_all_one_time_buying_deals')->name('one-time-buying-deals');
Route::get('regular-service/{category}', 'ServiceController@view_all_regular_service')->name('regular-service');
Route::get('service-deals/{category}', 'ServiceController@view_all_service_deals')->name('service-deals');
Route::get('view-all-companies', 'ServiceController@view_all_companies')->name('view-all-companies');

// Product Routes End
// Ajax Routes Start
Route::post('/compare-product-ajax', 'ProductController@add_to_compare');
Route::delete('/compare-product-deleted-ajax/{reference_no}', 'ProductController@delete_compare');
Route::delete('/compare-product-all-deleted-ajax', 'ProductController@delete_all_compare');

Route::post('/is-read-notification', 'FavouriteController@is_read_notification');
Route::post('/send-notification-id', 'FavouriteController@send_notification_id');
Route::post('/is-display-notification', 'FavouriteController@is_display_notification');
Route::post('/notification', 'HomeController@notification')->name('notification');

Route::get('search-product','HomeController@searchProduct')->name('search_product');

Route::post('/get-state-list','HomeController@getStateList');
Route::post('/get-city-list','HomeController@getCityList');
// Ajax Routes End
//Route::get('business-products/sub/{slug}', 'ServiceController@subcatProducts')->name('subcategory-subcat');
// Route::post('product-listing', 'ProductController@loadsubcatandprod')->name('loadsubcatandprod');
Route::get('specific-products/{id}', 'ProductController@getSpecificCategoryProduct')->name('getSpecificCategoryProduct');
Route::get('specific-subcat-products/{id}', 'ProductController@getSpecificSubCategoryProduct')->name('getSpecificSubCategoryProduct');
Route::resource('products', 'ProductController');
////////////office//////////
Route::post('assign-office', 'CompanyController@assignoffice')->name('assignoffice');
Route::get('public/{file}', 'CareerController@donload_file')->name('donloadfile');


