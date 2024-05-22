<div id="form">
<img src="images/logoo.png">
<h2>Potwierdzenie przyjęcia sprzetu do naprawy</h2>
<br />
<center><b><p>
[nazwa]<br />
[adres]<br />
Tel. [tel]<br />
</p></b></center>
<form action="form.php" method="post" />
<p>Numer zlecenia:<input type="text" name="nr" value="<?=$nr?>" />

<h4>Zlecający naprawę:</h4>
<table>
<tr>
   <td class="l21">Nazwa (imie/nazwisko):</td>
   <td><input type="text" name="nazwa" style="width: 100%;" value="<?=$row->nazwa?>" /></td>
</tr>
<tr>
   <td class="l21">Telefon:</td>
   <td><input type="text" name="tel" style="width: 100%;" value="<?=$row->tel?>" /></td> 
   <td class="l21">Adres:</td>
   <td><input type="text" name="adres" class="i10" style="width: 100%;" value="<?=$row->adres?>" /></td>
</tr>
<tr>
   <td class="l21">Kod:</td>
   <td><input type="text" name="kod" style="width: 100%;" value="<?=$row->kod?>" /></td> 
   <td class="l21">Miasto:</td>
   <td><input type="text" name="miasto" class="i10" style="width: 100%;" value="<?=$row->miasto?>" /></td>
</tr>
<tr>
   <td class="l21">NIP:</td>
   <td><input type="text" name="nip" style="width: 100%;" value="<?=$row->nip?>" /></td> 
</tr>

</table>

<h4>Dane dotyczące sprzętu:</h4>
<table>
<tr>
   <td class="l20">Marka/Model:</td>
   <td><input type="text" name="marka" style="width: 100%;" value="<?=$row->marka?>" /></td>
   <td class="l21">Numer seryjny:</td>
   <td><input type="text" name="numer" style="width: 100%;" value="<?=$row->numer?>" /></td>
</tr>
</table>

<h4>Akcesoria dostarczone ze sprzętem:</h4>
<table>
<tr>
   <td>
   <input type="checkbox" class="chk" name="zasilacz" <? if ($row->zasilacz) echo 'checked="checked"';?> /> Zasilacz
   <input type="checkbox" class="chk" name="kabel" <? if ($row->kabel) echo 'checked="checked"';?> /> Kabel zasilający
   <input type="checkbox" class="chk" name="bateria" <? if ($row->bateria) echo 'checked="checked"';?> /> Bateria
   <input type="checkbox" class="chk" name="torba" <? if ($row->torba) echo 'checked="checked"';?> />Torba
   </td>
</tr>
</table>

<table>
<tr>
   <td class="l10">Inne:</td> 
   <td><input type="text" name="inne" style="width: 100%;" value="<?=$row->inne?>" /></td>
</tr>
<tr>
   <td class="l10" >Uwagi:</td>
   <td><input type="text" name="uwagi" style="width: 100%;" value="<?=$row->uwagi?>" /></td>
</tr>

</table>

<p>Tarnów: <input type="text" value="<?if ($_GET['edit']) echo date('j - m - Y', $row->data); else echo date('j - m - Y');?>" /></p>

<p id="potwierdzenie">Potwierdzam odbiór wyżej wymienionego sprzetu z naprawy: ........................................</p>

<? if ($_GET['edit']) { ?>
	<tr>
<td><b>Dane go gwarancji:</b></td>
<br />
   <td class="l10" >liość miesięcy:</td>
   <select name="miesiac">
		<option value="<?=$row->miesiac?>"><?=$row->miesiac?></option>
		<option value=""></option>
		<option value="1 miesiąc">1 miesiąc</option>
		<option value="3 miesiące">3 miesiące</option>
		<option value="6 miesiący">6 miesiący</option>
		<option value="12 miesiący">12 miesiący</option>
	</select></tr><br /><br />
	<tr><td>Data wydania:<input type="data" name="data_wyd" value="<?=$row->data_wyd?>" /></td>
   <br />
   <td class="l10" >Uwagi po wydaniu:</td><td><input type="text" name="uwagi_wyd" style="width: 100%;" value="<?=$row->uwagi_wyd?>" /></td>
</tr>
   <br />
</tr>
<input type="hidden" name="status" value="<?=$row->status?>" />
	<input type="button" class="button" value="<<-Wstecz" onclick="javascript: history.go(-1)" />
	<input type="submit" class="button" name="update" value="Modyfikuj" />
<? } ?>
<input type="button" class="button" value="X-Zamknij" onclick="javascript: window.close()" />
<input type="submit" class="button" name="print<? if ($_GET['edit']) echo '2'?>" value="Drukuj" onclick="javascript:drukuj()" />
</form>
</div>
