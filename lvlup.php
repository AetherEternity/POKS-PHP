<?php
/**
 * Страница Повышение уровня. При наборе 3-х очков опыта, персонажу повышается
 * уровень и добавляется 3 очка характеристик, которые он может потратить на
 * повышение  Силы или Здоровья.
 */
if(!isset($_GET['id'])&&!isset($_POST['power'])){
    header("Location: ./create.php");
    die();
}
require_once '/var/www/configs/mysql/poks-php.php';
$id=0;
$res=getallbyid($id);
if(isset($_POST['power'])){
    $power=intval($_POST['power']);
    $health=intval($_POST['health']);
    $used=$power+$health;
    $points=intval($res['points']);
    if($power<0||$health<0){
        die("Значения не могут быть отрицательными");
    }
    if($used>$points){
        die("Сумма очков выше доступных баллов");
    }
    $points-=$used;
    $health+=intval($res['health']);
    $power+=intval($res['power']);
    $stmt=$db->prepare("UPDATE chars SET power=?, health=?, points=? WHERE id=?");
    $stmt->bind_param("iiii", $power, $health, $points, $id);
    $stmt->execute();
    header("Location: ./arena.php?id=0");
    die();
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Повышение уровня</title>
</head>
<body>
    <h3>У вас <?php echo $res['points']; ?> очков</h3>
    <h3>Распределение очков:</h3>
    <form action="./lvlup.php" method="post">
        Сила (<?php echo $res['power']; ?>):<br>
        <input type="number" value="0" name="power"><br>
        Здоровье (<?php echo $res['health']; ?>):<br>
        <input type="number" value="0" name="health"><br>
        <input type="submit" value="Повысить характеристики ">
    </form>
</body>
</html>
