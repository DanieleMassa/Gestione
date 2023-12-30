<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Creazione Formulari</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
<div class="container">
 <h1>Formulario Matematica</h1>

  <div id="userDetailsTable"></div>

    <form action="process-data.php" method="post" id="myForm">
        <label for="user_id">Inserisci il codice ID</label>
        <input type="text" id="user_id" name="user_id" style="width: 500px">

    <div class="tabella">
      <h2>Lista Voti</h2>

      <table>
        <thead>
          <tr>
            <th>Testo</th>
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

        $sql = "SELECT testo FROM formulario3";

        $result = $conn->query($sql);

        if (!$result) {
            die("Errore nella query: " . $conn->error);
        }

        echo "<table>
        <tr>
            <th></th>
        </tr>";

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                <td>" . $row["testo"] . "</td>
              </tr>";
            }
        } else {
            echo "<tr><td>Non ci sono ancora richieste disponibili.</td></tr>";
        }

        echo "</table>";

        $conn->close();
        ?>
        </tbody>
      </table>
    </div>
    <fieldset>
        <legend>Argomenti Formulario</legend>
        <span>
            <label for="testo">Richiesta:</label>
            <input type="text" id="testo" name="testo" value="9">
        </span>
    </fieldset>
    <button>Invia!</button>
  </form>
</div>
</body>
</html>

