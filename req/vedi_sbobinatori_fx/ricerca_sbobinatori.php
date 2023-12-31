<?php
// ricerca_sbobinatori.php

// Include il file di connessione al database
include "../../db_connector.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ottieni il valore di ricerca dal campo di input
    $searchText = $_POST["search_text"];

    // Query parametrizzata per ottenere gli sbobinatori in base al valore di ricerca
    $query = "SELECT * FROM sx_users WHERE matricola LIKE ? OR nome LIKE ? OR cognome LIKE ?";

    // Prepara la query
    $stmt = $conn->prepare($query);

    // Aggiungi il carattere jolly (%) al valore di ricerca
    $searchText = "%" . $searchText . "%";

    // Lega il parametro e imposta il tipo di dati
    $stmt->bind_param("sss", $searchText, $searchText, $searchText);

    // Esegui la query
    $stmt->execute();

    // Ottieni il risultato
    $result = $stmt->get_result();

    // Genera il codice HTML per le righe della tabella con i risultati filtrati
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['matricola'] . '</td>';
            echo '<td>' . $row['nome'] . '</td>';
            echo '<td>' . $row['cognome'] . '</td>';
            echo '<td>' . $row['malus'] . '</td>';
            echo '<td>' . $row['insegnamenti'] . '</td>';


            // Includi qui altre colonne della tabella, se necessario
            echo '<td>
                    <button class="btn btn-primary btn-sm btn-modifica" data-id="' . $row['id'] . '">Modifica</button>
                    <button class="btn btn-danger btn-sm btn-elimina" data-id="' . $row['id'] . '">Elimina</button>
                  </td>';
            echo '</tr>';
        }
    } else {
        // Nessun risultato trovato
        echo '<tr><td colspan="6">Nessun risultato trovato.</td></tr>';
    }

    // Chiudi il prepared statement
    $stmt->close();

    // Chiudi la connessione al database
    $conn->close();
} else {
    // Errore: metodo di richiesta non valido
    echo '<tr><td colspan="6">Errore nella richiesta di ricerca.</td></tr>';
}
?>


