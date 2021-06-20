<?php
require_once 'structure.php';
?>
<!DOCTYPE html>
<html lang="ko">
<html>
<?php
require_once 'headerspace.php';
?>
<link rel="stylesheet" href="./content.css">
<script>
    function createCookie(name, value, days) {
        var expires;
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toGMTString();
        }
        else {
            expires = "";
        }
        document.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
    }
</script>
<body>
<?php
require_once 'bodyspace.php';
?>
<main role="main" class="container">
    <div class="blog-post">
        <label data-toggle="modal" data-target="#settingModal" class="setting"></label>
        <label class="bookmark top " data="3491" onclick="mark(this)">
        </label>
        <label class="copy-share"></label>
        <h5 class="subject">
            <span class="number">
            <?php
            $sql = "select * from quizzies where article_id = {$_GET['article_id']} order by article_num desc;";
            $smtm = $pdo -> query($sql);
            foreach ($smtm as $row){
                echo "<script>var maxNum = ".$row['article_num'].";</script>";
//                $random = rand(1,$row['article_num']);
                break;
            }
            if (!empty($_COOKIE['article_num'])){
                $sql = "select * from quizzies where article_id = {$_GET['article_id']} and article_num = ".$_COOKIE['article_num'].";";
                $smtm2 = $pdo -> query($sql);
            }else{
                $sql2 = "select * from quizzies where article_id = {$_GET['article_id']} and  article_num = 1;";
                $smtm2 = $pdo -> query($sql2);
            }
            foreach ($smtm2 as $row){
            echo "<script>var answer = '".$row['answer']."'; var currentNum = {$row['article_num']} ;</script>";
            echo $row['article_num'].".";
            ?>
            </span>
            <?php
                echo $row['description'];
            ?>
        </h5>
        <hr>
        <pre class="contents" >
            <?php
                echo $row['content'];
            ?>
        </pre>
        <hr>
        <?php
            if ($row['answer_type'] == 1){
                echo '<ul class="example">';
                if ($row['select1'] != null && $row['select1'] != undefined)
                    echo '<li id="example1" onclick="checkAnswer(1)">'.
                        '<div class="number"><span class="circled">① '.$row['select1'].'</span></div></li>';
                if ($row['select2'] != null && $row['select2'] != undefined)
                    echo '<li id="example2" onclick="checkAnswer(2)">'.
                        '<div class="number"><span class="circled">② '.$row['select2'].'</span></div></li>';
                if ($row['select3'] != null && $row['select3'] != undefined)
                    echo '<li id="example3" onclick="checkAnswer(3)">'.
                        '<div class="number"><span class="circled">③ '.$row['select3'].'</span></div></li>';
                if ($row['select4'] != null && $row['select4'] != undefined)
                    echo '<li id="example4" onclick="checkAnswer(4)">'.
                        '<div class="number"><span class="circled">④ '.$row['select4'].'</span></div></li>';
                if ($row['select5'] != null && $row['select5'] != undefined)
                    echo '<li id="example5" onclick="checkAnswer(5)">'.
                        '<div class="number"><span class="circled">⑤ '.$row['select5'].'</span></div></li></ul>';
            }else if ($row['answer_type'] == 2){
                echo '<ul style="margin-bottom: 10px">';
                if ($row['select1'] != null && $row['select1'] != undefined)
                    echo '<li><input type="checkbox" id="select1" class="form-check-input">'.$row['select1'].'</li>';
                if ($row['select1'] != null && $row['select2'] != undefined)
                    echo '<li><input type="checkbox" id="select2" class="form-check-input">'.$row['select2'].'</li>';
                if ($row['select1'] != null && $row['select3'] != undefined)
                    echo '<li><input type="checkbox" id="select3" class="form-check-input">'.$row['select3'].'</li>';
                if ($row['select1'] != null && $row['select4'] != undefined)
                    echo '<li><input type="checkbox" id="select4" class="form-check-input">'.$row['select4'].'</li>';
                if ($row['select1'] != null && $row['select5'] != undefined)
                    echo '<li><input type="checkbox" id="select5" class="form-check-input">'.$row['select5'].'</li>';
                echo '<li><input type="button" value="정답 확인" class="btn btn-success" style="margin-top: 10px" onclick="check_MultiAnswer()"></li>';
                echo '</ul>';

            }else{
                echo '<input type="text" id="short_answer" class="form-control d-inline" style="width: 200px; margin: 20px">';
                echo '<input type="button" class="btn btn-success" onclick="check_ShortAnswer()" value="정답 확인">';
            }

        ?>
        <hr>
        <canvas id="answerChart" style="display:none; max-width:400px; max-height:400px; margin:0px auto;"></canvas>
        <div id="answer" style="font-size:0.8rem; display:none;">
            <hr>
        </div>
        <div class="buttons">
            <input type="button" value="이전 문제" class="btn btn-secondary" onclick="preQuiz()">
            <input type="button" value="다음 문제" class="btn btn-secondary" onclick="nextQuiz()">
        </div>
        <?php
            break;
            }
        ?>
    </div>
</main>
<?php
require_once 'footerspace.php';
?>
</body>
<script>
    function check_MultiAnswer(){
        var ans ="";
        for (var i =1; i<=5 ; i++){
            if ($('input:checkbox[id="select'+i+'"]').is(":checked") == true){
                ans += i+',';
            }
        }
        if(ans.slice(0,ans.length-1) == answer) {
            alert("정답입니다!");
            nextQuiz();
        }
        else alert("오답입니다!");

    }
    function check_ShortAnswer(){
        if(document.querySelector('#short_answer').value == answer){
            alert("정답입니다!");
            nextQuiz();
        }
        else
            alert("오답입니다!");
    }
     function checkAnswer(ans){
         if(parseInt(ans) == parseInt(answer)){
             alert("정답입니다!");
             nextQuiz();
         }
         else
             alert("오답입니다!");

     }
     function nextQuiz(){
         if (currentNum >= maxNum){
            alert("마지막문제입니다.");
         }else{
             <?php
             unset($_COOKIE['article_num']);
             ?>
             createCookie("article_num",currentNum+1);
             window.location.reload();
         }
     }
     function preQuiz(){
         if (currentNum <= 1){
             alert("첫번째문제입니다.");
         }else{
             <?php
             unset($_COOKIE['article_num']);
             ?>
             createCookie("article_num",currentNum-1);
             window.location.reload(true);
         }
     }
</script>
</html>
