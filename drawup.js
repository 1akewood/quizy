var $appendNum = 1;
$( document ).ready(function() {
    $('.btn-group').each(function (key, dropdown) {
        var dropdown = $(dropdown);
        dropdown.find(".dropdown-menu a").on("click", function () {
            let temp = dropdown.find('#quiz-es-type').text().trim();
            $answer = $(document).find($('.answer')[$('.answer').length-1]);
            $answer.empty();
            if($(this).text().trim() === "체크박스") {
                $answer.append('<div class="checkbox-answer" style="margin-bottom: 10px">' +
                    '<input id="quiz-check-answer" type="checkbox"  name="checkbox" value="select"+$appendNum/>' +
                    '<input id="quiz-check-select" type="text" class="form-control" style="width: 300px; display: inline-block; margin-left: 10px;">'+
                    '</div>');
                $answer.append('<div id="buttons" style="margin-bottom: 10px"><input type="button" value="보기 추가" class="btn btn-secondary" onclick="appendchoice(null)"> <input type="button" value="보기 삭제" class="btn btn-secondary" onclick="removechoice(null)"/></div>');
            }else if($(this).text().trim() === "주관식"){
                $answer.append('<h6 class="quiz-body-clickable-text" style="color: #737373">주관식 정답</h6> <input type="text" id="quiz-body-content" class="form-control" style="display:none;" placeholder="주관식 정답" required autofocus>')
                addBorderEvent()
                addClickableEvent()
            }else if($(this).text().trim() === "객관식") {
                $answer.append('<div class="radio-answer" style="margin-bottom: 10px">' +
                    '<input id="quiz-radio-answer" type="radio"  name="radio" value="select"+$appendNum/>' +
                    '<input id="quiz-radio-select" type="text" class="form-control" style="width: 300px; display: inline-block; margin-left: 10px;">' +
                    '</div>');
                console.log($appendNum)
                $appendpoint = $(this);
                $removepoint = document.querySelector('.radio-answer').parentElement;
                $answer.append('<div id="buttons" style="margin-bottom: 10px"><input type="button" value="보기 추가" class="btn btn-secondary" onclick="appendchoice(null)"> <input type="button" value="보기 삭제" class="btn btn-secondary" onclick="removechoice(null)"/></div>');
            /*
            }else{
                $target.find('.answer').append('<input type="text" id="quiz-es-answer" class="form-control d-inline" placeholder="서술형 정답" required>');
            */
            }
            dropdown.find('#quiz-es-type').text($(this).text());
            $(this).text(temp);
        });
    });

    // 초기화 부분
    $('#quiz-reset').on('click',function () {
        window.location.reload();
    })

    $quiz = $('#quiz').clone();

    addBorderEvent()
    addClickableEvent()

    $('#quiz-submit').on('click', function() {
        var answer_type
        if ($("[id='quiz-es-type']").text().trim() === "객관식") {
            answer_type = 1
        } else if ($("[id='quiz-es-type']").text().trim() === "체크박스") {
            answer_type = 2
        } else if ($("[id='quiz-es-type']").text().trim() === "주관식") {
            answer_type = 3
        } else {
            answer_type = 0
        }

        var select = new Array()
        var answers = new Array()
        var answer
        if (answer_type == 1) {
            for(var i = 0; i < document.querySelectorAll("#quiz-radio-select").length; i++) {
                select[i] = document.querySelectorAll("#quiz-radio-select")[i].value
                var radio = document.querySelectorAll("#quiz-radio-answer")[i].checked
                if(radio) {
                    answers.push(i)
                }
            }
            answer = answers.join(",")
        } else if (answer_type == 2) {
            for(var i = 0; i < document.querySelectorAll("#quiz-check-select").length; i++) {
                select[i] = document.querySelectorAll("#quiz-check-select")[i].value
                var check = document.querySelectorAll("#quiz-check-answer")[i].checked
                if(check) {
                    answers.push(i)
                }
            }
            answer = answers.join(",")
        } else if (answer_type == 3) {
            answer = $("[id='quiz-body-content']").val()
        }


        var data = new FormData();
        data.append('header-description', $('#quiz-header-description').val())
        data.append('header-content', $('#quiz-header-content').val())
        data.append('article-num', $("[id='quiz']").length)
        data.append('body-description', $("[id='quiz-body-description']").val())
        data.append('body-content', $("[id='quiz-body-content']").val())
        data.append('answer-type', answer_type)
        data.append('select1', select[0])
        data.append('select2', select[1])
        data.append('select3', select[2])
        data.append('select4', select[3])
        data.append('select5', select[4])
        data.append('answer', answer)
        data.append('article-id', '76')

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'drawup.php', true);
        xhr.onload = function () {
            // do something to response
            console.log(this.responseText);
        };
        xhr.send(data);
    })
});

