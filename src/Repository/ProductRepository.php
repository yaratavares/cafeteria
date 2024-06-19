<?php

require "src/Model/Product.php";

class ProductRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function coffeeOptions(): array
    {
        $sql1 = "SELECT * FROM produtos WHERE tipo = 'Café' ORDER BY preco";
        $statement = $this->pdo->query($sql1);
        $coffeeOptions = $statement->fetchAll(PDO::FETCH_ASSOC);

        $dataCoffee =
            array_map(
                function ($coffee) {
                    return $this->formatObject($coffee);
                },
                $coffeeOptions
            );

        return $dataCoffee;
    }

    public function lunchOptions(): array
    {
        $sql2 = "SELECT * FROM produtos WHERE tipo = 'Almoço' ORDER BY preco";
        $statement = $this->pdo->query($sql2);
        $lunchProducts = $statement->fetchAll(PDO::FETCH_ASSOC);

        $dataLunch =
            array_map(
                function ($lunch) {
                    return $this->formatObject($lunch);
                },
                $lunchProducts
            );

        return $dataLunch;
    }

    private function formatObject($product)
    {
        return
            new Product($product['id'], $product['tipo'], $product['nome'], $product['descricao'], $product['preco'], $product['imagem']);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM produtos ORDER BY preco";
        $statement = $this->pdo->query($sql);
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);

        $allData =
            array_map(
                function ($product) {
                    return $this->formatObject($product);
                },
                $data
            );

        return $allData;
    }

    public function deleteId(int $id)
    {
        $sql = "DELETE FROM produtos WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $id);
        $statement->execute();
    }

    public function saveProduct(Product $product)
    {
        $sql = "INSERT INTO produtos (tipo, nome, descricao, preco, imagem) VALUES (?,?,?,?,?)";

        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $product->getType());
        $statement->bindValue(2, $product->getName());
        $statement->bindValue(3, $product->getDescription());
        $statement->bindValue(4, $product->getPrice());
        $statement->bindValue(5, $product->getImage());
        $statement->execute();
    }

    public function findOne(int $id)
    {
        $sql = "SELECT * FROM produtos WHERE id = ?";

        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $id);
        $statement->execute();

        $data = $statement->fetch(PDO::FETCH_ASSOC);
        return $this->formatObject($data);
    }

    public function update(Product $product)
    {
        $sql = "UPDATE produtos SET tipo = ?, nome = ?, descricao = ?, preco = ?, imagem = ? WHERE id = ?";

        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $product->getType());
        $statement->bindValue(2, $product->getName());
        $statement->bindValue(3, $product->getDescription());
        $statement->bindValue(4, $product->getPrice());
        $statement->bindValue(5, $product->getImage());
        $statement->bindValue(6, $product->getId());
        $statement->execute();
    }
}
