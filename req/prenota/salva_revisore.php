<?php
session_start();
$sbobinaId = $_POST['sbobinaId'];
$revisoreId = $_SESSION['id'];

// Connessione al database (sostituisci con le tue credenziali)
include "../../db_connector.php";

$conn = mysqli_connect($sName, $uName, $pass, $db_name);


if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

// Esegui la query per inserire i dati nella tabella sx_sbobinatori_sbobine
$sql = "INSERT INTO sx_revisori_sbobine (id_sbobina, id_revisore) VALUES ($sbobinaId, $revisoreId)";

if ($conn->query($sql) === TRUE) {
    echo "Sei diventato revisore di questa lezione. Buon lavoro!";
} else {
    echo "Errore: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
