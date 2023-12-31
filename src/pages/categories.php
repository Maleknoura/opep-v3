<?php
include "config.php";

class categories
{
    private $categoryId;
    private $categoryName;
    private $conn;

    public function __construct($categoryId, $categoryName)
    {
        $this->categoryId = $categoryId;
        $this->categoryName = $categoryName;
        $config = new Config();
        $this->conn = $config->conn();
    }

    public function getcategoryId()
    {
        return $this->categoryId;
    }
    public function getcategoryName()
    {
        return $this->categoryName;
    }
    public function setcategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    }
    public function setcategoryName($categoryName)
    {
        $this->categoryName = $categoryName;
    }

    public  static function getAllcategories()
    {
        $conn = (new Config())->conn();
        $stmt = $conn->query("SELECT categories.*, COUNT(plants.plantId) AS plantsCount 
    FROM categories 
    LEFT JOIN plants ON categories.categoryId = plants.categoryId 
    GROUP BY categories.categoryId");
        $arraycategories = array();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {

            $p = new categories($row['categoryName'], $row['categoryId']);

            array_push($arraycategories, $p);
        }

        return $arraycategories;
    }
    public function addcategory()
    {
        $query = "INSERT INTO categories (categoryName)VALUES(:categoryName)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":categoryName", $this->categoryName, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "Ajout avec succès";
        } else {
            echo "Erreur lors de l'ajout";
        }
    }
    public function update()
    {
        // Utilisez des marqueurs de position "?" dans la requête
        $updateQuery = "UPDATE categories SET categoryName = ? WHERE categoryId = ?";
        $stmt = $this->conn->prepare($updateQuery);

        // Liez les valeurs aux marqueurs de position
        $stmt->bindParam(1, $this->categoryName, PDO::PARAM_STR);
        $stmt->bindParam(2, $this->categoryId, PDO::PARAM_INT);

        // Exécutez la requête
        if ($stmt->execute()) {

            echo $this->categoryId;
            echo "lfkdjkj";
        } else {
            echo "Erreur lors de la modification";
            // Affichez les détails de l'erreur pour le débogage
            print_r($stmt->errorInfo());
        }
    }
}
