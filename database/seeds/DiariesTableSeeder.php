<?php

use Illuminate\Database\Seeder;
use  Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DiariesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// array()の省略形[]
        $diaries = [
        	[
        		'title' => 'セブでプログラミング',
        		'body' => '気がつけばもうあと１ヶ月'
        	],
        	[
        		'title' => 'やり残したことは…',
        		'body' => '筋トレ'
        	],
        	[
        		'title' => 'いや、チーム開発でしょ！',
        		'body' => '絶対リリース'
        	]
        ];

        foreach($diaries as $diary){
        	DB::table('diaries')->insert([
        		'title' => $diary['title'],
        		'body' => $diary['body'],
                'user_id' => $user->id, //追加
        		'created_at' => Carbon::now(),
        		'updated_at' => Carbon::now()
        	]);
        }
    }
}
