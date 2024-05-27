    <?php
    require_once 'E:\INTERVOLGA2023\Xampp\htdocs\Sem2LR1NEW\actions\FieldsActions.php'; 
    require_once 'CRUD/plants/update.php'
    ?>

    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Редактирование элемента</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    </head>
    <body>
    <?php include 'templates\header.php'; ?>

    <div class="container mt-5">
        <h2>Редактирование элемента</h2>

        <form action="" method="post" enctype="multipart/form-data">
        <!-- Скрытое поле с id растения -->
        <input type="hidden" name="id" value="<?php echo $plant_id; ?>">
        
        <div class="mb-3">
            <label for="current_image" class="form-label">Текущее изображение</label>
            <div id="current_image">
                <?php
                // Создаем экземпляр класса PlantsTable
                $plantsModule = new PlantsTable();
                // Получаем имя текущей картинки растения
                $currentImage = $plantsModule->getPlantImageName($plant_id);
                if ($currentImage) {
                    echo '<img src="/Sem2LR1NEW/inc/catalog_images/' . $currentImage . '" alt="Текущая картинка">';
                } else {
                    echo 'Картинка отсутствует';
                }
                ?>
            </div>
        </div>
        
        <div class="mb-3">
            <label for="img_path" class="form-label">Изображение</label>    
            <input type="file" class="form-control" id="img_path" name="img_path" accept="image/*">
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Название элемента</label>
            <input type="text" class="form-control" id="name" name="name" required value="<?php echo $name;?>" >
        </div>

        <div class="mb-3">
            <label for="id_field" class="form-label">Поле</label>
            <select class="form-select" id="id_field" name="id_field">
                <?php
                $fieldsModule = new FieldsTable(); // Создаем экземпляр класса для работы с полями
                $fields = $fieldsModule->getAllFields(); // Получаем все поля из таблицы
                if ($fields->num_rows > 0) {
                    while ($row = $fields->fetch_assoc()) {
                        $selected = ($row['id'] == $id_field) ? 'selected' : ''; // Проверяем, должно ли это поле быть выбрано по умолчанию
                        echo "<option value='" . $row['id'] . "' $selected>" . $row['field_name'] . "</option>";
                    }
                } else {
                    echo "<option value=''>Нет доступных полей</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <textarea class="form-control" id="description" name="description" rows="3"><?php echo $description;?></textarea>

        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Цена</label>
            <input type="number" class="form-control" id="price" name="cost_per_ton" required value="<?php echo $cost_per_ton;?>">
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <?php include 'templates\footer.php'; ?>

    </body>
    </html>
