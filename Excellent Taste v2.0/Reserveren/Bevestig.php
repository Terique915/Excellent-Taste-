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

            // Get the last inserted klant_id (to use as foreign key for reservering)
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

    // Check if the table is available at the given time
    try {
        $stmt = $conn->prepare("SELECT tafel FROM reservering WHERE datum = :datum AND tijd = :tijd");
        $stmt->execute([
            ':datum' => $datum,
            ':tijd' => $tijd
        ]);
        $reservedTables = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Create an array of reserved tables
        $reservedTafels = [];
        foreach ($reservedTables as $row) {
            $reservedTafels[] = $row['tafel'];
        }

        // Find a random available table (assuming tables are numbered 1-10 for example)
        $availableTafel = null;
        for ($i = 1; $i <= 10; $i++) {
            if (!in_array($i, $reservedTafels)) {
                $availableTafel = $i;
                break;
            }
        }

        if (!$availableTafel) {
            echo "No available tables at this time. Please select a different time.";
            exit;
        } else {
            // Insert reservering with available tafel
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
            ]);

            echo "Reservation successfully created with table " . $availableTafel . ".";
            header("refresh:1;url=Lijst.php");
        }

    } catch (PDOException $e) {
        echo "Error checking table availability: " . $e->getMessage();
    }
}
?>