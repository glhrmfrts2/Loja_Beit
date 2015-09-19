<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//$route['administraitor'] = 'painel/';
$route['produtos'] = "appsite/produtos";
$route['_produtos/(:any)'] = "appsite/get_produtos/$1";
$route['default_controller'] = "appsite";
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
