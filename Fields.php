<?php
require_once '/INTERVOLGA2023/Xampp/htdocs/Sem2LR1NEW/actions/FieldsActions.php';
$fieldsModule = new FieldsTable();
$fields = $fieldsModule->getAllFields(); // Получаем результат

// Вывод сообщения об успешном обновлении, если есть
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo '<div class="alert alert-success" id ="successMessage" role="alert">Данные успешно изменены.</div>';
}

?>

<script>
    // Ждем 3 секунды и скрываем сообщение
    setTimeout(function() {
        document.getElementById("successMessage").style.display = "none";
    }, 3000);
</script>

<?php include 'templates\header.php'; ?>

<div class="container mt-5">
    <h2>Список полей</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название поля</th>
                <th>Действие</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            while ($row = $fields->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <!-- Название поля теперь является ссылкой -->
                    <td><a href='index.php?field_id=<?php echo $row['id']; ?>'><?php echo $row['field_name']; ?></a></td>
                    <td>
                        <div class="mb-2">
                            <a href='fieldupdateform.php?id=<?php echo $row['id']; ?>' class='btn btn-primary'>Редактировать</a>
                        </div>
                        <div class="mb-2">
                            <form action='CRUD/fields/delete.php' method='post'>
                                <input type='hidden' name='field_id' value='<?php echo $row['id']; ?>'>
                                <button type='submit' class='btn btn-danger' onclick="return confirm('Вы уверены, что хотите удалить это поле?')">Удалить</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endwhile; ?>
            
        </tbody>
    </table>
    
    <form action='fieldscreateform.php' method='post' class="mt-3">
        <button type='submit' class='btn btn-primary'>Создать</button>
    </form>

</div>

<?php include 'templates\footer.php'; ?>
