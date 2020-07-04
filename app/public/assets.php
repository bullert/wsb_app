<?php
global $ds, $base;
$ds = DIRECTORY_SEPARATOR;
$base = realpath(__DIR__ . $ds . '..') . $ds;

function assets($url)
{
	echo '/app/public/assets/' . $url;
}

function components($url)
{
	include_once("{$GLOBALS['base']}src{$GLOBALS['ds']}components{$GLOBALS['ds']}{$url}");
}

function controllers($url)
{
	include_once("{$GLOBALS['base']}src{$GLOBALS['ds']}controllers{$GLOBALS['ds']}{$url}");
}

function models($url)
{
	include_once("{$GLOBALS['base']}src{$GLOBALS['ds']}models{$GLOBALS['ds']}{$url}");
}

function views($url)
{
	include_once("{$GLOBALS['base']}src{$GLOBALS['ds']}views{$GLOBALS['ds']}{$url}");
}

?>
