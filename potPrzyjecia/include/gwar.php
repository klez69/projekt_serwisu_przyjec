<div id="gwar">

<br />
<center><h1>KARTA GWARANCYJNA nr <input type="text" name="nr" value="<?=$nr?>" /></h1></center>


<form action="gwar.php" method="post" />
<br />
<center><h4>Data wydania sprzętu po naprawie .........</h4></center>
<center><h4>Na naprawę udzielamy <input type="text" name="miesiac" value="<?=$row->miesiac?>" /> miesięc/y gwarancji od daty wydania sprzętu po naprawie</h4></center>
<table>
<tr><td class="l25">Nazwa (imie/nazwisko):</td><td><b><input type="text" name="nazwa" style="width: 100%;" value="<?=$row->nazwa?>" /></b></td></tr>
<td class="l10">Adres:</td><td><input type="text" name="adres" class="i100" style="width: 100%;" value="<?=$row->adres?>" /></td>
<tr><td class="l20">Marka/Model:</td><td><input type="text" name="marka" style="width: 100%;" value="<?=$row->marka?>" /></td></tr>
<tr><td class="l21">Numer seryjny:</td><td><input type="text" name="numer" style="width: 100%;" value="<?=$row->numer?>" /></td></tr>
<tr><td class="l21">Numer nr zlecenia:</td><td><input type="text" name="nr" value="<?=$nr?>" /></td></tr>
</table>
<center><h4>Zgłoszenie usterek objętych naprawą gwarancyjną są przyjmowane telefonicznie bądź w biurze obsługi klienta.</h4></center>

<table style="text-align:center;">
<tr><td>[nazwa]</td><td>[Tel]:</td></tr>
<tr><td>[adres]</td><td>[tel]</td></tr>
<tr><td>[kod, miasto]</td><td></td></tr>
</table>


<center><h2>Warunki gwarancji.</h2></center>
<table style="text-align:center;">
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

<p>Tarnów: <input type="text" value="<?if ($_GET['dodaj']) echo date('j - m - Y', $row->data); else echo date('j - m - Y');?>" /></p>

<br />

<? if ($_GET['dodaj']) { ?>
	<input type="button" class="button" value="<<-Wstecz" onclick="javascript: history.go(-1)" />
	<input type="submit" class="button" name="zmien" value="Modyfikuj" />
<? } ?>
<input type="button" class="button" value="X-Zamknij" onclick="javascript: window.close()" />
<input type="submit" class="button" name="print<? if ($_GET['dodaj']) echo '2'?>" value="Drukuj" onclick="javascript:drukuj()" />
</form>
</div>
