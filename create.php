<?php
/**
 * Страница создания персонажа. Пользователь задает параметры Имя, Сила и Здоровье
 * (значения в пределах от 1 до 9). После этого переходит на страницу Арена.
 * При попытке открыть другие страницы (кроме страницы Сохранение/Загрузка) без
 * создания персонажа происходит перенаправление на страницу создания.
 * Характеристики нового персонажа должны быть предварительно проверены
 * регулярными выражениями.
 */
    if(isset($_POST['name'])){
        $name=$_POST['name'];
        $power=$_POST['power'];
        $health=$_POST['health'];
        if(!preg_match("/^[A-z\d]{1,20}$/",$name)||!preg_match("/^[1-9]$/",$power)||!preg_match("/^[1-9]$/",$health)){
            die("Недопустимые значения полей");
        }
        require_once '/var/www/configs/mysql/poks-php.php';
        $stmt=$db->prepare("REPLACE INTO chars (id,name,power,health,level,experience,points) VALUES (0,?,?,?,1,0,0)");
        $stmt->bind_param("sii", $name, $power, $health);
        $stmt->execute();
        header("Location: ./arena.php?id=0");
        die();
    }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Создание персонажа</title>
</head>
<body>
    <form action="./create.php" method="post">
        Имя:<br>
        <input type="text" name="name"><br>
        Сила:<br>
        <input type="text" name="power"><br>
        Здоровье:<br>
        <input type="text" name="health"><br>
        <input type="submit" value="Создать">
    </form><br>
    <button onclick='location.href="./saverestore.php?id=0"'>Сохранить/загрузить</button>
</body>
</html>
