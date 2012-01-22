<?php

$lang = '';

// While testing, you can set the locale by hand...
//$lang = "bs_BA.UTF-8";

// ...unless the website has pased a GET value, in which case you can use that instead...
if (isSet($_GET["lang"])) { 
	$lang = $_GET["lang"];
}

// ...or you could do it this way (eventually)
//$lang = locale_accept_from_http($_SERVER['HTTP_ACCEPT_LANGUAGE']);

// Tell the server to use that language
putenv("LANGUAGE=$lang");
setlocale(LC_ALL,$lang);

// This is a way to test that things are going well:
//echo strftime("%A %e %B %Y", mktime(0, 0, 0, 12, 22, 1978));

// Set this to the name of the .po file, but without the .po suffix on the end
$domain = "messages";

// Set this to the location of the translation files.
bindtextdomain($domain, "_locales");
bind_textdomain_codeset($domain, 'UTF-8'); 
textdomain($domain);

?>
