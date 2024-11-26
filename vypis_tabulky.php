
<?php
//připojení k MySQL databázy
$servername = "localhost";  //název serveru
$username = "root";         //jmeno uživatele (defaultně je "root")
$password = "";             //heslo (pro local host je obvykle prázdné)
$dbname = "zamestanci";   //název databázes

//vytvoření připojení
$conn = new mysqli($servername, $username, $password, $dbname);

//kontrola
if ($conn->connect_error){
    die("Selhalo připojení". $conn->connect_error);
}

//sql dotaz
$sql = "SELECT id, jmeno, prijmeni FROM zamestnanci";
$result = $conn->query($sql);

//zpracování výsledku
//if ($result->num_rows > 0){
//    //výpis dat pro každý řádek
//    while($row=$result->fetch_assoc()){
//        echo "ID: " . $row["id"] . " - Jméno " . $row["jmeno"] . " Příjmení " . $row["prijmeni"] . "<br>";
//    }
//}

if ($result->num_rows > 0){
    // Začátek tabulky
    echo "<table border='10' style='border: 5px solid blue;'>
            <tr>
                <th style='color:red;'>ID</th>
                <th>Jméno</th>
                <th>Příjmení</th>
            </tr>";

    // Výpis dat z databáze do řádků tabulky
    while($row = $result->fetch_assoc()){
        echo "<tr>
                <td style='background-color: rgba(98, 149, 172, 0.5)'>".$row["id"]."</td>
                <td style='background-color: rgba(98, 149, 250, 0.5)'>".$row["jmeno"]."</td>
                <td>".$row["prijmeni"]."</td>
              </tr>";
    }

    // Konec tabulky
    echo "</table>";
}

else {
    echo "0, výsledků";
}



    //Uzavření připojení
    $conn->close();

?>