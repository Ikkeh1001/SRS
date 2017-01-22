$(document).ready(function(){
getLeft();
});

function getLeft(){
$.post("api.php", {
  "action": "GET_LEFT",
  "lang": lang
},function(data){
  console.log(JSON.parse(data));
}
);
}