function post_to_url(path, params, method) {
    method = method || "post"; // Set method to post by default, if not specified.
    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);
    for(var key in params) {
        var hiddenField = document.createElement("input");
        hiddenField.setAttribute("type", "hidden");
        hiddenField.setAttribute("name", key);
        hiddenField.setAttribute("value", params[key]);
        form.appendChild(hiddenField);
    }
    document.body.appendChild(form);
    form.submit();
}
function appendchoice($target){
    if($target !=null){
        if ($target.find('#quiz-es-type').text().trim() === "객관식"){
            if($target.appendNum <5){
                $target.find('#buttons').before('<div class="radio-answer" style="margin-bottom: 10px">' +
                    '<input id="quiz-radio-answer" type="radio" name="radio" value=$target.appendNum/>' +
                    '<input id="quiz-radio-select" type="text" class="form-control" style="width: 300px; display: inline-block; margin-left: 10px;">' +
                    '</div>');
                $target.appendNum++;
            }
        }else if ($target.find('#quiz-es-type').text().trim() === "체크박스"){
            if($target.appendNum <5){
                $target.find('#buttons').before('<div class="checkbox-answer" style="margin-bottom: 10px">' +
                    '<input id="quiz-check-answer" type="checkbox"  name="checkbox" value=$target.appendNum/>' +
                    '<input id="quiz-check-select" type="text" class="form-control" style="width: 300px; display: inline-block; margin-left: 10px;">' +
                    '</div>');
                $target.appendNum++;
            }
        }
    }else {
        if($('#buttons').parent().parent().find('#quiz-es-type').text().trim()==="객관식"){
            if ($appendNum < 5) {
                $('#buttons').before('<div class="radio-answer" style="margin-bottom: 10px">' +
                    '<input id="quiz-radio-answer" type="radio" name="radio" value="select"+$appendNum/>' +
                    '<input id="quiz-radio-select" type="text" class="form-control" style="width: 300px; display: inline-block; margin-left: 10px;">' +
                    '</div>');
                $appendNum++;
            }
        }else if ($('#buttons').parent().parent().find('#quiz-es-type').text().trim()==="체크박스")
            if ($appendNum < 5) {
                $('#buttons').before('<div class="checkbox-answer" style="margin-bottom: 10px">' +
                    '<input id="quiz-check-answer" type="checkbox"  name="checkbox" value="select"+$appendNum/>' +
                    '<input id="quiz-check-select" type="text" class="form-control" style="width: 300px; display: inline-block; margin-left: 10px;">' +
                    '</div>');
                $appendNum++;
            }
    }
}
function removechoice($target){
    if($target != null){
        if ($target.find('#quiz-es-type').text().trim() === "객관식"){
            if($target.appendNum > 1){
                $radioNode = $target.find('.radio-answer');
                $radioNode.last().remove();
                $target.appendNum--;
            }
        }else if ($target.find('#quiz-es-type').text().trim() === "체크박스"){
            if($target.appendNum > 1){
                $checkboxNode = $target.find('.checkbox-answer');
                $checkboxNode.last().remove();
                $target.appendNum--;
            }
        }

    }else{
        if($('#buttons').parent().parent().find('#quiz-es-type').text().trim()==="객관식"){
            if($appendNum > 1 ){
                $answerNode = document.querySelector('.answer');
                $radioNode = $answerNode.querySelectorAll('.radio-answer');
                $radioNode[$radioNode.length-1].remove();
                $appendNum--;
            }
        }else if ($('#buttons').parent().parent().find('#quiz-es-type').text().trim()==="체크박스")
            if ($appendNum > 1) {
                $answerNode = document.querySelector('.answer');
                $checkboxNode = $answerNode.querySelectorAll('.checkbox-answer');
                $checkboxNode[$checkboxNode.length-1].remove();
                $appendNum--;
            }
    }
}
function appendquiz($quiz){
    $target = $quiz.clone();
    $('#quiz').after($target);
    dropdownfunc($target);
    addBorderEvent()
    addClickableEvent()
}
function removequiz($target){
    if(document.querySelectorAll('#quiz').length != 1)
        $target.parent().parent().remove();
}

