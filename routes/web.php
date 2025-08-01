<?php

use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserManagement\RoleController;
use App\Http\Controllers\Admin\UserManagement\UserActivityController;
use App\Http\Controllers\Admin\WebPreferences\AboutUsController;
use App\Http\Controllers\Admin\WebPreferences\BlogArticleController;
use App\Http\Controllers\Admin\WebPreferences\CarouselIndexController;
use App\Http\Controllers\Admin\WebPreferences\ClientExperienceController;
use App\Http\Controllers\Admin\WebPreferences\CompanyInformationController;
use App\Http\Controllers\Admin\WebPreferences\HeroImagesController;
use App\Http\Controllers\Admin\WebPreferences\KategoriProdukController;
use App\Http\Controllers\Admin\WebPreferences\ProdukController;
use App\Http\Controllers\Admin\UserManagement\UserManagementController;
use App\Http\Controllers\Admin\WebPreferences\ServiceController;
use App\Http\Controllers\Admin\WebPreferences\SorotanController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;



// Route::view('/about', 'user.about')->name('about');
Route::view('/smartos', 'user.smartos')->name('smartos');
Route::view('/bcap', 'user.bcap')->name('bcap');
Route::view('/career', 'user.career')->name('career');

Route::middleware(['track.visitors'])->controller(LandingPageController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/about', 'about')->name('about');
    Route::get('/service', 'service')->name('service');
    Route::prefix('product')->name('product.')->group(function () {
        Route::get('/', 'product')->name('product.index');
        Route::get('/{slug}', 'showProduct')->name('product.show');
    });
    Route::prefix('blog')->name('blog.')->group(function () {
        Route::get('/', 'blog')->name('blog.index');
        Route::get('/load-more', 'loadMorePosts');
        Route::post('/comment', 'comment');
        Route::get('/{slug}', 'showBlog')->name('blog.show');
    });
    Route::get('/contact', 'contact')->name('contact');
    Route::post('/contact', 'sendContact')->name('contact.send');
});


Route::get('/admin', function () {
    return view('/admin/dashboard/index');
})->name('dashboard')->middleware('auth');

// Start  Dashboard
Route::middleware('auth')->controller(DashboardController::class)->group(function () {
    Route::get('admin', 'index')->name('admin.dashboard');
});
// End Dashboard
// Start Hero
Route::middleware('auth')->controller(HeroImagesController::class)->group(function () {
    Route::get('admin/web-preferences/hero', 'index')->name('admin.web_preferences.hero');
    Route::post('admin/web-preferences/hero', 'store');
    Route::get('admin/web-preferences/hero/create', 'create')->name('admin.web_preferences.hero');
    Route::post('admin/web-preferences/hero/update', 'update');
    Route::get('admin/web-preferences/hero/{id}', 'edit');
    Route::delete('admin/web-preferences/hero/{id}', 'destroy');
});

// Start About
Route::middleware('auth')->controller(AboutUsController::class)->group(function () {
    Route::get('admin/web-preferences/about', 'index')->name('admin.web_preferences.about');
    Route::post('admin/web-preferences/about', 'store');
});
Route::middleware('auth')->controller(CompanyInformationController::class)->group(function () {
    Route::get('admin/web-preferences/informasi', 'index')->name('admin.web_preferences.informasi');
    Route::post('admin/web-preferences/informasi', 'store');
});


// Start Blog
Route::middleware('auth')->controller(BlogArticleController::class)->group(function () {
    Route::get('admin/web-preferences/blog', 'index')->name('admin.web_preferences.blog');
    Route::post('admin/web-preferences/blog', 'store');
    Route::post('admin/web-preferences/blog/lists', 'lists');
    Route::get('admin/web-preferences/blog/create', 'create')->name('admin.web_preferences.blog');
    Route::get('admin/web-preferences/blog/{id}', 'edit')->name('admin.web_preferences.blog');
    Route::put('admin/web-preferences/blog/{id}', 'update');
    Route::delete('admin/web-preferences/blog/{id}', 'destroy');
});

// Start Kategori Produk
Route::middleware('auth')->controller(KategoriProdukController::class)->group(function () {
    Route::get('admin/web-preferences/kategori', 'index')->name('admin.web_preferences.kategori');
    Route::post('admin/web-preferences/kategori', 'store');
    Route::post('admin/web-preferences/kategori/lists', 'lists');
    Route::get('admin/web-preferences/kategori/create', 'create')->name('admin.web_preferences.kategori');
    Route::get('admin/web-preferences/kategori/{id}', 'edit')->name('admin.web_preferences.kategori');
    Route::put('admin/web-preferences/kategori/{id}', 'update');
    Route::delete('admin/web-preferences/kategori/{id}', 'destroy');
});

