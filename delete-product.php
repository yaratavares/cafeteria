<?php

require "src/conexao-db.php";
require "src/Repository/ProductRepository.php";

$productRepository = new ProductRepository($pdo);
$products = $productRepository->deleteId($_POST['id']);

header("Location: admin.php");
