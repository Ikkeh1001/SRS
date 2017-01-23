var lang = "";
var templ = "";
var addwordsfault = false;

$(document).ready(function () {
$("#list").hide();

languages();

$("#listtableback").click(function(){
if (currentpage != 1){
currentpage--;
getWords();
}
});

$("#listtablenext").click(function(){
if($(".listcontent").length == 14){
currentpage++;
getWords();
}
});

});

function languages(){
  $.post("api.php", {
    "action": "GET_LANG"
  },function(data){
    var response=JSON.parse(data);
    $("#droppeddownMenu1").html("");
    response.forEach(function(element){
      if (lang == element["language"]){
        return;
      }
      if (!isNaN(lang)){
        lang = element["language"];
        var differenthtml = lang+"<span class='caret'></span>";
        $("#dropdownMenu1").html(differenthtml);
        var differenthtml = "List of <strong>"+lang+"</strong> words";
        $("#listtableheader").html(differenthtml);
        return;
      }
      var differenthtml = "<li onclick='changeLanguage($(this).html());'><a href='#' style='color:#BBBBBB'>"+element["language"]+"</a></li>";
      $("#droppeddownMenu1").prepend(differenthtml);
    });
  });
  getLeft();
}

function changeLanguage(tmp){
  lang = tmp.substring(tmp.indexOf(">")+1,tmp.indexOf("</a>"));
  var differenthtml = lang+"<span class='caret'></span>";
  $("#dropdownMenu1").html(differenthtml);
  var differenthtml = "List of <strong>"+lang+"</strong> words";
  $("#listtableheader").html(differenthtml);
  languages();
}

function newWord(){
  if(!$("#inputword").val() || !$("#inputmeaning").val()){
    if (!addwordsfault){
      var differenthtml = "<p style='color:red;margin:10px 0 0 0;'><strong>You must fill in all fields!</strong></p>";
      $("#addwordsbody").append(differenthtml);
    }
    addwordsfault = true;
    }
    else{
      var word = $("#inputword").val();
      var meaning = $("#inputmeaning").val();
      var difficulty = $("#inputdiff option:selected").text();
      var now = $.now();
      $.post("api.php",{
        "action":"SET_WORD",
        "lang":lang,
        "word":word,
        "meaning":meaning,
        "difficulty":difficulty,
        "timestamp": now
      });
$('.modal-backdrop').hide();
      $("#addword").hide();
    }

}
