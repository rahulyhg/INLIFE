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

/* * *********************  DESARROLLO  *************************  
  define('LOCALHOST', 'http://localhost');
  define('CORE_RESOURCES', 'inlife_core_resources/');
  define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);
  define('URL_RESOURCES_WEB', LOCALHOST . '/VITALCORECONNECTION/InLife/INLIFE_CORE_PROYECT/inlife_core_resources/');
  define('URL_RESOURCES_ROOT', DOCUMENT_ROOT . '/VITALCORECONNECTION/InLife/INLIFE_CORE_PROYECT/inlife_core_resources/');
  define('INLIFE_CORE_SERVICES', LOCALHOST . '/VITALCORECONNECTION/InLife/INLIFE_CORE_PROYECT/com.inlife.core/');

*/

/* * *********************  DESARROLLO IG *************************  
  define('LOCALHOST', 'http://localhost');
  define('CORE_RESOURCES', 'inlife_core_resources/');
  define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);
  define('URL_RESOURCES_WEB', LOCALHOST . '/VITALCORECONNECTION/InLife/INLIFE_CORE_PROYECT/inlife_core_resources/');
  define('URL_RESOURCES_ROOT', DOCUMENT_ROOT . '/VITALCORECONNECTION/InLife/INLIFE_CORE_PROYECT/inlife_core_resources/');
  define('INLIFE_CORE_SERVICES', LOCALHOST . '/VITALCORECONNECTION/InLife/INLIFE_CORE_PROYECT/com.inlife.core/');

*/


/* * *********************  PRODUCCION  *************  
define('LOCALHOST', 'http://inlife.com.co');
define('CORE_RESOURCES', 'inlife_core_resources/');
define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('URL_RESOURCES_WEB', LOCALHOST . '/inlife_core_resources/');
define('URL_RESOURCES_ROOT', DOCUMENT_ROOT . '/inlife_core_resources/');
 
 */

