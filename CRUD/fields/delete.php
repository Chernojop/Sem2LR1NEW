<?php
require_once '/INTERVOLGA2023/Xampp/htdocs/Sem2LR1NEW/actions/FieldsActions.php';
require_once 'E:\INTERVOLGA2023\Xampp\htdocs\Sem2LR1NEW\actions\PlantsActions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['field_id'])) {
        $fieldId = $_POST['field_id'];

        $plantsTable = new PlantsTable();
        $plantsCount = $plantsTable->getPlantsCountByField($fieldId);

        if ($plantsCount > 0) {
            echo "Ошибка: Невозможно удалить поле, так как к нему привязаны растения.";
            exit();
        } else {
            // Иначе пытаемся удалить поле
            $fieldsTable = new FieldsTable();
            $deleted = $fieldsTable->deleteField($fieldId);

            if ($deleted) {
                header("Location: ../../Fields.php");
                exit();
            } else {
                // Если возникла ошибка при удалении поля
                echo "Ошибка: Не удалось удалить поле.";
            }
        }
    }
}
?>
