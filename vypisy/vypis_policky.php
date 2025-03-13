<?php
//připojení k MySQL databázy
$servername = "localhost";      //název serveru
$username = "fasorad";          //jmeno uživatele (defaultně je "root")
$password = "Agama987.Qe23:";   //heslo (pro local host je obvykle prázdné)
$dbname = "fasorad_obchod";     //název databázes

//vytvoření připojení
$conn = new mysqli($servername, $username, $password, $dbname);

//kontrola
if ($conn->connect_error){
    die("Selhalo připojení". $conn->connect_error);
}

//sql dotaz
$vybranyProdukt = 1; // Příklad: Vybrané ID produktu
$sql = "SELECT ID_nabytek, nazev_nabytku, Cena, prodejna FROM nabytek WHERE ID_nabytek = 6";
$result = $conn->query($sql);

if ($result->num_rows > 0){

    // Výpis dat z databáze 
    while($row = $result->fetch_assoc()){
        echo '<img style="width: 250px; height: 400px; margin-bottom: 25px; morgin-top: 20px;" src="obrazky/policka.png" alt="Obrázek produktu" ">';
        echo "<h4> ---" .$row["nazev_nabytku"]. " --- </h4>";
        echo "<h4>Prodejna: ".$row["prodejna"]."</h4>";
        echo "<h3>".$row["Cena"]." ,-</h3>";
        }
}

else {
    echo "0, výsledků";
}
    //Uzavření připojení
    $conn->close();
?>