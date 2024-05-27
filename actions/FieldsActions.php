<?php
//require_once '../../../conn.php';проблема
require_once 'E:\INTERVOLGA2023\Xampp\htdocs\Sem2LR1NEW\conn.php';
require_once 'E:\INTERVOLGA2023\Xampp\htdocs\Sem2LR1NEW\actions\PlantsActions.php';
class FieldsTable
{
    private $conn;

    public function __construct()
    {
        $db = Database::getInstance();
        $this->conn = $db->getConnection();
    
        if ($this->conn->connect_error) {
            die('Ошибка подключения: ' . $this->conn->connect_error);
        }
    }
    public function createField($fieldName)
    {
        // Подготовленный запрос для вставки нового поля
        $stmt = $this->conn->prepare("INSERT INTO fields (field_name) VALUES (?)");

        // Привязываем параметры
        $stmt->bind_param("s", $fieldName);

        // Выполняем запрос
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            // Если произошла ошибка при выполнении запроса
            $stmt->close();
            return false;
        }
    }

    public function deleteField($fieldId)
{
    // Проверяем, есть ли привязанные к полю растения
    $plantsTable = new PlantsTable();
    $plantsCount = $plantsTable->getPlantsCountByField($fieldId);

    if ($plantsCount > 0) {
        // Если есть привязанные растения, возвращаем ошибку
        return "Невозможно удалить поле, так как к нему привязаны растения.";
    } else {
        // Иначе удаляем поле
        $stmt = $this->conn->prepare("DELETE FROM fields WHERE id = ?");
        $stmt->bind_param("i", $fieldId);
        
        // Выполняем запрос
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            // Если произошла ошибка при выполнении запроса
            $stmt->close();
            return false;
        }
    }
}


    public function getAllFields()
    {
        $stmt = $this->conn->prepare("SELECT id, field_name FROM fields"); 
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    public function updateField($fieldId, $fieldName)
    {
        // Подготовленный запрос для обновления данных поля
        $stmt = $this->conn->prepare("UPDATE fields SET field_name = ? WHERE id = ?");

        // Привязываем параметры
        $stmt->bind_param("si", $fieldName, $fieldId);

        // Выполняем запрос
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            // Если произошла ошибка при выполнении запроса
            $stmt->close();
            return false;
        }
    }

    public function getIdFieldByName($fieldName)
    {
        $stmt = $this->conn->prepare("SELECT id FROM fields WHERE field_name = ?");
        $stmt->bind_param("s", $fieldName);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $idField = $row['id'];
        $stmt->close();
        return $idField;
    }

    public function getFieldNameById($fieldId)
    {
        $stmt = $this->conn->prepare("SELECT field_name FROM fields WHERE id = ?");
        $stmt->bind_param("i", $fieldId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $fieldName = $row['field_name'];
        $stmt->close();
        return $fieldName;
    }

    /*public function __destruct()
    {
        if ($this->conn->connect_errno === 0) {
            $this->conn->close();
        }
    }*/
}
?>
