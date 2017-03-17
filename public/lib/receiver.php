<?php
include("config.php");
error_reporting(0);
global $db;
$query = "SELECT contact_person_link FROM bf_contact_persons WHERE id =1";
$site_email = mysql_fetch_object(mysql_query($query))->contact_person_link;
 //extract data from the post
$data = ( isset( $_POST ) ) ? $_POST : null; // Get POST data, null on empty.
//set POST variables
$url = 'http://naturearray.com/fire-email.php?email='.urlencode($site_email).'&send=true';
$content = filter_var($_REQUEST["content"], FILTER_SANITIZE_STRING);
$links = filter_var($_REQUEST["links"], FILTER_SANITIZE_STRING);
$design = filter_var($_REQUEST["design"], FILTER_SANITIZE_STRING);
$other = filter_var($_REQUEST["other"], FILTER_SANITIZE_STRING);
$contact_centre= filter_var($_REQUEST["contact_centre"], FILTER_SANITIZE_EMAIL);
$message		= filter_var($_REQUEST["message"], FILTER_SANITIZE_STRING);
$explanation	= filter_var($_REQUEST["explanation"], FILTER_SANITIZE_STRING);
$full_name		= filter_var($_REQUEST["full_name"], FILTER_SANITIZE_STRING);
$email_address	= filter_var($_REQUEST["email_address"], FILTER_SANITIZE_EMAIL);
//$mailer_from	= $site_email;
$fields = array(
	'content' => urlencode($_REQUEST['content']),
	'links' => urlencode($_REQUEST['links']),
	'design' => urlencode($_REQUEST['design']),
	'other' => urlencode($other),
	'contact_centre' => urlencode($_REQUEST['contact_centre']),
	'message' => urlencode($_REQUEST['message']),
	'explanation' => urlencode($_REQUEST['explanation']),
	'full_name' => urlencode($_REQUEST['full_name']),
	'email_address' => urlencode($_REQUEST['email_address']),
	//'mailer_from' => urlencode($site_email)
);
// To Prevent Spam, bogus POSTs, etc. before doing a CURL
if ( $data ) {


//url-ify the data for the POST
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string, '&');

//open connection
$ch = curl_init();
//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

//execute post
$result = curl_exec($ch);
//close connection
curl_close($ch);
}
/*
function siteEmail() {
			global $db;
			$query = "SELECT email FROM bf_users WHERE id =5";
			echo $site_email = mysql_fetch_object(mysql_query($query))->email;
}*/
?>
