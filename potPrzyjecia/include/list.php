<?


if ($_POST['update']) {
	
	$status = $_POST['status'];

	for ($i=0; $i< count($status); $i++) {
		$par = explode('-', $status[$i]);
		if ($par[0] == 'delete') {
			$query = 'DELETE FROM pot_przyjecia WHERE id='.$par[1];
			$delete = mysql_query($query);
		}
		
		$query = "UPDATE pot_przyjecia SET status=".$par[0]." WHERE id=".$par[1];
		$update = mysql_query($query);
	}
}

if ($_GET['status'] == 4) {
	if (isset($_GET['search_cirit']))
		$_SESSION['search_cirit'] = $_GET['search_cirit'];
	
	if (isset($_GET['search_value']))
		$_SESSION['search_value'] = $_GET['search_value'];
		
				
	$query = "SELECT * FROM pot_przyjecia WHERE ".$_SESSION['search_cirit']." LIKE '%".$_SESSION['search_value']."%' ORDER BY ID DESC";

} else {
	if ($_GET['status'] == 0)
		$query = "SELECT * FROM pot_przyjecia ORDER BY ID DESC";
	if ($_GET['status'] == 1)
		$query = "SELECT * FROM pot_przyjecia WHERE status=1 ORDER BY ID DESC";
	if ($_GET['status'] == 2)
		$query = "SELECT * FROM pot_przyjecia WHERE status=2 ORDER BY ID DESC";
	if ($_GET['status'] == 3)
		$query = "SELECT * FROM pot_przyjecia WHERE status=3 ORDER BY ID DESC";
	
	
	$_SESSION['search_cirit'] = '';
	$_SESSION['search_value'] = '';
	
}

$potwierdzenie = mysql_query($query);
$count = mysql_num_rows($potwierdzenie);

