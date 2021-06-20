<?php
    require_once "config.php";
    session_start();
        $ip = $_SERVER['REMOTE_ADDR'];
        $article_id = $_POST['article_id'];
        $service_code = $_GET['getLikedByCode'];

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        if (!empty($article_id)) {

            $sql1 = "SELECT * from like_article WHERE service_code = 'phpex-$article_id' AND liked_userid = '$ip'";
            $smtm = $pdo->query($sql1);
            $count = 0;
            foreach ($smtm as $row) {
                $count++;
            }
            if ($count == 0) {
                // 좋아요 기록이 없는 경우 -> 좋아요 등록
                $sql2 = "INSERT into like_article VALUES(0, 'phpex-$article_id', '$ip')";
                $res2 = $pdo->query($sql2);
                // 게시판 테이블 업데이트
                $sql3 = "UPDATE articles SET heart = heart + 1 WHERE article_id = $article_id";
                $res3 = $pdo->query($sql3);

                echo $res2 && $res3 ? "like" : "failed";
            } else {
                // 이미 좋아요를 누른 경우 -> 좋아요 취소
                $sql2 = "DELETE from like_article WHERE service_code = 'phpex-$article_id' AND liked_userid = '$ip'";
                $res2 = $pdo->query($sql2);

                $sql3 = "UPDATE articles SET heart = heart - 1 WHERE article_id = $article_id";
                $res3 = $pdo->query($sql3);
                echo $res2 && $res3 ? "unlike" : "failed";
            }
        } else if (!empty($service_code)) {
            $sql1 = "SELECT * from like_article WHERE service_code = 'phpex-$service_code' AND liked_userid = '$ip'";
            $smtm2 = $pdo->query($sql1);
            $check = -1;
            foreach ($smtm2 as $row) {
                $check++;
            }
            echo $check != -1 ? "liked" : "unliked";
        }
    }

?>