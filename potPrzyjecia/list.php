<?php
session_start();


if (!isset($_SESSION['s']) || $_SESSION['s']!==true) {
	if ( isset($_GET['s']) & ($_GET['s']=='1qaz2wsx') ) {
		$_SESSION['s'] = true;
	} else {
		$_SESSION['s'] = false;
	}
}

if ( isset($_GET['l']) & ($_GET['l']==1) ) {
	$_SESSION['s'] = false;
}

if ($_SESSION['s'] == true) {
	
	include ('layout/header.php');

	include ('include/dtbas.php');


		
	$db = @mysql_connect ($db_srvr1, $db_user1, $db_pswd1) or die ($db_error01);
	mysql_select_db($db_dtbs1, $db) or die ($db_error02);

	include ('include/list.php');

	mysql_close($db);
	include ('layout/footer.php');
} else {
	header("Location: http://serwis.notebookservice.pl/");
}

?>
