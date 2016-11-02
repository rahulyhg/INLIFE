<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
  |--------------------------------------------------------------------------
  | File and Directory Modes
  |--------------------------------------------------------------------------
  |
  | These prefs are used when checking and setting modes when working
  | with the file system.  The defaults are fine on servers with proper
  | security, but you may wish (or even need) to change the values in
  | certain environments (Apache running a separate process for each
  | user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
  | always be used to set the mode correctly.
  |
 */
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
  |--------------------------------------------------------------------------
  | File Stream Modes
  |--------------------------------------------------------------------------
  |
  | These modes are used when working with fopen()/popen()
  |
 */

define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
  |--------------------------------------------------------------------------
  | Custom
  |--------------------------------------------------------------------------
  |
 */

define('IMAGES', 'resources/img/');
define('JS', 'resources/js/');
define('XML', 'resources/xml/');
define('CSS', 'resources/css/');
define('FONTS', 'resources/font-awesome/');
define('ICONS', 'resources/ico/');
define('UPLOAD', 'resources/upload/');
define('ROOTCONTROLER', 'application/controllers/');
define('ROOTVIEW', 'application/views/');
define('ROOTMODEL', 'application/models/');

/*
  |--------------------------------------------------------------------------
  | INLIFE CONSTANTS DEVELOPMENT
  |--------------------------------------------------------------------------
  |


define('NLF_LOCALHOST', 'http://localhost/');
define('NLF_LOCALHOST_ROOT', $_SERVER['DOCUMENT_ROOT'] . "/");
define('NLF_SWEET_ROOT_BIN', NLF_LOCALHOST . 'VITALCORECONNECTION/InLife/INLIFE_CORE_PROYECT/core/sweph/bin/');
define('NLF_SWEET_ROOT_DOCUMENT_BIN', NLF_LOCALHOST_ROOT . 'VITALCORECONNECTION/InLife/INLIFE_CORE_PROYECT/core/sweph/bin/');
define('URL_RESOURCES_WEB', NLF_LOCALHOST . '/VITALCORECONNECTION/InLife/INLIFE_CORE_PROYECT/inlife_core_resources/');
define('URL_RESOURCES_ROOT', NLF_LOCALHOST_ROOT . '/VITALCORECONNECTION/InLife/INLIFE_CORE_PROYECT/inlife_core_resources/');

 */


/*
  |--------------------------------------------------------------------------
  | INLIFE CONSTANTS DEVELOPMENT IG
  |--------------------------------------------------------------------------
  |
 */

define('NLF_LOCALHOST', 'http://localhost/');
define('NLF_LOCALHOST_ROOT', $_SERVER['DOCUMENT_ROOT'] . "/");
define('NLF_SWEET_ROOT_BIN', NLF_LOCALHOST . 'INLIFE/core/sweph/bin/');
define('NLF_SWEET_ROOT_DOCUMENT_BIN', NLF_LOCALHOST_ROOT . 'INLIFE/core/sweph/bin/');
define('URL_RESOURCES_WEB', NLF_LOCALHOST . '/INLIFE/inlife_core_resources/');
define('URL_RESOURCES_ROOT', NLF_LOCALHOST_ROOT . '/INLIFE/inlife_core_resources/');





/*
  |--------------------------------------------------------------------------
  | INLIFE CONSTANTS PRODUCTION
  |--------------------------------------------------------------------------
  |
 */

//define('NLF_LOCALHOST', 'http://inlife.com.co/');
//define('NLF_LOCALHOST_ROOT', $_SERVER['DOCUMENT_ROOT'] . "/");
//define('NLF_SWEET_ROOT_BIN', NLF_LOCALHOST . 'core/sweph/bin/');
//define('NLF_SWEET_ROOT_DOCUMENT_BIN', NLF_LOCALHOST_ROOT . 'core/sweph/bin/');
//define('URL_RESOURCES_WEB', LOCALHOST . '/inlife_core_resources/');
//define('URL_RESOURCES_ROOT', DOCUMENT_ROOT . '/inlife_core_resources/');