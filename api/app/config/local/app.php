<?php

return array(
	"debug" => true, 

	"providers" => array(
		'Barryvdh\Debugbar\ServiceProvider',
	),

	"aliases" => array(
		'Debugbar' => 'Barryvdh\Debugbar\Facade',
	),
);