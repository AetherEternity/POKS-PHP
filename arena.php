<?php
/**
 * Страница Арена. Здесь отображаются текущие параметры персонажа, его Уровень
 * (изначально 1) и Опыт (изначально 0) и кнопки перехода на страницы Бой и
 * Повышение уровня.
 */
    if(!isset($_GET['id'])){
        header("Location: ./create.php");
        die();
    }
    require_once '/var/www/configs/mysql/poks-php.php';
    $id=$_GET['id'];
    $res=getallbyid($id);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Арена</title>
</head>
<body>
    <h3><?php echo $res["name"]; ?></h3>
    Сила: <?php echo $res["power"]; ?><br>
    Здоровье: <?php echo $res["health"]; ?><br>
    Уровень: <?php echo $res["level"]; ?><br>
    Опыт: <?php echo $res["experience"]; ?><br><br>
    <button onclick='location.href="./battle.php?id=<?php echo $id; ?>"'>Бой</button>  <button onclick='location.href="./lvlup.php?id=<?php echo $id; ?>"'>Повышение уровня</button><br>
    <button onclick='location.href="./saverestore.php?id=<?php echo $id; ?>"'>Сохранить/загрузить</button>
</body>
</html>
