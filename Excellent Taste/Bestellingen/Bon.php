<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bon</title>
    <link rel="stylesheet" href="bestellen.css">
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
                    <li><a style="text-decoration: none; color: white" href="../Reserveren/Reserveform.php">Formulier</a> </li>
                    <li><a style="text-decoration: none; color: white" href="../Reserveren/Lijst.php">Lijst</a></li>
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

</body>
</html>
<?php
require_once ('../config.php');
session_start();
if (isset($_GET['Reserveringid'])) {
    $reserveringID = intval($_GET['Reserveringid']);

    $query = "SELECT menu.naam, menu.prijs, bestellingen.aantal FROM bestellingen LEFT JOIN menu ON bestellingen.Menu_IdMenu=menu.IdMenu 
                WHERE bestellingen.Reservering_idReservering = :reserveringID";

    $stmt = $conn->prepare($query);
    $stmt->execute([':reserveringID' => $reserveringID]);
    $ordered_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($ordered_items)) {
    $total = 0;

    echo "<h2>BON</h2>";
    echo "<table id='bon' border='1' style='background-color: white'>";
    echo "<tr><th>Menu Item</th><th>Prijs</th><th>Aantal</th><th>Totaal</th></tr>";

    // Loop through the ordered items and display them
    foreach ($ordered_items as $item) {
        $item_total = $item['prijs'] * $item['aantal'];
        $total += $item_total;

            echo "<tr>";
            echo "<td>" . htmlspecialchars($item['naam']) . "</td>";
            echo "<td>" . number_format($item['prijs'], 2) . "</td>";
            echo "<td>" . $item['aantal'] . "</td>";
            echo "<td>" . number_format($item_total, 2) . "</td>";
            echo "</tr>";
    }

    // Display the overall total
    echo "<tr><td colspan='3'><strong>Totaal</strong></td><td>" . ($total) . "</td></tr>";
    echo "</table>";
}}
?>

