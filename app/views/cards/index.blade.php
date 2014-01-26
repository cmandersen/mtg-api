@extends('layouts.scaffold')

@section('title') Cards @stop

@section('main')

<h1>Cards</h1>
<div class="row-fluid">
	<div class="btn-group">
		<div class="btn-group">
		  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
		    Begins with <span class="caret"></span>
		  </button>
		  <ul class="dropdown-menu" role="menu">
		    <li><a href="?begins=a">A</a></li>
		    <li><a href="?begins=b">B</a></li>
		  </ul>
		</div>
	</div>
</div> 
@if ($cards->count())
	<div class="row">
	@foreach ($cards as $index => $card)
		@if(($index+1) > 4 && 4 % ($index+1) === 0)
	</div>
	<div class="row">
		@endif

		<div class="col-md-3 col-sm-6">
			<div class="thumbnail">
				<strong>{{{ $card->title }}}</strong>
				<img src="{{{ $card->image }}}">
			</div>
		</div>
	@endforeach
	</div>
@else
	There are no cards
@endif

@stop
