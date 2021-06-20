<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>

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
require_once 'footerspace.php';
?>
<?php
require_once 'bodyspace.php';
?>

<?php
$session_id = $err_session_id = "";
$header_description = $err_header_description = "";
$header_content = $err_header_content = "";

$body_description = $err_body_description = "";
$body_content = $err_body_content = "";
$answer_type = $err_answer_type = "";
$select1 = "";
$select2 = "";
$select3 = "";
$select4 = "";
$select5 = "";
$err_select = "";
$answer = $err_answer = "";
$article_num = $err_article_num = "";
$article_id = $err_article_id = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (empty($_SESSION['id']))
    {
        $err_session_id = "Session Error";
    }
    else
    {
        $session_id = $_SESSION['id'];
    }

    if (empty($_POST["header-description"]) || $_POST["header-description"] == "")
    {
        $err_header_description = "Please fill header description";
    }
    else
    {
        $header_description = $_POST["header-description"];
    }

    if (empty($_POST["header-content"]) || $_POST["header-content"] == "")
    {
        $err_header_content = "Please fill header content";
    }
    else
    {
        $header_content = $_POST["header-content"];
    }

    if (empty($_POST["article-num"]) || $_POST["article-num"] == "")
    {
        $err_article_num = "Error in article-num";
    }
    else
    {
        $article_num = $_POST["article-num"];
    }

    // for($index = 1; $index <= $article_num; $index++) {
        if (empty($_POST["body-description"]) || $_POST["body-description"] == "") {
            $err_body_description = "Please fill body description";
        } else {
            $body_description = $_POST["body-description"];
        }

        if (empty($_POST["body-content"]) || $_POST["body-content"] == "") {
            $err_body_content = "Please fill body content";
        } else {
            $body_content = $_POST["body-content"];
        }

        if (empty($_POST["answer-type"])) {
            $err_answer_type = "Error in answer type";
        } else {
            $answer_type = $_POST["answer-type"];
        }

        if (!empty($_POST["select1"])) {
            $select1 = $_POST["select1"];
        }

        if (!empty($_POST["select2"])) {
            $select2 = $_POST["select2"];
        }

        if (!empty($_POST["select3"])) {
            $select3 = $_POST["select3"];
        }

        if (!empty($_POST["select4"])) {
            $select4 = $_POST["select4"];
        }

        if (!empty($_POST["select5"])) {
            $select5 = $_POST["select5"];
        }

        if (empty($_POST["answer"]) || $_POST["answer"] == "") {
            $err_answer = "Please fill answer";
        } else {
            $answer = $_POST["answer"];
        }
    //}


    if (empty($_POST["article-id"]) || $_POST["article-id"] == "")
    {
        $err_article_id = "Error in article-id";
    }
    else
    {
        $article_id = $_POST["article-id"];
    }

    if (empty($err_header_description) && empty($err_header_content))
    {
        $sql = "INSERT INTO articles (user_id, description, content) VALUES (:session_id, :header_description, :header_content)";
        if ($stmt = $pdo->prepare($sql))
        {
            $stmt->bindParam(":session_id", $param_userid, PDO::PARAM_INT);
            $stmt->bindParam(":header_description", $param_description, PDO::PARAM_STR);
            $stmt->bindParam(":header_content", $param_content, PDO::PARAM_STR);

            $param_userid = $session_id;
            $param_description = $header_description;
            $param_content = $header_content;

            if($stmt->execute()){
                // Redirect to login page
                //header("Location: https://quizy.site/drawup.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            //unset($pdo);
        }

        $article_id = $pdo->query("SELECT article_id FROM articles ORDER BY article_id DESC LIMIT 1")->fetchColumn();

        //for($index = 1; $index <= $article_num; $index++) {
            $sql = "INSERT INTO quizzies (article_id, description, content, answer_type, select1, select2, select3, select4, select5, answer, article_num) VALUES (:article_id, :body_description, :body_content, :answer_type, :select1, :select2, :select3, :select4, :select5, :answer, :article_num)";

            if ($stmt = $pdo->prepare($sql)) {
                $stmt->bindParam(":article_id", $param_article_id, PDO::PARAM_INT);
                $stmt->bindParam(":body_description", $param_description, PDO::PARAM_STR);
                $stmt->bindParam(":body_content", $param_content, PDO::PARAM_STR);
                $stmt->bindParam(":answer_type", $param_answer_type, PDO::PARAM_INT);
                $stmt->bindParam(":select1", $param_select1, PDO::PARAM_STR);
                $stmt->bindParam(":select2", $param_select2, PDO::PARAM_STR);
                $stmt->bindParam(":select3", $param_select3, PDO::PARAM_STR);
                $stmt->bindParam(":select4", $param_select4, PDO::PARAM_STR);
                $stmt->bindParam(":select5", $param_select5, PDO::PARAM_STR);
                $stmt->bindParam(":answer", $param_answer, PDO::PARAM_STR);
                $stmt->bindParam(":article_num", $param_article_num, PDO::PARAM_INT);

                $param_article_id = $article_id;
                $param_description = $body_description;
                $param_content = $body_content;
                $param_answer_type = $answer_type;
                $param_select1 = $select1;
                $param_select2 = $select2;
                $param_select3 = $select3;
                $param_select4 = $select4;
                $param_select5 = $select5;
                $param_answer = $answer;
                $param_article_num = $article_num;

                if ($stmt->execute()) {
                    // Redirect to login page
                    //header("Location: https://quizy.site/drawup.php");
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }
                unset($pdo);
            }
        //}
    }
}

