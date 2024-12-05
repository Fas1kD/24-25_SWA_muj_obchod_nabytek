<?php
// Start session
session_start();
?>

<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obchod s nabytkem</title>
</head>

<body style="background-color: #ECECEC;">


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

    <p1 style="font-size:32px">Druhý největší prodejce nábytku ze Švédska</p1>




    <!--Produkty-->
    <div class="product_list"> <!--Usporadani produktu do jednoho "místa"-->
        <!--samostnatné produkty-->
        <div class="product">
            <a href="auto.png" class="clickable-image">
                <?php include 'vypisy/vypis_zidle.php';?>
            </a>
        </div>


        <div class="product">
            <a href="auto.png" class="clickable-image">
                <?php include 'vypisy/vypis_stolu.php';?>
            </a>
        </div>

        <div class="product">
            <a href="auto.png" class="clickable-image">
                <h3>Stůl</h3>
                <img src="obrazky/zidle.png" alt="Obrázek produktu">
                <p class="cena">750 kč</p>
            </a>
        </div>
        
        <div class="product">
            <a href="auto.png" class="clickable-image">
                <h3>Stůl</h3>
                <img src="obrazky/zidle.png" alt="Obrázek produktu">
                <p class="cena">750 kč</p>
            </a>
        </div>
    </div>





    <div class="footer">
        <?php include 'templates/footer.php'; ?>
    </div>




</body>

</html>