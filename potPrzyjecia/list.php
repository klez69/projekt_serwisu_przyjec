<?php
session_start();
include('potPrzyjecia/include/dtbas.php');

if (!isset($_SESSION['s']) || $_SESSION['s'] !== true) {
    if (isset($_GET['s']) && $_GET['s'] === '$klucz') {
        $_SESSION['s'] = true;
    } else {
        $_SESSION['s'] = false;
    }
}

if (isset($_GET['l']) && $_GET['l'] == 1) {
    $_SESSION['s'] = false;
}

if ($_SESSION['s'] === true) {
    include('potPrzyjecia/layout/header.php');
    include('potPrzyjecia/include/dtbas.php');

    // Tworzenie połączenia
    $db = new mysqli($db_srvr1, $db_user1, $db_pswd1, $db_dtbs1);

    // Sprawdzanie połączenia
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    include('potPrzyjecia/include/list.php');

    // Zamknięcie połączenia
    $db->close();
    include('potPrzyjecia/layout/footer.php');
} else {
    header("Location: http://[strona]");
    exit();
}
?>