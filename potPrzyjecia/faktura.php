<?


$name = $_GET['name'];
$a = trim($_REQUEST['a']);

// Skrypt i szablon dla wystawiania drukowania faktur.
// ©Jacek Lisowski, styczen 2005 r.
include ('include/dtbas.php');

	$db = @mysql_connect ($db_srvr1, $db_user1, $db_pswd1) or die ($db_error01);
	mysql_select_db($db_dtbs1, $db) or die ($db_error02);

// parametry do faktury odbiorcy
$sSQL = mysql_query ("SELECT * FROM `pot_parametry` WHERE `id_num` = '$name'") or die ("błąd w pytaniu1");

while ($rekord = mysql_fetch_array ($sSQL)) {
$id_num = $rekord[1];

}

// parametry do faktury
$sSQL = "SELECT * FROM pot_parametry WHERE typ =1";
$rekord = mysql_query($sSQL, $db);
if (mysql_num_rows($rekord)>0) {
	$rs_parametry = mysql_fetch_object($rekord);
} else {
	exit("Blad: nie mozna wczytac parametrow programu!");
}
mysql_free_result($rekord);


if (!isset($rs_parametry->stawka_VAT)) exit("Nie mozna wczytac stawki VAT!");
	$stawka_VAT = $rs_parametry->stawka_VAT;

if (!isset($rs_parametry->rok_na_fakturze)) exit("Nie mozna wczytac roku na fakture!");
	$rok = $rs_parametry->rok_na_fakturze;

if (!isset($rs_parametry->nazw_sprz)) exit("Nie mozna wczytac nazwy sprzedawcy!");
	$nazw_s = $rs_parametry->nazw_sprz;

if (!isset($rs_parametry->adres_sprz)) exit("Nie mozna wczytac adres sprzedawcy!");
	$adres_s = $rs_parametry->adres_sprz;	
	
if (!isset($rs_parametry->nip_s)) exit("Nie mozna wczytac nip sprzedawcy!");
	$nip_s = $rs_parametry->nip_s;
	
if (!isset($rs_parametry->id_num)) exit("Nie mozna wczytac numer sprzedawcy!");
	$num = $rs_parametry->id_num;
	
$suma_BTO = $BTO1 + $BTO2 + $BTO3;

$dta_wystawienia = $rs_faktura->dta_wystawienia;
$dta_sprzedazy = $rs_faktura->dta_sprzedazy;
$dta_termin = $rs_faktura->dta_termin_platnosci;

$sDoZaplaty = KwotaSlownie($suma_BTO);

// -----------------------------------------------------------------------


?>
<HTML>
<HEAD>
<TITLE>Faktura</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-2">
<META NAME="author" CONTENT="Janusz">

<STYLE TYPE="text/css">

body {
	font-family: Times New Roman, Times, Serif;
	font-size: 12pt;
	text-align:left;
}
td, th {
	vertical-align: top;
	text-align: center;
	font-size: 12pt;
	padding: 3pt;
}
.gb {
	font-family: Arial, Helvetica, Sans-Serif;
	font-size: 16pt;
	font-weight: bold;
	color: #606060;
	vertical-align: bottom;
}
.ops {
	font-family: Times New Roman, Times, Serif;
	font-size: 8pt;
	font-style: italic;
}

.sl {
	text-align: left;
	margin: 3pt;
}

.sr {
	text-align: right;
	padding-right:8pt;
	margin: 3pt;
}

