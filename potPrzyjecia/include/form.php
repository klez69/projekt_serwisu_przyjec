<div id="form">
<h2>Potwierdzenie przyjęcia sprzetu do naprawy</h2>
<h3>
Notebook Service<br />
ul. Pulaskiego 6B, 33-100 Tarnów<br />
Tel. 503 779 312
</h3>
<form action="form.php" method="post" />
<p>Numer zlecenia:<input type="text" name="nr" value="<?=$nr?>" />

<h4>Zlecający naprawę:</h4>
<table>
<tr>
   <td class="l25">Nazwa (imię/nazwisko):</td>
   <td><input type="text" name="nazwa" style="width: 100%;" value="<?=$row->nazwa?>" /></td>
</tr>
</table>

<table style="width: 100%;">
<tr>
   <td class="l10">Adres:</td>
   <td><input type="text" name="adres" class="i100" style="width: 100%;" value="<?=$row->adres?>" /></td>
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
   <input type="checkbox" class="chk" name="zasilacz" <? if ($row->zasilacz) echo 'checked="checked"';?> /> Zasilacz<br />
   <input type="checkbox" class="chk" name="kabel" <? if ($row->kabel) echo 'checked="checked"';?> /> Kabel zasilajacy<br />
   <input type="checkbox" class="chk" name="bateria" <? if ($row->bateria) echo 'checked="checked"';?> /> Bateria<br />
   <input type="checkbox" class="chk" name="torba" <? if ($row->torba) echo 'checked="checked"';?> />Torba<br />
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
<tr>
   <td class="l10" >liość miesięcy:</td>
   <td><input type="text" name="miesiac" style="width: 100%;" value="<?=$row->miesiac?>" /></td>
</tr>
</table>

<p>Tarnów: <input type="text" value="<?=date('j - m - Y')?>" /></p>

<p id="potwierdzenie">Potwierdzam odbiór wyżej wymienionego sprzetu z naprawy: ........................................</p>

<input type="submit" class="button" name="update" value="Modyfikuj" />
<input type="submit" class="button" name="print<? if ($_GET['edit']) echo '2'?>" value="Drukuj" onclick="javascript:drukuj()" />
</form>
</div>