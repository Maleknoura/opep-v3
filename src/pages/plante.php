<?php
include "config.Php";
class plante {
    private $plantId;
    private $plantName;
    private $plantDesc;
    private $plantImage;
    private $plantPrice;
    private $categoryId;
    private $conn;
   


public function __construct($plantId,$plantName,$plantDesc,$plantImage,$plantPrice,$categoryId)
{
    $this->plantId = $plantId ;
    $this->plantName = $plantName ;
    $this->plantDesc = $plantDesc ;
    $this->plantImage = $plantImage;
    $this->plantPrice = $plantPrice ;
    $this->categoryId = $categoryId ;
    $config = new Config();
    $this->conn = $config->conn();
} 


public function getplantId() {
    return $this->plantId;
    
}
public function getplantName() {
    return $this->plantName;
    
}
public function getplantdesc() {
    return $this->plantDesc;
    
}
public function getplantimage(){
    return $this->plantImage;
}
public function getplantPrice() {
    return $this->plantPrice;
    
}
public function getcategoryId() {
    return $this->categoryId;
    
} 
public function setnom($plantName){
    $this->plantName=$plantName;
}
public function setDesc($plantDesc){
    $this->plantDesc=$plantDesc;
}
public function setImg($plantImage){
    $this->plantImage=$plantImage;
}
public function setId($plantId){
    $this->plantId=$plantId;
}
public function setPrice($plantPrice){
    $this->plantPrice=$plantPrice;
}
public function setcategoryId($categoryId){
    $this->categoryId=$categoryId;
}





public static function getAllPlants() {
    $conn = (new Config())->conn();
    $stmt = $conn->query("SELECT p.*, c.categoryName 
    FROM plants p 
    JOIN categories c ON p.categoryId = c.categoryId");
    $result= $stmt->fetchAll(PDO::FETCH_ASSOC);
    $arrayplants=array();


    foreach($result as $row)
    {
        
        $p = new plante ($row ['plantId'],$row['plantName'],$row['plantDesc'],$row['plantImage'],$row['plantPrice'],$row['categoryId']);

        array_push($arrayplants,$p);
    }
   
return $arrayplants;

}
public function deletePlant($plantId) {

    $deleteQuery = "DELETE FROM plants WHERE plantId = :plantId";
    $stmt = $this->conn->prepare($deleteQuery);
    $stmt->bindParam(":plantId", $plantId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "supression avec succes" ;
    } else {
        echo "erreur lors de la suppression";
    }
}
public function addplant() {
    $insertquery = "INSERT INTO plants ( plantName, plantDesc, plantImage, plantPrice, categoryId) 
                    VALUES ( :plantName, :plantDesc, :plantImage, :plantPrice, :categoryId)";
                    
    $stmt = $this->conn->prepare($insertquery);


    $stmt->bindParam(":plantName", $this->plantName, PDO::PARAM_STR);
    $stmt->bindParam(":plantDesc", $this->plantDesc, PDO::PARAM_STR);
    $stmt->bindParam(":plantImage", $this->plantImage, PDO::PARAM_STR);
    $stmt->bindParam(":plantPrice", $this->plantPrice, PDO::PARAM_INT);
    $stmt->bindParam(":categoryId", $this->categoryId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "Ajout avec succès";
    } else {
        echo "Erreur lors de l'ajout";
    }
}

}

?>