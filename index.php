<?php
    $db = new PDO('mysql:host=localhost;dbname=ek', 'root', 'root');
    $db->exec("SET NAMES UTF8");

    if (count($_POST) > 0) {
        $name = trim($_POST['name']);
        $text = trim($_POST['text']);

        if ($name != '' && $text != '') {
            $query = $db->prepare("INSERT INTO comments SET name='$name', text='$text'");
            $query->execute();


            header("Location: index.php");
            exit();
        }
    }

    $query = $db->prepare("INSERT INTO comments ORDER BY DT DESC ");

    $query->execute();
    $comments = $query->fetchAll();
?>

<form method="post">
    Имя<br>
    <input type="text" name="name" value="<?php echo $name;?>"><br>
    Комментарий<br>
    <textarea name="text"></textarea><?php echo $text;?><br>
    <input type="submit" value="Отправить">
</form>

<div class="comments">
    <? foreach ($comments as $one): ?>
        <div class="item">
            <span><?=$one['dt']?></span>
            <strong><?=$one['name']?></strong>
            <div><?=$one['text']?></div>
        </div>
    <? endforeach; ?>
</div>
