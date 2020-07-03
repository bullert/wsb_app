<?php
global $ds, $base, $url2;
$ds = DIRECTORY_SEPARATOR;
$base = realpath(__DIR__ . $ds . '..') . $ds;
$url2 = 'af';

// RewriteRule ^src/(.+)/(.+)$ http://%{HTTP_HOST}/app/src/$1/$2 [R=301,L]

// echo "{$GLOBALS['base']}src{$GLOBALS['ds']}views{$GLOBALS['ds']}asfs" . ' ' . $GLOBALS['base'];
// "{$GLOBALS['base']}public{$GLOBALS['ds']}assets{$GLOBALS['ds']}{$url}";

function assets($url)
{
	echo '/app/public/assets/' . $url;
}

function components($url)
{
	// include('../../app/src/components/' . $url);
	include_once("{$GLOBALS['base']}src{$GLOBALS['ds']}components{$GLOBALS['ds']}{$url}");
}

function controllers($url)
{
	// include('../../app/src/controllers/' . $url);
	include_once("{$GLOBALS['base']}src{$GLOBALS['ds']}controllers{$GLOBALS['ds']}{$url}");
}

function models($url)
{
	// include('../../app/src/controllers/' . $url);
	include_once("{$GLOBALS['base']}src{$GLOBALS['ds']}models{$GLOBALS['ds']}{$url}");
}

function views($url)
{
	// include('../../app/src/views/' . $url);
	include_once("{$GLOBALS['base']}src{$GLOBALS['ds']}views{$GLOBALS['ds']}{$url}");
}

?>
