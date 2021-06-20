$(document).ready(function () {
  'use strict'
  $('[data-toggle="offcanvas"]').on('click', function () {
    $('#navbarsExampleDefault').toggleClass('open')
  })


  $("[class*='media-body']").not($("[class='btn-like']")).css('cursor','pointer').on('click', function () {
    location.href = './content.php';
  })

})

$(function () {
  'use strict'

  $('[data-toggle="offcanvas"]').on('click', function () {
    $('#navbarsExampleDefault').toggleClass('open')
  })
})

$(".btn-like").on("click", function (e) {
  var button = $(e.currentTarget || e.target)
  var likeCount = button.find(".like-count")
  var heartShape = button.find(".heart-shape")
  $.post("./heart.php", {
    article_id: button.data('articleId')
  }, function(result) {
    if(result == "unlike")
      var addCount = -1
    else if(result == "like")
      var addCount = 1
    else
      var addCount = 0;
    likeCount.text(parseInt(likeCount.text()) + addCount)
    if(result == "like")
      var txt = "♥"
    else
      var txt = "♡"
    heartShape.text(txt)
  });
});
$(".btn-like").each(function(idx, el) {
  var button = $(el)
  var heartShape = button.find(".heart-shape")
  $.get("./heart.php", {
    getLikedByCode: button.data("articleId")
  }, function(result) {
    if(result == "liked")
      var txt= "♥"
    else
      var txt="♡"
    heartShape.text(txt);
    button.fadeIn(200)
  })
})
