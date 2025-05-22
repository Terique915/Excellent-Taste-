<?php
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="User.css">
    <title>Reserve Form</title>
</head>
<body>
<header id="header"><h1> Excellent Taste </h1></header>
<section id="form">
    <div id="formulier">
        <form method="post">
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
                    <input  id="telefoon" type="tel" name="telefoon" required maxlength="10">
                </div>

            </div>
            <div id="line"></div>
            <div id="gasten">
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
            <div id="tijd">
                <input id="date" type="date" required>
                <input type="time">
            </div>
            <div id="opmerking">
                <input id="opmerking" type="text" name="opmerking">
            </div>

        </form>
    </div>
</section>
</body>
</html>
