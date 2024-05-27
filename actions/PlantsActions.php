<?php
require_once 'E:\INTERVOLGA2023\Xampp\htdocs\Sem2LR1NEW\conn.php';

class PlantsTable{                                                                          
    // Connection
    private $conn;
    // Table
    private $db_table = "Plants";
    // Columns
    public $id;
    public $img_path;
    public $name;
    public $id_field;
    public $description;
    public $cost_per_ton;
    // Db connection
    public function __construct(){
        $db = Database::getInstance();
        $this->conn = $db->getConnection();
    }
    // GET ALL
    public function GetPlants(){
        $sqlQuery = "SELECT id, img_path, name, id_field, description, cost_per_ton FROM " . $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        $result= $stmt -> get_result();
        $stmt->close();
        return $result;
    }

    public function GetPlantById($plantId){
        $sqlQuery = "SELECT id, img_path, name, id_field, description, cost_per_ton FROM " . $this->db_table . " WHERE id = ?";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bind_param("i", $plantId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    // CREATE
    public function CreatePlant(){
        $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                        (img_path, name, id_field, description, cost_per_ton)
                        VALUES
                        (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sqlQuery);
        
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->img_path=htmlspecialchars(strip_tags($this->img_path));
        $this->id_field=htmlspecialchars(strip_tags($this->id_field));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->cost_per_ton=htmlspecialchars(strip_tags($this->cost_per_ton));
        
        // bind data
        $stmt->bind_param("ssiss", $this->img_path, $this->name, $this->id_field, $this->description, $this->cost_per_ton);
        
        if($stmt->execute()){
            return true;
        }
        return false;
    }


    public function DeletePlant($plantId)
    {
        $stmt = $this->conn->prepare("DELETE FROM plants WHERE id = ?");
        $stmt->bind_param("i", $plantId);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function getPlantImageName($plantId)
{
    $sqlQuery = "SELECT img_path FROM " . $this->db_table . " WHERE id = ?";
    $stmt = $this->conn->prepare($sqlQuery);
    $stmt->bind_param("i", $plantId);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['img_path'];
    } else {
        return false;
    }
}
public function GetPlantsByField($fieldId){
    $sqlQuery = "SELECT id, img_path, name, id_field, description, cost_per_ton FROM " . $this->db_table . " WHERE id_field = ?";
    $stmt = $this->conn->prepare($sqlQuery);
    $stmt->bind_param("i", $fieldId);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    return $result;
}


public function updatePlant($img_path, $plantId, $name, $id_field, $description, $cost_per_ton)
{
    // SQL-запрос для обновления данных растения, включая img_path
    $sqlQuery = "UPDATE " . $this->db_table . " SET img_path = ?, name = ?, id_field = ?, description = ?, cost_per_ton = ? WHERE id = ?";
    $stmt = $this->conn->prepare($sqlQuery);
    
    // "sanitize" данных
    $name = htmlspecialchars(strip_tags($name));
    $id_field = htmlspecialchars(strip_tags($id_field));
    $description = htmlspecialchars(strip_tags($description));
    $cost_per_ton = htmlspecialchars(strip_tags($cost_per_ton));
    $img_path = htmlspecialchars(strip_tags($img_path));

    // "bind" данных
    $stmt->bind_param("sssssi", $img_path, $name, $id_field, $description, $cost_per_ton, $plantId);

    // Выполнение запроса
    if($stmt->execute()){
        return true;
    }
    return false;
}

public function getPlantsCountByField($fieldId){
    $sqlQuery = "SELECT COUNT(*) AS total_plants FROM Plants WHERE id_field = ?";
    $stmt = $this->conn->prepare($sqlQuery);
    $stmt->bind_param("i", $fieldId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $count = $row['total_plants'];
    $stmt->close();
    return $count;
}


}
?>
