@extends('layouts.scaffold')

@section('main')

<h1>Show Card</h1>

<p>{{ link_to_route('cards.index', 'Return to all cards') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Title</th>
				<th>Mana</th>
				<th>Type</th>
				<th>Text</th>
				<th>Flavor</th>
				<th>Power</th>
				<th>Toughness</th>
				<th>Rarity</th>
				<th>Image</th>
				<th>Color</th>
				<th>Set</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $card->title }}}</td>
					<td>{{{ $card->mana }}}</td>
					<td>{{{ $card->type }}}</td>
					<td>{{{ $card->text }}}</td>
					<td>{{{ $card->flavor }}}</td>
					<td>{{{ $card->power }}}</td>
					<td>{{{ $card->toughness }}}</td>
					<td>{{{ $card->rarity }}}</td>
					<td>{{{ $card->image }}}</td>
					<td>{{{ $card->color }}}</td>
					<td>{{{ $card->set }}}</td>
                    <td>{{ link_to_route('cards.edit', 'Edit', array($card->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('cards.destroy', $card->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop