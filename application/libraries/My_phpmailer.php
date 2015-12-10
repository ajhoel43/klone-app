<?php  if ( !defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
class My_phpmailer
{
	protected $CI;

	public function __construct()
	{
		$this->CI=& get_instance();
		require_once(APPPATH.'third_party/phpmailer/PHPMailerAutoload.php');
	}

	public function smtp_googlemail($destn = array(), $mparams = array(), $params = array(), $config = array())
	{
		// Set Default Account & Mail Template
		$params = array(
			'username' => 'at.klone.app@gmail.com',
			'password' => 'electronicmind',
			'from' => 'noreply@kloneapp.com',
			'name' => 'Klone App',
			'subject' => 'Account Verification',
			'body' => 'views/templates/verification_mail.html',
			'altbody' => 'Alternative Body Mail',
			);

		// Set Default Configuration for Server
		$config = array(
			'smtpauth' => true,
			'smtpsecure' => 'ssl',
			'host' => 'smtp.gmail.com',
			'port' => 465
			);

		$message = file_get_contents(APPPATH.$params['body']);
		if(isset($mparams['user']))
		{
			$message = str_replace('%user%', $mparams['user'], $message);
			$message = str_replace('%link%', $mparams['link'], $message);
		}

		$mail = new PHPMailer();
        $mail->IsSMTP(); // we are going to use SMTP
        // $mail->SMTPDebug = 0; // view Debug
        $mail->SMTPAuth = $config['smtpauth']; // enabled SMTP authentication
        $mail->SMTPSecure = $config['smtpsecure']; // prefix for secure protocol to connect to the server
        $mail->Host = $config['host']; // setting GMail as our SMTP server
        $mail->Port = $config['port']; // SMTP port to connect to GMail

        $mail->Username = $params['username']; // user email address
        $mail->Password = $params['password']; // password in GMail
        $mail->SetFrom($params['from'], $params['name']);  //Who is sending the email
        // $mail->AddReplyTo($params['username'], $params['name']);  //email address that receives the response
        $mail->Subject = $params['subject'];
        $mail->msgHTML($message);
        $mail->AltBody = strip_tags($message);
        
        $mail->AddAddress($destn['email'], $destn['name']);

        // $mail->AddAttachment("images/phpmailer.gif");      // some attached files
        // $mail->AddAttachment("images/phpmailer_mini.gif"); // as many as you want
        $sending = $mail->Send();
        
        if(!$sending) {
            $data["message"] = "Error: " . $mail->ErrorInfo;
            // return array(false, $data['message']);
            return false;
        } else {
            $data["message"] = "Message sent correctly!";
            // return array(true, $data['message']);
            return true;
        }
	}
}