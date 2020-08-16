<?php

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

use Illuminate\Support\Facades\Route;

Auth::routes();
Route::resource('pertanyaan', 'PertanyaanController');

Route::get('/', 'HomeController@index')->name('home.index');
// Route::get('/home', 'HomeController@index')->name('home');

//ROUTE MENENTUKAN JAWABAN TEPAT
Route::get('/pertanyaan/{pertanyaan}/edit/{jawaban}', 'PertanyaanController@tepat')->name('pertanyaan.tepat');

//ROUTE MENAMBAH JAWABAN
Route::post('/pertanyaan/{pertanyaan}/jawaban', 'JawabanController@store')->name('jawaban.store');
Route::get('/pertanyaan/{pertanyaan}/jawaban/{jawaban}/edit', 'JawabanController@edit')->name('jawaban.edit');
Route::put('/pertanyaan/{pertanyaan}/jawaban/{jawaban}', 'JawabanController@update')->name('jawaban.update');

//ROUTE MENAMBAH KOMENTAR
Route::post('/komentar/pertanyaan/{pertanyaan}', 'KomentarController@pertanyaan')->name('komentar.pertanyaan');
Route::post('/komentar/pertanyaan/{pertanyaan}/jawaban/{jawaban}', 'KomentarController@jawaban')->name('komentar.jawaban');
Route::delete('/komentar/pertanyaan/{pertanyaan}/{komentar}', 'KomentarController@destroyPertanyaan')->name('komentar.pertanyaanDestroy');
Route::delete('/komentar/pertanyaan/{pertanyaan}/Jawaban/{komentar}', 'KomentarController@destroyJawaban')->name('komentar.jawabanDestroy');

//ROUTE MENAMBAH VOTE
Route::get('/vote/pertanyaan/{pertanyaan}/{poin}', 'VoteController@pertanyaan')->name('vote.pertanyaan');
Route::get('/vote/pertanyaan/{pertanyaan}/jawaban/{jawaban}/{poin}', 'VoteController@jawaban')->name('vote.jawaban');

Route::post('/vote/pertanyaan/{pertanyaan}jawaban/{jawaban}', 'VoteController@jawaban_upvote')->name('vote.jawaban_upvote');
Route::post('/vote/pertanyaan/{pertanyaan}jawaban/{jawaban}', 'VoteController@jawaban_downvote')->name('vote.jawaban_downvote');

// Route::resource('posts', 'PostController');
// Route::resource('postings', 'PostingController')->middleware('auth');



//PACKAGES
// Route::get('/test-dompdf', function(){

//     $pdf = App::make('dompdf.wrapper');
//     $pdf->loadHTML('<h1>Hello World</h1>');
//     return $pdf->stream();

// });
// Route::get('/test-dompdf2', 'PdfController@test');
// Route::get('/posts-export', 'PostController@export');
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
