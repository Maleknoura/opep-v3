<?php
include "config.Php";
class dash extends Config {



    public function fetchCategories(): array
    {
        $this->query("SELECT * FROM categories ORDER BY id ASC");
        $this->execute();
        $categories = $this->fetchAll();

        if (is_array($categories)) {
            $response = array(
                'status' => true,   
                'data' => $categories
            );
        } else {
            $response = array(
                'status' => false,
                'data' => []
            );
        }

        return $response;
    }
    public function fetchPlants($selectedCategory): array
    {
        try {
            $this->query("SELECT * FROM plants WHERE category_id = (SELECT id FROM categories WHERE name = ?)");
            $this->bind(1, $selectedCategory);
            $this->execute();
            $plants = $this->fetchAll();

            $response = array(
                'status' => true,
                'data' => $plants
            );
            return $response;
        } catch (PDOException $e) {
            $response = array(
                'status' => false,
                'data' => [],
                'error' => 'Database error: ' . $e->getMessage()
            );
            return $response;
        }
    }


}



?>