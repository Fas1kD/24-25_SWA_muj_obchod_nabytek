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
    <!--Nadpis-->
    <div class="head">
        <div class="ekea">
            <img style="position: absolute; top: 25px; left: 100px; width: 150px; height: auto;" alt="Popis obrázku" src="obrazky/ekea2.png">
        </div>
        <h1>PRODEJNY</h1>
    </div>

    <!--Menu-->
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

        // Vytvoření připojení
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Kontrola připojení
        if ($conn->connect_error) {
            die("Chyba připojení: " . $conn->connect_error);
        }

        // Zpracování požadavku na odebrání kusu
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['produkt_ID'])) {
            $produkt_ID = $_POST['produkt_ID'];

            // SQL dotaz pro snížení počtu kusů na skladě
            // Kontrola, aby počet kusů neklesl pod 0
            $sql = "UPDATE prodejny 
                    SET kusu_na_sklade = kusu_na_sklade - 1 
                    WHERE produkt_ID = $produkt_ID AND kusu_na_sklade > 0";

            // Provedení dotazu
            if ($conn->query($sql) === TRUE) {
                echo "<p style='color: green;'>Počet kusů u produktu s ID $produkt_ID byl úspěšně snížen.</p>";
            } else {
                echo "<p style='color: red;'>Chyba při aktualizaci: " . $conn->error . "</p>";
            }
        }

        // Funkce pro zobrazení tabulky produktů podle prodejny
        function zobrazProdukty($conn, $prodejna) {
            // SQL dotaz pro načtení produktů z konkrétní prodejny
            $sql = "SELECT prodejna, nazev_nabytku, produkt_ID, kusu_na_sklade 
                    FROM prodejny 
                    WHERE prodejna = '$prodejna'";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<p>.</p>";
                echo "<p>.</p>";
                echo "<h3>$prodejna:</h3>";
                echo "<table border='1' style='width: 100%; text-align: left; border-collapse: collapse;'>";
                echo "<tr>
                        <th>Prodejna</th>
                        <th>Název nábytku</th>
                        <th>Produkt ID</th>
                        <th>Kusů na skladě</th>
                      </tr>";

                // Procházíme všechny produkty a zobrazujeme je v tabulce
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["prodejna"] . "</td>
                            <td>" . $row["nazev_nabytku"] . "</td>
                            <td>" . $row["produkt_ID"] . "</td>
                            <td>" . $row["kusu_na_sklade"] . "</td>
                            <td>
                                <!-- Formulář pro koupi kusu -->
                                <form method='POST' style='margin: 0;'>
                                    <!-- Skryté pole pro přenos ID produktu -->
                                    <input type='hidden' name='produkt_ID' value='" . $row["produkt_ID"] . "'>
                                    <!-- Tlačítko pro odeslání formuláře -->
                                    <button type='submit'>Koupit</button>
                                </form>
                            </td>
                          </tr>";
                }

                echo "</table>";
            } else {
                echo "<h3>$prodejna:</h3><p>0 výsledků</p>";
            }
        }

        // Zobrazení produktů pro Brno
        zobrazProdukty($conn, "Brno");

        // Zobrazení produktů pro Prahu
        zobrazProdukty($conn, "Praha");

        // Uzavření připojení
        $conn->close();

        echo "<p>.</p>";
        echo "<p>.</p>";
        ?>
    </div>

    <!--Footer-->
    <div class="footer">
        <?php include 'templates/footer.php'; ?>
    </div>

</body>
</html>