unset($pdo);
?>

<script src="drawup.js?ver=29"></script>
<link rel="stylesheet" href="drawup.css?ver=8">
    <main role="main" class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div id="quiz-header" class="my-3 p-3 bg-white rounded box-shadow">
                <div class="card-title" style="margin-top:30px;">
                    <h2 class="card-title text-center" style="color:#113366;">새로운 퀴즈</h2>
                    <hr>
                </div>
                <div id="quiz-header-card" class="card-body">
                    <h2 class="quiz-header-clickable-text">퀴즈 제목</h2>
                    <input id="quiz-header-description" type="text" class="form-control" placeholder="퀴즈 제목" style="display:none;" required autofocus">
                    <!--
                    <input id="quiz-header-description" type="text" class="form-control <?php echo (!empty($err_header_description)) ? 'is-invalid' : ''; ?>" value="<?php echo $header_description; ?>" placeholder="퀴즈 제목" style="display:none;" required autofocus">
                    <span class="invalid-feedback"><?php echo $err_header_description; ?></span>
                    -->
                    <br>
                    <h6 class="quiz-header-clickable-text" style="color: #737373">어떤 퀴즈인지 설명해주세요.</h6>
                    <input id="quiz-header-content" type="text" class="form-control" placeholder="어떤 퀴즈인지 설명해주세요." style="display:none;" required autofocus">
                    <!--
                    <input id="quiz-header-content" type="text" class="form-control <?php echo (!empty($err_header_content)) ? 'is-invalid' : ''; ?>" value="<?php echo $header_content; ?>" placeholder="어떤 퀴즈인지 설명해주세요." style="display:none;" required autofocus">
                    <span class="invalid-feedback"><?php echo $err_header_content; ?></span>
                    -->
                </div>
            </div>

            <hr>

            <div id="quiz" class="my-3 p-5 bg-white rounded box-shadow">
                <div class="card-title mb-4">
                    <h2 class="card-title text-right mr-3" style="color:#113366; display: inline; float: right" onclick="removequiz($(this))">-</h2>
                    <h2 class="card-title text-right mr-3" style="color:#113366; display: inline; float: right" onclick="appendquiz($quiz)">+</h2>
                </div>
                <div id="quiz-body-card" class="card-body mt-3" style="margin-top:10px;">
                    <hr>
                    <h3 class="quiz-body-clickable-text">퀴즈 문제</h3>
                    <input type="text" id="quiz-body-description" class="form-control" style="display:none;" placeholder="퀴즈 문제" required autofocus>
                    <br>
                    <h6 class="quiz-body-clickable-text" style="color: #737373">퀴즈 설명</h6>
                    <input type="text" id="quiz-body-content" class="form-control" style="display:none;" placeholder="퀴즈 설명" required autofocus>
                    <br>
                    <div class="answer" style="margin-bottom: 10px">
                        <h6 class="quiz-body-clickable-text" style="color: #737373">주관식 정답</h6>
                        <input type="text" id="quiz-body-answer" class="form-control" style="display:none;" placeholder="주관식 정답" required autofocus>
                    </div>
                    <div class="btn-group dropright float-right">
                        <button id="quiz-es-type" type="button" class="btn btn-primary dropdown-toggle mt-3 ml-3 " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            주관식
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">객관식</a>
                            <a class="dropdown-item" href="#">체크박스</a>
                        </div>
                    </div>
                </div>
            </div>

            <div id="quiz-submit-card" class="my-3 p-3 bg-white rounded box-shadow">
                <div class="card-title">
                </div>
                <div id="quiz-submit-body" class="card-body">
                    <button id="quiz-reset" type="button" class="btn btn-primary">
                        초기화
                    </button>
                    <button id="quiz-submit" class="btn btn-primary">
                        제출하기
                    </button>
                </div>
            </div>

            <div class="modal">
            </div>
        </form>
    </main>
</body>
<footer></footer>
</html>
