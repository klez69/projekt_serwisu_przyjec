<? include ('layout/header.php');

// odczyt z bazy

$a = trim($_REQUEST['a']);
$nr = trim($_GET['nr']);

include ('include/dtbas.php');

	$db = @mysql_connect ($db_srvr1, $db_user1, $db_pswd1) or die ($db_error01);
	mysql_select_db($db_dtbs1, $db) or die ($db_error02);

$wynik = mysql_query ("SELECT * FROM `pot_przyjecia` WHERE `nr` = '$nr' ") or die ("błąd w pytaniu a");

if($a == 'edit' and empty($numer)) {
    /* zapytanie do tabeli */
    $wynik = mysql_query ("SELECT * FROM `pot_przyjecia` WHERE `nr` = '$nr' ") or die ("błąd w pytaniu b");
    /* 
     wyświetlamy wyniki, sprawdzamy,
     czy zapytanie zwróciło wartość większą od 0
     */
    if(mysql_num_rows($wynik) > 0) {
         /* odczytujemy zawartość wiersza z tabeli */
        $r = mysql_fetch_assoc($wynik);
        /* wczytujemy dane do formularza */
        /* 
        w formularz znajdują się ukryte pola "a"
        z wartością "save" i pole "id" z wartością
        zmiennej id
        */

print "
<input type='hidden' name='id' value='".$id."' />
<input type='hidden' name='status' value='".$status."' />
<input type='hidden' name='data' value='".$data."' />
<div id='gwar'>
<br /><br />
<img src='logoo.png'>
<br />
<center><h1>KARTA GWARANCYJNA nr ".$nr." </h1></center>

<form action='doda.php?a=save&nr=$nr' method='post'>
<input type='hidden' name='a' value='save' />
<br />
<center><h4>Data wydania sprzętu po naprawie <input type='date' name='nazwa';' value='$dat_wyd' /></h4></center>
<center><h4>Na naprawę udzielamy <select name='miesiac'>
		<option value='$miesiac'>$miesiac</option>
		<option value=''></option>
		<option value='1 miesiąc'>1 miesiąc</option>
		<option value='3 miesiące'>3 miesiące</option>
		<option value='6 miesiący'>6 miesiący</option>
		<option value='12 miesiący'>12 miesiący</option>
	</select> gwarancji od daty wydania sprzętu po naprawie</h4></center>
<table>
<tr><td class='l25'>Nazwa (imie/nazwisko):</td><td><b><input type='text' name='nazwa' style='width: 50%;' value='".$r["nazwa"]."' /></b></td><td></td></tr>
<tr><td class='l25'>Telefon:</td><td><b><input type='text' name='tel' style='width: 20%;' value='$tel' /></b></td><td></td></tr> 
<tr><td class='l10'>Adres:</td><td><input type='text' name='adres' class='i100' style='width: 50%;' value='$adres' /></td><td></td></tr>
<tr><td>Kod:</td><td><input type='text' name='adres' style='width:15%;' value='$kod' />
Miasto:<input type='text' name='miasto' style='width: 25%;' value='$miasto' /></td>
</tr>
<tr><td class='l20'>Marka/Model:</td><td><input type='text' name='marka' style='width: 50%;' value='$marka' /></td><td></td></tr>
<tr><td class='l21'>Numer seryjny:</td><td><input type='text' name='numer' style='width: 50%;' value='$numer' /></td><td></td></tr>
<tr><td class='l21'>Numer nr zlecenia:</td><td>".$nr."</td><td></td></tr>
</table>
<center><h4>Zgłoszenie usterek objętych naprawą gwarancyjną są przyjmowane telefonicznie bądź w biurze obsługi klienta.</h4></center>

<table style='text-align:center;'>
<tr><td>Notebook Serwice</td><td>Telefony:</td></tr>
<tr><td>ul. Szkotnik 17</td><td>503 779 312</td></tr>
<tr><td>33-100 Tarnów</td><td></td></tr>
</table>


<center><h2>Warunki gwarancji.</h2></center>
<table style='text-align:center;'>
<tr>
1.	Okres gwarancyjny rozpoczyna się od daty wydania sprzętu po naprawie<br />
2.	Uszkodzone urządzenie powinno być dostarczone do serwisu po wcześniejszym kontakcie  telefonicznym.<br />
3.	Oddając sprzęt do reklamacji bezwzględnie należy mieć przy sobie niniejszą kartę gwarancyjną bez niej reklamacja nie zostanie przyjęta<br />
4.	Gwarancją nie są objęte uszkodzenia powstałe w wyniku nie właściwej eksploatacji lub z winy użytkownika. Gwarancja nie obejmuje również naturalnego zużycia elementów urządzenia <br />
5.	Samowolne naprawy lub przeróbki sprzętu oraz użytkowanie nie zgodne z przeznaczeniem powoduje utratę gwarancji <br />
6.	W przypadku zagubienia karty gwarancyjnej duplikaty nie będą wydawane a niniejszy egzemplarz jest jedynym uprawniającym do reklamacji uszkodzonego sprzętu<br />
7.	Uszkodzone urządzenie objęte gwarancją do serwisu dostarcza użytkownik <br />
</tr>
</table>

<table>
<tr>
   <td>Inne:</td> 
   <td><b><i>$inne</i></b></td>
</tr>
<tr>   
   <td>Uwagi:</td> 
   <td><b><i>$uwagi</i></b></td>
</tr>
<tr>
   <td class='l20' >Uwagi po wydaniu:</td>
   <td><input type='text' name='uwagi' style='width: 100%;' value='$uwagi_wyd' /></td>
</tr>
</table>

<br /><br /><br /><input type='button' class='button' value='<<-Wstecz' onclick='javascript: history.go(-1)' /><center><input type='submit' name='save' value='POPRAW' /></center>";


}
print "</div></form>";

}

if($a == 'save') 
{
    /* odbieramy zmienne z formularza */
	$id = $_POST['id'];
	$nr =  trim($_POST['nr']);
	$data = trim($_POST['data']);
	$nazwa = trim($_POST['nazwa']);
	
mysql_query ("UPDATE `pot_przyjecia` SET `nr` = '$nr', `nazwa` = '$nazwa' WHERE `nr` = '$nr' ") or die("Błąd 1 zapytania");
	
	  echo "<center>
	<meta http-equiv='refresh' content='1; URL=\"form.php?edit=$row->nr\">$row->nr</td>\n\"></center>
	<center><div><img src='https://serwis.notebookservice.pl/images/loadmore.gif'>";
}


include ('layout/footer.php');
?>