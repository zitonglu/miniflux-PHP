<?php

// PHP 5.3.3 minimum
if (version_compare(PHP_VERSION, '5.3.3', '<')) {
    die('This software require PHP 5.3.3 minimum');
}

// Checks for PHP < 5.4
if (version_compare(PHP_VERSION, '5.4.0', '<')) {

    // Magic quotes are deprecated since PHP 5.4
    if (get_magic_quotes_gpc()) {
        die('This software require to have "Magic quotes" disabled, it\'s deprecated since PHP 5.4 ("magic_quotes_gpc = Off")');
    }
}

// Old libxml2 version are not supported (Debian Lenny is too old)
if (version_compare(LIBXML_DOTTED_VERSION, '2.7.0', '<')) {
    die('This software require at least libxml2 version 2.7.0');
}

// Check XML functions
if (! function_exists('simplexml_load_string')) {
    die('PHP extension required: SimpleXML');
}

if (! function_exists('xml_parser_create')) {
    die('PHP extension required: XML Parser');
}

if (! function_exists('dom_import_simplexml')) {
    die('PHP extension required: DOM');
}

if (DB_DRIVER === 'sqlite' && ! extension_loaded('pdo_sqlite')) {
    die('PHP extension required: pdo_sqlite');
}

if (DB_DRIVER === 'postgres' && ! extension_loaded('pdo_pgsql')) {
    die('PHP extension required: pdo_pgsql');
}

if (DB_DRIVER === 'mysql' && ! extension_loaded('pdo_mysql')) {
    die('PHP extension required: pdo_mysql');
}

// Check extension: mbstring (simpleValidator)
if (! extension_loaded('mbstring')) {
    die('PHP extension required: mbstring');
}

// Check extension: iconv (picoFeed)
if (! extension_loaded('iconv')) {
    die('PHP extension required: iconv');
}

// Check for curl
if (! function_exists('curl_init') && ! ini_get('allow_url_fopen')) {
    die('You must have "allow_url_fopen=On" or curl extension installed');
}

// Check if /data is writeable
if (! is_writable(DATA_DIRECTORY)) {
    die('The data directory must be writeable by your web server user');
}

// Create favicon folder if missing
if (! is_dir(FAVICON_DIRECTORY)) {
    mkdir(FAVICON_DIRECTORY);
}

// Check if favicon directory is writeable
if (! is_writable(FAVICON_DIRECTORY)) {
    die('The favicon directory must be writeable by your web server user');
}
