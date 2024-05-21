<? include ('layout/header.php');
include ('include/dtbas.php');

	$db = @mysql_connect ($db_srvr1, $db_user1, $db_pswd1) or die ($db_error01);
	mysql_select_db($db_dtbs1, $db) or die ($db_error02);

if ($_POST['print'] || $_POST['update']) {
	
	if ($_POST['print'])	
		$query = 'INSERT INTO pot_przyjecia SET';
		
	if ($_POST['update'])
		$query = 'UPDATE pot_przyjecia SET';
	
	
	if ($_POST['zasilacz'])
		$zasilacz = 1;
		
	
	if ($_POST['kabel'])
		$kabel = 1;
		
	
	if ($_POST['bateria'])
		$bateria = 1;
		
	
	if ($_POST['torba'])
		$torba = 1;
		
	
	$query.= " nr='".$_POST['nr']."'";
	$query.= ", data='".mktime()."'";
	$query.= ", nazwa='".$_POST['nazwa']."'";
	$query.= ", adres='".$_POST['adres']."'";
	$query.= ", marka='".$_POST['marka']."'";
	$query.= ", numer='".$_POST['numer']."'";
	$query.= ", zasilacz='".$zasilacz."'";
	$query.= ", kabel='".$kabel."'";
	$query.= ", bateria='".$bateria."'";
	$query.= ", torba='".$torba."'";
	$query.= ", inne='".$_POST['inne']."'";
	$query.= ", uwagi='".$_POST['uwagi']."'";
	$query.= ", miesiac='".$_POST['miesiac']."'";
	$query.= ", data_wyd='".$_POST['data_wyd']."'";
	$query.= ", uwagi_wyd='".$_POST['uwagi_wyd']."'";
	$query.= ", tel='".$_POST['tel']."'";
	$query.= ", kod='".$_POST['kod']."'";
	$query.= ", miasto='".$_POST['miasto']."'";
	$query.= ", nip='".$_POST['nip']."'";
	
	
	if ($_POST['print'])
		$query.= ", status=1";
	
	
	
	if ($_POST['update']) {
		$query.= ", status=".$_POST[status];
		$query.= ' WHERE nr='.$_POST['nr'];
	}
	
	$query.=';';
	
	if (mysql_query($query)) {
		echo '<h4 class="success">Dane zostały zapisane poprawnie</h4>';
		include ('include/list.php');
	} else {
		echo $query;
		echo '<h4 class="error">Wystąpł problem z zapisem danych w bazie</h4>';
		include ('include/list.php');
	}	
} elseif ($_GET['edit']) { 
		
	$query = 'SELECT * FROM pot_przyjecia WHERE nr='.$_GET['edit'];
	$res = mysql_query($query);
	$row = mysql_fetch_object($res);
	$nr = $row->nr;
	include ('include/formularz.php');
	

} elseif ($_POST['print2']) {
	echo '<h4 class="success">Proces wydruku został zakonczony</h4>';
	include ('include/list.php');
} else {
	$query = "SELECT nr FROM pot_przyjecia ORDER BY ID DESC LIMIT 0,1";
	
	if ($res = mysql_query($query)) {
		$row = mysql_fetch_object($res);
		$nr = $row->nr + 1;
	} else
		$nr = 1;
	include ('include/formularz.php');
}
mysql_close($db);
include ('layout/footer.php');
?>