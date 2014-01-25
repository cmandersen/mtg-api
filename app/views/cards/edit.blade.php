@extends('layouts.scaffold')

@section('main')

<h1>Edit Card</h1>
{{ Form::model($card, array('method' => 'PATCH', 'route' => array('cards.update', $card->id))) }}
	<ul>
        <li>
            {{ Form::label('title', 'Title:') }}
            {{ Form::text('title') }}
        </li>

        <li>
            {{ Form::label('mana', 'Mana:') }}
            {{ Form::text('mana') }}
        </li>

        <li>
            {{ Form::label('type', 'Type:') }}
            {{ Form::text('type') }}
        </li>

        <li>
            {{ Form::label('text', 'Text:') }}
            {{ Form::text('text') }}
        </li>

        <li>
            {{ Form::label('flavor', 'Flavor:') }}
            {{ Form::text('flavor') }}
        </li>

        <li>
            {{ Form::label('power', 'Power:') }}
            {{ Form::input('number', 'power') }}
        </li>

        <li>
            {{ Form::label('toughness', 'Toughness:') }}
            {{ Form::input('number', 'toughness') }}
        </li>

        <li>
            {{ Form::label('rarity', 'Rarity:') }}
            {{ Form::text('rarity') }}
        </li>

        <li>
            {{ Form::label('image', 'Image:') }}
            {{ Form::text('image') }}
        </li>

        <li>
            {{ Form::label('color', 'Color:') }}
            {{ Form::text('color') }}
        </li>

        <li>
            {{ Form::label('set', 'Set:') }}
            {{ Form::text('set') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('cards.show', 'Cancel', $card->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
