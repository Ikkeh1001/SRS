var numberleft = 0;
var wordnumber = 0;
var currentpage = 1;
var savedwords = [];
var testresults = [];
var updatedwords = {};
var status = "";
var updatedandsentwords = 0;

$(document).ready(function(){

});

function getLeft(){
$.post("api.php", {
  "action": "GET_LEFT",
  "lang": lang
},function(data){
  var response=JSON.parse(data);
  numberleft = 0;
  savedwords = [];
  response.forEach(function(element){
    var thisstatus = element["status"];
    if (thisstatus.substring(3,4) == "1" && parseInt(element["timestamp"])+xxx1 < $.now()){
      this.numberleft++;
      savedwords.push(element);
      return;
    }
    var vartime = thisstatus.substring(0,2);
    vartime = "t"+vartime+"xx";
    if (parseInt(element["timestamp"])+ window[vartime] < $.now()){
      this.numberleft++;
      savedwords.push(element);
      return;
    }
  });
}
);
setTimeout(function(){
  changeHowManyAreLeft();
}, 200);
}

function changeHowManyAreLeft(){
  var differenthtml = "<strong>"+numberleft.toString()+"</strong> left";
  $("#status").fadeOut("fast",function(){
    $(this).html(differenthtml).fadeIn("fast");
  });
}

function getWords(){
$.post("api.php", {
  "action": "GET_LEFT",
  "lang": lang
},function(data){
  var response=JSON.parse(data);
  $(".removeable").remove();
  wordnumber = 0;
  var differenthtml = "Page " + currentpage;
  $("#listtablepage").html(differenthtml);
  response.forEach(function(element){
    var thisstatus = element["status"];
      if(wordnumber>=14*currentpage || wordnumber<(currentpage-1)*14){
        this.wordnumber++;
        return;
      }
      this.wordnumber++;
      var differenthtml = "<tr class='removeable listcontent' style='width:100%; height: 5%;'><td style='width:33%;'>"+element["word"]+"</td><td style='width:33%;'>"+element["meaning"]+"</td><td style='width:33%;'>Level "+element["status"].substring(0,1)+"</td></tr>";
      $("#listtable").append(differenthtml);
      return;

  });
  var differenthtml = "<tr class='removeable' style='width:100%; height: "+(70-5*(wordnumber-((currentpage-1)*14)))+"'></tr>";
  $("#listtable").append(differenthtml);
}
);
}

