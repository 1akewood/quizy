<?php
require_once "config.php";

//    $sql = "select * from articles where description = $description;";
//    $smtm = $pdo->query($sql);
////    if ($_SESSION['username'] != $smtm['username']) {
//        $sql = "update articles set heart = heart + 1 where description = $description;";
//        $smtm = $pdo->query($sql);

//    }
$article_id = $_POST['article_id'];
if ($article_id != null){
    $query = "update articles set heart = heart + 1 where article_id = '$article_id';";
    $st = $pdo->prepare($query);
    $st->execute();
}
header("location: index.php");
exit;
?>