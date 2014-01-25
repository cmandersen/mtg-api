<?php

return array(
	'providers' => array(
		'Barryvdh\Debugbar\ServiceProvider',
		'Way\Generators\GeneratorsServiceProvider',
	),

	'aliases' => array(
		'Debugbar' => 'Barryvhh\Debugbar\Facade'
	),
);