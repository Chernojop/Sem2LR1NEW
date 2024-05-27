<?php
require_once '/INTERVOLGA2023/Xampp/htdocs/Sem2LR1NEW/actions/PlantsActions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['plant_id'])) {
        $plantId = $_POST['plant_id'];

        $deletePlant = new PlantsTable();

        // Получаем имя файла из базы данных
        $plantImageName = $deletePlant->getPlantImageName($plantId);

        // Проверяем, удалось ли получить имя файла
        if ($plantImageName) {
            // Путь к директории с изображениями
            $imageDirectory = '/INTERVOLGA2023/Xampp/htdocs/Sem2LR1NEW/inc/catalog_images/';

            // Формируем полный путь к файлу
            $plantImagePath = $imageDirectory . $plantImageName;

            // Проверяем, существует ли файл
            if (file_exists($plantImagePath)) {
                // Удаляем файл
                if (unlink($plantImagePath)) {
                    echo "Изображение успешно удалено.";
                } else {
                    echo "Ошибка при удалении изображения.";
                }
            } else {
                echo "Ошибка: Файл изображения не найден.";
            }
        } else {
            echo "Ошибка: Имя файла изображения не найдено.";
        }

        // После удаления изображения удаляем запись из базы данных
        $deleted = $deletePlant->deletePlant($plantId);

        if ($deleted) {
            header("Location: ../../index.php");
            exit();
        } else {
            echo "Ошибка при удалении растения из базы данных.";
        }
    } else {
        echo "Ошибка: Идентификатор растения не был передан.";
    }
} else {
    echo "Ошибка: Неверный метод запроса.";
}
?>
