<div id="gwar">
<img src="images/logoo.png">
<br />
<center><h1>KARTA GWARANCYJNA DO ZLECENIA  - <?=$nr?>  </h1></center>
<? if ($_GET['edit']) { 
?>

<form action="gwar.php" method="post" />
<br />

<center><h4>Data wydania sprzętu po naprawie <input type="date" name="data_wyd" value="<?=$row->data_wyd?>" /></h4></center>


<center><h4>Na naprawę udzielamy <i> <select name="miesiac">
		<option value="<?=$row->miesiac?>"><?=$row->miesiac?></option>
		<option value=""></option>
		<option value="1 miesiąc">1 miesiąc</option>
		<option value="3 miesiące">3 miesiące</option>
		<option value="6 miesiący">6 miesiący</option>
		<option value="12 miesiący">12 miesiący</option>
	</select></i> gwarancji od daty wydania sprzętu po naprawie</h4></center>
<table>

<tr><td class="l25">Nazwa (imie/nazwisko):</td><td><b><input type="text" name="nazwa" style="width: 60%;" value="<?=$row->nazwa?>" /></b></td></tr>
<tr><td class="l10">Adres:</td><td><b><input type="text" name="adres" class="i10" style="width: 40%;" value="<?=$row->adres?>" /></b> </td></tr>
<tr><td class="l10">Telefon:</td><td><b><input type="text" name="tel" class="i10" style="width: 25%;" value="<?=$row->tel?>" /></b> </td></tr>
<tr><td class="l10">Kod / Miasto </td><td><b><input type="text" name="kod" style="width: 10%;" value="<?=$row->kod?>" /> <input type="text" name="miasto" style="width: 30%;" value="<?=$row->miasto?>" /></b></td></tr>
<tr><td class="l10">NIP:</td><td><b><input type="text" name="nip" class="i10" style="width: 20%;" value="<?=$row->nip?>" /></b> </td></tr>
<tr><td class="l20">Marka/Model:</td><td><b><input type="text" name="marka" class="i10" style="width:40%;" value="<?=$row->marka?>" /></b></td></tr>
<tr><td class="l21">Numer seryjny:</td><td><b><input type="text" name="numer" class="i10" style="width:40%;" value="<?=$row->numer?>" /></b></td></tr>
</table>
<br />
<center><font size="3em"><b>Zgłoszenie usterek objętych naprawą gwarancyjną są przyjmowane telefonicznie bądź w biurze obsługi klienta.</b></font></center>

<table style="text-align:center;">
<tr><td>Notebook Serwice</td><td>Telefony:</td></tr>
<tr><td>ul. Pulaskiego 6B<br />
Tel. 503 779 312</td><td>503 779 312</td></tr>
<tr><td>33-100 Tarnów</td><td></td></tr>
<br />
<center><font size="3em"><b>Warunki gwarancji.</b></font></center></table>
<tr><br />
1.	Okres gwarancyjny rozpoczyna się od daty wydania sprzętu po naprawie<br />
2.	Uszkodzone urządzenie powinno być dostarczone do serwisu po wcześniejszym kontakcie  telefonicznym.<br />
3.	Oddając sprzęt do reklamacji bezwzględnie należy mieć przy sobie niniejszą kartę gwarancyjną bez niej reklamacja nie zostanie przyjęta<br />
4.	Gwarancją nie są objęte uszkodzenia powstałe w wyniku nie właściwej eksploatacji lub z winy użytkownika. Gwarancja nie obejmuje również naturalnego zużycia elementów urządzenia <br />
5.	Samowolne naprawy lub przeróbki sprzętu oraz użytkowanie nie zgodne z przeznaczeniem powoduje utratę gwarancji <br />
6.	W przypadku zagubienia karty gwarancyjnej duplikaty nie będą wydawane a niniejszy egzemplarz jest jedynym uprawniającym do reklamacji uszkodzonego sprzętu<br />
7.	Uszkodzone urządzenie objęte gwarancją do serwisu dostarcza użytkownik <br />
</tr>
</table>
<br />
<fieldset><table border="0" cellspacing="0"><legend>UWAGI PO WYDANIU</legend>
<tr>
<td>
<input type="text" name="uwagi_wyd" style="width: 100%;" value="<?=$row->uwagi_wyd?>" />
</td>
</tr>
</table></fieldset>
<br />
<p id="potwierdzenie">Podpis i pieczęć serwisu: ........................................</p>
<br />

<input type="hidden" name="nr" value="<?=$nr?>" />
<input type="hidden" name="data" value="<?=$row->data?>" />
<input type="hidden" name="numer" value="<?=$row->numer?>" />
<input type="hidden" name="zasilacz" value="<?=$row->zasilacz?>" />
<input type="hidden" name="kabel" value="<?=$row->kabel?>" />
<input type="hidden" name="bateria" value="<?=$row->bateria?>" />
<input type="hidden" name="torba" value="<?=$row->torba?>" />
<input type="hidden" name="inne" value="<?=$row->inne?>" />
<input type="hidden" name="uwagi" value="<?=$row->uwagi?>" />
<input type="hidden" name="status" value="<?=$row->status?>" />
<? } ?>
<input type="button" class="button" value="<<-Wstecz" onclick="javascript: history.go(-1)" />
<input type="submit" class="button" name="update" value="Modyfikuj" />
<input type="submit" class="button" name="print<? if ($_GET['edit']) echo '2'?>" value="Drukuj" onclick="javascript:drukuj()" />



</form>
</div>