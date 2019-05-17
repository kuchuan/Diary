<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiaryController extends Controller
//　↑require_once('別のファイル');のイケてる版
{
    public function index()
    {
    	// dd('Hello Laravel');
    	// dump and die関数というLaravelに用意された関数
    	// var_dumpとdieを組み合わせたもの
    	//Laravel開発の必須ツールです

    	return view('diaries.index');
    	//view関数はresources/view/内にあるファイルを取得する関数
    	//view('ファイル名')もしくは
    	//view('フォルダ名.ファイル名')のように記述する
    	//＊ファイル名は.bladeの前のみ
    	//例）view('welcome')
    	//例）view('daiaries.edit')
    }

    public function create(){
    	return view('diaries.create');
    }
}
