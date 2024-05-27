<?php
require_once '/INTERVOLGA2023/Xampp/htdocs/Sem2LR1NEW/actions/PlantsActions.php';
require_once '/INTERVOLGA2023/Xampp/htdocs/Sem2LR1NEW/actions/FieldsActions.php';

$fieldsModule = new FieldsTable();
$plantsModule = new PlantsTable();

if (isset($field_id)) {
    // Получение растений только для выбранного поля
    $plants = $plantsModule->GetPlantsByField($field_id);
} else {
    // Если параметр field_id не передан, получите все растения
    $plants = $plantsModule->GetPlants();
}
?>
