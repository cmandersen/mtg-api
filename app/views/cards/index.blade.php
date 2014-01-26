@extends('layouts.scaffold')

@section('main')

<h1>Cards</h1>

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
