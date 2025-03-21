<!---->

<!DOCTYPE html>
<html lang="cs">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="tlacitka_menu">
        <a class="one" href="index.php">Domovská Stránka</a>
        <a class="one" href="prodejny.php" style="margin-right: 100px;">Prodejny</a>

        <!-- !isset(...)... podpínka když nejsem přihlášen-->
        <?php if (!isset($_SESSION['username'])): ?>
            <a class="one" href="register.php">Registrace</a>
            <a class="one" href="login.php">Přihlášení</a>
        <?php endif; ?>

        <!-- Zobrazení jména uživatele v pravém horním rohu -->
        <?php if (isset($_SESSION['username'])): ?>
            <div class="user-info">
                Jméno: <?php echo $_SESSION['username']; ?>
            </div>
        <?php endif; ?>
        
        <!--Odhlášení, zobrazí se jen když je uživatel přihlášen-->
        <?php if (isset($_SESSION['username'])): ?>
            <a class="one" href="logout.php">Logout</a>
        <?php endif; ?>

        <!--změna hesla, zobrazí se jen když je uživatel přihlášen-->
        <?php if (isset($_SESSION['username'])): ?>
            <a class="one" href="podstranky/change_password.php">Změna hesla</a>
        <?php endif; ?>

    </div>
    
</body>
</html>
