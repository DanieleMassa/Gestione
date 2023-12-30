<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Votazioni Scienze</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
<div class="container">
  <h1>Votazioni gruppi scienze</h1>

  <div id="userDetailsTable"></div>

  <form action="process-data.php" method="post" id="myForm">

    <label for="user_id">Inserisci il codice ID</label>
    <input type="text" id="user_id" name="user_id" style="width: 500px">


    <div class="tabella">
      <h2>Lista Voti</h2>
      <br>
      <table>

        <thead>
          <tr>
            <th>Nome</th>
            <th>Cognome</th>
            <th>Pianeta</th>
          </tr>
        </thead>

        <tbody>
        <?php
        // Connessione al database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "gestione";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connessione fallita: " . $conn->connect_error);
        }

        $sql = "SELECT ids.nome, ids.cognome, pianeti.nome AS nome_pianeta
        FROM ids
        JOIN votazione_pianeti ON ids.user_id = votazione_pianeti.user_id
        JOIN pianeti ON votazione_pianeti.pianeta = pianeti.id";

        $result = $conn->query($sql);

        if (!$result) {
            die("Errore nella query: " . $conn->error);
        }

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                <td>" . $row["nome"] . "</td>
                <td>" . $row["cognome"] . "</td>
                <td>" . $row["nome_pianeta"] . "</td>
              </tr>";
            }
        } else {
            echo "Sei il primo a votare!";
        }

        $conn->close();
        ?>
        </tbody>

      </table>
    </div>
    <fieldset>
      <legend>Scegli tra i pianeti</legend>
      <label>
        <input type="radio" name="pianeta" value="1" checked>
        Mercurio
      </label>
      <br>
      <label>
        <input type="radio" name="pianeta" value="2">
        Venere
      </label>
      <br>
      <label>
        <input type="radio" name="pianeta" value="3">
        Terra
      </label>

      <br>
      <label>
        <input type="radio" name="pianeta" value="4">
        Marte
      </label>
      <br>
      <label>
        <input type="radio" name="pianeta" value="5">
        Giove
      </label>
      <br>
      <label>
        <input type="radio" name="pianeta" value="6">
        Saturno
      </label>
      <br>
      <label>
        <input type="radio" name="pianeta" value="7">
        Urano
      </label>
      <br>
      <label>
        <input type="radio" name="pianeta" value="8">
        Nettuno
      </label>
      <br>
      <label>
        <input type="radio" name="pianeta" value="9">
        Plutone
      </label>
    </fieldset>

    <button>Invia!</button>
  </form>
</div>

</body>
</html>
