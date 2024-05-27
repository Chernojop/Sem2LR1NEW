<?php
require_once '/INTERVOLGA2023/Xampp/htdocs/Sem2LR1NEW/actions/FieldsActions.php';
$fieldsModule = new FieldsTable();
$fields = $fieldsModule->getAllFields(); // Получаем результат


// Далее вы можете передать $plants в index.php для его использованияkl