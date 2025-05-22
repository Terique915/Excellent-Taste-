<?php
require_once('../config.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch submitted data
    $reservering_id = $_POST['reservering_id'];
    $klant_id = $_POST['klant_id'];

    // Klant
    $voornaam = $_POST['voornaam'];
    $achternaam = $_POST['achternaam'];
    $telefoon = $_POST['telefoon'];
    $email = $_POST['email'];
    $naam = $voornaam . ' ' . $achternaam;

    // Reservering
    $gasten = $_POST['gast'];
    $datum = $_POST['datum'];
    $tijd = $_POST['tijd'];
    $opmerking = $_POST['opmerking'];
    $allergien = $_POST['allergien'];

    try {
        // Update klant
        $stmt = $conn->prepare("UPDATE klant SET naam = :naam, Telefoon = :telefoon, email = :email WHERE idKlant = :id");
        $stmt->execute([
            ':naam' => $naam,
            ':telefoon' => $telefoon,
            ':email' => $email,
            ':id' => $klant_id
        ]);

        // Update reservering
        //[[366]]Begin(wijzigen)
        $stmt = $conn->prepare("UPDATE reservering 
            SET AantalPersonen = :gasten, datum = :datum, tijd = :tijd, opmerking = :opmerking, allergien = :allergien 
            WHERE idReservering = :id");
        $stmt->execute([
            ':gasten' => $gasten,
            ':datum' => $datum,
            ':tijd' => $tijd,
            ':opmerking' => $opmerking,
            ':allergien' => $allergien,
            //[[366]]Einde(wijzigen)
            ':id' => $reservering_id
        ]);

        $_SESSION['success'] = "Reservering succesvol bijgewerkt.";
        header("Location: Lijst.php");
        exit;

    } catch (PDOException $e) {
        echo "Fout bij updaten: " . $e->getMessage();
    }

} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    // Fetch reservation and customer details
    $reservering_id = $_GET['id'];

    $stmt = $conn->prepare("SELECT r.*, k.idKlant, k.Naam, k.Telefoon, k.Email 
                            FROM reservering r 
                            JOIN klant k ON r.klant_idKlant = k.idKlant 
                            WHERE idReservering = :id");
    $stmt->execute([':id' => $reservering_id]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        echo "Reservering niet gevonden.";
        exit;
    }

    list($voornaam, $achternaam) = explode(' ', $data['Naam'], 2);
} else {
    echo "Geen reservering geselecteerd.";
    exit;
}
?>

<!-- Form to display and update -->
<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Reservering Bewerken</title>
    <link rel="stylesheet" href="Reserveren.css" >
</head>
<body>
<h1>Reservering bijwerken</h1>
<section id="form">
    <div id="formulier" >
<form method="post" action="update.php">
    <input type="hidden" name="reservering_id" value="<?= $data['idReservering'] ?>">
    <input type="hidden" name="klant_id" value="<?= $data['idKlant'] ?>">

    <div id="naam">
        <div class="input-field">
            <label for="voornaam">First Name</label>
            <input type="text" name="voornaam" id="voornaam" required value="<?= ($voornaam) ?>">
        </div>
        <div class="input-field">
            <label for="achternaam">Last Name</label>
            <input type="text" name="achternaam" id="achternaam" required value="<?= ($achternaam) ?>">
        </div>
    </div>

    <div id="contact">
        <div class="input-field">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" required value="<?= ($data['Email']) ?>">
        </div>
        <div class="input-field">
            <label for="telefoon">Telefoon</label>
            <input id="telefoon" type="tel" name="telefoon" required maxlength="15" value="<?= ($data['Telefoon']) ?>">
        </div>
    </div>

    <div id="line"></div>

    <div id="gasten">
        <div class="input-field">
            <label for="gast">Aantal Gasten</label>
            <select name="gast" id="gast" required>
                <?php
                for ($i = 1; $i <= 10; $i++) {
                    $selected = ($data['AantalPersonen'] == $i) ? "selected" : "";
                    echo "<option value='$i' $selected>$i</option>";
                }
                ?>
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
                <option value="">Kies een Tijd</option>
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
            <textarea id="opmerking" name="opmerking" rows="8"><?= htmlspecialchars($data['Opmerking']) ?></textarea>
        </div>
    </div>

    <div id="allergien">
        <div class="input-field">
            <label for="allergien">Allergieën</label>
            <textarea id="allergien" name="allergien" rows="4"><?= htmlspecialchars($data['Allergien']) ?></textarea>
        </div>
    </div>

    <div id="submit">
        <input type="submit" id="bevestig" value="Opslaan Wijziging">
    </div>
</form>
    </div>
</section>
</body>
</html>