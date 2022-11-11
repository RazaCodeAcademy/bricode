<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
|--------------------------------------------------------------------------
| Public And Customer Routes
|--------------------------------------------------------------------------
*/

Route::namespace('API')->group(function () {
    // clear app cache
    Route::get('/clear', function () {
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Artisan::call('cache:clear');

        return response()->json([
            'success' => true,
            'message' => 'All application cache has been cleared!',
        ]);
    });

    // Mobile application routes
    Route::namespace('Frontend')->group(function () {
        Route::post('/industries', 'CommonController@industry_list')->name('industries-list');
        Route::post('/countries', 'CommonController@country_list')->name('countries-list');
        Route::post('/cities', 'CommonController@city_list')->name('cities-list');
        Route::post('/no-of-employees', 'CommonController@number_of_employees')->name('no-of-employees');

        Route::middleware(['auth:api'])->group(function () {
            // posts routes here
            Route::post('/story/list', 'StoryController@list')->name('story.list');
            Route::post('/story/store', 'StoryController@store')->name('story.store');

            // story routes here
            Route::post('/posts/list', 'PostController@posts_list')->name('posts.list');
            Route::post('/posts/store', 'PostController@store')->name('posts.store');

            //social routes
            Route::post('social/store', 'SocialController@storesocial')->name('social.store');
            Route::post('/socials/list', 'SocialController@index')->name('social.list');

            //team routes
            Route::post('/team/store', 'TeamController@store')->name('team.store');
            Route::post('/team/list', 'TeamController@index')->name('team.list');
            Route::post('/team/show', 'TeamController@show')->name('team.show');
            Route::post('/team/{slug}', 'TeamController@joinslug')->name('team.slug');
            Route::post('/team/search/list', 'TeamController@search')->name('team.search');
            Route::post('/team/remove/member', 'TeamController@remove_member')->name('team.remove_member');
            Route::post('/team/add/card', 'TeamController@add_cards_to_team')->name('team.add_cards_to_team');
            Route::post('/team/remove/card', 'TeamController@remove_card_from_team')->name('team.remove_card_from_team');
            Route::post('/team/list/card', 'TeamController@card_list')->name('team.card_list');

            // conversation routes here.
            Route::prefix('conversation')->group(function () {
                Route::post('/search-user', 'ConversationController@searchUser')->name('searchUser');
                Route::post('/send-message', 'ConversationController@sendMessage')->name('sendMessage');
                Route::post('/list', 'ConversationController@getConversationList')->name('getConversationList');
                Route::post('/get-chat', 'ConversationController@getConversationChat')->name('getConversationChat');
                Route::post('/read_message', 'ConversationController@readMessage')->name('ReadMessage');
            });

            //user profile
            Route::post('user/user-profile', 'UserController@singleuser')->name('user.singleprofile');

            //Edit User/Company
            Route::post('user/update-user', 'UserController@update')->name('user.update');

            //image upload
            Route::post('/user/image-upload', 'UserController@imageupload')->name('user.imageupload');

            //follow request routes
            Route::post('/follow/send-request', 'FollowController@sendfollowrequest')->name('follow.sendrequest');
            Route::post('/follow/following-list', 'FollowController@followinglist')->name('follow.followinglist');
            Route::post('/follow/follower-list', 'FollowController@followerlist')->name('follow.followerlist');

            //Comment Routes
            Route::post('/comment/send-comment', 'CommentController@comment')->name('comment.send');
            Route::post('/comment/reply-comment', 'CommentController@replycomment')->name('comment.reply');

            //like routes
            Route::post('/like/post-like', 'LikeController@postlike')->name('post.like');
            Route::post('/like/comment-like', 'LikeController@commentlike')->name('like.comment');
            Route::post('/like/reply-comment-like', 'LikeController@replycommentlike')->name('like.commentreply');

            //Card Route
            Route::post('/card/save', 'CardController@store')->name('card.save');
            Route::post('/card/update', 'CardController@update')->name('card.update');
            Route::post('/card/list', 'CardController@index')->name('card.index');
            Route::post('/card/show', 'CardController@show')->name('card.show');
            Route::post('/card/filtered-list', 'CardController@card_filter')->name('card.filter');
            Route::post('/card/saved', 'CardController@card_saved')->name('card.saved');
            Route::post('/card/favourites', 'CardController@card_favourites')->name('card.favourites');

            //Product & Services Routes
            Route::prefix('product')->group(function () {
                Route::post('/store', 'ProductController@store')->name('product.store');
                Route::post('/list', 'ProductController@index')->name('product.index');
                Route::post('/update', 'ProductController@update')->name('product.update');
                Route::post('/delete', 'ProductController@delete')->name('product.delete');

            });
            //Notification routes
            Route::post('notification/list', 'NotificationController@index')->name('notification.index');

            //Postions Routes
            Route::post('postion/store', 'PositionController@store')->name('postion.store');
            Route::post('postion/list', 'PositionController@index')->name('postion.index');
            Route::post('postion/update', 'PositionController@update')->name('postion.update');
            Route::post('postion/delete', 'PositionController@delete')->name('postion.delete');

            //Expos Routes
            Route::post('expos/store','ExpoController@store')->name('expos.store');
            Route::post('expos/list','ExpoController@index')->name('expos.index');
            Route::post('expos/detail','ExpoController@show')->name('expos.show');
            Route::post('expos/filter','ExpoController@expo_filter')->name('expos.filter');

            //Rating and Reviews Routes
            Route::post('ratings/list','RatingController@index')->name('ratings.list');
            Route::post('ratings/add','RatingController@store')->name('ratings.store');

            //Notes Routes
            Route::post('notes/add','NoteController@store')->name('notes.store');
        });
    });

    // login and register route
    Route::namespace('Auth')->group(function () {
        Route::post('/login', 'LoginController@login')->name('login');
        Route::post('reset-password', 'ForgotPasswordController@resetPassword')->name('forgotpassword');
        Route::post('/register', 'RegisterController@register')->name('register');
        Route::post('/sendotp', 'RegisterController@sendOTP')->name('sendotp');
        Route::post('/verifyotp', 'RegisterController@verifyOTP')->name('verifyotp');
        Route::get('/logout', 'LoginController@logout')->name('logout');
        Route::post('/email-exist', 'RegisterController@emailexist')->name('emailexist');
    });
});
