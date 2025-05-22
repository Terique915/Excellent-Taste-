<?php
require_once ('config.php');
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="index.css">
    <title>Homepage</title>
</head>
<body>
<header id="header">
    <div id="Logo">
        <h1> Excellent Taste </h1>
    </div>
    <div id="hovermenu">
        <ul id="hoofdmenu">
            <li><a style="text-decoration: none; color: black" href="index.php">Home</a>
            </li>
            <li>Reserveringen ▾
                <ul id="subReserveringen">
                    <li><a style="text-decoration: none; color: white" href="Reserveren/Reserveform.php">Formulier</a> </li>
                    <li><a style="text-decoration: none; color: white" href="Reserveren/Lijst.php">Lijst</a></li>
                </ul>
            </li>
            <li>Serveren ▾
              <ul id="subserveren">
                <li>Voor kok</li>
                <li>Voor barman</li>
                <li>Voor ober</li>
              </ul>
            </li>
            <li>Gegevens ▾
                <ul id="subGegevens">
                    <li>Drinken</li>
                    <li>Eten</li>
                    <li>Klanten</li>
                    <li>Gerecht Hoofdgroep</li>
                    <li>Gerecht subgroep</li>
                </ul>
            </li>
        </ul>

    </div>
</header>

<section id="content">
    <div id="tekst">
        <h3>
            Welkom bij de reserevering en bestellingenapplicatie van Restaurant Excellent Taste.

            Vul eerst een reservering in. Deze kan telefonisch binnenkomen of kan worden ingevoerd als gasten
            plaatsnemen bj een vrije tafel.

            Daarna kan een bestelling worden opgenomen.
        </h3>

    </div>
    <div id="image">
        <img id="photo1"src="Image/ExcellentTaste.jpg">
    </div>
</section>

<footer id="footer"><h1> Excellent Taste </h1> <h4>V 1.0</h4> </footer>
</body>
</html>
