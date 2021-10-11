<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

//login
Route::get('administrator', function () { return view('auth/login'); });
Route::post('administrator', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('administrator');

Route::get('/', [App\Http\Controllers\FontendController::class, 'index'])->name('fronend.home');

//page
Route::get('pages/{parmalink}', [App\Http\Controllers\FontendController::class, 'pages'])->name('fronend.page.detail');

//artlicle
Route::get('articles/detail/{parmalink}', [App\Http\Controllers\FontendController::class, 'articles'])->name('fronend.articles.detail');
Route::get('articles/recommend', [App\Http\Controllers\FontendController::class, 'recommend'])->name('fronend.articles.recommend');
Route::get('category/{parmalink}', [App\Http\Controllers\FontendController::class, 'category'])->name('fronend.category.index');
Route::get('tag', [App\Http\Controllers\FontendController::class, 'tag'])->name('fronend.tag');
Route::get('tag/{parmalink}', [App\Http\Controllers\FontendController::class, 'tagsearch'])->name('fronend.search.tag');
Route::get('search', [App\Http\Controllers\FontendController::class, 'search'])->name('fronend.search');


Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
    'login' => false, // login Route...
]);


Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //setting
    Route::get('/setting/index', [App\Http\Controllers\SettingController::class, 'index'])->name('setting.index');
    Route::put('/setting/updateSeting/{id}', [App\Http\Controllers\SettingController::class, 'updateSeting'])->name('setting.updateSeting');
    Route::put('/setting/deleteLogo', [App\Http\Controllers\SettingController::class, 'deleteLogo'])->name('setting.deleteLogo');
    Route::put('/setting/deleteIcon', [App\Http\Controllers\SettingController::class, 'deleteIcon'])->name('setting.deleteIcon');
    Route::get('/setting/contact', [App\Http\Controllers\SettingController::class, 'contact'])->name('setting.contact');
    Route::put('/setting/updateContact/{id}', [App\Http\Controllers\SettingController::class, 'updateContact'])->name('setting.updateContact');
    Route::get('/setting/extensions', [App\Http\Controllers\SettingController::class, 'extensions'])->name('setting.extensions');
    Route::post('/setting/crateExtensions', [App\Http\Controllers\SettingController::class, 'crateExtensions'])->name('setting.crateExtensions');
    Route::put('/setting/updateExtensions/{id}', [App\Http\Controllers\SettingController::class, 'updateExtensions'])->name('setting.updateExtensions');
    Route::get('/setting/logtag', [App\Http\Controllers\SettingController::class, 'logtag'])->name('setting.logtag');
    Route::put('/setting/logtagUpdate', [App\Http\Controllers\SettingController::class, 'logtagUpdate'])->name('setting.logtagUpdate');

    //logtag
    Route::get('setting/logtag/json', [App\Http\Controllers\LogtagController::class, 'json'])->name('logtag.json');

    //banner
    Route::get('/banner/index', [App\Http\Controllers\BannerController::class, 'index'])->name('banner.index');
    Route::get('/banner/add', [App\Http\Controllers\BannerController::class, 'add'])->name('banner.add');
    Route::post('/banner/crate', [App\Http\Controllers\BannerController::class, 'crate'])->name('banner.crate');
    Route::get('/banner/edit/{id}', [App\Http\Controllers\BannerController::class, 'edit'])->name('banner.edit');
    Route::put('/banner/update/{id}', [App\Http\Controllers\BannerController::class, 'update'])->name('banner.update');
    Route::get('/banner/status/{id}', [App\Http\Controllers\BannerController::class, 'status'])->name('banner.status');
    Route::get('/banner/jsondata', [App\Http\Controllers\BannerController::class, 'jsondata'])->name('banner.jsondata');
    Route::delete('banner/delete', [App\Http\Controllers\BannerController::class, 'delete'])->name('banner.delete');

    //custom code
    Route::get('/custom/{code}/index', [App\Http\Controllers\CustomcodeController::class, 'index'])->name('custom.index');
    Route::get('/custom/{code}/add', [App\Http\Controllers\CustomcodeController::class, 'add'])->name('custom.add');
    Route::post('/custom/crate', [App\Http\Controllers\CustomcodeController::class, 'crate'])->name('custom.crate');
    Route::get('/custom/{code}/edit/{id}', [App\Http\Controllers\CustomcodeController::class, 'edit'])->name('custom.edit');
    Route::put('/custom/update/{id}', [App\Http\Controllers\CustomcodeController::class, 'update'])->name('custom.update');
    Route::get('/custom/status/{id}', [App\Http\Controllers\CustomcodeController::class, 'status'])->name('custom.status');
    Route::get('/custom/jsondata/{code}', [App\Http\Controllers\CustomcodeController::class, 'jsondata'])->name('custom.jsondata');
    Route::delete('custom/delete', [App\Http\Controllers\CustomcodeController::class, 'delete'])->name('custom.delete');

    //category
    Route::get('/setting/category/index', [App\Http\Controllers\CategoryController::class, 'index'])->name('category.index');
    Route::get('/setting/category/add', [App\Http\Controllers\CategoryController::class, 'add'])->name('category.add');
    Route::post('/setting/category/crate', [App\Http\Controllers\CategoryController::class, 'crate'])->name('category.crate');
    Route::get('/setting/category/edit/{id}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/setting/category/update/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('category.update');
    Route::get('/setting/category/status/{id}', [App\Http\Controllers\CategoryController::class, 'status'])->name('category.status');
    Route::get('/setting/category/jsondata', [App\Http\Controllers\CategoryController::class, 'jsondata'])->name('category.jsondata');
    Route::delete('setting/category/delete', [App\Http\Controllers\CategoryController::class, 'delete'])->name('category.delete');

    //artlicle
    Route::get('/setting/artlicle/index', [App\Http\Controllers\ArtlicleController::class, 'index'])->name('artlicle.index');
    Route::get('/setting/artlicle/preview/{parmalink}', [App\Http\Controllers\ArtlicleController::class, 'preview'])->name('artlicle.preview');
    Route::get('/setting/artlicle/add', [App\Http\Controllers\ArtlicleController::class, 'add'])->name('artlicle.add');
    Route::post('/setting/artlicle/crate', [App\Http\Controllers\ArtlicleController::class, 'crate'])->name('artlicle.crate');
    Route::get('/setting/artlicle/edit/{id}', [App\Http\Controllers\ArtlicleController::class, 'edit'])->name('artlicle.edit');
    Route::put('/setting/artlicle/update/{id}', [App\Http\Controllers\ArtlicleController::class, 'update'])->name('artlicle.update');
    Route::get('/setting/artlicle/status/{id}', [App\Http\Controllers\ArtlicleController::class, 'status'])->name('artlicle.status');
    Route::get('/setting/artlicle/jsondata', [App\Http\Controllers\ArtlicleController::class, 'jsondata'])->name('artlicle.jsondata');
    Route::get('/setting/artlicle/getCat', [App\Http\Controllers\ArtlicleController::class, 'getCat'])->name('artlicle.getCat');
    Route::delete('setting/artlicle/delete', [App\Http\Controllers\ArtlicleController::class, 'delete'])->name('artlicle.delete');
    Route::put('/setting/artlicle/deleteImg', [App\Http\Controllers\ArtlicleController::class, 'deleteImg'])->name('artlicle.deleteImg');
    Route::get('/setting/artlicle/random', [App\Http\Controllers\ArtlicleController::class, 'random'])->name('artlicle.random');
    Route::get('/setting/artlicle/search', [App\Http\Controllers\ArtlicleController::class, 'search'])->name('artlicle.search');

    //page
    Route::get('/setting/page/about/index', [App\Http\Controllers\PageaboutControlle::class, 'index'])->name('page.about.index');
    Route::post('/setting/page/about/crate', [App\Http\Controllers\PageaboutControlle::class, 'crate'])->name('page.about.crate');
    Route::put('/setting/page/about/update/{id}', [App\Http\Controllers\PageaboutControlle::class, 'update'])->name('page.about.update');

    Route::get('/setting/page/contactads/index', [App\Http\Controllers\PageadsControlle::class, 'index'])->name('page.contactads.index');
    Route::post('/setting/page/contactads/crate', [App\Http\Controllers\PageadsControlle::class, 'crate'])->name('page.contactads.crate');
    Route::put('/setting/page/contactads/update/{id}', [App\Http\Controllers\PageadsControlle::class, 'update'])->name('page.contactads.update');

    //user
    Route::get('/setting/user/index', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
    Route::get('/setting/user/add', [App\Http\Controllers\UserController::class, 'add'])->name('user.add');
    Route::post('/setting/user/crate', [App\Http\Controllers\UserController::class, 'crate'])->name('user.crate');
    Route::get('/setting/user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
    Route::put('/setting/user/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
    Route::get('/setting/user/status/{id}', [App\Http\Controllers\UserController::class, 'status'])->name('user.status');
    Route::get('/setting/user/jsondata', [App\Http\Controllers\UserController::class, 'jsondata'])->name('user.jsondata');
    Route::get('/setting/user/jsonpenname/{id}', [App\Http\Controllers\UserController::class, 'jsonpenname'])->name('user.json.penname');
    Route::delete('setting/user/delete', [App\Http\Controllers\UserController::class, 'delete'])->name('user.delete');
    Route::get('setting/user/profile/{id}', [App\Http\Controllers\UserController::class, 'profile'])->name('user.profile');
    Route::get('setting/user/level/{id}', [App\Http\Controllers\UserController::class, 'level'])->name('user.level');
    Route::put('/setting/user/levelupdate/{id}', [App\Http\Controllers\UserController::class, 'levelupdate'])->name('user.levelupdate');
    Route::get('setting/user/changpassword/{id}', [App\Http\Controllers\UserController::class, 'changpassword'])->name('user.changpassword');
    Route::put('/setting/user/changpasswordUpdate/{id}', [App\Http\Controllers\UserController::class, 'changpasswordUpdate'])->name('user.changpasswordUpdate');

    //setting ads
    Route::get('/setting/ads/index', [App\Http\Controllers\AdsController::class, 'index'])->name('ads.index');
    Route::post('/setting/ads/crate', [App\Http\Controllers\AdsController::class, 'crate'])->name('ads.crate');
    Route::put('/setting/ads/update/{id}', [App\Http\Controllers\AdsController::class, 'update'])->name('ads.update');
    //setting ads head
    Route::get('/setting/ads/head/index', [App\Http\Controllers\AdsheadController::class, 'index'])->name('ads.head.index');
    Route::get('/setting/ads/head/add', [App\Http\Controllers\AdsheadController::class, 'add'])->name('ads.head.add');
    Route::post('/setting/ads/head/crate', [App\Http\Controllers\AdsheadController::class, 'crate'])->name('ads.head.crate');
    Route::get('/setting/ads/head/edit/{id}', [App\Http\Controllers\AdsheadController::class, 'edit'])->name('ads.head.edit');
    Route::put('/setting/ads/head/update/{id}', [App\Http\Controllers\AdsheadController::class, 'update'])->name('ads.head.update');
    Route::get('/setting/ads/head/status/{id}', [App\Http\Controllers\AdsheadController::class, 'status'])->name('ads.head.status');
    Route::get('/setting/ads/head/jsondata', [App\Http\Controllers\AdsheadController::class, 'jsondata'])->name('ads.head.jsondata');
    Route::delete('setting/ads/head/delete', [App\Http\Controllers\AdsheadController::class, 'delete'])->name('ads.head.delete');
    Route::get('/setting/ads/head/getDisplay', [App\Http\Controllers\AdsheadController::class, 'getDisplay'])->name('ads.head.getDisplay');
    //setting ads banner
    Route::get('/setting/ads/banner/index', [App\Http\Controllers\AdsbannerController::class, 'index'])->name('ads.banner.index');
    Route::get('/setting/ads/banner/add', [App\Http\Controllers\AdsbannerController::class, 'add'])->name('ads.banner.add');
    Route::post('/setting/ads/banner/crate', [App\Http\Controllers\AdsbannerController::class, 'crate'])->name('ads.banner.crate');
    Route::get('/setting/ads/banner/edit/{id}', [App\Http\Controllers\AdsbannerController::class, 'edit'])->name('ads.banner.edit');
    Route::put('/setting/ads/banner/update/{id}', [App\Http\Controllers\AdsbannerController::class, 'update'])->name('ads.banner.update');
    Route::get('/setting/ads/banner/status/{id}', [App\Http\Controllers\AdsbannerController::class, 'status'])->name('ads.banner.status');
    Route::get('/setting/ads/banner/jsondata', [App\Http\Controllers\AdsbannerController::class, 'jsondata'])->name('ads.banner.jsondata');
    Route::delete('setting/ads/banner/delete', [App\Http\Controllers\AdsbannerController::class, 'delete'])->name('ads.banner.delete');
    Route::get('/setting/ads/banner/getDisplay', [App\Http\Controllers\AdsbannerController::class, 'getDisplay'])->name('ads.banner.getDisplay');
    //setting ads right
    Route::get('/setting/ads/right1/index', [App\Http\Controllers\AdsrightController::class, 'index'])->name('ads.right.index');
    Route::get('/setting/ads/right1/add', [App\Http\Controllers\AdsrightController::class, 'add'])->name('ads.right.add');
    Route::post('/setting/ads/right1/crate', [App\Http\Controllers\AdsrightController::class, 'crate'])->name('ads.right.crate');
    Route::get('/setting/ads/right1/edit/{id}', [App\Http\Controllers\AdsrightController::class, 'edit'])->name('ads.right.edit');
    Route::put('/setting/ads/right1/update/{id}', [App\Http\Controllers\AdsrightController::class, 'update'])->name('ads.right.update');
    Route::get('/setting/ads/right1/status/{id}', [App\Http\Controllers\AdsrightController::class, 'status'])->name('ads.right.status');
    Route::get('/setting/ads/right1/jsondata', [App\Http\Controllers\AdsrightController::class, 'jsondata'])->name('ads.right.jsondata');
    Route::delete('setting/ads/right1/delete', [App\Http\Controllers\AdsrightController::class, 'delete'])->name('ads.right.delete');
    Route::get('/setting/ads/right1/getDisplay', [App\Http\Controllers\AdsrightController::class, 'getDisplay'])->name('ads.right.getDisplay');
});
