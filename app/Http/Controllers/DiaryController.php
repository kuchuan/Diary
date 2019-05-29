<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Diary; // App/Diaryクラスを使用する宣言（追加）
use App\Http\Requests\CreateDiary;
use Illuminate\Support\Facades\Auth;

class DiaryController extends Controller
//　↑require_once('別のファイル');のイケてる版
{
    public function index()
    {
    	//Authクラス
        // dd(Auth::user()->name);
        // dd(Auth::user()->email);
        // dd('Hello Laravel');
    	// dump and die関数というLaravelに用意された関数
    	// var_dumpとdieを組み合わせたもの
    	//Laravel開発の必須ツールです

        //モデルファイルを使ってデータを取得する
          $diaries = Diary::with('likes')->orderBy('id', 'desc')->get();
        //SELECT * FROM diaries WHERE 1を実行し$diariesに入れる
          // dd($diaries);


    	return view('diaries.index',['diaries' => $diaries]);
    	//view関数はresources/view/内にあるファイルを取得する関数
    	//view('ファイル名')もしくは
    	//view('フォルダ名.ファイル名')のように記述する
    	//＊ファイル名は.bladeの前のみ
    	//例）view('welcome')
    	//例）view('daiaries.edit')
        //＊ファイル名は.bladeは
        //
    }

    public function create(){
        //投稿画面
    	return view('diaries.create');
    }

    public function store(CreateDiary $request){
        //保存処理
        //POST送信のデータの受け取り（以前はS_POSTで受けていた）
        //Laravelでは＄_POSTの代わりにRequestクラスを使う
        // dd($request);
        // INSERT INTO テーブル名 (colum名) VALUE (値)
        // INSET INTO diaries (title. body) VALUE ($_POST['title'], $_POST['body'])
        // INSET INTO diaries (title. body) VALUE ($request ->title, $request->body)
        //ModelクラスDiaryを使用する
        $diary = new Diary();// インスタンス化
        $diary->title = $request->title;
        $diary->body = $request->body;
        $diary->user_id = Auth::user()->id; //追加 ログインしてるユーザーのidを保存
        $diary->save(); //DBに保存

        //一覧ページに戻る（リダイレクト処理）
        return redirect()->route('diary.index');//pureHTMLのheader()と同じ

    }
    public function destory($id){ 
    //web.phpの'diary/{id}/delete'にある{id}と同名の引数が定義される
        // dd($id);
        // DELETE FROM テーブル名 WHERE id=?をLaravelで
        $diary = Diary::find($id);
        // SELECT * FROM daiary WHERE id=?

        $diary->delete();
        //DELETE FROM テーブル名 WHERE id=?

        return redirect()->route('diary.index');
    }

    function edit($id){
        $diary = diary::find($id);
        // SERECT * FROM diaries WHERE id=?
        // $diaryはCollectionという型でできていて、Arrayに変換するにはtoArray()

        return view('diaries.edit',['diary' =>$diary]);
    }
    function update($id, CreateDiary $request){
        $diary = diary::find($id);//一見探してくる

        // $requestがバリデーション機能付きの$_POSTみたいなもの
        $diary->title = $request->title;//値上書き
        $diary->body = $request->body;//
        $diary->save(); //保存

        return redirect()->route('diary.index');
    }
    public function  mypage(){
        // $login_user = auth::user();
        // // dd($login_user->id);
        // $diaries = diary::where('user_id', 1)->get();
        // // where('カラム名', 値)
        // // SELECT * FROM diaries WHERE カラム名=値

        // イケてるやり方
        $login_user =  auth::user();
        $diaries  = $login_user->diaries;

        return view('diaries.mypage', ['diaries' => $diaries]);
    }
    function like($id){
        // idを元にdiaryデータ1件取得
        $diary = Diary::where('id', $id)->with('likes')->first();
        // dd($diary);
        // likesたーブルに選択されているdiaryとログインしているユーザーのidをINSERTする
        $diary->likes()->attach(Auth::user()->id);
        // INSERT INTO likes (diary_id, user_id) VALUES ($diary->id, Auth::user()->id)
        return redirect()->route('diary.index');
    }

}
