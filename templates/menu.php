<!DOCTYPE html>
<html lang="cs">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <a href="prodejny.php"> ahoj</a>
    <a href="register.php">Registrace</a>
    <a href="login.php">Přihlášení</a>
    <!-- Zobrazení jména uživatele v pravém horním rohu -->
    <?php if (isset($_SESSION['username'])): ?>
        <div class="user-info">
            Jméno: <?php echo $_SESSION['username']; ?>
        </div>
    <?php endif; ?>
    <a href="logout.php">Logout</a>
</body>
</html>
