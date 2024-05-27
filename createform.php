<?php
require_once 'E:\INTERVOLGA2023\Xampp\htdocs\Sem2LR1NEW\conn.php'; // Подключаем файл с подключением к БД
require_once 'E:\INTERVOLGA2023\Xampp\htdocs\Sem2LR1NEW\actions\FieldsActions.php'; // Подключаем файл с классом для работы с таблицей полей

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создание нового элемента</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
<?php include 'templates\header.php'; ?>

<div class="container mt-5">
    <h2>Создание нового элемента</h2>

    <form action="  CRUD/plants/create.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="img_path" class="form-label">Изображение</label>
            <input type="file" class="form-control" id="img_path" name="img_path" accept="image/*">
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Название элемента</label>
            <input type="text" class="form-control" id="name" name="name" required  >
        </div>

        <div class="mb-3">
            <label for="id_field" class="form-label">Поле</label>
            <select class="form-select" id="id_field" name="id_field">
                <?php
                $fieldsModule = new FieldsTable(); // Создаем экземпляр класса для работы с полями
                $fields = $fieldsModule->getAllFields(); // Получаем все поля из таблицы
                if ($fields->num_rows > 0) {
                    while($row = $fields->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['field_name'] . "</option>";
                    }
                } else {
                    echo "<option value=''>Нет доступных полей</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Цена</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<?php include 'templates\footer.php'; ?>

</body>
</html>