function updatewords(){
  var now = $.now();
  testresults.forEach(function(element){
    if (!element["correct"]){
      status = element["status"].substring(0,3)+"1";
      updatedwords = {word:element["word"],newstatus:status,timestamp:now};
    }
    else{
    switch(element["status"].substring(0,1)){
      case "0":

      switch(element["status"].substring(1,2)){
        case "0":

        switch(element["status"].substring(3,4)){
          case "0":
          status = "01"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
          case "1":
          status = "00"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
        }
        break;

        case "1":
        switch(element["status"].substring(3,4)){
          case "0":
          status = "02"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
          case "1":
          status = "00"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
        }
        break;

        case "2":
        switch(element["status"].substring(3,4)){
          case "0":
          if (element["status"].substring(2,3) != "1"){
            status = "03"+element["status"].substring(2,3)+"0";
          }
          else{
            status = "10"+element["status"].substring(2,3)+"0";
          }
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
          case "1":
          status = "01"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
        }
        break;

        case "3":
        switch(element["status"].substring(3,4)){
          case "0":
          if (element["status"].substring(2,3) == "3"){
            status = "04"+element["status"].substring(2,3)+"0";
          }
          else{
            status = "10"+element["status"].substring(2,3)+"0";
          }
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
          case "1":
          status = "02"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
        }
        break;

        case "4":
        switch(element["status"].substring(3,4)){
          case "0":
          status = "10"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
          case "1":
          status = "03"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
        }
        break;

      }
      break;

      case "1":
      switch(element["status"].substring(1,2)){
        case "0":

        switch(element["status"].substring(3,4)){
          case "0":
          status = "11"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
          case "1":
          status = "00"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
        }
        break;

        case "1":
        switch(element["status"].substring(3,4)){
          case "0":
          status = "12"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
          case "1":
          status = "10"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
        }
        break;

        case "2":
        switch(element["status"].substring(3,4)){
          case "0":
          if (element["status"].substring(2,3) != "1"){
            status = "13"+element["status"].substring(2,3)+"0";
          }
          else{
            status = "20"+element["status"].substring(2,3)+"0";
          }
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
          case "1":
          status = "11"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
        }
        break;

        case "3":
        switch(element["status"].substring(3,4)){
          case "0":
          status = "20"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
          case "1":
          status = "12"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
        }
        break;

    }
      break;

      case "2":
      switch(element["status"].substring(1,2)){
        case "0":
        switch(element["status"].substring(3,4)){
          case "0":
          status = "21"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
          case "1":
          status = "11"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
        }
        break;

        case "1":
        switch(element["status"].substring(3,4)){
          case "0":
          status = "22"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
          case "1":
          status = "20"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
        }
        break;

        case "2":
        switch(element["status"].substring(3,4)){
          case "0":
          status = "23"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
          case "1":
          status = "21"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
        }
        break;

        case "3":
        switch(element["status"].substring(3,4)){
          case "0":
          if (element["status"].substring(2,3) != "1"){
            status = "24"+element["status"].substring(2,3)+"0";
          }
          else{
            status = "30"+element["status"].substring(2,3)+"0";
          }
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
          case "1":
          status = "22"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
        }
        break;

        case "4":
        switch(element["status"].substring(3,4)){
          case "0":
          if (element["status"].substring(2,3) == "3"){
            status = "25"+element["status"].substring(2,3)+"0";
          }
          else{
            status = "30"+element["status"].substring(2,3)+"0";
          }
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
          case "1":
          status = "23"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
        }
        break;

        case "5":
        switch(element["status"].substring(3,4)){
          case "0":
          status = "30"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
          case "1":
          status = "24"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
        }
        break;

      }
      break;

      case "3":
      switch(element["status"].substring(1,2)){
        case "0":
        switch(element["status"].substring(3,4)){
          case "0":
          status = "31"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
          case "1":
          status = "22"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
        }
        break;

        case "1":
        switch(element["status"].substring(3,4)){
          case "0":
          status = "32"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
          case "1":
          status = "30"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
        }
        break;

        case "2":
        switch(element["status"].substring(3,4)){
          case "0":
          status = "33"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
          case "1":
          status = "31"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
        }
        break;

        case "3":
        switch(element["status"].substring(3,4)){
          case "0":
          if (element["status"].substring(2,3) != "1"){
            status = "34"+element["status"].substring(2,3)+"0";
          }
          else{
            status = "40"+element["status"].substring(2,3)+"0";
          }
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
          case "1":
          status = "32"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
        }
        break;

        case "4":
        switch(element["status"].substring(3,4)){
          case "0":
          status = "40"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
          case "1":
          status = "33"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
        }
        break;

      }
      break;

      case "4":
      switch(element["status"].substring(1,2)){

        case "0":
        switch(element["status"].substring(3,4)){
          case "0":
          status = "41"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
          case "1":
          status = "32"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
        }
        break;

        case "1":
        switch(element["status"].substring(3,4)){
          case "0":
          status = "42"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
          case "1":
          status = "40"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
        }
        break;

        case "2":
        switch(element["status"].substring(3,4)){
          case "0":
          status = "50"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
          case "1":
          status = "41"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
        }
        break;

      }
      break;

      case "5":
      switch(element["status"].substring(1,2)){

        case "0":
        switch(element["status"].substring(3,4)){
          case "0":
          status = "51"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
          case "1":
          status = "41"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
        }
        break;

        case "1":
        switch(element["status"].substring(3,4)){
          case "0":
          status = "52"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
          case "1":
          status = "50"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
        }
        break;

        case "2":
        switch(element["status"].substring(3,4)){
          case "0":
          status = "60"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
          case "1":
          status = "51"+element["status"].substring(2,3)+"0";
          updatedwords = {word:element["word"],newstatus:status,timestamp:now};
          break;
        }
        break;

      }
      break;

      case "6":
      status = "60"+element["status"].substring(2,3)+"0";
      updatedwords = {word:element["word"],newstatus:status,timestamp:now};
      break;

      default:
      console.log("sumtingwong");
    }}
    var wordupdate = updatedwords["word"];
    var newstatus = updatedwords["newstatus"];
    var timestamp = updatedwords["timestamp"];
    setTimeout(function(){
      $.post("api.php",{
        "action":"UPDATE_STATUS",
        "lang":lang,
        "word":wordupdate,
        "newstatus":newstatus,
        "timestamp":timestamp
      });
    }, 20*updatedandsentwords);
    updatedandsentwords++
  });

  setTimeout(function(){
    location.reload();
  }, 50+(20*updatedandsentwords));

}
