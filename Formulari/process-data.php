<?php

$testo = $_POST['testo'];
$user_id = $_POST['user_id'];


if ($testo === false) {
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

// Verifica che l'ID dell'utente esista nella tabella ids
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


// Inserisci il voto nel database
$insert_query = "INSERT INTO formulario3 (user_id, testo) VALUES (?, ?)";
$insert_stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($insert_stmt, $insert_query)) {
    die("Errore nella preparazione dello statement: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($insert_stmt, "ss", $user_id, $testo);
mysqli_stmt_execute($insert_stmt);


header("Location: http://localhost/gestione/formulari/formulario3/form.php");

$message = "Voto registrato con successo";
