<?php
// Pobieranie danych z zapytania
$name = isset($_GET['name']) ? trim($_GET['name']) : '';
$a = isset($_REQUEST['a']) ? trim($_REQUEST['a']) : '';

// Skrypt i szablon dla wystawiania drukowania faktur.
// ©
include('include/dtbas.php');

// Połączenie z bazą danych
$db = new mysqli($db_srvr1, $db_user1, $db_pswd1, $db_dtbs1);
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Pobieranie parametrów do faktury odbiorcy
$stmt = $db->prepare("SELECT * FROM `pot_parametry` WHERE `id_num` = ?");
$stmt->bind_param('s', $name);
$stmt->execute();
$result = $stmt->get_result();

while ($rekord = $result->fetch_array()) {
    $id_num = $rekord[1];
}
$stmt->close();

// Pobieranie parametrów do faktury
$sSQL = "SELECT * FROM pot_parametry WHERE typ = 1";
$rekord = $db->query($sSQL);
if ($rekord->num_rows > 0) {
    $rs_parametry = $rekord->fetch_object();
} else {
    exit("Błąd: nie można wczytać parametrów programu!");
}
$rekord->free();

// Sprawdzanie i ustawianie parametrów
$stawka_VAT = isset($rs_parametry->stawka_VAT) ? $rs_parametry->stawka_VAT : exit("Nie można wczytać stawki VAT!");
$rok = isset($rs_parametry->rok_na_fakturze) ? $rs_parametry->rok_na_fakturze : exit("Nie można wczytać roku na fakturze!");
$nazw_s = isset($rs_parametry->nazw_sprz) ? $rs_parametry->nazw_sprz : exit("Nie można wczytać nazwy sprzedawcy!");
$adres_s = isset($rs_parametry->adres_sprz) ? $rs_parametry->adres_sprz : exit("Nie można wczytać adresu sprzedawcy!");
$nip_s = isset($rs_parametry->nip_s) ? $rs_parametry->nip_s : exit("Nie można wczytać NIP sprzedawcy!");
$num = isset($rs_parametry->id_num) ? $rs_parametry->id_num : exit("Nie można wczytać numeru sprzedawcy!");

// Obliczanie sumy brutto
$suma_BTO = $BTO1 + $BTO2 + $BTO3;

$dta_wystawienia = isset($rs_faktura->dta_wystawienia) ? $rs_faktura->dta_wystawienia : '';
$dta_sprzedazy = isset($rs_faktura->dta_sprzedazy) ? $rs_faktura->dta_sprzedazy : '';
$dta_termin = isset($rs_faktura->dta_termin_platnosci) ? $rs_faktura->dta_termin_platnosci : '';

$sDoZaplaty = KwotaSlownie($suma_BTO);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="ISO-8859-2">
    <meta name="author" content="Janusz">
    <title>Faktura</title>
    <style>
        body {
            font-family: Times New Roman, Times, Serif;
            font-size: 12pt;
            text-align: left;
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
            padding-right: 8pt;
            margin: 3pt;
        }
        .er1 {
            color: red;
            font-weight: bold;
        }
        #button input {
            float: left;
            margin: 1em 1em 0 1em;
        }
        .error {
            color: #c33;
        }
        .button, .submit {
            padding: 0.25em;
            background: #39f;
            color: #fff;
            cursor: pointer;
        }
        .submit {
            margin: 1em;
            padding: 0.25em 0.5em;
            background: #390;
        }
    </style>
</head>
<body>

