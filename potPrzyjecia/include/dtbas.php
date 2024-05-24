<?
// #opis: Definicja dostepu do bazy danych
// #autr: ©Janusz Rojek, czerwiec 2023 r.
// plik: dtbas.php

// ąćęłńóśżźĄĆĘŁŃÓŚŻŹ (utf-8)

$db_srvr1 = "localhost";
$db_user1 = "user";
$db_pswd1 = "pass";
$db_dtbs1 = "baza";

$db_error00 = '';
$db_error01 = 'ERROR (mysql_connect): nie mozna polaczyc sie z baza danych, sprobuj pozniej.';
$db_error02 = 'ERROR (mysql_select_db): nie mozna polaczyc sie z baza danych.';

$klucz = '';
?>
