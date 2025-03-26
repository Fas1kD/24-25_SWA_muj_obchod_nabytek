<?php
// Start session
session_start();
?>

<!DOCTYPE html>
<html lang="cs">

<head>
    <link rel="icon" type="image" href="obrazky/ekea.png">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obchod s nabytkem</title>
</head>

<body style="background-color: #ECECEC;">

<!--Vyskakující okno z alertem-->
    <script src=".js/script.js"></script>


<!--Nadpis-->
    <div class="head">
        <?php include 'templates/header.php'; ?>
    </div>


<!--Menu-->
    <div class="menu">
        <div class="menu_neco">
            <?php include 'templates/menu.php'; ?>
        </div>
    </div>


    <!--Produkty-->
    <div class="polozky">
        <p1 style="font-size:32px">Druhý největší prodejce nábytku ze Švédska</p1>
        <p>
            <span class="textA">AHOJ</span>
        </p>

        <div class="product_list"> <!--Usporadani produktu do jednoho "místa"-->

            <!--samostnatné produkty-->

            <!--Židle-->
            <div class="product">
                <a href="prodejny.php" class="clickable-image">
                    <?php include 'vypisy/vypis_zidle.php';?>
                </a>
            </div>

            <!--Stůl-->
            <div class="product">
                <a href="prodejny.php" class="clickable-image">
                    <?php include 'vypisy/vypis_stolu.php';?>
                </a>
            </div>

            <!--Polička-->
            <div class="product">
                <a href="prodejny.php" class="clickable-image">
                    <?php include 'vypisy/vypis_policky.php';?>
                </a>
            </div>
            

            <!--lustr-->
            <div class="product">
                <a href="prodejny.php" class="clickable-image">
                   <?php include 'vypisy/vypis_lustr.php';?>
                </a>
            </div>
        </div>
    </div>

<!--Footer-->
    <div class="footer">
        <?php include 'templates/footer.php'; ?>
    </div>




</body>

</html>