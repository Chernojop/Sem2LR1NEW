
    <?php include 'templates\header.php'; 
    if (isset($_GET['field_id'])) {
        $field_id = $_GET['field_id'];
        require_once('CRUD\plants\read.php'); 
    }
    else{
        require_once('CRUD\plants\read.php'); 
    }

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


    <div class="container mt-5">
        <h2>Список растений</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Изображение</th>
                    <th>Название растения</th>
                    <th>Поле</th>
                    <th>Описание</th>
                    <th>Цена за тонну</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                while ($row = $plants->fetch_assoc()):  
                        $fieldName = $fieldsModule->getFieldNameById($row['id_field']);
                    ?>
                    <tr>
                        <td><img src='inc/catalog_images/<?php echo $row['img_path']; ?>' alt='<?php echo $row['name']; ?>' style='max-width: 100px;'></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $fieldName; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['cost_per_ton']; ?></td>
                        <td>
                            <div class="mb-2">
                                <a href='editform.php?id=<?php echo $row['id']; ?>' class='btn btn-primary'>Редактировать</a>
                            </div>
                            <div class="mb-2">
                                <form action='CRUD/plants/delete.php' method='post'>
                                    <input type='hidden' name='plant_id' value='<?php echo $row['id']; ?>'>
                                    <button type='submit' class='btn btn-danger' onclick="return confirm('Вы уверены, что хотите удалить это растение?')">Удалить</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
                
            </tbody>
        </table>
        
        <form action='createform.php' method='post' class="mt-3">
            <button type='submit' class='btn btn-primary'>Создать</button>
        </form>

    </div>

    <?php include 'templates\footer.php'; ?>
