var lang = "";
var templ = "";

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
