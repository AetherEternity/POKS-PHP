<?php
/**
 * Страница Сохранения/Загрузки. Игроку предоставляются три ячейки для
 * сохранения/загрузки персонажа. Поставив галочку около выбранной ячейки,
 * пользователь может нажать кнопку «Сохранить» либо «Загрузить».
 * Все характеристики персонажа будут соответственно сохранены
 * в базу данных, либо загружены из неё.
 */
if(!isset($_GET['id'])&&!isset($_POST['slot'])){
    header("Location: ./create.php");
    die();
}
require_once '/var/www/configs/mysql/poks-php.php';

if(isset($_POST['save'])){
    movechar(0, $_POST['slot']);
    header("Location: ./arena.php?id=0");
    die();
}
if(isset($_POST['restore'])){
    movechar($_POST['slot'],0);
    header("Location: ./arena.php?id=0");
    die();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Сохранение/загрузка</title>
</head>
<body>
    <h3>Выберите слот:</h3>
    <form action="./saverestore.php" method="post">
        1 слот <input type="radio" name="slot" value="1"><br>
        2 слот <input type="radio" name="slot" value="2"><br>
        3 слот <input type="radio" name="slot" value="3"><br><br>
        <input type="submit" name="save" value="Сохранить" />
        <input type="submit" name="restore" value="Загрузить" />
    </form>
</body>
</html>
