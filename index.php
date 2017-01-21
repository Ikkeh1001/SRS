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
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
        <script src="js/ui.js"></script>
</head>
<body>
<div id="wrapper">
  <div class="jumbotron content">
    <table border="0" style="width: 100%; height: 100%;">
      <tr style="width:100%; height: 50%">
    <td style="width:33%;"><div class="alert alert-success" role="alert" id="status"><p class="statustext" onclick="$('#wrapper').hide('fast',function(){$('#flop').show('fast');});"><strong>0</strong> left</p></div>
</td>
<td style="width:33%;"><div class="alert alert-danger" role="alert" id="status"><p class="statustext">Language:</p></div>
</td>
  <td style="width:33%;"><div class="dropdown">

  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="background-color:orange; width: 100%; height: 50%;">
    English
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
    <li><a href="#">Action</a></li>
    <li><a href="#">Another action</a></li>
    <li><a href="#">Something else here</a></li>
    <li role="separator" class="divider"></li>
    <li><a href="#">Separated link</a></li>
  </ul>
</div>

  </td>
</tr>
<tr style="width:100%; height: 50%">
  <td style="width:33%;"></td>
    <td style="width:33%;"></td>
    <td style="width:33%;"></td>
</tr>
    </table>

</div>
</div>
<div id="flop">
  <div class="jumbotron content">
    <table border="0" style="width: 100%; height: 100%;">
      <tr style="width:100%; height: 50%">
    <td style="width:33%;">    <div class="alert alert-danger" role="alert" id="status"><p class="statustext" onclick="$('#flop').hide('fast',function(){$('#wrapper').show('fast');});"><strong>0</strong> left</p></div>
</td>
<td style="width:33%;"><div class="alert alert-danger" role="alert" id="status"><p class="statustext">Language:</p></div>
</td>
  <td style="width:33%;"><div class="alert alert-danger" role="alert" id="status"><p class="statustext">English</p></div>
  </td>
</tr>
<tr style="width:100%; height: 50%">
  <td style="width:33%;"></td>
    <td style="width:33%;"></td>
    <td style="width:33%;"></td>
</tr>
    </table>

</div>
</div>
</body>
</html>
