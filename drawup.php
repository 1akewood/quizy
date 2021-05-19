<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="drawup.css">
    <title>퀴즈 만들기</title>

</head>

<body cellpadding="0" cellspacing="0" marginleft="0" margintop="0" width="100%" height="100%" align="center">

<div class="card align-middle" style="width:40rem; border-radius:20px;">
    <div class="card-title" style="margin-top:30px;">
        <h2 class="card-title text-center" style="color:#113366;">새로운 퀴즈</h2>
        <hr>
    </div>
    <div class="card-body">
        <input type="text" id="quiz-article-description" class="form-control" placeholder="퀴즈 제목" required autofocus><BR>
        <input type="text" id="quiz-article-content" class="form-control" placeholder="퀴즈 설명" required><BR>
    </div>
</div>

<div class="card align-middle" style="width:40rem; border-radius:20px;">
    <div class="card-title" style="margin-top:30px;">
        <h6 class="card-title text-right mr-3" style="color:#113366;">X</h6>
    </div>
    <div class="card-body">
        <input type="text" id="quiz-es-description" class="form-control" placeholder="퀴즈1 제목" required autofocus><BR>
        <input type="text" id="quiz-es-content" class="form-control d-inline" placeholder="퀴즈 정답" required>
        <div class="btn-group">
            <button id="quiz-es-type" type="button" class="btn btn-primary dropdown-toggle d-inline ml-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                약술형
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">서술형</a>
                <a class="dropdown-item" href="#">객관식</a>
                <a class="dropdown-item" href="#">체크박스</a>
            </div>
        </div>
    </div>
</div>

<div class="modal">
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
    $appendNum = 1;
    $( document ).ready(function() {
        $('.btn-group').each(function (key, dropdown) {
            var $dropdown = $(dropdown);
            $dropdown.find('.dropdown-menu a').on('click', function () {
                let temp = $dropdown.find('#quiz-es-type').text().trim();
                $(this).parent().parent().prev().remove();
                if($(this).text().trim() === "체크박스") {
                    $(this).parent().parent().prev().after('<div class="checkbox">' +
                        '<input type="radio"  name="checkbox" value=""/>' +
                        '<input type="text">'+
                        '</div>');
                    $appendpoint = $(this);
                    $removepoint = document.querySelector('.checkbox').parentElement;
                    $(this).parent().parent().prev().after('<div><input type="button" value="보기 추가" class="checkbox-button" onclick="appendchoice($appendpoint)"> <input type="button" value="보기 삭제" class="checkbox-button" onclick="removechoice($removepoint)"/></div>');
                }else if($(this).text().trim() === "약술형"){
                    $(this).parent().parent().prev().after('<input type="text" id="quiz-es-awnser" class="form-control d-inline" placeholder="약술형 정답" required>');
                }else if($(this).text().trim() === "객관식"){
                    $(this).parent().parent().prev().after('<p>Select Number</p>');

                }else{
                    $(this).parent().parent().prev().after('<input type="text" id="quiz-es-awnser" class="form-control d-inline" placeholder="서술형 정답" required>');
                }
                $dropdown.find('#quiz-es-type').text($(this).text());
                $(this).text(temp);
            });
        });
    });

    function appendchoice($appendpoint){
        if($appendNum < 5) {
            $($appendpoint).parent().parent().prev().before('<div class="checkbox">' +
                '<input type="radio" name="checkbox" value=""/>' +
                '<input type="text">' +
                '</div>');
            $appendNum++;
        }
    }
    function removechoice($removepoint){
        if($appendNum > 1 ){
            $checkboxNode = document.querySelectorAll('.checkbox');
            $checkboxNode[$checkboxNode.length-1].remove();
            $appendNum--;
        }
    }
</script>
</body>
</html>
