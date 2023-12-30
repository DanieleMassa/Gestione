<?php

$priority = filter_input(INPUT_POST, 'priority', FILTER_VALIDATE_INT);
$pianeta = filter_input(INPUT_POST, 'pianeta', FILTER_VALIDATE_INT);
$terms = filter_input(INPUT_POST, 'terms', FILTER_VALIDATE_BOOL);
$user_id = $_POST['user_id'];

if ($priority === false || $pianeta === false || $terms === false || $user_id === null) {
    die("Errore nei dati inviati.");
}

// Connessione al database
$host = "localhost";
$database = "gestione";
$username = "root";
$password = "";

$conn = mysqli_connect($host, $username, $password, $database);

if (mysqli_connect_errno()) {
    die("Errore di connessione al database: " . mysqli_connect_error());
}

// Verifica se l'ID dell'utente esiste nella tabella ids
$id_check_query = "SELECT * FROM ids WHERE user_id = ?";
$id_check_stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($id_check_stmt, $id_check_query)) {
    die("Errore nella preparazione dello statement: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($id_check_stmt, "s", $user_id);
mysqli_stmt_execute($id_check_stmt);
mysqli_stmt_store_result($id_check_stmt);

if (mysqli_stmt_num_rows($id_check_stmt) === 0) {
    die("ID utente non valido. Inserisci un ID presente nella tabella IDs.");
}

// Verifica se l'utente ha già votato
$vote_check_query = "SELECT * FROM votazione_pianeti WHERE user_id = ?";
$vote_check_stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($vote_check_stmt, $vote_check_query)) {
    die("Errore nella preparazione dello statement: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($vote_check_stmt, "s", $user_id);
mysqli_stmt_execute($vote_check_stmt);
mysqli_stmt_store_result($vote_check_stmt);

if (mysqli_stmt_num_rows($vote_check_stmt) > 0) {
    die("Hai già votato. Non è possibile votare più di una volta.");
}

// Inserisci il voto nel database
$insert_query = "INSERT INTO votazione_pianeti (user_id, pianeta) VALUES (?, ?)";
$insert_stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($insert_stmt, $insert_query)) {
    die("Errore nella preparazione dello statement: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($insert_stmt, "si", $user_id, $pianeta);
mysqli_stmt_execute($insert_stmt);

echo "Voto registrato con successo!";

$message = "Voto registrato con successo";
