<?php

require "src/conexao-db.php";
require "src/Repository/ProductRepository.php";

$productRepository = new ProductRepository($pdo);
$dataCoffee = $productRepository->coffeeOptions();
$dataLunch = $productRepository->lunchOptions();
?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Serenatto - Cardápio</title>
</head>

<body>
    <main>
        <section class="container-banner">
            <div class="container-texto-banner">
                <img src="img/logo-serenatto.png" class="logo" alt="logo-serenatto">
            </div>
        </section>
        <h2>Cardápio Digital</h2>
        <section class="container-cafe-manha">
            <div class="container-cafe-manha-titulo">
                <h3>Opções para o Café</h3>
                <img class="ornaments" src="img/ornaments-coffee.png" alt="ornaments">
            </div>
            <div class="container-cafe-manha-produtos">
                <?php foreach ($dataCoffee as $coffee) : ?>
                    <div class="container-produto">
                        <div class="container-foto">
                            <img src=<?= $coffee->getImageDiretory() ?>>
                        </div>
                        <p><?= $coffee->getName() ?></p>
                        <p><?= $coffee->getDescription() ?></p>
                        <p><?= $coffee->getPriceFormatted() ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
        <section class="container-almoco">
            <div class="container-almoco-titulo">
                <h3>Opções para o Almoço</h3>
                <img class="ornaments" src="img/ornaments-coffee.png" alt="ornaments">
            </div>
            <div class="container-almoco-produtos">
                <?php foreach ($dataLunch as $lunch) : ?>
                    <div class="container-produto">
                        <div class="container-foto">
                            <img src=<?= $lunch->getImageDiretory() ?>>
                        </div>
                        <p><?= $lunch->getName() ?></p>
                        <p><?= $lunch->getDescription() ?></p>
                        <p><?= $lunch->getPriceFormatted() ?></p>
                    </div>
                <?php endforeach; ?>
            </div>

        </section>
    </main>
</body>

</html>