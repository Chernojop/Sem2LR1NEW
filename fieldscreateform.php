<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создание нового поля</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
<?php include 'templates\header.php'; ?>

<div class="container mt-5">
    <h2>Создание нового поля</h2>

    <form action="CRUD/fields/create.php" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Название поля</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <button type="submit" class="btn btn-primary">Создать поле</button>
    </form>
</div>

<?php include 'templates\footer.php'; ?>

</body>
</html>
