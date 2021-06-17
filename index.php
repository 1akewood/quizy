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
    <style>
        #load {
            display: block;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 99;
            width: 100%;
            height: 100%;
            background-color: white;
            text-align: center;
        }
        #load>img{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            -webkit-transform: translate(-50%,-50%);
            -moz-transform: translate(-50%,-50%);
            -ms-transform: translate(-50%,-50%);
            -o-transform: translate(-50%,-50%);
            z-index: 100;
        }
        .btn-like .heart-shape {
            display: inline;
            color: red;
        }
        .btn-like {
            border: none;
            background-color: inherit;
        }
    </style>
    <link rel="stylesheet" href="index.js">
    <script>
        function heart(target) {
            $title = target.parentNode.querySelector('strong').textContent.trim();
            $sql = "select * from articles where description = "+$title+";";
//            $smtm = $pdo->query($sql);
//            if ($_SESSION['username'] != $smtm['username'])
//            $sql = "update articles set heart = heart + 1 where description = $title;";
//            $pdo->query();
        }

        $(window).on('load',function (){
            $('#load').hide();
        });
    </script>
</head>
<body class="bg-light">
<div id="load" style="display: none"><img src="https://tistory4.daumcdn.net/tistory/2525279/skin/images/loading.gif" alt="loading"></div>
<nav class="navbar navbar-expand-md fixed-top navbar-light bg-light">
    <img id="logo" class="mr-3" src="../que.svg" onClick="window.location.reload()" alt="" width="24" height="24">
    <a id="logo" class="navbar-brand" onClick="window.location.reload()" href="index.php">Quizy</a>
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
            &nbsp;트랜딩
        </h6>
        <?php
        $sql = "select * from articles order by heart desc;";

        $smtm = $pdo->query($sql);
        $count = 0;
        foreach ($smtm as $row){
            if($count == 5)
                break;
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
                <form action="./heart.php" method="post">
                    <button type="submit" class="btn-like"><input type="hidden" name="article_id" value="<?=$row['article_id']?>">
                        <span class="heart-shape">♡</span> <span class="like-count"><?=$row['heart']?></span>
                    </button>
                </form>
                </p>
            </div>
            <?php
            $count++;
        }
        ?>


        <!--<div id="index-articles" class="media text-muted pt-3">
            <img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">
            <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <strong class="d-block text-gray-dark">2021 정보처리기사 필기 2회 예상문제</strong>
                사람들의 릴케 나의 하나에 그리고 내 계십니다. 북간도에 벌레는 내린 이런 책상을 언덕 자랑처럼 소학교 버리었습니다.
            </p>
        </div>
        <div id="index-articles" class="media text-muted pt-3">
            <img data-src="holder.js/32x32?theme=thumb&bg=e83e8c&fg=e83e8c&size=1" alt="" class="mr-2 rounded">
            <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <strong class="d-block text-gray-dark">제 430회 정규토익 시험 기출문제</strong>
                나는 별 둘 이름을 나의 가슴속에 밤을 그리고 계집애들의 있습니다. 아스라히 가난한 이름과, 나의 노새, 둘 북간도에 별을 있습니다. 걱정도 자랑처럼 내 까닭입니다.
            </p>
        </div>
        <div id="index-articles" class="media text-muted pt-3">
            <img data-src="holder.js/32x32?theme=thumb&bg=6f42c1&fg=6f42c1&size=1" alt="" class="mr-2 rounded">
            <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <strong class="d-block text-gray-dark">테스트</strong>
                계절이 슬퍼하는 소학교 추억과 이름자 까닭입니다. 이런 경, 많은 듯합니다. 했던 경, 가난한 별 못 어머니, 계집애들의 거외다.
            </p>
        </div>-->
        <small class="d-block text-right mt-3">
            <a href="./all.php">더 보기</a>
        </small>
    </div>

    <div class="my-3 p-3 bg-white rounded box-shadow">
        <h6 class="border-bottom border-gray pb-2 mb-0">
            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1.4em" width="1.4em" xmlns="http://www.w3.org/2000/svg">
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
            $count++;
        }
        ?>
        <!--<div id="index-articles" class="media text-muted pt-3">
            <img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">
            <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <strong class="text-gray-dark">강상우</strong>
                    <a class="text-dark" onclick="return false" style="cursor:default;">
                        <svg width="13" height="13" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M18 1l-6 4-6-4-6 5v7l12 10 12-10v-7z"></path>
                        </svg>
                        0
                    </a>
                </div>
                <span class="d-block">@rnesw</span>
            </div>
        </div>
        <div id="index-articles" class="media text-muted pt-3">
            <img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">
            <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <strong class="text-gray-dark">오현민</strong>
                    <a class="text-dark" onclick="return false" style="cursor:default;">
                        <svg width="13" height="13" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M18 1l-6 4-6-4-6 5v7l12 10 12-10v-7z"></path>
                        </svg>
                        0
                    </a>
                </div>
                <span class="d-block">@odengmin</span>
            </div>
        </div>
        <div id="index-articles" class="media text-muted pt-3">
            <img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">
            <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <strong class="text-gray-dark">최지현</strong>
                    <a class="text-dark" onclick="return false" style="cursor:default;">
                        <svg width="13" height="13" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M18 1l-6 4-6-4-6 5v7l12 10 12-10v-7z"></path>
                        </svg>
                        0
                    </a>
                </div>
                <span class="d-block">@91.3mm</span>
            </div>
        </div>-->
        <small class="d-block text-right mt-3">
            <a href="./all.php">더 보기</a>
        </small>
    </div>
    <div id="loading"></div>
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