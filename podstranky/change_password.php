<?php
session_start();

// Kontrola, zda je uživatel přihlášen
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Připojení k databázi
$servername = "localhost";
$username = "fasorad";
$password = "Agama987.Qe23:";
$dbname = "fasorad_obchod";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kontrola připojení
if ($conn->connect_error) {
    die("Chyba připojení: " . $conn->connect_error);
}

$message = ""; // Pro zobrazení hlášek uživateli

// Zpracování formuláře
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_SESSION['username'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Kontrola shody nového hesla
    if ($new_password !== $confirm_password) {
        $message = "<p style='color: red;'>Nové heslo a potvrzení hesla se neshodují.</p>";
    } else {
        // Ověření aktuálního hesla
        $sql = "SELECT password FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            //Kontrola jestli bylo aktuální heslo správne
            if ($current_password === $row['password']) {
                // Aktualizace hesla v databázi
                $sql_update = "UPDATE users SET password = ? WHERE username = ?";
                $stmt_update = $conn->prepare($sql_update);
                $stmt_update->bind_param("ss", $new_password, $username);

                if ($stmt_update->execute()) {
                    $message = "<p style='color: green;'>Heslo bylo úspěšně změněno.</p>";
                } else {
                    $message = "<p style='color: red;'>Chyba při aktualizaci hesla.</p>";
                }
            }
            //Špatně zadané aktuální heslo
            else {
                $message = "<p style='color: red;'>Aktuální heslo není správné.</p>";
            }
        } else {
            $message = "<p style='color: red;'>Uživatel nebyl nalezen.</p>";
        }

        $stmt->close();
    }
}

// Uzavření připojení
$conn->close();
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <title>Změna hesla</title>
</head>
<body style="background-color: #ECECEC;">

    <!-- Nadpis -->
    <h1>Změna hesla</h1>
    
    <!-- Zpráva -->
    <div class="message">
        <?php if (!empty($message)) echo $message; ?>
    </div>

    <!-- Formulář pro změnu hesla -->
    <div class="change-password-form">
        <form method="POST">
            <label for="current_password">Aktuální heslo:</label><br>
            <input type="password" id="current_password" name="current_password" required><br><br>

            <label for="new_password">Nové heslo:</label><br>
            <input type="password" id="new_password" name="new_password" required><br><br>

            <label for="confirm_password">Potvrzení nového hesla:</label><br>
            <input type="password" id="confirm_password" name="confirm_password" required><br><br>

            <button type="submit">Změnit heslo</button>
        </form>
    </div>

    <!-- Odkaz zpět -->
    <a href="../index.php">Domovská Stránka</a> <!--../ - odkáže na složku nad to, bez toho by to odkazovalo na složku /podstranky ...-->


</body>
</html>
