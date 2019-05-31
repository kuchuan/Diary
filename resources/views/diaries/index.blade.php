@extends('layout')

@section('title')
Diary 一覧
@endsection

@section('content')

{{-- 画像の表示 --}}
<img src="/img/6000.jpg" alt="">

 <a href="{{ route('diary.create') }}" class ="btn btn-primary">新規投稿</a>
	@foreach ($diaries as $diary)
		<div class="m-4 p-4 border border-primary">
			<p>{{ $diary['title'] }}</p>
			<p>{{ $diary['body'] }}</p>
			@if($dairy->img_url)
			  <img src="{{ str_replace('pubic/', 'storage', $diary->img_url) }}">
			@endif
			<p>{{ $diary['created_at'] }}</p>

	@if(Auth::check() && Auth::user()->id == $diary['user_id'])
			<a class="btn btn-outline-success" href="{{ route('diary.edit', ['id' => $diary['id']]) }}"><i class="fas fa-edit">：編集</i></a>

			<form action="{{ route('diary.destory', ['id' => $diary['id']]) }}" method="POST" class="d-inline">
				@csrf
				@method('delete')
				<button class="btn btn-outline-danger"><i class="fas fa-trash-alt">：削除</i></button>
			</form>
		@endif
		{{-- いいね機能まわりの表示 --}}
		{{-- <div class="mt-3 ml-3"> --}}
			@if(auth::check() && $diary->likes->contains(function($user){
				return $user->id == auth::user()->id;
			}))
				{{-- おおねされていたら、いいねを取り消すぼたんを設置 --}}
			<form style="display: inline;" method="POST" action="{{ route('diary.dislike', ['id' => $diary['id']])}}">
				@csrf
				<button type="submit" class="btn btn-outline-danger">
					<i class="fas fa-thumbs-up">
						<span>{{ $diary->likes->count() }}</span> {{-- 仮に100 --}}
					</i>
				</button>
			</form>
			@else
			{{-- いいねされていなければ、いいねボタンを設置 --}}
			<form style="display: inline;" method="POST" action="{{ route('diary.like', ['id' => $diary['id']])}}">
				@csrf
				<button type="submit" class="btn btn-outline-primary">
					<i class="fas fa-thumbs-up">
						<span>{{ $diary->likes->count() }}</span> {{-- 仮に100 --}}
					</i>
				</button>
			</form>
			@endif
		{{-- </div> --}}
		</div>
	@endforeach
@endsection