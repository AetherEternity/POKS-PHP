<?php
/**
 * Страница Бой. При открытии генерируется противник со случайными параметрами
 * в пределах от 1 до 9. Происходит сравнение характеристик. Если Сила
 * персонажа больше Здоровья противника, персонаж победил. Если Сила противника
 * больше Здоровья персонажа, противник победил. Если оба условия верны или оба
 * не верны – ничья. Если победил персонаж – ему добавляется 1 очко опыта,
 * если противник – очки опыта персонажа сбрасываются.
 */
    if(!isset($_GET['id'])) {
        header("Location: ./create.php");
        die();
    }
    require_once '/var/www/configs/mysql/poks-php.php';
    $id=$_GET['id'];
    $res=getallbyid($id, $db);
    $level=intval($res["level"]);
    $points=intval($res["points"]);
    $experience=intval($res["experience"]);
    $enpower=rand(1,9);
    $enhealth=rand(1,9);
    $result="ERROR";
    $enstronger=$enpower>$res["health"];
    $stronger=$res["power"]>$enhealth;
    if($enstronger&&!$stronger){
        $result="Поражение";
        $stmt=$db->prepare("UPDATE chars SET experience=0 WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }elseif (!$enstronger&&$stronger){
        $result="Победа";
        $stmt=$db->prepare("UPDATE chars SET experience=?, level=?, points=? WHERE id=?");
        $experience+=1;
        if($experience==3){
            $experience=0;
            $points+=3;
            $level+=1;
        }
        $stmt->bind_param("iiii", $experience, $level, $points, $id);
        $stmt->execute();
    }else{
        $result="Ничья";
    }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Бой</title>
</head>
<body>
<h3>Противник</h3>
Сила: <?php echo $enpower; ?><br>
Здоровье: <?php echo $enhealth; ?><br><br>
Результат боя: <?php echo $result; ?><br>
<button onclick='location.href="./arena.php?id=<?php echo $id; ?>"'>На арену</button>
</body>
</html>
