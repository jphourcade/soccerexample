<?php
// check if user logged in, if not, kick them to login.php
	session_start();
	if(!isset($_SESSION['email'])) {
		// if this is not set, it means they are not logged in
		header("Location: login.php");
	}

?>

<?php
	include_once('config.php');
	include_once('dbutils.php');
?>

