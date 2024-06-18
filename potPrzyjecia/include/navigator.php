<?
/*
$criteria - ktore zamowienia maja zostac wyswietlone
$count - liczba wszystkich zamowien
$ile_wynikow - liczba wynikow prezentowanych na stronie
$strona - aktualnie wyswietlana strona z wynikami
$query - zapytanie do modyfikacji
*/

function insert_navigator ($criteria, $count, $ile_wynikow, $strona, $query) {

		
		
		$pNum=$count/$ile_wynikow;
	
		$query =' LIMIT '.($strona*$ile_wynikow).','.$ile_wynikow;
		$potwierdzenie = mysqli_query ($query);

		$lStron = ceil($count/$ile_wynikow);
		

		//dodane
		echo '<div id="TrescPelna_1" style="display:none;">';
		//
		
		echo '<div class="navigator"><p>';
		
		for ($i=0;$i<$pNum;$i++) { ?>
			<a href="list.php?status=<?=$_GET['status']?>&amp;s=<?=$i?>" class="<? if ($_GET['s'] == $i) echo 'selected';?>"><?=($i+1)?></a>
		<? }
		
		echo '</p></div>';
		
		//dodane
		echo '<div id="TrescSkrocona_1"></div></div>';
		//
			
		//dodane
		echo "<div id='PrzyciskPokaz_1' onclick='PokazUkryjTekst(1,1);' style='cursor:pointer;'><br /><h3>>>POKAŻ<<</h3><br /></div>
			  <div id='PrzyciskUkryj_1' onclick='PokazUkryjTekst(2,1);' style='display:none; cursor:pointer;'><br /><h3>>>UKRYJ<<</h3><br /></div>	";
		//

		return ($potwierdzenie);
	}


?>