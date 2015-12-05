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

function return_flag( $bool )
{
	if( $bool )
		return 1;
	else
		return 0;
}

function insert_flag( $bool )
{
	if( $bool )
		return lang('message_success_insert');
	else
		return lang('message_error_insert');
}

function update_flag( $bool )
{
	if( $bool )
		return lang('message_success_update');
	else
		return lang('message_error_update');
}

function delete_flag( $bool )
{
	if( $bool )
		return lang('message_success_delete');
	else
		return lang('message_error_delete');
}

function to_db_date($string)
{
	if($string)
	{
		$string = date('Y-m-d', strtotime($string));
	}

	return $string;
}

function datePrint($string)
{
	if($string)
	{
		$string = date('d-M-Y', strtotime($string));
	}

	return $string;
}

function reverseDate($strDate)
{
    if ( $strDate )
    {
        $buffer = explode( '-' , $strDate );
        $first = $buffer[2];
        $mid = $buffer[1];
        $last = $buffer[0];

        return $first.'-'.$mid.'-'.$last;
    }
    else
    {
        return $strDate;
    }
}

function year_list()
{
	$year = array();
	$now = date('Y');
	$minyear = 1985;
	for($i=$minyear;$i<=$now;$i++)
	{
		$year[$i] = $i;
	}
	return $year;
}

function month_list()
{
	$month = array(
		1 => lang('januari'),
		2 => lang('februari'),
		3 => lang('maret'),
		4 => lang('april'),
		5 => lang('mei'),
		6 => lang('juni'),
		7 => lang('juli'),
		8 => lang('agustus'),
		9 => lang('september'),
		10 => lang('oktober'),
		11 => lang('november'),
		12 => lang('desember')
		);
	
	return $month;	
}

function date_list()
{
	$date = array();
	for($i=1;$i<=31;$i++){
		$date[$i] = $i;
	}

	return $date;
}

function userStatus($int)
{
	switch ($int) {
		case 1:
			return 'Active';
			break;
		
		default:
			return 'Inactive';
			break;
	}
}

function dashDateExplode($string)
{
	$check = explode("-", $string);
	$yfirst = strlen($check[0]);

	if($yfirst >= 4)
		$stringnew = date('d-m-Y', strtotime($string));
	else
		$stringnew = $string;

	$string = explode("-", $stringnew);
	$date = $string[0];
	$month = $string[1];
	$year = $string[2];

	return array($date, $month, $year);
}
