<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomController;
use App\Http\Controllers\SendingEmail;
use App\Http\Controllers\SendContactFormEmail;
use App\Http\Controllers\BlogPostCreateController;
use App\Http\Controllers\RequestForCallController;
use App\Http\Controllers\SendProductQuoteEmail;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashProductsDataController;
use App\Http\Controllers\ManageSitemapController;
use App\Http\Controllers\ManageCategoriesController;

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

// Route::get('/login', function () {
//     // return view('welcome');
//     // echo "string";
//     Session::flush();
// });

// redirections
Route::get('/product/cardboard-packaging/', function (){ return Redirect::to('/product/custom-cardboard-packaging/'); });
Route::get('/product/die-cut-boxes/', function (){ return Redirect::to('/product/customized-die-cut-boxes/'); });
Route::get('/product/christmas-boxes', function (){ return Redirect::to('/product/christmas-gift-boxes'); });
Route::get('/product-category/cosmetic-packaging-boxes/', function (){ return Redirect::to('/product-category/cosmetic-boxes/'); });
Route::get('/product/cake-container-boxes/', function (){ return Redirect::to('/product/cake-boxes/'); });
Route::get('/category/custom-cbd-boxes/', function (){ return Redirect::to('/product-category/cbd-boxes/'); });
Route::get('/term-conditions/', function (){ return Redirect::to('/terms-conditions/'); });
Route::get('/blog/', function (){ return Redirect::to('/blogs/'); });
Route::get('/product', function (){ return Redirect::to('/products'); });
Route::get('/price-quote', function (){ return Redirect::to('/product-quote-for-price'); });
Route::get('/review/', function (){ return Redirect::to('/'); });
Route::get('/our-portfolios/', function (){ return Redirect::to('/'); });
Route::get('/product/custom-cbd-boxes/', function (){ return Redirect::to('/product/cbd-boxes/'); });
Route::get('/home/', function (){ return Redirect::to('/'); });
Route::get('/product/candle-boxes/', function (){ return Redirect::to('/product/custom-candle-boxes/'); });
Route::get('/product/eyelashes-boxes/', function (){ return Redirect::to('/product/custom-eyelash-boxes/'); });
Route::get('/product/cupcake-boxes/', function (){ return Redirect::to('/product/custom-cupcake-boxes/'); });
Route::get('/product/pop-corn-boxes/', function (){ return Redirect::to('/product/popcorn-boxes/'); });
Route::get('/product-quote-form/', function (){ return Redirect::to('/product-quote-for-price/'); });
Route::get('/cbd-boxes', function (){ return Redirect::to('/product/cbd-boxes/'); });




