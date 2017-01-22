var lang = "";
var templ = "";

$(document).ready(function () {
$("#flop").hide();

templ = $("#dropdownMenu1").html();
lang = templ.substring(0,(templ.indexOf("<")));
lang = lang.toLowerCase();
});
