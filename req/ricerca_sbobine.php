<?php
include '../db_connector.php';

// Verifica che la richiesta sia di tipo POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Verifica se la connessione è riuscita
    if ($conn->connect_error) {
        die("Connessione al database fallita: " . $conn->connect_error);
    }

    // Ottieni il valore di ricerca inviato dal modulo
    $search_term = $_POST["search_text"];

    // Esegui la query per cercare le bobine nel database
    $sql = "SELECT sbobine_calendarizzate.*, insegnamenti.materia AS nome_materia
            FROM sbobine_calendarizzate
            INNER JOIN insegnamenti ON sbobine_calendarizzate.insegnamento = insegnamenti.id
            WHERE insegnamenti.materia LIKE '%$search_term%'
            OR sbobine_calendarizzate.data_lezione LIKE '%$search_term%'";

    $result = $conn->query($sql);

    // Chiudi la connessione al database
    $conn->close();

    function getSbobinatoriFromSbobina($sbobina_id, $conn)
    {
        $sbobinatori_data = array();

        // Esegui la query per ottenere gli ID degli sbobinatori associati alla sbobina
        $query = "SELECT id_sbobinatore FROM sbobinatori_sbobine WHERE id_sbobina = $sbobina_id";
        $result = $conn->query($query);

        // Popola l'array con gli ID degli sbobinatori
        while ($row = $result->fetch_assoc()) {
            $sbobinatori_ids[] = $row['id_sbobinatore'];
        }

        // Ottieni i nomi e i cognomi degli sbobinatori associati agli ID
        if (!empty($sbobinatori_ids)) {
            $sbobinatori_ids_str = implode(',', $sbobinatori_ids);
            $query_users = "SELECT nome, cognome FROM users WHERE id IN ($sbobinatori_ids_str)";
            $result_users = $conn->query($query_users);

            // Popola l'array con i nomi completi degli sbobinatori
            while ($row_user = $result_users->fetch_assoc()) {
                $sbobinatori_data[] = $row_user['nome'] . ' ' . substr($row_user['cognome'], 0, 1) . '.';
            }
        }

        return $sbobinatori_data;
    }

    // Mostra i risultati della ricerca
    if ($result->num_rows > 0) {
        echo '<table class="table">'; // Inizia la tabella


        // Inizia il corpo della tabella
        echo '<tbody>';

        // Popola le righe della tabella con i dati ottenuti dalla query
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row["id"] . '</td>';
            echo '<td>' . $row["nome_materia"] . '</td>';
            echo '<td>' . $row["data_lezione"] . '</td>';
            echo '<td>' . $row["data_lezione"] . '</td>';
            echo '<td>' . $row["data_lezione"] . '</td>';

            // Aggiungi altre colonne e dati se necessario
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>'; // Fine della tabella
    } else {
        echo "Nessun risultato trovato.";
    }
}
?>
