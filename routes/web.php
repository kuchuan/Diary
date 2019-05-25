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

// Route::get('/', function () {
//     return view('welcome');
// });

// get('URLリクエスト','対象コントローラー@対象メソッド')
Route::get('/', 'DiaryController@index')->name('diary.index'); //追加

		Route::group(['middleware'=>'auth'],function(){
		Route::get('diary/create', 'DiaryController@create')->name('diary.create');//投稿画面
		Route::post('diary/create', 'DiaryController@store')->name('diary.create');//保存画面

		Route::delete('diary/{id}/delete', 'DiaryController@destory')->name('diary.destory'); //削除処理
		//{}は対応するメソッドの引数になる
});


// オブジェクト指向のクラスメソッド
// オブジェクト「：：」クラスメソッド
// オブジェクト−＞メソッド

//RESTFul設計
//GET取得 POST作成 PATCH更新 DELETE削除の４タイプ
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