$ile_wynikow = 30;
include ('include/navigator.php');
//menu
if ($count) { ?>
	<h4>Lista zleceń</h4>
	<ul class="menu">
	   <li><a href="list.php?status=0" class="<? if ($_GET['status'] == 0) echo 'selected';?>">wszystkie</a></li>
	   <li><a href="list.php?status=1" class="<? if ($_GET['status'] == 1) echo 'selected';?>">przyjęte</a></li>
	   <li><a href="list.php?status=2" class="<? if ($_GET['status'] == 2) echo 'selected';?>">zrealizowane</a></li>
	   <li><a href="list.php?status=3" class="<? if ($_GET['status'] == 3) echo 'selected';?>">anulowane</a></li>
	   <li><a href="form.php" class="<? if ($_GET['status'] == 3) echo 'selected';?>">NOWE ZGŁOSZENIE</a></li>
	   <li><a href="list.php?l=1">WYLOGUJ</a></li>
	   <? if ($_SESSION['search_cirit']) { ?>
	   		<li><a href="#" class="selected">wyszukane</a></li>
	   	<? } ?>
	</ul>
	
	<div id="search_engine">
	<form action="list.php" method="get" />
		<select name="search_cirit">
			<option value="nr" <?if ($_SESSION['search_cirit'] == 'nr') echo 'selected="selected"';?>>nr:</option>
			<option value="nazwa" <?if ($_SESSION['search_cirit'] == 'nazwa') echo 'selected="selected"';?>>Nazwa:</option>
			<option value="marka" <?if ($_SESSION['search_cirit'] == 'marka') echo 'selected="selected"';?>>Marka:</option>
			<option value="tel" <?if ($_SESSION['search_cirit'] == 'tel') echo 'selected="selected"';?>>Telefon:</option>
		</select>
		<input type="text" name="search_value" value="<?=$_SESSION['search_value']?>" />
		<input type="hidden" name="status" value="4" />
		<input type="submit" class="button" name="search" value="Szukaj" />
	</form>
	</div>
	<br /><br />
	
	<h4 class=\"success\">Znaleziono: <?=$count?></h4>
	<? if ($count > $ile_wynikow)
		$potwierdzenie = insert_navigator($_GET['status'], $count, $ile_wynikow, $_GET['s'], $query);
	
	echo "<br /><form action=\"list.php?status=".$_GET['status']."\" method=\"post\">\n";
	echo "<table cellspacing=\"0\" cellpadding=\"0\">\n";
	echo "<tr>\n";
	echo '<th>Nr</th>';
	echo '<th>Gwar</th>';
	echo '<th>Data</th>';
	echo '<th>Nazwa</th>';
	echo '<th>Telefon</th>';
	
	echo '<th>Marka</th>';
	echo '<th>Numer</th>';
	echo '<th>Z</th>';
	echo '<th>K</th>';
	echo '<th>B</th>';
	echo '<th>T</th>';
	echo '<th>Inne</th>';
	echo '<th width="30%">Uwagi</th>';
	echo '<th>Status</th>';
	echo "</tr>\n";
	$wiersz=1;
	
	while ($row = mysql_fetch_object($potwierdzenie)) {
				
		
		if ($wiersz%2)
			$class = 'row1';
		else
			$class = 'row2';
			
		echo "<tr class=\"$class\">";
		echo "<td><a href=\"form.php?edit=$row->nr\">$row->nr</td>\n";
		echo "<td class=\"ziel\"><a href=\"gwar.php?edit=$row->nr\">$row->nr</td>\n";
		?>
		<td><? if ($row->data) echo date('j - m - Y', $row->data); else echo '&nbsp;';?></td>
		<td><? if ($row->nazwa) echo $row->nazwa; else echo '&nbsp;';?></td>
		<td><b><? if ($row->tel) echo $row->tel; else echo '&nbsp;';?></b></td>
		
		<td><? if ($row->marka) echo $row->marka; else echo '&nbsp;';?></td>
		<td><? if ($row->numer) echo $row->numer; else echo '&nbsp;';?></td>
		<?
		if ($row->zasilacz) $zasilacz = 'T'; else $zasilacz = 'N';
		echo "<td>$zasilacz</td>\n";
		if ($row->kabel) $kabel = 'T'; else $kabel = 'N';
		echo "<td>$kabel</td>\n";
		if ($row->bateria) $bateria = 'T'; else $bateria = 'N';
		echo "<td>$bateria</td>\n";
		if ($row->torba) $torba = 'T'; else $torba = 'N';
		echo "<td>$torba</td>\n";
		?>
		<td><? if ($row->inne) echo $row->inne; else echo '&nbsp;';?></td>
		<td><? if ($row->uwagi) echo $row->uwagi; else echo '&nbsp';?></td>
		<td>
		<? 
		$query ="SELECT * FROM pot_przyjecia_status";
		$status_zamowienia = mysql_query($query);
		
		echo '<select name="status[]">';
			
			for ($i=0; $i<mysql_num_rows($status_zamowienia); $i++) {
				
				$s_zamowienia = mysql_fetch_object($status_zamowienia); ?>
				<option value="<?=$s_zamowienia->id;?>-<?=$row->id?>"<?if ($s_zamowienia->id == $row->status) echo 'selected="selected"';?>><?=$s_zamowienia->nazwa?></option>
			<? } ?>
			<option value="delete-<?=$row->id?>">Usuń</option>
		</select>
		</td>
		<?
		echo "</tr>\n";
		$wiersz++;
		
	}
	
	echo "</table>\n";
	echo '<input type="submit" class="submit" value="Aktualizuj" name="update" />';
	echo '</form>';
} else {
	echo '<h4 class="error">Lista zlecen jest pusta</h4>';
} ?>
<div id="button">
<input type="button" class="button" value="<<-Wstecz" onclick="javascript: history.go(-1)" />
<input type="button" class="button" value="X-Zamknij" onclick="javascript: window.close()" />
</div>
