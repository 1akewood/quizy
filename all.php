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
            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1.4em" width="1.4em" xmlns="http://www.w3.org/2000/svg">
                <path d="M16 6l2.29 2.29-4.88 4.88-4-4L2 16.59 3.41 18l6-6 4 4 6.3-6.29L22 12V6z"></path>
            </svg>
            &nbsp;전체
        </h6>
        <?php
        $sql = "select * from articles;";

        $smtm = $pdo->query($sql);
        foreach ($smtm as $row){
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
        }
        ?>
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