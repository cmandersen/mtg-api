@extends('layouts.scaffold')

@section('title')Planes @stop
@section('script')
	<script type="text/javascript" src="/media/js/modalNavigation.js"></script>
@stop

@section('main')

<h1>Planes</h1>
<div class="row-fluid">
<a href="/planes?randomize=1" class="btn btn-default"><i class="fa fa-random"></i> Random</a>
</div> <br />
@if ($planes->count())
	<div class="row">
	@foreach ($planes as $index => $plane)
		@if(($index+1) > 4 && 4 % ($index+1) === 0)
	</div>
	<div class="row">
		@endif

		<div class="col-md-3 col-sm-6" data-toggle="modal" data-target="#planeModal{{{ $plane->id }}}">
			<div class="thumbnail">
				<strong>{{{ $plane->title }}}</strong>
				<img src="{{{ $plane->image }}}">
			</div>
		</div>
		<!-- Modal -->
		<div class="modal fade" id="planeModal{{{ $plane->id }}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		        	<img src="{{{ $plane->image }}}" class="img-responsive img-rounded">
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	@endforeach
	</div>
@else
	There are no planes
@endif

@stop
