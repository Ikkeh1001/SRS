var lang = "";
var templ = "";
var addwordsfault = false;
var addlanguagefault = false;
var testword = 1;

$(document).ready(function () {
$("#list").hide();
$("#starttest").hide();
$("#maintest").hide();
$("#stoptest").hide();

languages();

$("#listtableadd").click(function(){
$("#addword").modal('toggle');
});

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

$('#addword').on('shown.bs.modal', function () {
    $('#inputword').focus();
});

$('#addword').on('show.bs.modal', function () {
    $('#inputword').val("");
    $('#inputmeaning').val("");
    addwordsfault = false;
});

$('#addlanguage').on('shown.bs.modal', function () {
    $('#inputlanguage').focus();
});

$('#addlanguage').on('show.bs.modal', function () {
    $('#inputlanguage').val("");
    addlanguagefault = false;
});

$("#inputlanguage").keypress(function(event){
    if(event.which == 13){
      newLanguage();
    }
  });

$("#inputmeaning").keypress(function(event){
    if(event.which == 13){
      newWord();
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
        var differenthtml = "Testing <strong>"+lang+"</strong> words";
        $("#testlanguage").html(differenthtml);
        return;
      }
      var differenthtml = "<li onclick='changeLanguage($(this).html());'><a href='#' style='color:#BBBBBB'>"+element["language"]+"</a></li>";
      $("#droppeddownMenu1").append(differenthtml);
    });
  });
  setTimeout(function(){
    getLeft();
  }, 100);
}

function changeLanguage(tmp){
  lang = tmp.substring(tmp.indexOf(">")+1,tmp.indexOf("</a>"));
  var differenthtml = lang+"<span class='caret'></span>";
  $("#dropdownMenu1").html(differenthtml);
  var differenthtml = "List of <strong>"+lang+"</strong> words";
  $("#listtableheader").html(differenthtml);
  var differenthtml = "Testing <strong>"+lang+"</strong> words";
  $("#testlanguage").html(differenthtml);
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
//$('.modal-backdrop').hide();
      $("#addword").modal('toggle');
    }
}

function newLanguage(){
if (!$("#inputlanguage").val()){
  if(!addlanguagefault){
    var differenthtml = "<p style='color:red;margin:10px 0 0 0;'><strong>You must fill in all fields!</strong></p>";
    $("#addlanguagebody").append(differenthtml);
  }
  addwordsfault = true;
  }
  else{
    var language = $("#inputlanguage").val();
    language = language.toLowerCase().replace(/\b[a-z]/g, function(letter) {
    return letter.toUpperCase();
    });
    $.post("api.php",{
      "action":"SET_LANG",
      "lang":language
    });
    location.reload();
  }
}

function maintest(){
  var questioncorrect = false;

  if ($('#starttest').css('display') != "none"){
  $('#starttest').fadeOut('fast',function(){$('#maintest').fadeIn('fast')});
}
  $("#testfirstoption").html("");
  $("#testsecondoption").html("");
  var differenthtml = "<strong>Continue</strong>";
  $("#testcontinue").html(differenthtml);
  $("#inputtestmeaning").val("");

  var temp = savedwords[testword-1]["word"];
  temp = temp.toLowerCase().replace(/\b[a-z]/g, function(letter) {
  return letter.toUpperCase();
  });
  var differenthtml = temp;
  $("#totranslate").html(differenthtml);
    var differenthtml = "Word <strong>"+testword+"</strong> of "+savedwords.length;
    $("#testwordnumber").html(differenthtml);
    $("#testcontinue").click(function(event){
      $(this).unbind(event);
      $("#inputtestmeaning").unbind("keypress");
      clicked();
    });
    $("#inputtestmeaning").keypress(function(event){
        if(event.which == 13){
          $(this).unbind(event);
          $("#testcontinue").unbind("click");
          clicked();
        }
      });


  function clicked(){
    questioncorrect = false;
    var temp = savedwords[testword-1]["meaning"];
    var temparr = temp.split(", ");
    temparr.forEach(function(element){
      if (element == $("#inputtestmeaning").val() || element == $("#inputtestmeaning").val().toLowerCase()){
        questioncorrect = true;
      }
    });
    if (questioncorrect){
      var differenthtml = "<div class='alert alert-success' role='alert'><p class='testmain'><strong>Correct</strong></p></div>"
      $("#testfirstoption").html(differenthtml);
      var differenthtml = "<strong>Next</strong>";
      $("#testcontinue").html(differenthtml);
    }
    else{
      var differenthtml = "<div class='alert alert-danger' role='alert'><p class='testmain'><strong>Wrong</strong></p></div>"
      $("#testfirstoption").html(differenthtml);
      var differenthtml = "<div class='alert alert-warning' role='alert'><p class='testmain click'><strong>Still correct</strong></p></div>"
      $("#testsecondoption").html(differenthtml);
      var differenthtml = "<strong>Next</strong>";
      $("#testcontinue").html(differenthtml);
      var differenthtml = $("#inputtestmeaning").val()+" -> " + savedwords[testword-1]["meaning"];
      $("#inputtestmeaning").val(differenthtml);
    }


    $("#testcontinue").click(function(event){
      $(this).unbind(event);
      $("#inputtestmeaning").unbind("keypress");
      $("#testsecondoption").unbind("click");
      tinysubroutine();
    });

    $("#inputtestmeaning").keypress(function(event){
        if(event.which == 13){
          $(this).unbind(event);
          $("#testcontinue").unbind("click");
          $("#testsecondoption").unbind("click");
          tinysubroutine();
        }
      });

      $("#testsecondoption").click(function(event){
        $(this).unbind(event);
        $("#testcontinue").unbind("click");
        $("#inputtestmeaning").unbind("keypress");
        questioncorrect = true;
        tinysubroutine();
      });

      function tinysubroutine(){
        var temp = savedwords[testword-1]["word"];
        var temp2 = savedwords[testword-1]["status"];
        var obj = {word:temp,correct:questioncorrect,status:temp2};
        testresults.push(obj);
        if(testword == savedwords.length){
          $('#maintest').fadeOut('fast',function(){$('#stoptest').fadeIn('fast')});
          return;
        }
        testword++;
        maintest();
      }
  }
}