.er1 {
	color: red;
	font-weight: bold;
	
#button input {float: left; margin: 1em 1em 0 1em;}
.error {color: #c33;}

.button, .submit {padding: 0.25em; background: #39f; color: #fff; cursor: pointer;}
.submit {margin: 1em; padding: 0.25em 0.5em; background: #390;}
	
}
</STYLE>

<?

if ($a = 'edit' and !empty($name))
{
	echo "<form action='include/faktura.php?a=save&name=$num' method='post' />
	<input type='hidden' name='a' value='save' />
<table width='100%' style='border-bottom: 0.5pt dotted black;'><tr>
<td class='gb' style='text-align:left; width:33%'>Faktura VAT</td>
<td class='gb' width='33%'><div class='ops' style='color: black;font-weight: normal;'>Numer:</div>
<span style='color:black;'>$num/$rok/VAT</span></td>
<td class='gb'  style='text-align:right; width:33%'>oryginał / kopia</td>
</tr></table>

<table width='50%' align='center'><tr>
<td><div class='ops'>Suma brutto:</div><?=number_format($suma_BTO, 2, ',', '')?> zł</td>
<td><div class='ops'>Termin płatnśoci:</div>
<input type='date' name='dta_termin' value='$dta_termin' /></td>
<td><div class='ops'>Forma płatnosci:</div>
<select name='$platnosc'>
		<option value=''></option>
		<option value='przelew'>Przelew</option>
		<option value='gotowka'>Gotówka</option>
		<option value='karta'>Karta płatnicza</option>
	</select>
</td>
</tr></table>

<table width='100%' style='border-top: 0.5pt dotted black;'>
<tr>
<td style='text-align:left;padding-top:5.0pt;'>
<div class='ops'>Sprzedawca:</div>
<div style='line-height: 17pt;'>
<b>$nazw_s</b><br>
$adres_s<br>
NIP: $nip_s<br>
konto: 
</div>
</td>
<td style='text-align:right;padding-top:5.0pt;'>
<div class='ops'>Miejsce i data wystawienia:</div>
Tarnów, <?=$dta_wystawienia?>
<div class='ops'>Data sprzedaży:</div>
<?=$dta_sprzedazy?>
</td>
</tr>

</table>

<table width='100%'>
<tr>
<td style='width:50%;text-align:left;padding-top:5.0pt;'>
<div class='ops'>Nabywca:</div>
<div style='line-height: 17pt;'>
<b><input type='text' id='temat' name='nazwa' value='$nazwa' style='width: 100%;' placeholder='Brak nazwy klienta' /></b><br>
<input type='text' id='temat' name='adres' value='$adres' style='width: 25%;'  placeholder='Brak adresu'/><input type='text' id='temat' name='kod' value='$kod' style='width: 25%;' placeholder='Brak kodu'/><input type='text' id='temat' name='misato' value='$miasto' style='width: 50%;' placeholder='Brak miasta' /><br>
NIP: <input type='text' id='temat' name='nip' value='$nip' style='width: 60%;' placeholder='Brak nip' /><br>
</div>
</td>
<td style='width:50%;text-align:left;padding-top:5.0pt;'>
<div class='ops'></div>
<div style='line-height: 17pt;'></b></div>
</td>


</tr>
</table>
<br>

<table width='100%' cellspacing='0' border='0'>
<col width='1%'><col><col width='1%'><col width='1%'><col width='1%'>
<col width='1%'><col width='1%'><col width='1%'><col width='1%'>
<tr>
<td style='text-align:center;border-top: 0.5pt dotted black;border-bottom: 0.5pt dotted black;'>
<div class='ops'><br>Lp.</div></td>
<td style='text-align:left;border-top: 0.5pt dotted black;border-bottom: 0.5pt dotted black;'>
<div class='ops'><br>Nazwa</div></td>
<td style='text-align:center;border-top: 0.5pt dotted black;border-bottom: 0.5pt dotted black;'>
<div class='ops'><br>Ilość</div></td>
<td style='text-align:center;border-top: 0.5pt dotted black;border-bottom: 0.5pt dotted black;'>
<div class='ops'>Jedn.<br>miar.</div></td>
<td style='text-align:center;border-top: 0.5pt dotted black;border-bottom: 0.5pt dotted black;'>
<div class='ops' style='text-align:center;'>CenaN<br>zł</div></td>
<td style='text-align:center;border-top: 0.5pt dotted black;border-bottom: 0.5pt dotted black;'>
<div class='ops'>%<br>VAT</div></td>
<td style='text-align:center;border-top: 0.5pt dotted black;border-bottom: 0.5pt dotted black;'>
<div class='ops'>KwotaVAT<br>zł</div></td>
<td style='text-align:center;border-top: 0.5pt dotted black;border-bottom: 0.5pt dotted black;'>
<div class='ops'>WartośćN<br>zł</div></td>
<td style='text-align:center;border-top: 0.5pt dotted black;border-bottom: 0.5pt dotted black;'>
<div class='ops'>WartośćB<br>zł</div></td>
</tr>
<tr><td class='sr'>1.</td>
<td class='sl'><input type='text' name='pozycja1' value='$pozycja' style='width: 100%;' placeholder='pozycja'/></td>
<td class='sr'><input type='text' name='jednostka1' value='$jednostka1' style='width: 100%;' placeholder='1'/></td>
<td class='sr'><input type='text' name='szt1' value='$szt1' style='width: 150%;' placeholder='szt'/></td>
<td class='sr'>$NTO1</td>
<td class='sr'>$stawka_VAT</td>
<td class='sr'>$VAT1</td>
<td class='sr'>$NTO1</td>
<td class='sr'><input type='text' name='BTO1' style='width: 100%;' value='$BTO1' /></td>
</tr>


<tr>
<td colspan='5' style='vertical-align:middle;text-align:right;border-top: 0.5pt dotted black;'>
<div class='ops'>Razem wg stawek VAT:</div></td>
<td class='sr' style='text-align:right;border-top: 0.5pt dotted black;'>23</td>
<td class='sr' style='text-align:right;border-top: 0.5pt dotted black'><?=number_format($suma_VAT, 2, ',', '')?></td>
<td class='sr' style='text-align:right;border-top: 0.5pt dotted black;'><?=number_format($suma_NTO, 2, ',', '')?></td>
<td class='sr' style='text-align:right;border-top: 0.5pt dotted black;'><?=number_format($suma_BTO, 2, ',', '')?></td>
</tr>

<tr>
<td colspan='5' style='vertical-align:middle;text-align:right;font-weight: bold;'>
Razem:</td>
<td class='sr' style='text-align:right;border-top: 0.5pt dotted black;border-bottom: 0.5pt dotted black;'>&nbsp;</td>
<td class='sr' style='text-align:right;border-top: 0.5pt dotted black;border-bottom: 0.5pt dotted black;'><?=number_format($suma_VAT, 2, ',', '')?></td>
<td class='sr' style='text-align:right;border-top: 0.5pt dotted black;border-bottom: 0.5pt dotted black;'><?=number_format($suma_NTO, 2, ',', '')?></td>
<td class='sr' style='text-align:right;border-top: 0.5pt dotted black;border-bottom: 0.5pt dotted black;font-weight: bold;'><?=number_format($suma_BTO, 2, ',', '')?></td>
</tr>
</table>


<table><tr>
<td style='text-align:left;'>
<div class='ops'>Do zapłaty:</div>
<div class='gb'><?=number_format($suma_BTO, 2, ',', '')?> zł</div>
</td>

<td style='padding-left:2em;text-align:left;'>
<div class='ops' style='margin-bottom: 4pt;'>Do zapłaty słownie:</div>
<?=$sDoZaplaty?>
</td>
</tr></table>

<br><br><br><br><br>

<table width='100%'>
<col width='33%'><col><col width='33%'>
<tr>
<td>

</td>
<td>
</td>
<td>

</td>
</tr>

<tr>
<td style='border-top: 0.5pt dotted black;'>
<div class='ops'>Imię i nazwisko osoby upoważnionej<br>do wystawiania faktury VAT</div>
</td>
<td>
<div class='ops'>Pieczatka</div>
</td>
<td style='border-top: 0.5pt dotted black;'>
<div class='ops'>Imię i nazwisko osoby upoważnionej<br>do odbioru dokumentu</div>
</td>
</tr>
</table>
<br /><br /><br />
<input type='submit' class='button' value='<<-Wstecz' onclick='javascript: history.go(-1)' />
<td class=\"ziel\"><a href=\"https://serwis.notebookservice.pl/potPrzyjecia/include/faktura.php?name=$num\">pokarz</a></td>
<input type='submit' value='popraw' />
</form>";
}


if($a == 'save' and !empty($name)) {
/* odbieramy zmienne z formularza */
	$numer = $_POST['numer'];
	$num = $_POST['num'];
	$rok = $_POST['rok'];
	$dta_termin = $_POST['dta_termin'];
	$platnosc = $_POST['platnosc'];
	
	
	mysql_query ("INSERT INTO `pot_druki` (`id_druku`, `num`, `dta_termin`, `platnosc`) VALUES ('new()', '$num/$rok/VAT', '$dta_termin', '$platnosc')") or die('Błąd zapytania zapisu');
}




?>
</HEAD>

<BODY></BODY>
</HTML>
<?


// ©Jacek Lisowski -------------------------------------------------------
function LiczbaSlownie($Liczba) {
$MLD_ = 1000000000;
$MLN_ = 1000000;
$TYS_ = 1000;

$Jednosci = array('', 'jeden ', 'dwa ', 'trzy ', 'cztery ', 'pięć ',
			'sześć ', 'siedem ', 'osiem ', 'dziewięć ');
$Nastki = array('', 'jedenaście ', 'dwanaście ', 'trzynaście ',
			'czternaście ', 'piętnaście ', 'szesnaście ',
			'siedemnaście ', 'osiemnaście ', 'dziewiętnaście ');
$Dziesiatki = array('', 'dziesięć ', 'dwadzieścia ', 'trzydzieści ',
			'czterdzieści ', 'piędziesiąt ', 'sześdziesiąt ',
			'siedemdziesiąt ', 'osiemdziesiąt ', 'dziewiędziesiąt ');
$Setki = array('', 'sto ', 'dwieście ', 'trzysta ', 'czterysta ', 'pięset ',
			'sześćset ', 'siedemset ', 'osiemset ', 'dziewięćset ');

	if ($Liczba == 0) {
    		return "zero";
	}
	if ($Liczba > 2147483647) {
		return "########";
	}

	$Tekst = "";
	$i = 0;
	$l = sprintf("%d", $Liczba);
	$dl = strlen($l);

	$mld = floor($Liczba / $MLD_);
	$mln = floor(($Liczba - ($mld * $MLD_)) / $MLN_);
	$tys = floor(($Liczba - ($mld * $MLD_) - ($mln * $MLN_)) / $TYS_);

	while($i < $dl) {
		$p = $dl - $i;
		$pq = $p % 3;
		$ix = intval(substr($l, $i, 1), 10);
		if ($pq == 1) {
			if ($i == 0) {
				$Tekst .= $Jednosci[$ix];
			} elseif (intval(substr($l, $i-1, 1), 10)!=1) {
				$Tekst .= $Jednosci[$ix];
			}
			if (($p > 9) && ($mld > 0)) {
				$st0 = "";
				if ($i > 0) $st0 = substr($l, $i-1, 1);
				$st1 = substr($l, $i, 1);
				if ($mld == 1) {
					$Tekst .= "miliard ";
				} elseif ($st0 == "1") {
					$Tekst .= "miliardów ";
				} elseif (($st1 == "2") || ($st1 == "3") || ($st1 == "4")) {
					$Tekst .= "miliardy ";
				} else {
					$Tekst .= "miliardów ";
				}
			} elseif (($p > 6) && ($p <= 9) && ($mln > 0)) {
				$st0 = "";
				if ($i > 0) $st0 = substr($l, $i-1, 1);
				$st1 = substr($l, $i, 1);
				if ($mln == 1) {
					$Tekst .= "milion ";
				} elseif ($st0 == "1") {
					$Tekst .= "milionów ";
				} elseif (($st1 == "2") || ($st1 == "3") || ($st1 == "4")) {
					$Tekst .= "miliony ";
				} else {
					$Tekst .= "milionów ";
				}
			} elseif (($p > 3) && ($p <= 6) && ($tys > 0)) {
				$st0 = "";
				if ($i > 0) $st0 = substr($l, $i-1, 1);
				$st1 = substr($l, $i, 1);
				if ($tys == 1) {
					$Tekst .= "tysiąc ";
				} elseif ($st0 == "1") {
					$Tekst .= "tysięcy ";
				} elseif (($st1 == "2") || ($st1 == "3") || ($st1 == "4")) {
					$Tekst .= "tysiące ";
				} else {
					$Tekst .= "tysięcy ";
				}
			}
		} elseif ($pq == 2) {
			if ((intval(substr($l, $i, 1), 10)==1)&&(intval(substr($l, $i+1, 1), 10)>0)) {
				$Tekst .= $Nastki[intval(substr($l, $i+1, 1), 10)];
			} else {
				$Tekst .= $Dziesiatki[$ix];
			}
		} else {
			$Tekst .= $Setki[$ix];
		}
		$i++;
	}
	return $Tekst;
}

// ©Jacek Lisowski -------------------------------------------------------
function KwotaSlownie($kwota) {
	$zl = floor($kwota);
	$gr = round(($kwota - $zl) * 100, 0);
	return LiczbaSlownie($zl).' zł '.LiczbaSlownie($gr).' gr';
}


?>