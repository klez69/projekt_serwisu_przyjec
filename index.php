<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRZYJECIA</title>

    <!-- Linki do stylów CSS -->
    <link rel="stylesheet" type="text/css" href="potPrzyjecia/css/style.css" />
    <link rel="stylesheet" type="text/css" href="potPrzyjecia/css/print.css" media="print" />

    <!-- Linki do skryptów JavaScript -->
    <script src="https://code.jquery.com/jquery-latest.js"></script>
    <script src="potPrzyjecia/js/script.js" type="text/javascript"></script>
    <script src="potPrzyjecia/js/ukryj.js" type="text/javascript"></script>
</head>
<body>
    <header>
        <h1>[NAZWA FIRMY]</h1>
    </header>

    <main>
        <center>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio accusamus, ipsum nulla at exercitationem
                commodi obcaecati quidem sit! Dolorem labore perferendis voluptates, neque dignissimos commodi optio
                ipsum
                possimus harum itaque.</p>
        </center>

        <?php
        require_once('list.php');
        ?>
    </main>
</body>

</html>