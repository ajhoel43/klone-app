<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/

function genderString( $gender ){
	switch ($gender) {
		case 'L':
			return 'Laki-Laki';
			break;
		case 'P':
			return 'Perempuan';
			break;
		default:
			return 'Error';
			break;
	}
}

function genderInt( $gender ){
	switch ($gender) {
		case 'L':
			return 1;
			break;
		case 'P':
			return 2;
			break;
		default:
			return 0;
			break;
	}
}