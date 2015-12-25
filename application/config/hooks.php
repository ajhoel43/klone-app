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

function tempHash($string, $option)
{
	$pass = password_hash($string, PASSWORD_BCRYPT, $option);
	return $pass;
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

function report_flag($code, $msg)
{
	if($code === 0)
		$msg = '<div class="text-danger">'.$msg.'</div>';
	else if($code === 1)
		$msg = '<div>'.$msg.'</div>';
	else
		$msg = '<div class="text-warning">'.$msg.'</div>';

	return sprintf('%s@@%s@@', $code, $msg);
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

function get_time_stamp($date = null)
{
	if($date)
		$string = date('Y-m-d H:i:s', strtotime($date));
	else
		$string = date('Y-m-d H:i:s');

	return $string;
}

function post_time_stamp($date)
{
	$string = date('d-M-Y H:i:s', strtotime($date));

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
	$year[''] = lang('date_year');
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
		'' => lang('date_month'),
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
	$date[''] = lang('date_date');
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

function is_super($int)
{
	$int = (int)$int;
	if($int == 4)
		return true;
	else
		return false;
}

function is_admin($int)
{
	$int = (int)$int;
	if($int == 3)
		return true;
	else
		return false;
}

function is_owner($int)
{
	$int = (int)$int;
	if($int == 2)
		return true;
	else
		return false;
}

function _valid_email($subject)
{
	$subject = strtolower($subject);
	$string = preg_match('/(^[A-Za-z]{1}\w*([._%~-]\w+)?)@\w+[._%~-]?\w+[.](\w*[^ ]+\w)\z/', $subject);

	if(!$string)
		return false;
	else
		return true;
}

function _is_number($value)
{
	$filter = preg_match('/[0-9]+\z/', $value);

	if($filter)
		return true;
	else
		return false;
}

function _generateCode() 
{
	$length = 10;
	$char = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
	$karakter = preg_replace("/[^A-Za-z0-9]/",'', $char);
	//set string = null
	$string = '';
	for ($i = 0; $i < $length; $i++) 
	{
		$pos = rand(0, strlen($karakter)-1);
		$string .= $karakter{$pos};
	}
	
	return $string;
}

function load_pagination_config()
{
	$config['full_tag_open'] = '<ul class="pagination">';
	$config['full_tag_close'] = '</ul>';
	$config['first_link'] = '<span class="glyphicon glyphicon-chevron-left"></span><span class="glyphicon glyphicon-chevron-left"></span> First';
	$config['last_link'] = 'Last <span class="glyphicon glyphicon-chevron-right"></span><span class="glyphicon glyphicon-chevron-right"></span>';
	$config['prev_link'] = '<span class="glyphicon glyphicon-chevron-left"></span> Prev';
	$config['next_link'] = 'Next <span class="glyphicon glyphicon-chevron-right"></span>';
	$config['first_tag_open'] = '<li>';
	$config['first_tag_close'] = '</li>';
	$config['last_tag_open'] = '<li>';
	$config['last_tag_close'] = '</li>';
	$config['prev_tag_open'] = '<li>';
	$config['prev_tag_close'] = '</li>';
	$config['next_tag_open'] = '<li>';
	$config['next_tag_close'] = '</li>';
	$config['cur_tag_open'] = '<li class="active"><a>';
	$config['cur_tag_close'] = '</a></li>';
	$config['num_tag_open'] = '<li>';
	$config['num_tag_close'] = '</li>';

	return $config;
}

function type_kend_dropdown()
{
	$buffer = array();
	$buffer[''] = '- Select Type -';
	$buffer['motor'] = 'Motor';
	$buffer['mobil'] = 'Mobil';
	$buffer['truck'] = 'Truk';

	return $buffer;
}