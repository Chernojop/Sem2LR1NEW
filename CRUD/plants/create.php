<?php
// Подключение к базе данных
require_once 'E:\INTERVOLGA2023\Xampp\htdocs\Sem2LR1NEW\conn.php';

// Подключение класса для работы с таблицей Plants
require_once 'E:\INTERVOLGA2023\Xampp\htdocs\Sem2LR1NEW\actions\PlantsActions.php';

// Создание экземпляра класса для работы с таблицей Plants
$plantsTable = new PlantsTable();

// Обработка данных из формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Проверка, был ли отправлен файл
    if (isset($_FILES['img_path']) && $_FILES['img_path']['error'] === UPLOAD_ERR_OK) {
        // Путь для сохранения файла
        $uploadDirectory = 'E:/INTERVOLGA2023/Xampp/htdocs/Sem2LR1NEW/inc/catalog_images/';
        
        // Генерация уникального имени для файла
        $fileName = uniqid() . '_' . basename($_FILES["img_path"]["name"]);
        
        // Полный путь к файлу на сервере
        $targetPath = $uploadDirectory . $fileName;
        
        // Перемещение файла из временной директории в целевую
        if (move_uploaded_file($_FILES["img_path"]["tmp_name"], $targetPath)) {
            // Данные из формы
            $name = htmlspecialchars($_POST['name']);
            $id_field = htmlspecialchars($_POST['id_field']);
            $description = htmlspecialchars($_POST['description']);
            $price = htmlspecialchars($_POST['price']);

            // Заполнение свойств объекта класса PlantsTable данными из формы
            $plantsTable->name = $name;
            $plantsTable->img_path = $fileName;
            $plantsTable->id_field = $id_field;
            $plantsTable->description = $description;
            $plantsTable->cost_per_ton = $price;

            // Вызов метода CreatePlant для занесения данных в базу данных
            if ($plantsTable->CreatePlant()) {
                // Перенаправление на главную страницу после успешного создания элемента
                header("Location: ../../index.php?success=1");
                exit();
            } else {
                echo "Ошибка при создании элемента.";
            }
        } else {
            echo "Ошибка при загрузке файла.";
        }
    } else {
        echo "Файл изображения не был загружен.";
    }
}
?>
