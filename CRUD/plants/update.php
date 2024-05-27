<?php
require_once '/INTERVOLGA2023/Xampp/htdocs/Sem2LR1NEW/actions/PlantsActions.php';

// Проверяем, был ли отправлен POST-запрос
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Переменная для хранения имени файла изображения
    $fileName = null;

    // Проверяем, был ли загружен файл изображения
    if (isset($_FILES['img_path']) && $_FILES['img_path']['error'] === UPLOAD_ERR_OK) {
        // Путь для сохранения файла
        $uploadDirectory = 'E:/INTERVOLGA2023/Xampp/htdocs/Sem2LR1NEW/inc/catalog_images/';
        
        // Генерация уникального имени для файла
        $fileName = uniqid() . '_' . basename($_FILES["img_path"]["name"]);
        
        // Полный путь к файлу на сервере
        $targetPath = $uploadDirectory . $fileName;
        
        // Перемещение файла из временной директории в целевую
        if (!move_uploaded_file($_FILES["img_path"]["tmp_name"], $targetPath)) {
            echo "Ошибка при загрузке файла.";
            exit;
        }
    }

    // Проверяем, были ли переданы необходимые данные для обновления растения
    if (isset($_POST['id'], $_POST['name'], $_POST['cost_per_ton'])) {
        // Получаем данные из POST-параметров
        $plantId = $_POST['id'];
        $name = $_POST['name'];
        $description = isset($_POST['description']) ? $_POST['description'] : ''; // Проверяем, было ли отправлено поле 'description', и присваиваем значение или пустую строку
        $id_field = isset($_POST['id_field']) ? $_POST['id_field'] : null; // Аналогично для поля 'id_field'
        $cost_per_ton = $_POST['cost_per_ton'];

        // Создаем экземпляр класса PlantsTable
        $plantsModule = new PlantsTable();

        // Если файл изображения не был загружен, берем старый путь к изображению по его id
        if (!isset($fileName)) {
            $fileName = $plantsModule->getPlantImageName($plantId);
        }

        // Обновляем данные растения с помощью функции updatePlant
        if ($plantsModule->updatePlant($fileName, $plantId, $name, $id_field, $description, $cost_per_ton)) {
            echo "Данные растения успешно обновлены.";
            header("Location: /Sem2LR1NEW/index.php?success=1");
            exit(); 
        } else {
            echo "Произошла ошибка при обновлении данных растения.";
        }
    } else {
        echo "Ошибка: Не переданы все необходимые данные для обновления растения.";
    }
}

// Проверяем, был ли передан параметр id в GET-запросе
if (isset($_GET['id'])) {
    $plantsModule = new PlantsTable();
    $plant_id = $_GET['id'];
    $plant = $plantsModule->GetPlantById($plant_id); // Получаем объект mysqli_result

    // Проверяем, есть ли данные в результирующем наборе
    if ($plant->num_rows > 0) {
        // Извлекаем данные из объекта mysqli_result
        $row = $plant->fetch_assoc();
        $name = $row['name'];
        $img_path = $row['img_path'];
        $id_field = $row['id_field'];
        $description = $row['description'];
        $cost_per_ton = $row['cost_per_ton'];
    } else {
        echo "Ошибка: Растение с указанным идентификатором не найдено.";
        exit;
    }
} else {
    echo "Ошибка: Не передан идентификатор растения для редактирования.";
    exit;
}
?>