<?php
if ($a == 'edit' && !empty($name)) {
    echo "<form action='include/faktura.php?a=save&name=$num' method='post'>
    <input type='hidden' name='a' value='save' />
    <table width='100%' style='border-bottom: 0.5pt dotted black;'>
        <tr>
            <td class='gb' style='text-align:left; width:33%'>Faktura VAT</td>
            <td class='gb' width='33%'><div class='ops' style='color: black; font-weight: normal;'>Numer:</div>
            <span style='color:black;'>$num/$rok/VAT</span></td>
            <td class='gb' style='text-align:right; width:33%'>oryginał / kopia</td>
        </tr>
    </table>

    <table width='50%' align='center'>
        <tr>
            <td><div class='ops'>Suma brutto:</div>" . number_format($suma_BTO, 2, ',', '') . " zł</td>
            <td><div class='ops'>Termin płatności:</div>
            <input type='date' name='dta_termin' value='$dta_termin' /></td>
            <td><div class='ops'>Forma płatności:</div>
            <select name='platnosc'>
                <option value=''></option>
                <option value='przelew'>Przelew</option>
                <option value='gotowka'>Gotówka</option>
                <option value='karta'>Karta płatnicza</option>
            </select>
            </td>
        </tr>
    </table>

    <table width='100%' style='border-top: 0.5pt dotted black;'>
        <tr>
            <td style='text-align:left; padding-top:5.0pt;'>
                <div class='ops'>Sprzedawca:</div>
                <div style='line-height: 17pt;'>
                    <b>$nazw_s</b><br>
                    $adres_s<br>
                    NIP: $nip_s<br>
                    konto:
                </div>
            </td>
            <td style='text-align:right; padding-top:5.0pt;'>
                <div class='ops'>Miejsce i data wystawienia:</div>
                Tarnów, $dta_wystawienia
                <div class='ops'>Data sprzedaży:</div>
                $dta_sprzedazy
            </td>
        </tr>
    </table>

    <table width='100%'>
        <tr>
            <td style='width:50%; text-align:left; padding-top:5.0pt;'>
                <div class='ops'>Nabywca:</div>
                <div style='line-height: 17pt;'>
                    <b><input type='text' id='temat' name='nazwa' value='$nazwa' style='width: 100%;' placeholder='Brak nazwy klienta' /></b><br>
                    <input type='text' id='temat' name='adres' value='$adres' style='width: 25%;' placeholder='Brak adresu'/><input type='text' id='temat' name='kod' value='$kod' style='width: 25%;' placeholder='Brak kodu'/><input type='text' id='temat' name='miasto' value='$miasto' style='width: 50%;' placeholder='Brak miasta' /><br>
                    NIP: <input type='text' id='temat' name='nip' value='$nip' style='width: 60%;' placeholder='Brak nip' /><br>
                </div>
            </td>
            <td style='width:50%; text-align:left; padding-top:5.0pt;'>
                <div class='ops'>Odbiorca:</div>
                <div style='line-height: 17pt;'>
                    <b><input type='text' id='temat' name='odbiorca_nazwa' value='$odbiorca_nazwa' style='width: 100%;' placeholder='Brak nazwy odbiorcy' /></b><br>
                    <input type='text' id='temat' name='odbiorca_adres' value='$odbiorca_adres' style='width: 25%;' placeholder='Brak adresu'/><input type='text' id='temat' name='odbiorca_kod' value='$odbiorca_kod' style='width: 25%;' placeholder='Brak kodu'/><input type='text' id='temat' name='odbiorca_miasto' value='$odbiorca_miasto' style='width: 50%;' placeholder='Brak miasta' /><br>
                    NIP: <input type='text' id='temat' name='odbiorca_nip' value='$odbiorca_nip' style='width: 60%;' placeholder='Brak nip' /><br>
                </div>
            </td>
        </tr>
    </table>

    <table width='100%' align='center' style='border: 1.5pt solid black; margin-top:5.0pt;'>
        <tr>
            <td class='gb'>L.p.</td>
            <td class='gb'>Nazwa</td>
            <td class='gb'>PKWiU</td>
            <td class='gb'>J.m.</td>
            <td class='gb'>Ilość</td>
            <td class='gb'>Cena netto</td>
            <td class='gb'>Wartość netto</td>
            <td class='gb'>Stawka VAT</td>
            <td class='gb'>Wartość brutto</td>
        </tr>
        <tr>
            <td>1</td>
            <td>Produkt A</td>
            <td>01.01.1</td>
            <td>szt.</td>
            <td>10</td>
            <td>100,00</td>
            <td>1 000,00</td>
            <td>23%</td>
            <td>1 230,00</td>
        </tr>
    </table>

    <div style='text-align:right; padding-top:5.0pt;'>
        <input type='submit' value='Zapisz' class='button'>
    </div>
</form>";
}
?>
</body>
</html>