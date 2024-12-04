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
$vybranyProdukt = 1; // Příklad: Vybrané ID produktu
$sql = "SELECT ID_nabytek, nazev_nabytku, Cena, prodejna FROM nabytek WHERE ID_nabytek = 1";
$result = $conn->query($sql);

if ($result->num_rows > 0){

    // Výpis dat z databáze 
    while($row = $result->fetch_assoc()){
        echo 
            "<h2>" .$row["nazev_nabytku"]. "</h2>";
        echo '<img src="auto.png" alt="Obrázek produktu" ">';
        echo "<h3>".$row["Cena"]." Kč</h3>";
        echo "<h4>Prodejna: ".$row["prodejna"]."</h4>";
        }
}

else {
    echo "0, výsledků";
}
    //Uzavření připojení
    $conn->close();
?>