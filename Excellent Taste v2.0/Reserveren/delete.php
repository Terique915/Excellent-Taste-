<?php

require_once('../config.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reservering_id = $_POST['reservering_id'];

    if (!empty($reservering_id)) {
        try {
            // First, get the klant_id linked to the reservation
            $stmt = $conn->prepare("SELECT klant_idKlant FROM reservering WHERE idReservering = :id");
            $stmt->execute([':id' => $reservering_id]);
            $reservering = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($reservering) {
                $klant_id = $reservering['klant_idKlant'];

                // Delete the reservation
                $stmt = $conn->prepare("DELETE FROM reservering WHERE idReservering = :id");
                $stmt->execute([':id' => $reservering_id]);


                $stmt = $conn->prepare("DELETE FROM klant WHERE idKlant = :klant_id");
                $stmt->execute([':klant_id' => $klant_id]);


                echo "Reservering succesvol verwijderd.";

                header("refresh:1;url=Lijst.php");
                exit;
            } else {
                echo "Reservering niet gevonden.";
            }

        } catch (PDOException $e) {
            echo "Fout bij verwijderen: " . $e->getMessage();
        }
    } else {
        echo "Geen reservering ID opgegeven.";
    }
} else {
    echo "Ongeldige toegang.";
}
