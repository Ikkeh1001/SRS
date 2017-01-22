<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SRS</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-capable" content="yes" />

    <link rel="manifest" href="manifest.json">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/bootstrap.paper.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="icon" type="image/png" sizes="96x96" href="img/favicon-96x96.png">
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
        <script src="js/ui.js"></script>
        <script src="js/time.js"></script>
        <script src="js/srs.js"></script>
</head>
<body>
<div id="wrapper">
  <div class="jumbotron content">
    <table border="0" style="width: 100%; height: 100%;">
      <tr style="width:100%; height: 50%">
    <td style="width:33%;"><div class="alert alert-success" role="alert"><p class="statustext" id="status"><strong>0</strong> left</p></div>
</td>
<td style="width:33%;"><div class="alert alert-danger" role="alert"><p class="statustext">Language:</p></div>
</td>
  <td style="width:33%;"><div class="dropdown">

  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="background-color:orange; width: 100%; height: 50%;">None<span class="caret"></span></button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" id="droppeddownMenu1">
  </ul>
</div>

  </td>
</tr>
<tr style="width:100%; height: 50%">
  <td style="width:33%;"><div class="alert alert-info" role="alert" onclick="$('#wrapper').fadeOut('fast',function(){$('#list').fadeIn('fast')});getWords();"><p class="statustext click">List</p></div></td>
    <td style="width:33%;"><div class="alert alert-warning" role="alert"><p class="statustext click">Test</p></div></td>
    <td style="width:33%;"><div class="alert alert-success" role="alert"><p class="statustext click">Add</p></div></td>
</tr>
    </table>

</div>
</div>
<div id="list">
  <div class="jumbotron dalist">
    <table border="0" style="width: 100%; height: 100%;" id="listtable">
      <tr style="width:100%; height: 10%">
    <td style="width:33%;"><div class="alert alert-danger" role="alert"><p class="listtext" id="listtableheader"></p></div>
</td>
<td style="width:33%;"><div class="alert alert-success" role="alert"><p class="listtext click" id="listtableadd">Add Word</p></div>
</td>
<td style="width:33%;"><div class="alert alert-success" role="alert"><p class="listtext click" onclick="$('#list').fadeOut('fast',function(){$('#wrapper').fadeIn('fast')});">Back</p></div>
</td>
</tr>
<tr style="width:100%; height: 10%">
  <td style="width:33%;"><div class="alert alert-info" role="alert"><p class="listtext click" id="listtableback"><<</p></div></td>
    <td style="width:33%;"><div class="alert alert-warning" role="alert"><p class="listtext" id="listtablepage"></p></div></td>
    <td style="width:33%;"><div class="alert alert-info" role="alert"><p class="listtext click" id="listtablenext">>></p></div></td>
</tr>
<tr style="width:100%; height: 5%">
</tr>
<tr style="width:100%; height: 5%;">
  <td style="width:33%;"><div class="alert alert-info" role="alert"><p class="listheader">Word</p></div></td>
  <td style="width:33%;"><div class="alert alert-info" role="alert"><p class="listheader">Meaning</p></div></td>
  <td style="width:33%;"><div class="alert alert-info" role="alert"><p class="listheader">Status</p></div></td>
</tr>
    </table>

</div>
</div>
</body>
</html>
