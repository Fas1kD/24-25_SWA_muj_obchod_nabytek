<?php
echo"<body style='background-color:rgb(166, 223, 223);'>";
// Start session
session_start();

// Připojení k databázi
$servername = "localhost";      //název serveru
$username = "fasorad";          //jmeno uživatele (defaultně je "root")
$password = "Agama987.Qe23:";   //heslo (pro local host je obvykle prázdné)
$dbname = "fasorad_obchod";     //název databázes

// Vytvoření připojení
$conn = new mysqli($servername, $username, $password, $dbname);

// Kontrola připojení
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Zpracování přihlašovacího formuláře
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // SQL dotaz pro získání uživatele
    $sql = "SELECT * FROM users WHERE username = '$user' AND password = '$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $user;  // Uložení uživatelského jména do session
        header('Location: index.php');  // Přesměrování na hlavní stránku
        exit();
    } else {
        echo "Neplatné uživatelské jméno nebo heslo!";
    }
}

// Uzavření připojení
$conn->close();
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přihlášení</title>
</head>
<body>

<h2>Přihlášení</h2>
<form method="POST">
    <label for="username">Uživatelské jméno:</label><br>
    <input type="text" id="username" name="username" required><br><br>
    <label for="password">Heslo:</label><br>
    <input type="password" id="password" name="password" required><br><br>
    <input type="submit" value="Přihlásit se">
</form>

</body>
</html>
