<?php
// Start session
session_start();

// Připojení k databázi
$servername = "localhost";
$username = "root";
$password = "";  // Připojovací heslo k databázi (pokud existuje)
$dbname = "test_db";

// Vytvoření připojení
$conn = new mysqli($servername, $username, $password, $dbname);

// Kontrola připojení
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Zpracování formuláře
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Získání údajů z formuláře
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Ověření, zda uživatel již existuje
    $check_sql = "SELECT * FROM users WHERE username = '$user'";
    $result = $conn->query($check_sql);

    //Kontrola jestli uživatel již existuje
    if ($result->num_rows > 0) {
        // Uživatel již existuje
        echo "<p style='color: red;'>Uživatel s tímto jménem již existuje. Zvolte jiné jméno.</p>";
    } else {
        // Vložení nového uživatele do databáze
        $sql = "INSERT INTO users (username, password) VALUES ('$user', '$pass')";
        
        if ($conn->query($sql) === TRUE) {
            $_SESSION['username'] = $user;  // Uložení uživatelského jména do session
            header('Location: index.php');  // Přesměrování na hlavní stránku
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
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
    <title>Registrace</title>
</head>
<body>

<h2>Registrace</h2>
<form method="POST">
    <label for="username">Uživatelské jméno:</label><br>
    <input type="text" id="username" name="username" required><br><br>
    <label for="password">Heslo:</label><br>
    <input type="password" id="password" name="password" required><br><br>
    <input type="submit" value="Registrovat">
</form>

</body>
</html>
