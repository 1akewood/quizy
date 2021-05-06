<?php session_start();
require_once "config.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../que.ico">

    <title>Quizy</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/offcanvas/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="index.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-md fixed-top navbar-light bg-light">
    <img id="logo" class="mr-3" src="../que.svg" onClick="window.location.reload()" alt="" width="24" height="24">
    <a id="logo" class="navbar-brand" onClick="window.location.reload()">Quizy</a>
    <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <!--
            <li class="nav-item active">
                  <a class="nav-link" href="#">Dashboard <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Notifications</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Profile</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Switch account</a>
            </li>
            -->
            <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) : ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $_SESSION["username"] ?></a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
            <?php endif; ?>
        </ul>
        <form class="form-inline my-2 my-lg-0" method="post" action="./search.php">
            <input class="form-control mr-sm-2" type="text" name="keyword" placeholder="검색어를 입력하세요." aria-label="Search">
            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">검색</button>
            <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) : ?>
                <button class='btn btn-outline-primary ml-2 my-2 my-sm-0' type='button' onclick='location.href="drawup.php";'>퀴즈 만들기</button>
            <?php endif; ?>
            <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) : ?>
                <button class='btn btn-primary ml-2 my-2 my-sm-0' type='button' onclick='location.href="logout.php";'>로그아웃</button>
            <?php else : ?>
                <button class='btn btn-primary ml-2 my-2 my-sm-0' type='button' onclick='location.href="signin.php";'>로그인</button>
            <?php endif; ?>
        </form>
    </div>
</nav>

<div class="nav-scroller bg-white box-shadow">
    <nav class="nav nav-underline">
        <a class="nav-link active" href="#">대시보드</a>
        <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) : ?>
            <a class="nav-link" href="#">
                팔로우
                <span class="badge badge-pill bg-light align-text-bottom">27</span>
            </a>
        <?php endif; ?>
        <!--
        <a class="nav-link" href="#">Explore</a>
            <a class="nav-link" href="#">Suggestions</a>
            <a class="nav-link" href="#">Link</a>
            <a class="nav-link" href="#">Link</a>
            <a class="nav-link" href="#">Link</a>
            <a class="nav-link" href="#">Link</a>
        <a class="nav-link" href="#">Link</a>
        -->
    </nav>
</div>

<main role="main" class="container">
    <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow">
        <img class="mr-3" src="../que.svg" alt="" width="48" height="48">
        <div class="lh-100">
            <h6 class="mb-0 text-white lh-100">Quizy</h6>
            <small>Since 2021</small>
        </div>
    </div>

    <div class="my-3 p-3 bg-white rounded box-shadow">
        <h6 class="border-bottom border-gray pb-2 mb-0">
            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1.4em" width="1.4em" xmlns="http://www.w3.org/2000/svg">
                <path d="M16 6l2.29 2.29-4.88 4.88-4-4L2 16.59 3.41 18l6-6 4 4 6.3-6.29L22 12V6z"></path>
            </svg>
            <?php
            echo "'".$_POST['keyword']."' 에 대한";
            ?>
            &nbsp;검색 결과
        </h6>
        <?php
        $keyword = "\"%".$_POST['keyword']."%\"";
        $sql = "select * from articles where description like".$keyword." or content like ".$keyword;

        $smtm = $pdo->query($sql);
        foreach ($smtm as $row){
            ?>
            <div id="index-articles" class="media text-muted pt-3">
                <img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">
                <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                    <strong class="d-block text-gray-dark">
                        <?php
                        echo $row['description'];
                        ?>
                    </strong>
                    <?php
                    echo $row['content'];
                    ?>
                </p>
            </div>
            <?php
        }
        ?>
    </div>

</main>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js" integrity="sha512-cJMgI2OtiquRH4L9u+WQW+mz828vmdp9ljOcm/vKTQ7+ydQUktrPVewlykMgozPP+NUBbHdeifE6iJ6UVjNw5Q==" crossorigin="anonymous"><\/script>')</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.7/holder.min.js" integrity="sha512-O6R6IBONpEcZVYJAmSC+20vdsM07uFuGjFf0n/Zthm8sOFW+lAq/OK1WOL8vk93GBDxtMIy6ocbj6lduyeLuqQ==" crossorigin="anonymous"></script>
<script>
    $(function () {
        'use strict'

        $('[data-toggle="offcanvas"]').on('click', function () {
            $('#navbarsExampleDefault').toggleClass('open')
        })
    })
</script>
</body>
</html>

