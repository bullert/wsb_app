<?php

// spl_autoload_register(function($class)
// {
// 	$prefix = 'app\\';
//
// 	$length = strlen($prefix);
//
// 	$base_directory = __DIR__ . '/app/';
//
// 	if (strncmp($prefix, $class, $length) !== 0)
// 	{
// 		return;
// 	}
//
// 	$class_end = substr($class, $length);
//
// 	$file = $base_directory . str_replace('\\', '/', $class_end) . '.php';
// 	echo $file;
//
// 	if (file_exists($file))
// 	{
// 		require $file;
// 	}
// });

// spl_autoload_register('Autoloader');
// spl_autoload_register('Autoloader2');

// class Autoloader
// {
// 	public static function ControllersLoader($className)
// 	{
// 		$path = '../src/controllers/';
// 	    include $path.$className.'.php';
// 	}
//
// 	public static function ModelsLoader($className)
// 	{
// 		$path = '../src/models/';
// 	    include $path.$className.'.php';
// 	}
// }

// function Autoloader($className)
// {
// 	$class = str_replace('\\', DIRECTORY_SEPARATOR, $className);
// 	echo $class;
// 	$paths = [
// 		'../src/controllers/DatabaseController.php',
// 		'../src/controllers/DirectHUBController.php',
// 		'../src/controllers/SessionController.php',
// 		'../src/controllers/ValidationController.php',
// 		'../src/models/User.php',
// 		'../src/models/Validator.php'
// 	];
//
// 	foreach ($paths as $templatePath) {
//
// 		$path = str_replace(["\\", "file"], [DIRECTORY_SEPARATOR, $class], $templatePath);
// 		if (file_exists($path))
// 		{
// 		    require_once "$path";
// 			// echo "$path";
// 		    break;
// 		}
// 	}
// }

function Autoloader($className)
{
	// echo __DIR__;
	$paths = [
		'../src/controllers/',
		'../src/models/'
	];
	// echo $className;
	foreach ($paths as $path)
	{
		// echo "a".file_exists($path.$className.'.php')."a";
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