Route::middleware('auth')->controller(ClientExperienceController::class)->group(function () {
    Route::get('admin/web-preferences/client-experience', 'index')->name('admin.web_preferences.client-experience');
    Route::post('admin/web-preferences/client-experience', 'store');
    Route::post('admin/web-preferences/client-experience/lists', 'lists');
    Route::get('admin/web-preferences/client-experience/create', 'create')->name('admin.web_preferences.client-experience');
    Route::get('admin/web-preferences/client-experience/{id}', 'edit')->name('admin.web_preferences.client-experience');
    Route::put('admin/web-preferences/client-experience/{id}', 'update');
    Route::delete('admin/web-preferences/client-experience/{id}', 'destroy');
});

// Start Services
Route::middleware('auth')->controller(ServiceController::class)->group(function () {
    Route::get('admin/web-preferences/services', 'index')->name('admin.web_preferences.services');
    Route::post('admin/web-preferences/services', 'store');
    Route::post('admin/web-preferences/services/lists', 'lists');
    Route::get('admin/web-preferences/services/create', 'create')->name('admin.web_preferences.services');
    Route::get('admin/web-preferences/services/{id}', 'edit')->name('admin.web_preferences.services');
    Route::put('admin/web-preferences/services/{id}', 'update');
    Route::delete('admin/web-preferences/services/{id}', 'destroy');
});

// Start Produk
Route::middleware('auth')->controller(ProdukController::class)->group(function () {
    Route::get('admin/web-preferences/produk', 'index')->name('admin.web_preferences.produk');
    Route::post('admin/web-preferences/produk', 'store');
    Route::post('admin/web-preferences/produk/lists', 'lists');
    Route::get('admin/web-preferences/produk/create', 'create')->name('admin.web_preferences.produk');
    Route::get('admin/web-preferences/produk/{id}', 'edit')->name('admin.web_preferences.produk');
    Route::put('admin/web-preferences/produk/{id}', 'update');
    Route::delete('admin/web-preferences/produk/{id}', 'destroy');
});
Route::middleware('auth')->controller(SorotanController::class)->group(function () {
    Route::get('/admin/web-preferences/sorotan', 'index')->name('admin.web_preferences.sorotan');
    Route::post('/admin/web-preferences/sorotan', 'store');
    Route::get('/admin/web-preferences/sorotan/create', 'create')->name('admin.web_preferences.sorotan');
    Route::get('/admin/web-preferences/sorotan/{id}', 'edit');
    Route::put('/admin/web-preferences/sorotan/{id}', 'update');
    Route::delete('/admin/web-preferences/sorotan/{id}', 'destroy');
});

Route::middleware('auth')->controller(CarouselIndexController::class)->group(function () {
    Route::get('/admin/web-preferences/carousel', 'index')->name('admin.web_preferences.carousel');
    Route::post('/admin/web-preferences/carousel', 'store');
    Route::get('/admin/web-preferences/carousel/create', 'create')->name('admin.web_preferences.carousel');
    Route::put('/admin/web-preferences/carousel/{id}', 'update');
    Route::delete('/admin/web-preferences/carousel/{id}', 'destroy');
});



// Start Users
Route::middleware('auth')->controller(UserManagementController::class)->group(function () {
    Route::get('admin/user-management/users', 'index')->name('admin.user-management.users');
    Route::post('admin/user-management/users', 'store');
    Route::post('admin/user-management/users/lists', 'lists');
    Route::get('admin/user-management/users/create', 'create')->name('admin.user-management.users');
    Route::get('admin/user-management/users/{id}', 'edit')->name('admin.user-management.users');
    Route::put('admin/user-management/users/{id}', 'update');
    Route::delete('admin/user-management/users/{id}', 'destroy');
});

// Start Role
Route::middleware('auth')->controller(RoleController::class)->group(function () {
    Route::get('admin/user-management/role', 'index')->name('admin.user-management.role');
    Route::post('admin/user-management/role', 'store');
    Route::get('admin/user-management/role/create', 'create')->name('admin.user-management.role');
    Route::get('admin/user-management/role/{id}', 'edit')->name('admin.user-management.role');
    Route::put('admin/user-management/role/{id}', 'update');
    Route::delete('admin/user-management/role/{id}', 'destroy');
});
Route::middleware('auth')->controller(UserActivityController::class)->group(function () {
    Route::get('/admin/user-management/users-activity', 'index')->name('admin.user-management.users_activity');
    Route::post('/admin/user-management/users-activity/lists', 'lists');
});

Route::middleware('auth')->controller(ContactController::class)->group(function () {
    Route::get('/admin/contact', 'index')->name('admin.contact');
    Route::post('/admin/contact/lists', 'lists');
});



// Authentication
// Auth::routes();
Auth::routes(['register' => false]);
