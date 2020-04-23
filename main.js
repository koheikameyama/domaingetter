//test.js
var value = "こんにちは";
$.ajax({
  type: "POST",
  url: "ajax.php",
  data: {"item": "value"},
      success: function(html) {
     alert(html);
  }
});