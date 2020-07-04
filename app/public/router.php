<?php

function Autoloader($className)
{
	$paths = [
		'../src/controllers/',
		'../src/models/'
	];

	foreach ($paths as $path)
	{
		if (file_exists($path.$className.'.php'))
		{
			require_once($path.$className.'.php');
			break;
		}
		else if (file_exists('../'.$path.$className.'.php'))
		{
			require_once('../'.$path.$className.'.php');
			break;
		}
	}
}

spl_autoload_register('Autoloader');

?>