function dropdownfunc($target){
    $target.appendNum = 1;
    $target.find('.btn-group').find('.dropdown-menu a').on('click', function () {
        let temp = $target.find('#quiz-es-type').text().trim();
        $target.find('.answer').empty();
        if ($(this).text().trim() === "체크박스") {
            make_CheckBox($target)
        } else if ($(this).text().trim() === "주관식") {
            make_ShortAnswer($target)
        } else if ($(this).text().trim() === "객관식") {
            make_SelectNum($target)
        }
        $target.find('#quiz-es-type').text($(this).text());
        $(this).text(temp);
    });
}
function make_CheckBox($target){
    $target.find('.answer').append('<div class="checkbox-answer" style="margin-bottom: 10px">' +
        '<input id="quiz-check-answer" type="checkbox"  name="checkbox" value=$target.appendNum/>' +
        '<input id="quiz-check-select" type="text" class="form-control" style="width: 300px; display: inline-block; margin-left: 10px;">'+
        '</div>');
    $target.find('.answer').append('<div id="buttons" style="margin-bottom: 10px"><input type="button" value="보기 추가" class="btn btn-secondary" onclick="appendchoice($target)"> <input type="button" value="보기 삭제" class="btn btn-secondary" onclick="removechoice($target)"/></div>')

}
function make_ShortAnswer($target){
    $target.find('.answer').append('<h6 class="quiz-body-clickable-text" style="color: #737373">주관식 정답</h6> <input type="text" id="quiz-body-content" class="form-control" style="display:none;" placeholder="주관식 정답" required autofocus>')
    addBorderEvent()
    addClickableEvent()
}
function make_SelectNum($target){
    $target.find('.answer').prepend('<div class="radio-answer" style="margin-bottom: 10px">' +
        '<input id="quiz-radio-answer" type="radio"  name="radio" value=$target.appendNum/>' +
        '<input id="quiz-radio-select" type="text" class="form-control" style="width: 300px; display: inline-block; margin-left: 10px;">'+
        '</div>');
    $target.find('.answer').append('<div id="buttons" style="margin-bottom: 10px"><input type="button" value="보기 추가" class="btn btn-secondary" onclick="appendchoice($target)"> <input type="button" value="보기 삭제" class="btn btn-secondary" onclick="removechoice($target)"/></div>')

}
// 카드 클릭 시 왼쪽에 하늘색 보더 주기
function addBorderEvent() {
    $(document).ready(function() {
        $("#quiz-header").mousedown(function () {
            $(this).css("border-left", "10px solid #368dc5")
        })

        $(document).click(function (e) {
            if ((!$(e.target).is("#quiz-header"))
                && (!$(e.target).is("#quiz-header-card"))
                && (!$(e.target).is("#quiz-header-description"))
                && (!$(e.target).is("#quiz-header-content"))) {
                $("#quiz-header").css("border-left", "none")
            }
        })

        var quiz_compare_closest
        $("[id=quiz]").mousedown(function () {
            $(this).css("border-left", "10px solid #368dc5")
            quiz_compare_closest = $(this)
        })

        $(document).click(function (e) {
            if ((!$(e.target).is("#quiz"))
                && (!$(e.target).is("#quiz-body-card"))
                && (!$(e.target).is("#quiz-body-description"))
                && (!$(e.target).is("#quiz-body-content"))
                && (!$(e.target).is("#quiz-body-answer"))
                && (!$(e.target).hasClass("answer"))
                && (!$(e.target).is("#quiz-check-answer"))
                && (!$(e.target).is("#quiz-check-select"))
                && (!$(e.target).is("#quiz-radio-answer"))
                && (!$(e.target).is("#quiz-radio-select"))
                && (!$(e.target).children().is("#quiz"))) {
                console.log($(e.target))
                $(quiz_compare_closest).closest("#quiz").css("border-left", "none")
            }
        })
    })
}

// 카드의 텍스트 클릭 시 인풋으로 바꿔주기
function addClickableEvent() {
    // 어떤 퀴즈인지 알려주는 부분
    var quiz_header_clickable_text = new Array(); // must be array
    $("[class*='quiz-header-clickable-text']").mousedown(function() {
        quiz_header_clickable_text.push($(this))
        $(this).hide()
        $(this).next().show()
        $(this).next().focus()
    })

    $(document).click(function(e) {
        if((!$(e.target).is("#quiz-header-card"))
            && (!$(e.target).is("#quiz-header-description"))
            && (!$(e.target).is("#quiz-header-content"))) {
            // need foreach
            quiz_header_clickable_text.forEach(function (item, index, array) {
                if($(item).next().val() === "") {
                    $(item).text($(item).next().attr('placeholder'))
                } else {
                    $(item).text($(item).next().val())
                }
                $(item).next().hide()
                $(item).show()
            })
            while(quiz_header_clickable_text.length > 0) {
                quiz_header_clickable_text.pop();
            }
        }
    })

    // 퀴즈 내용 부분
    var quiz_body_clickable_text = new Array(); // must be array
    $("[class*='quiz-body-clickable-text']").mousedown(function() {
        quiz_body_clickable_text.push($(this))
        $(this).hide()
        $(this).next().show()
        $(this).next().focus()
    })

    $(document).click(function(e) {
        if((!$(e.target).is("#quiz-body-card"))
            && (!$(e.target).is("#quiz-body-description"))
            && (!$(e.target).is("#quiz-body-content"))
            && (!$(e.target).children().next().is("#quiz-body-answer"))
            && (!$(e.target).hasClass("form-control"))) {
            // need foreach
            quiz_body_clickable_text.forEach(function (item, index, array) {
                if($(item).next().val() === "") {
                    $(item).text($(item).next().attr('placeholder'))
                } else {
                    $(item).text($(item).next().val())
                }
                $(item).next().hide()
                $(item).show()
            })
            while(quiz_body_clickable_text.length > 0) {
                quiz_body_clickable_text.pop();
            }
        }
    })
}