// dashboard login
Route::get('bcb-login', [AuthController::class, 'loginpage'])->middleware('dashboard-redirection');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
// dashboard route
Route::group(['middleware' => 'prevent-back-history'],function(){
    Route::get('/bcb-backend', [AuthController::class, 'bcbDashboard']);
    Route::get('logout', [AuthController::class, 'logout'])->name('logout'); 
    // manage product
    Route::get('/add-new-product', [DashProductsDataController::class, 'AddNewProduct']); 
    Route::post('/add-new-product', [DashProductsDataController::class, 'SavedNewProduct']); 
    Route::post('/add_new_specification', [DashProductsDataController::class, 'StoreSpecification']);
    Route::get('/list-of-products', [DashProductsDataController::class, 'ListOfProducts']); 
    Route::get('/delete-complete-product/{id}', [DashProductsDataController::class, 'DeleteCompleteProdDetails']); 
    Route::get('/edit-product-details/{id}', [DashProductsDataController::class, 'EditCompleteProdDetails']); 
    Route::get('/product-status-update/{id}', [DashProductsDataController::class, 'ProdStatusUpdate']); 
    Route::post('/delete-product-specs', [DashProductsDataController::class, 'DeleteProductsSpecs']); 
    Route::post('/addnew-perm-specification', [DashProductsDataController::class, 'NewPermProductsSpecs']); 
    Route::post('/update-perm-specification', [DashProductsDataController::class, 'UpdatePermProductsSpecs']); 
    Route::post('/update-exist-product', [DashProductsDataController::class, 'UpdateExistProduct']);
    Route::post('/delete-multi-img', [DashProductsDataController::class, 'DeleteMultipleImg']);
    Route::get('/add-product-faq', [DashProductsDataController::class, 'ProductFaqList']);
    Route::post('/storeprodfaq', [DashProductsDataController::class, 'StoreProductFAQ']);
    Route::post('/fetchfaqlist', [DashProductsDataController::class, 'FetchFAQList']);
    Route::get('/add-product-testimonials', [DashProductsDataController::class, 'ProductTestimonialsList']);
    Route::post('/storeprodtestimonials', [DashProductsDataController::class, 'StoreProductTestMonials']);
    Route::post('/fetchtestimlist', [DashProductsDataController::class, 'FetchTestimList']);
    // manage user modules
    Route::get('/add-new-user', [AuthController::class, 'registeruser']);
    Route::post('/post-registration', [AuthController::class, 'postRegistration']);
    Route::post('/check-unique-email', [AuthController::class, 'uniqueEmail']);
    Route::get('/list-of-users', [AuthController::class, 'userList']);
    Route::get('/user-delete/{id}', [AuthController::class, 'userDelete']);
    Route::get('/edit-user/{id}', [AuthController::class, 'userEdit']);
    Route::post('/update-user', [AuthController::class, 'userUpdate']);
    // manage blog post
    Route::get('/create-blogpost', [BlogPostCreateController::class, 'createBlogPageForm']);
    Route::post('/create-blogpost', [BlogPostCreateController::class, 'storeBlogPageForm']);
    Route::get('/list-of-blogpost', [BlogPostCreateController::class, 'DashBlogPostList']);
    Route::get('/update-status-blogpost/{id}', [BlogPostCreateController::class, 'DashBlogPostUpdateStatus']);
    Route::get('/delete-blogpost/{id}', [BlogPostCreateController::class, 'DashBlogPostDelete']);
    Route::get('/edit-blogpost/{id}', [BlogPostCreateController::class, 'DashBlogPostEdit']);
    Route::post('/update-blogpost', [BlogPostCreateController::class, 'UpdateBlogPostForm']);
    // check unique slug
    Route::post('/check_unique_slug', [BlogPostCreateController::class, 'checkUniqueSlug']);
    // manage sitemap
    Route::get('/create-sitemap', [ManageSitemapController::class, 'createSitemapForm']);
    Route::post('/post-sitemap-form', [ManageSitemapController::class, 'submitSitemapForm']);
    Route::get('/list-of-sitemap', [ManageSitemapController::class, 'listSitemapData']);
    Route::get('/view-sitemap-details', [ManageSitemapController::class, 'viewSitemapDetails']);
    Route::get('/replace-sitemap-file', [ManageSitemapController::class, 'replaceSitemapFile']);
    Route::get('/delete-sitemap-url/{id}', [ManageSitemapController::class, 'deleteSitemapURL']);
    Route::get('/edit-sitemap-url/{id}', [ManageSitemapController::class, 'editSitemapURL']);
    Route::post('/update-sitemap-form', [ManageSitemapController::class, 'updateSitemapForm']);
    // manage categories
    Route::get('/create-new-category', [ManageCategoriesController::class, 'createCategoryForm']);
    Route::post('/post-category-form', [ManageCategoriesController::class, 'submitCategoryForm']);
    Route::get('/list-of-category', [ManageCategoriesController::class, 'listOfCategories']);
    Route::get('/edit-category-url/{id}', [ManageCategoriesController::class, 'editOfCategories']);
    Route::post('/update-category-data', [ManageCategoriesController::class, 'updateCategoryData']);
    Route::get('/delete-category-url/{id}', [ManageCategoriesController::class, 'deleteOfCategory']);
});
// frontend website
Route::get('/', [CustomController::class, 'index']);
Route::get('/why-bcb/', [CustomController::class, 'whyBCB']);
Route::get('/about-us', [CustomController::class, 'about']);
Route::get('/categories', [CustomController::class, 'categories']);
Route::get('/product-quote-for-price', [CustomController::class, 'productQuote']);
Route::get('/contact', [CustomController::class, 'contact']);
Route::get('/request-for-call', [RequestForCallController::class, 'ReqForCall']);
Route::post('/request-for-a-call',[RequestForCallController::class, 'RequestForACalls']);
Route::post('/product-quote-form',[SendProductQuoteEmail::class, 'productQuoteFormEmail'])->name('product-quote-form');
// terms and conditions, privacy policy and disclaimer
Route::get('/terms-conditions', [CustomController::class, 'TermsAndConditions']);
Route::get('/privacy-policy', [CustomController::class, 'PrivacyPolicy']);
Route::get('/disclaimer', [CustomController::class, 'Disclaimer']);
// category page get
Route::get('/product-category/{name}', [CustomController::class, 'productCategory']);
Route::post('/more-product-category', [CustomController::class, 'moreproductCategory']);
Route::get('/product/{name}', [CustomController::class, 'singleProductDetail']);
Route::get('/products', [CustomController::class, 'AllProductsList']);
Route::get('/product', function (){ return Redirect::to('/products'); });
Route::get('/custom-boxes', function (){ return Redirect::to('/'); });
// send quote page contact page email
Route::post('/product-quote-for-price', [SendingEmail::class, 'sendqouteform']);
Route::post('/contact-form-email', [SendContactFormEmail::class, 'contactFormEmails']);
Route::get('/thank-you', function () {  return view('frontend.thank-you'); });
// blogpost
Route::get('/blogs', [BlogPostCreateController::class, 'getBlogs']);
Route::get('/blog/{name}', [BlogPostCreateController::class, 'showBlogDetails']);
Route::get('/{name}', [BlogPostCreateController::class, 'redirectBlog']);
// search
Route::post('/search',[CustomController::class, 'SearchForAll'])->name('search');
Route::post('/search_products_list',[CustomController::class, 'SearchProductList'])->name('search_products_list');


