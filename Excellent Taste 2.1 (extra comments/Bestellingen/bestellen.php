<?php
require_once ('../config.php');
session_start();

// Query om alle menu items te vangen met naam prijs  categorie en sub categorie.
try {

    $stmt = $conn->prepare("SELECT IdMenu,
                                menu.Naam AS MenuNaam,
                                Prijs,
                                subcategorie.Naam AS SubcategoryNaam,
                                categorie.Naam AS CategoryNaam 
                            FROM menu 
                            LEFT JOIN subcategorie ON menu.Subcategorie_idSubcategorie = subcategorie.idSubcategorie 
                            LEFT JOIN categorie ON subcategorie.Categorie_idCategorie = categorie.idCategorie");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bestellingen</title>
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

<section>
<!-- Reservering id sturen in url om bestellde items bij te houden voor die reservering-->
<form method="post" action="bestelling%20process.php?Reserveringid=<?= $_GET['Reserveringid'] ?>">
    <?php
//
    // Alle results samen groepen bij hun categorieNaam
    $grouped = [];
    foreach ($result as $row) {
        $category = $row['CategoryNaam'] ;
        $grouped[$category][] = $row;
    }

    // Alle  menu items in hun eigen tabel onder hun Categorie naam
    foreach ($grouped as $categoryName => $items) {
        echo "<h2>" . ($categoryName) . "</h2>";
        echo "<table id='Menu' border='1'>";
        echo "<tr><th>Menu Name</th><th>Subcategorie</th><th>Price</th><th>Select</th><th>Aantal</th></tr>";

        foreach ($items as $item) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($item['MenuNaam']) . "</td>";
            echo "<td>" . htmlspecialchars($item['SubcategoryNaam']) . "</td>";
            echo "<td>" . htmlspecialchars($item['Prijs']) . "</td>";
            echo "<td><input type='checkbox' name='menu_items[]' value='" . $item['IdMenu'] . "'></td>";
            echo "<td><input type='number' name='aantal[" . $item['IdMenu'] . "]' value='0' min='0' max='10'></td>";
            echo "</tr>";
        }

        echo "</table><br>";
    }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>
    <input type="submit" name="Bestellen" value="Bestellen" id="Bestelknop">
</form>
    <a  href="Bon.php?Reserveringid=<?= $_GET['Reserveringid'] ?>">
        <button id="Bon" onclick="">Bon Uitprinten</button>
    </a>

</section>



</body>
</html>
