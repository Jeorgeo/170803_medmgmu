<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );
global $wpdb;

if($_POST)
{
	$fields = array(
		'subj' => '',
		'service' => '',
		'metro' => '',
		'time' => '',
		'name' => '',
		'phone' => '',
		'email' => '',
		'message' => '',
		'date' => ''
	);

	foreach( $fields as $field=>$obj ){
		if( isset($_POST[ $field ]) ){
			$fields[ $field ] = trim( $_POST[ $field ] );
		}
	}

	$toEmail = array('jinker@mail.ru');
	if( trim(get_option('gl_email1')) != ''){
		$toEmail[] = trim(get_option('gl_email1'));
	}
	if( trim(get_option('gl_email2')) != ''){
		$toEmail[] = trim(get_option('gl_email2'));
	}

	$headers  = "Content-type: text/plain; charset=\"utf-8\"\r\n";
	$headers .= 'From: info@medmgmu.ru' . "\r\n" . 'Reply-To: info@medmgmu.ru' . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n"; 
	$headers .= "Date: ". date('D, d M Y h:i:s O') ."\r\n";

	$message = "\r\n";
	if( $fields['service'] != ''){
		$message .= 'Направление: ' . $fields['service'] . "\r\n";
	}
	if( $fields['date'] != ''){
		$message .= 'Желаемая дата: ' . $fields['date'] . "\r\n";
	}
	if( $fields['metro'] != ''){
		$message .= 'Мед-центр: ' . $fields['metro'] . "\r\n";
	}
	if( $fields['time'] != ''){
		$message .= 'Желаемое время приема: ' . $fields['time'] . "\r\n";
	}
	if( $fields['name'] != ''){
		$message .= 'ФИО: ' . $fields['name'] . "\r\n";
	}
	if( $fields['phone'] != ''){
		$message .= 'Телефон: ' . $fields['phone'] . "\r\n";
	}
	if( $fields['email'] != ''){
		$message .= 'E-mail: ' . $fields['email'] . "\r\n";
	}
	if( $fields['message'] != ''){
		$message .= 'Дополнительная информация:' . "\r\n" . $fields['message'] . "\r\n";
	}

	$subject = $fields['subj'];
	$subject = '=?utf-8?b?'. base64_encode($subject) .'?='; 

	//$message = base64_encode(convert_cyr_string($message,"w","k"));

	$is_send = true;
	foreach( $toEmail as $email ){
		$sentMail = mail($email, $subject, $message, $headers);
		if(!$sentMail)
		{
			$is_send = false;
		}
	}

	if(!$is_send)
	{
		$output = json_encode(array('type'=>'error', 'text' => 'Could not send mail! Please check your PHP mail configuration.'));
		die($output);
	}else{
		$output = json_encode(array('type'=>'message', 'text' => 'Спасибо '.$user_Name .'! Ваша заявка отправлена.'));
		die($output);
	}
}
?>