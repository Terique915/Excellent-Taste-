<?php
require_once ('../config.php');
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['menu_items'])) {
    $menu_items = $_POST['menu_items'];
    $aantal = $_POST['aantal'];
    $ReserveringID = isset($_GET['Reserveringid']) ? intval($_GET['Reserveringid']) : null;



    if ($ReserveringID > 0) {
        foreach ($menu_items as $menuId) {
            // Check if a quantity is set and greater than 0
            if (isset($aantal[$menuId]) && intval($aantal[$menuId]) > 0) {
                $quantity = intval($aantal[$menuId]);
                try {
                    $stmt = $conn->prepare("INSERT INTO bestellingen (Reservering_idReservering, Menu_IdMenu, Aantal)
                                    VALUES (:idReservering, :IdMenu, :Aantal)");
                    $stmt->execute([
                        ":idReservering" => $ReserveringID,
                        ":IdMenu" => $menuId,
                        ":Aantal" => $quantity
                    ]);


                    echo "Je hebt menu id $menuId bestelt met aantal: $quantity<br>";
                    header("refresh:1;url=bestellen.php?Reserveringid= $ReserveringID");
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage(); // Handle errors
                }

            }


        }}}
?>