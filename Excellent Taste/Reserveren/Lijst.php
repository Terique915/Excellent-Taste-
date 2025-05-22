<?php
require_once ('../config.php');
session_start();
//Query om alle reservering van vandaag te vangen van de database
$Date = date('Y-m-d');

$query="SELECT reservering.*, klant.Naam From reservering LEFT JOIN klant ON reservering.klant_idKLant = idKlant WHERE Datum = :date ";
$stmt= $conn->prepare($query);
$stmt->execute([
    ':date'=>$Date
]);
$results= $stmt->fetchAll();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lijst van Reserveren</title>
    <link rel="stylesheet" href="lijst.css">
</head>
<body>
<header id="header">
    <div id="Logo">
        <h1> Excellent Taste </h1>
    </div>
    <div id="hovermenu">
        <ul id="hoofdmenu">
            <li><a style="text-decoration: none; color: black" href="../index.php">Home</a></li>
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
<section >
<?php
echo "<table id='Lijst' border='1'>";
//[[366]]Begin(Tonen)
echo "<thead>
        <tr>
            <th>Naam</th>
            <th>Tafel</th>
            <th>Aantal Gasten</th>
            <th>Datum</th>
            <th>Tijd</th>
            <th>Opmerking</th>
            <th>Allergien</th>
            <th>Wijzegen</th>
            <th>Verwijderen</th>
        </tr>
      </thead>";
//[[366]]Einde(Tonen)
// Alle resultaten in in een tabel.
foreach ($results as $row) {
    echo "<tr>";
    echo "<td>" . $row['Naam'] . "</td>";
    echo "<td><a href='../Bestellingen/bestellen.php?Reserveringid=" . $row['idReservering'] . "'>" . $row['Tafel'] .
        "</a></td>";
    echo "<td>" . $row['AantalPersonen'] . "</td>";
    echo "<td>" . $row['Datum'] . "</td>";
    echo "<td>" . $row['Tijd'] . "</td>";
    echo "<td>" . $row['Opmerking'] . "</td>";
    //[[366]]Begin(Tonen)
    echo "<td>" . $row['Allergien'] . "</td>";
    //[[366]]Einde(Tonen)
//    reservereing update
    echo "<td><a href='update.php?id=" . $row['idReservering'] . "'><button>Bewerk</button></a></td>";
//    reservering verwijderen
    echo "
<td>
    <form method='post' action='delete.php' onsubmit=\"return confirm('Weet je zeker dat je dit wilt verwijderen?');\">
        <input type='hidden' name='reservering_id' value='" . $row['idReservering'] . "'>
        <button type='submit'>Verwijder</button>
    </form>
</td>";    echo "</tr>";
}

echo "</tbody>";
echo "</table>";
 ?>
</section>
</body>
</html>
