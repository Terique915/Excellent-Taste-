<?php
require_once ('../config.php');
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="Reserveren.css">
    <title>Reserve Form</title>
</head>
<body>
<header id="header">
    <div id="Logo">
        <h1> Excellent Taste </h1>
    </div>
    <div id="hovermenu">
        <ul id="hoofdmenu">
            <li><a style="text-decoration: none; color: black" href="../index.php">Home</a>
            <li>Reserveringen ▾
                <ul id="subReserveringen">
                    <li><a style="text-decoration: none; color: white" href="Reserveform.php">Formulier</a> </li>
                    <li><a style="text-decoration: none; color: white" href="Lijst.php">Lijst</a></li>
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
<section id="form">
    <div id="formulier" >
        <form method="post" action="Bevestig.php">
            <div id="naam">
                <div class="input-field">
                    <label for="voornaam">First Name</label>
                    <input type="text" name="voornaam" id="voornaam" required>
                </div>
                    <div class="input-field">
                        <label for="achternaam">Last Name</label>
                        <input type="text" name="achternaam" id="achternaam" required>
                    </div>
            </div>
            <div id="contact">
                <div class="input-field">
                    <label for="email">Email</label>
                    <input  id="email" type="text" name="email" required>
                </div>
                <div class="input-field">
                    <label for="telefoon">Telefoon</label>
                    <input  id="telefoon" type="tel" name="telefoon" required maxlength="15">
                </div>

            </div>
            <div id="line"></div>
            <div id="gasten">
                <div class="input-field">
                    <label for="gast">Aantal Gasten</label>
                <select name="gast" id="gast" required>
                    <option value="1">1 </option>
                    <option value="2">2 </option>
                    <option value="3">3 </option>
                    <option value="4">4 </option>
                    <option value="5">5 </option>
                    <option value="6">6 </option>
                    <option value="7">7 </option>
                    <option value="8">8 </option>
                    <option value="9">9 </option>
                    <option value="10">10 </option>
                </select>
                </div>
            </div>
            <div id="tijd">
                <div class="input-field">
                    <label for="date">Datum</label>
                <input id="date" type="date" name="datum" required min="<?= date('Y-m-d') ?>">
                </div>
                <div class="input-field">
                    <label for="tijd">Tijd</label>
                    <select name="tijd" id="time" required>
                        <option value="">Kies een tijd</option>
                        <option value="11:00">11:00</option>
                        <option value="11:30">11:30</option>
                        <option value="12:00">12:00</option>
                        <option value="12:30">12:30</option>
                        <option value="13:00">13:00</option>
                        <option value="13:30">13:30</option>
                        <option value="14:00">14:00</option>
                        <option value="14:30">14:30</option>
                        <option value="15:00">15:00</option>
                        <option value="15:30">15:30</option>
                        <option value="16:00">16:00</option>
                        <option value="16:30">16:30</option>
                        <option value="17:00">17:00</option>
                        <option value="17:30">17:30</option>
                        <option value="18:00">18:00</option>
                        <option value="18:30">18:30</option>
                        <option value="19:00">19:00</option>
                        <option value="19:30">19:30</option>
                        <option value="20:00">20:00</option>
                        <option value="20:30">20:30</option>
                        <option value="21:00">21:00</option>
                        <option value="21:30">21:30</option>
                        <option value="22:00">22:00</option>
                    </select>
                </div>
            </div>
            <div id="opmerking">
                <div class="input-field">
                    <label for="opmerking">Opmerking</label>
                    <textarea id="opmerking" type="text" name="opmerking" rows="8"></textarea>
            </div>
                <div id="allergien">
                    <div class="input-field">
                        <label for="allergien">Allergien</label>
                        <textarea id="allergien" type="text" name="allergien" rows="4"></textarea>
                    </div>
            </div>
                <div id="submit">
                    <input type="submit" id="bevestig" value="Bevestig Reservering ">
                </div>
        </form>

    </div>
</section>
</body>
</html>
