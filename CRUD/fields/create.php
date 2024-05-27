<?php
// Подключение к базе данных
require_once 'E:\INTERVOLGA2023\Xampp\htdocs\Sem2LR1NEW\conn.php';

// Подключение класса для работы с таблицей Fields
require_once 'E:\INTERVOLGA2023\Xampp\htdocs\Sem2LR1NEW\actions\FieldsActions.php';

// Создание экземпляра класса для работы с таблицей Fields
$fieldsTable = new FieldsTable();

// Обработка данных из формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Данные из формы
    $name = htmlspecialchars($_POST['name']);


    // Вызов метода createField для создания нового поля в базе данных
    if ($fieldsTable->createField($name)) {
        // Перенаправление на главную страницу после успешного создания поля
        header("Location: ../../Fields.php?success=1");
        exit();
    } else {
        echo "Ошибка при создании поля.";
    }
}
?>
