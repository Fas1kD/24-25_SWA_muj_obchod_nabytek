<?php
//připojení k MySQL databázy
$servername = "localhost";  //název serveru
$username = "root";         //jmeno uživatele (defaultně je "root")
$password = "";             //heslo (pro local host je obvykle prázdné)
$dbname = "obchod_s_nabytkem";   //název databázes

//vytvoření připojení
$conn = new mysqli($servername, $username, $password, $dbname);

//kontrola
if ($conn->connect_error){
    die("Selhalo připojení". $conn->connect_error);
}

//sql dotaz
$sql = "SELECT ID_nabytek, nazev_nabytku, Cena, prodejna FROM nabytek";
$result = $conn->query($sql);

//zpracování výsledku
//if ($result->num_rows > 0){
//    //výpis dat pro každý řádek
//    while($row=$result->fetch_assoc()){
//        echo "ID: " . $row["id"] . " - Jméno " . $row["jmeno"] . " Příjmení " . $row["prijmeni"] . "<br>";
//    }
//}

if ($result->num_rows > 0){

    // Výpis dat z databáze do řádků tabulky
    while($row = $result->fetch_assoc()){
        echo "<tr>
                <h3>".$row["ID_nabytek"]. "</h3>
                <h3>".$row["nazev_nabytku"]."</h3>
                <h3>".$row["Cena"]."</h3>
                <h3>Kč</h3>
                <h3>".$row["prodejna"]."</h3>
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