<?php
require_once '/INTERVOLGA2023/Xampp/htdocs/Sem2LR1NEW/actions/FieldsActions.php';
$fieldsModule = new FieldsTable();
// Обработка данных из формы после отправки
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Проверяем, было ли отправлено название поля
    if (isset($_POST['name'])) {
        $new_name = $_POST['name'];
        $id = $_POST['id'];
        // Вызываем метод updateField для обновления данных поля
        if ($fieldsModule->updateField($id, $new_name)) {
            // Перенаправляем пользователя на страницу со списком полей после успешного обновления
            header("Location: /Sem2LR1NEW/Fields.php?success=1");
            exit(); 
        } else {
            echo "Ошибка при обновлении данных поля.";
        }
    } else {
        echo "Название поля не было отправлено.";
    }
}
// Проверяем, был ли передан параметр id в GET-запросе
if (isset($_GET['id'])) {

    $field_id = $_GET['id'];
    $name = $fieldsModule->getFieldNameById($field_id);

    
}
?>
