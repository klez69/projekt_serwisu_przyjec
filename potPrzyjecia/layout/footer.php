<div id="debug">
<?
$debug = 0;
if ($debug) {
		echo '<h5>Zmienne tablicy POST:</h5>';
		if (isset($_POST))
			foreach ($_POST as $klucz => $wartosc)
				echo $klucz.'=>'.$wartosc.'<br />';
		
		echo '<h5>Zmienne tablicy GET:</h5>';
		if (isset($_POST))
			foreach ($_GET as $klucz => $wartosc)
				echo $klucz.'=>'.$wartosc.'<br />';
		
		echo '<h5>Zmienne tablicy COOKIE:</h5>';	
		if (isset($_COOKIE))
			foreach ($_COOKIE as $klucz => $wartosc)
				echo $klucz.'=>'.$wartosc.'<br />';
		
		echo '<h5>Zmienne GLOBALS:</h5>';	
		if (isset($GLOBALS))
			foreach ($GLOBALS as $klucz => $wartosc)
				echo $klucz.'=>'.$wartosc.'<br />';
	
	}
	?>
</div>
</body>
</html>