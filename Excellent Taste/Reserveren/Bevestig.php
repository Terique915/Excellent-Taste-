<?php
require_once('../config.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Klanten data
    $voornaam = $_POST['voornaam'];
    $achternaam = $_POST['achternaam'];
    $telefoon = $_POST['telefoon'];
    $email = $_POST['email'];
    $naam = $voornaam . ' ' . $achternaam;

    // Reservering info
    $gasten = $_POST['gast'];
    $datum = $_POST['datum'];
    $tijd = $_POST['tijd'];
    $opmerking = $_POST['opmerking'];
    $allergien = $_POST['allergien'];

    if (!empty($voornaam) && !empty($achternaam) && !empty($telefoon) && !empty($email)) {
        try {
            // Insert klant
            $stmt = $conn->prepare("INSERT INTO klant (naam, Telefoon, email) VALUES (:naam, :telefoon, :email)");
            $stmt->execute([
                ':naam' => $naam,
                ':telefoon' => $telefoon,
                ':email' => $email
            ]);

            // Vangt het laatste inserted Klant Id om als foreign key te gebruiken
            $klant_id = $conn->lastInsertId();
            echo "Customer data inserted successfully.<br>";

        } catch (PDOException $e) {
            echo "Error inserting data into klant: " . $e->getMessage();
            exit;
        }
    } else {
        echo "Please fill in all required fields for klant.";
        exit;
    }
    //[[322]]Begin
    // Tafel functie dus dat tafels worden niet dubbel geboekt als een reservering dezelfde tijd en datum hebben
    try {
        $stmt = $conn->prepare("SELECT tafel FROM reservering WHERE datum = :datum AND tijd = :tijd");
        $stmt->execute([
            ':datum' => $datum,
            ':tijd' => $tijd
        ]);
        $reservedTables = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Maakt array een reserved tables
        $reservedTafels = [];
        foreach ($reservedTables as $row) {
            $reservedTafels[] = $row['tafel'];
        }

        // Een beschikbaare tafel vinden
        $availableTafel = null;
        for ($i = 1; $i <= 10; $i++) {
            if (!in_array($i, $reservedTafels)) {
                $availableTafel = $i;
                break;
            }
        }

        if (!$availableTafel) {
            echo "No available tables at this time. Please select a different time.";
            header("refresh:1;url=Lijst.php");
            exit;
            //[[322]]Einde
        } else {
            //[[366]]Begin(Insert)
            // Insert reservering met tafel
            $stmt = $conn->prepare("INSERT INTO reservering (klant_idKlant, tafel, datum, tijd, AantalPersonen, opmerking, allergien)
                                    VALUES (:klant_id, :tafel, :datum, :tijd, :AantalPersonen, :opmerking, :allergien)");
            $stmt->execute([
                ':klant_id' => $klant_id,
                ':tafel' => $availableTafel,
                ':datum' => $datum,
                ':tijd' => $tijd,
                ':AantalPersonen' => $gasten,
                ':opmerking' => $opmerking,
                ':allergien' => $allergien
            ]);//[[322]]Einde

            echo "Reservation successfully created with table " . $availableTafel . ".";
            header("refresh:1;url=Lijst.php");
        }

    } catch (PDOException $e) {
        echo "Error checking table availability: " . $e->getMessage();
    }
}
?>