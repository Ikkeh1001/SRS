var numberleft = 0;
var wordnumber = 0;
var currentpage = 1;

$(document).ready(function(){

});

function getLeft(){
$.post("api.php", {
  "action": "GET_LEFT",
  "lang": lang
},function(data){
  var response=JSON.parse(data);
  numberleft = 0;
  response.forEach(function(element){
    var thisstatus = element["status"];
    if (thisstatus.substring(3,4) == "1" && parseInt(element["timestamp"])+xxx1 < $.now()){
      this.numberleft++;
      return;
    }
    var vartime = thisstatus.substring(0,2);
    vartime = "t"+vartime+"xx";
    if (parseInt(element["timestamp"])+ window[vartime] < $.now()){
      this.numberleft++;
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
  console.log(numberleft);
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
    if (thisstatus.substring(3,4) == "1" && parseInt(element["timestamp"])+xxx1 < $.now()){
      if(wordnumber>=14*currentpage || wordnumber<(currentpage-1)*14){
        this.wordnumber++;
        return;
      }
      this.wordnumber++;
      var differenthtml = "<tr class='removeable listcontent' style='width:100%; height: 5%;'><td style='width:33%;'>"+element["word"]+"</td><td style='width:33%;'>"+element["meaning"]+"</td><td style='width:33%;'>Level "+element["status"].substring(0,1)+"</td></tr>";
      $("#listtable").append(differenthtml);
      return;
    }
    var vartime = thisstatus.substring(0,2);
    vartime = "t"+vartime+"xx";
    if (parseInt(element["timestamp"])+ window[vartime] < $.now()){
      if(wordnumber>=14*currentpage || wordnumber<(currentpage-1)*14){
        this.wordnumber++;
        return;
      }
      this.wordnumber++;
      var differenthtml = "<tr class='removeable listcontent' style='width:100%; height: 5%;'><td style='width:33%;'>"+element["word"]+"</td><td style='width:33%;'>"+element["meaning"]+"</td><td style='width:33%;'>Level "+element["status"].substring(0,1)+"</td></tr>";
      $("#listtable").append(differenthtml);
      return;
    }
  });
  var differenthtml = "<tr class='removeable' style='width:100%; height: "+(70-5*(wordnumber-((currentpage-1)*14)))+"'></tr>";
  $("#listtable").append(differenthtml);
}
);
}
