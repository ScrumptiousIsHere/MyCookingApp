<?php

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Models\Reteta;
use App\Models\User;
use App\Models\Ingredient;
use App\Models\continutIngredient;

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


Route::get('/dashboard', function () {
    return view('dashboard');
})


    ->middleware(['auth'])->name('dashboard');

Route::get('/',function(){
    if(Auth::user())
   return view('dashboard');
    else return view('dashboard');
});

Route::get('/descoperaretete',function(Reteta $reteta){
    return view('posts',['retete' => \App\Models\Reteta::latest('created_at')->where('is_visible',1)->where('is_active',1)->get(),'numar'=>Reteta::latest('created_at')->count()]);
})->name('descoperaretete');


Route::get('/retetelemele',function(Reteta $reteta){
    return view('retetelemele',['retete' => \App\Models\Reteta::latest('created_at')->where('user_id',Auth::id())->where('is_active',1)->with('autor')->get(),'numar'=>Reteta::latest('created_at')->get()->count()]);
})->middleware(['auth'])->name('retetelemele');
Route::view('form', 'retetelemele');
Route::post('deletereteta', 'App\Http\Controllers\RetetaController@sterge')->middleware(['auth'])->name('deletereteta');

Route::get('/programulmeu',function(){
    return view('programulmeu');
})->middleware(['auth'])->middleware(['setdata'])->name('programulmeu');


Route::get('/descoperaingrediente', function (Ingredient $ingredient) {
    return view('ingrediente-secure',['ingrediente' => \App\Models\Ingredient::latest('created_at')->get()]);
});





//sterge ingredient
Route::get('/ingredientelemele', function (Ingredient $ingredient,continutIngredient $continut) {
    return view('ingrediente',['ingrediente' => \App\Models\Ingredient::latest('created_at')->where('user_id',Auth::id())->where('is_active',1)->get()    ]);
})->middleware(['auth'])->name('ingredientelemele');
Route::view('form', 'ingredientelemele');
Route::post('deleteingredient', 'App\Http\Controllers\IngredientController@sterge')->middleware(['auth'])->name('deleteingredient');




//modifica un ingredient
Route::get('/editingredient/{ingredient:id}',function(Ingredient $ingredient){
   if($ingredient->user->id==Auth::id())
    return view('editingredient',['ingredient'=>$ingredient]);
   else abort(403);
})->middleware(['auth'])->name('editingredient');
Route::view('form', 'editingredient');
Route::post('editingredient/submitupdateingredient/{id}', 'App\Http\Controllers\IngredientController@modifica')->middleware(['auth'])->name('updateingredient');






Route::get('/retete/{reteta}', function (Reteta $reteta) {
    return view('post', ['reteta' => $reteta]);
})->name('viewreteta');

Route::get('/autori/{autor:username}', function (User $autor) {
    return view('posts', ['retete' => $autor->reteta,'numar'=>Reteta::latest('created_at')->where('user_id',$autor->id)->get()->count()]);
});






Route::get('/adaugaingredient', function () {

    return view('adaugaingredient',[]);

})->middleware(['auth'])->name('adaugaingredient');
Route::view('form', 'adaugaingredient');
Route::post('submitingredient', 'App\Http\Controllers\IngredientController@saveData')->middleware(['auth'])->name('submitingredient');







Route::get('/scriereview/{reteta:id}',function (Reteta $reteta){
    return view('scriereview',['reteta'=>$reteta]);
})->middleware(['auth'])->name('scriereview');
Route::view('form', 'scriereview');
Route::post('scriereview/submitreview/{id}', 'App\Http\Controllers\ReviewController@saveData')->middleware(['auth'])->name('submitreview');






Route::get('/adaugareteta','App\Http\Controllers\RetetaController@getIngredients')->middleware(['auth'])->name('adaugareteta');
Route::view('form', 'adaugareteta');
Route::post('submitreteta', 'App\Http\Controllers\RetetaController@saveData')->middleware(['auth'])->name('submitreteta');






Route::get('/setdata', function(){
    return view('setdata',[]);
})->middleware(['auth'])->name('setdata');
Route::view('form','setdata');
Route::post('submitdata', 'App\Http\Controllers\UserController@saveCaracteristici')->middleware(['auth'])->name('submitdata');


Route::get('/form',function() {
    return view('form');
});


Route::get('submitcauta','App\Http\Controllers\RetetaController@cauta')->name('submitsearch');



Route::get('addfavorite','App\Http\Controllers\FavoritController@data')->name('submitfavorit');




Route::get('/scriereport/{reteta:id}',function (Reteta $reteta){
    return view('scriereport',['reteta'=>$reteta]);
})->middleware(['auth'])->name('scriereview');
Route::view('form', 'scriereport');
Route::post('scriereport/submitreport/{id}', 'App\Http\Controllers\ReportController@data')->middleware(['auth'])->name('submitreport');




Route::get('/search',function($details){
       return view('cautare',['details'=>$details]);
})->name('cautare');


Route::get('favorite','App\Http\Controllers\FavoritController@show')->name('showfav');


Route::get('/ingredient/{ingredient:id}',function (Ingredient $ingredient){
    return view('ingredient',['ingredient'=>$ingredient]);
})->name('ingredient');


Route::get('/admin', function(Report $report){
    if(Auth::user()->is_admin==1)
    return view('admin',['report'=>Report::latest()->where('is_active',1)->first()]);
    else abort('403');
})->middleware(['auth'])->name('administrator');

Route::get('/comparaingrediente','App\Http\Controllers\RetetaController@getIngredientsComp')->middleware(['auth'])->name('comparatie');


Route::get('/getvaloricomparatie/{ingredient:id}','App\Http\Controllers\IngredientController@getContents')->name('fetchvalori');

Route::get('/filtreazadupaingredient','App\Http\Controllers\IngredientController@filterIngredient')->name('filteringredient');


Route::post('deletereport', 'App\Http\Controllers\ReportController@sterge')->middleware(['auth'])->name('deletereport');
require __DIR__.'/auth.php';

Route::post('ignorereport', 'App\Http\Controllers\ReportController@sariPeste')->middleware(['auth'])->name('ignorereport');

Route::get('/functie','App\Http\Controllers\RetetaController@startProgram')->middleware(['auth']);

Route::get('/zi',function($program){
   return view('generatie',['program'=>$program]);
})->name('zi')->middleware(['auth']);
