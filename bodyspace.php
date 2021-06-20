<div id="load" style="display: none">
    <img src="https://tistory4.daumcdn.net/tistory/2525279/skin/images/loading.gif" alt="loading">
</div>
<nav class="navbar navbar-expand-md fixed-top navbar-light bg-light">
    <img id="logo" class="mr-3" src="../que.svg" onclick="window.location.reload()" alt="" width="24" height="24">
    <a id="logo" class="navbar-brand" onclick="window.location.reload()" href="index.php">Quizy</a>
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
</main>