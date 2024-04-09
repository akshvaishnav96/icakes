<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\TierController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\FlavorController;
use App\Http\Controllers\FlavorWithPriceController;
use App\Http\Controllers\CakeSizeWithPriceController;



// Route::get("/",[CakesController::class,"getCakeData"]);


// Route::get("/cake",[PageController::class,"index"])->name("cake.get");    // uplode cake from
// Route::post("/cake",[CakesController::class,"uploadeCake"])->name("cake.post");



Route::get("/tags",[TagsController::class,"tags"])->name("tags.get");
Route::post("/tags",[TagsController::class,"uplodeTags"])->name("tags.post");
Route::get("/tags/edit/{id}",[TagsController::class,"editTags"]);
Route::post("/tags/edit/{id}",[TagsController::class,"updateTags"]);
Route::get("/tags/{id}",[TagsController::class,"deleteTags"]);




Route::get("/category",[CategoryController::class,"category"])->name("category.get");
Route::post("/category",[CategoryController::class,"uplodeCategory"])->name("category.post");
Route::get("/category/edit/{id}",[CategoryController::class,"editCategory"]);
Route::post("/category/edit/{id}",[CategoryController::class,"updateCategory"]);
Route::get("/category/{id}",[CategoryController::class,"deleteCategory"]);



Route::get("/tier",[TierController::class,"tier"])->name("tier.get");
Route::post("/tier",[TierController::class,"uplodetier"])->name("tier.post");
Route::get("/tier/edit/{id}",[TierController::class,"edittier"]);
Route::post("/tier/edit/{id}",[TierController::class,"updatetier"]);
Route::get("/tier/{id}",[TierController::class,"deletetier"]);


Route::get("/size",[SizeController::class,"size"])->name("size.get");
Route::post("/size",[SizeController::class,"uplodesize"])->name("size.post");
Route::get("/size/edit/{id}",[SizeController::class,"editsize"]);
Route::post("/size/edit/{id}",[SizeController::class,"updatesize"]);
Route::get("/size/{id}",[SizeController::class,"deletesize"]);



Route::get("/price",[PriceController::class,"price"])->name("price.get");
Route::post("/price",[PriceController::class,"uplodeprice"])->name("price.post");
Route::get("/price/edit/{id}",[PriceController::class,"editprice"]);
Route::post("/price/edit/{id}",[PriceController::class,"updateprice"]);
Route::get("/price/{id}",[PriceController::class,"deleteprice"]);


Route::get("/subcategory",[SubCategoryController::class,"subcategory"])->name("subcategory.get");
Route::post("/subcategory",[SubCategoryController::class,"uplodesubcategory"])->name("subcategory.post");
Route::get("/subcategory/edit/{id}",[SubCategoryController::class,"editsubcategory"]);
Route::patch("/subcategory/edit/{id}",[SubCategoryController::class,"updatesubcategory"]);
Route::get("/subcategory/{id}",[SubCategoryController::class,"deletesubcategory"]);



Route::get("/flavor",[FlavorController::class,"flavor"])->name("flavor.get");
Route::post("/flavor",[FlavorController::class,"uplodeflavor"])->name("flavor.post");
Route::get("/flavor/edit/{id}",[FlavorController::class,"editflavor"]);
Route::patch("/flavor/edit/{id}",[FlavorController::class,"updateflavor"]);
Route::get("/flavor/{id}",[FlavorController::class,"deleteflavor"]);




Route::get("/flavorprice",[FlavorWithPriceController::class,"flavorprice"])->name("flavorprice.get");
Route::post("/flavorprice",[FlavorWithPriceController::class,"uplodeflavorprice"])->name("flavorprice.post");
Route::get("/flavorprice/edit/{id}",[FlavorWithPriceController::class,"editflavorprice"]);
Route::patch("/flavorprice/edit/{id}",[FlavorWithPriceController::class,"updateflavorprice"]);
Route::get("/flavorprice/{id}",[FlavorWithPriceController::class,"deleteflavorprice"]);


Route::get("/cakesizewithprice",[CakeSizeWithPriceController::class,"cakesizewithprice"])->name("cakesizewithprice.get");
Route::post("/cakesizewithprice",[CakeSizeWithPriceController::class,"uplodecakesizewithprice"])->name("cakesizewithprice.post");
Route::get("/cakesizewithprice/edit/{id}",[CakeSizeWithPriceController::class,"editcakesizewithprice"]);
Route::patch("/cakesizewithprice/edit/{id}",[CakeSizeWithPriceController::class,"updatecakesizewithprice"]);
Route::get("/cakesizewithprice/{id}",[CakeSizeWithPriceController::class,"deletecakesizewithprice"]);



//user view roughts ------------------------------------------------------------------------------------------------

// Route::get("/cake/{id}",[PurchaseController::class,"index"]);

