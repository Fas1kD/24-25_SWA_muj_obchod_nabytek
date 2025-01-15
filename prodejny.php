<?php
// Start session
session_start(); 
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="background-color: #ECECEC;">
    <!-- Nadpis -->
    <div class="head">
        <div class="ekea">
            <img style="position: absolute; top: 25px; left: 100px; width: 150px; height: auto;" alt="Popis obrázku" src="obrazky/ekea2.png">
        </div>
        <h1>PRODEJNY</h1>
    </div>

    <!-- Menu -->
    <div class="menu">
        <div class="menu_neco">
            <?php include 'templates/menu.php'; ?> 
        </div>
    </div>

    <div class="polozky">
        <h2>Seznam prodejen:</h2>

        <?php
        // Připojení k databázi
        $servername = "localhost";
        $username = "fasorad";
        $password = "Agama987.Qe23:";
        $dbname = "fasorad_obchod";

        // Vytvoření připojení k databázi
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Kontrola připojení
        if ($conn->connect_error) {
            die("Chyba připojení: " . $conn->connect_error);
        }


        echo"<p>.</p>";
        echo"<p>.</p>";

        // PRO UŽIVATELE
        // Zpracování formuláře pro odebrání kusu (pouze pro přihlášené uživatele)
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['produkt_ID'])) {
            $produkt_ID = $_POST['produkt_ID'];

            // Získání názvu nábytku
            $sql_nazev = "SELECT nazev_nabytku FROM prodejny WHERE produkt_ID = $produkt_ID";
            $result_nazev = $conn->query($sql_nazev);

            if ($result_nazev->num_rows > 0) {
                $row_nazev = $result_nazev->fetch_assoc();
                $nazev_nabytku = $row_nazev['nazev_nabytku'];

                // SQL dotaz pro snížení počtu kusů
                $sql = "UPDATE prodejny 
                        SET kusu_na_sklade = kusu_na_sklade - 1 
                        WHERE produkt_ID = $produkt_ID AND kusu_na_sklade > 0";

                if ($conn->query($sql) === TRUE) {
                    echo "<p style='color: green;'>Nákup <strong>$nazev_nabytku</strong> (ID: $produkt_ID) byl úspěšně proveden.</p>";
                } else {
                    echo "<p style='color: red;'>Chyba při aktualizaci: " . $conn->error . "</p>";
                }
            } else {
                echo "<p style='color: red;'>Produkt s ID $produkt_ID nebyl nalezen.</p>";
            }
        }


        //PRO ADMINA
        // Zpracování formuláře pro přidání kusu (pouze pro admina)
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_produkt_ID']) && $_SESSION['username'] === 'admin') {
            $produkt_ID = $_POST['add_produkt_ID'];

            // Získání názvu nábytku
            $sql_nazev = "SELECT nazev_nabytku FROM prodejny WHERE produkt_ID = $produkt_ID";
            $result_nazev = $conn->query($sql_nazev);

            if ($result_nazev->num_rows > 0) {
                $row_nazev = $result_nazev->fetch_assoc();
                $nazev_nabytku = $row_nazev['nazev_nabytku'];

                // SQL dotaz pro zvýšení počtu kusů
                $sql = "UPDATE prodejny SET kusu_na_sklade = kusu_na_sklade + 1 WHERE produkt_ID = $produkt_ID";

                if ($conn->query($sql) === TRUE) {
                    echo "<p style='color: green;'>Přidání produkt: <strong>$nazev_nabytku</strong> (ID: $produkt_ID) bylo úspěšné.</p>";
                } else {
                    echo "<p style='color: red;'>Chyba při aktualizaci: " . $conn->error . "</p>";
                }
            } else {
                echo "<p style='color: red;'>Produkt s ID $produkt_ID nebyl nalezen.</p>";
            }
        }

        // Funkce pro zobrazení tabulky produktů podle prodejny
        function zobrazProdukty($conn, $prodejna) {
            $sql = "SELECT prodejna, nazev_nabytku, produkt_ID, kusu_na_sklade FROM prodejny WHERE prodejna = '$prodejna'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<h3>$prodejna:</h3>";
                echo "<table border='1' style='width: 100%; text-align: left; border-collapse: collapse;'>";
                echo "<tr>
                        <th>Prodejna</th>
                        <th>Název nábytku</th>
                        <th>Produkt ID</th>
                        <th>Kusů na skladě</th>
                        <th>Nákupy</th>
                      </tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["prodejna"] . "</td>
                            <td>" . $row["nazev_nabytku"] . "</td>
                            <td>" . $row["produkt_ID"] . "</td>
                            <td>" . $row["kusu_na_sklade"] . "</td>
                            <td>";

                    if (isset($_SESSION['username'])) {
                        echo "
                            <form method='POST' style='margin: 0; display: inline-block;'>
                                <input type='hidden' name='produkt_ID' value='" . $row["produkt_ID"] . "'>
                                <button type='submit'>Koupit</button>
                            </form>";
                    }

                    if (isset($_SESSION['username']) && $_SESSION['username'] === 'admin') {
                        echo "
                            <form method='POST' style='margin: 0; display: inline-block;'>
                                <input type='hidden' name='add_produkt_ID' value='" . $row["produkt_ID"] . "'>
                                <button type='submit'>Přidat kus</button>
                            </form>";
                    }

                    echo "</td></tr>";
                }

                echo "</table>";
            } else {
                echo "<h3>$prodejna:</h3><p>0 výsledků</p>";
            }
        }

        // Zobrazení produktů pro jednotlivé prodejny
        zobrazProdukty($conn, "Brno");
        echo"<p>.</p>";
        echo"<p>.</p>";
        zobrazProdukty($conn, "Praha");
        echo"<p>.</p>";
        echo"<p>.</p>";

        $conn->close();
        ?>
    </div>

    <!-- Footer -->
    <div class="footer">
        <?php include 'templates/footer.php'; ?>
    </div>
</body>
</html>
