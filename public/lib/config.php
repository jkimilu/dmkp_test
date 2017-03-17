<?php
//set timezone
define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','tV6gXwnxLPQZLWjC');
define('DBNAME','dmkp');

$con=mysql_connect(DBHOST,DBUSER,DBPASS) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DBNAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

try {

	//create PDO connection 
	$db = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
	//show error
    echo '<p class="error_msg">'.$e->getMessage().'</p>';
    //exit;
}

$mysqli = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

//Output any connection error
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}
?>