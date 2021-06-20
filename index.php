<?php
require_once 'structure.php';
?>

<!DOCTYPE html>
<html lang="ko">
<?php
require_once 'headerspace.php';
?>
<body class="demo">
    <?php
    require_once 'bodyspace.php';
    ?>
    <main role="main" class="container">
        <div class="my-3 p-3 bg-white rounded box-shadow">
            <h6 class="border-bottom border-gray pb-2 mb-0">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewbox="0 0 24 24" height="1.4em" width="1.4em" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16 6l2.29 2.29-4.88 4.88-4-4L2 16.59 3.41 18l6-6 4 4 6.3-6.29L22 12V6z"></path>
                </svg>
                &nbsp;트랜딩
            </h6>
            <?php
            echo '<script>createCookie("article_num","","-1")</script>';
            $sql = "select * from articles order by heart desc;";
            $smtm = $pdo->query($sql);
            $count = 0;
            foreach ($smtm as $row){
                if($count == 5)
                    break;
                ?>
                <div id="index-articles" class="media text-muted pt-3">
                    <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
                    <?php
                    echo '<a class="media-body text-gray-dark" style="margin-left: 20px" href="content.php?article_id='.$row['article_id'].'" >';
                    echo '<p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">';
                    echo '<strong class="d-block text-gray-dark">'.$row['description'].'</strong>';
                    echo $row['content'];
                    echo '</p></a>';
                    echo '<button type="button" class="btn-like"  data-article-id="'.$row['article_id'].'">'
                            .'<span class="heart-shape">♡</span> <span class="like-count">'.$row['heart'].'</span></button>'
                    ?>
                </div>
                <?php
                $count++;
            }

            ?>
            <small id="more-click" class="d-block text-right mt-3">
                <a href="all.php"">더 보기</a>
            </small>
        </div>
        <div class="my-3 p-3 bg-white rounded box-shadow">
            <h6 class="border-bottom border-gray pb-2 mb-0">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewbox="0 0 24 24" height="1.4em" width="1.4em" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"></path>
                </svg>
                &nbsp;최신
            </h6>
            <?php
            $sql = "select * from articles order by article_id desc;";

            $smtm = $pdo->query($sql);
            $count = 0;
            foreach ($smtm as $row){
                if($count ==5)
                    break;
                ?>
                <div id="index-articles" class="media text-muted pt-3">
                    <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
                    <?php
                    echo '<a class="media-body text-gray-dark" style="margin-left: 20px" href="content.php?article_id='.$row['article_id'].'" >';
                    echo '<p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">';
                    echo '<strong class="d-block text-gray-dark">'.$row['description'].'</strong>';
                    echo $row['content'];
                    echo '</p></a>';
                    ?>
                </div>
                <?php
                $count++;
            }
            ?>
            <small id="more-click" class="d-block text-right mt-3">
                <a href="all.php"">더 보기</a>
            </small>
        </div>
    </main>
    <?php
    require_once 'footerspace.php';
    ?>
</body>
<style>
    a:link { color: gray; text-decoration: none;}
    a:visited { color: gray; text-decoration: none;}
    a:hover { color: black; text-decoration: none;}
    a:active { color: black; text-decoration: none;}
    button:focus, button:active {
        outline: none;
        box-shadow: none;
    }
</style>
</html>