@extends('curriculum.layout')

@section('style')

@endsection

@section('content')

	<div class="courseDetail-container">
		<div class="content">
			<p class="title">Nana Mizuki Live Adventure</p>
			<span class="list">
				<span class="icon"><i class="fa fa-microphone" aria-hidden="true"></i></span>
				<span class="desc">授課教師</span>
				<span class="content">水樹奈奈</span>
			</span>
			<span class="list">
				<span class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
				<span class="desc">教室位置</span>
				<span class="content">工EC 5012</span>
			</span>
			<span class="list">
				<span class="icon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
				<span class="desc">上課時間</span>
				<span class="content">一 67, 二 8</span>
			</span>
			<span class="list">
				<span class="icon"><i class="fa fa-university" aria-hidden="true"></i></span>
				<span class="desc">開課系所</span>
				<span class="content">音樂系</span>
			</span>
			<span class="list">
				<span class="icon"><i class="fa fa-money" aria-hidden="true"></i></span>
				<span class="desc">課程學分</span>
				<span class="content">10</span>
			</span>
			<div class="btn-collect">
				<span class="btn-list blue-btn">課程評鑑</span>
				<span class="btn-list pink-btn">發送點名通知</span>
				<span class="btn-list mi-btn">發送考試通知</span>
			</div>
		</div>
	</div>

@endsection

@section('scriptArea')

<script src="/Curr/js/views/courseDetail.js"></script>

@endsection