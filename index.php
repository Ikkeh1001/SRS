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
  <td style="width:33%;"><div class="alert alert-info" role="alert" onclick="$('#wrapper').fadeOut('fast',function(){$('#list').fadeIn('fast')});getWords();"><p class="statustext click unselectable">List</p></div></td>
    <td style="width:33%;"><div class="alert alert-warning" role="alert" onclick="$('#wrapper').fadeOut('fast',function(){$('#starttest').fadeIn('fast')});"><p class="statustext click unselectable">Test</p></div></td>
    <td style="width:33%;"><div class="alert alert-success" role="alert"><p class="statustext click unselectable" data-toggle="modal" data-target="#addlanguage">Add</p></div></td>
</tr>
    </table>

</div>
</div>



<div id="list">
  <div class="jumbotron dalist">
    <table border="0" style="width: 100%; height: 100%;" id="listtable">
      <tr style="width:100%; height: 9%">
    <td style="width:33%;"><div class="alert alert-danger" role="alert"><p class="listtext" id="listtableheader"></p></div>
</td>
<td style="width:33%;"><div class="alert alert-success" role="alert"><p class="listtext click unselectable" id="listtableadd">Add/Change Word</p></div>
</td>
<td style="width:33%;"><div class="alert alert-success" role="alert"><p class="listtext click unselectable" onclick="$('#list').fadeOut('fast',function(){$('#wrapper').fadeIn('fast')});getLeft();">Back</p></div>
</td>
</tr>
<tr style="width:100%; height: 9%">
  <td style="width:33%;"><div class="alert alert-info" role="alert"><p class="listtext click unselectable" id="listtableback"><<</p></div></td>
    <td style="width:33%;"><div class="alert alert-warning" role="alert"><p class="listtext" id="listtablepage"></p></div></td>
    <td style="width:33%;"><div class="alert alert-info" role="alert"><p class="listtext click unselectable" id="listtablenext">>></p></div></td>
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

<div id="starttest">
  <div class="jumbotron dastarttest">
      <table style="width: 100%; height: 100%;"><tr style="width: 100%; height: 100%;"><td style="width: 66%;" colspan="2"><div class="alert alert-danger" role="alert"><p class="teststartstop click unselectable" onclick="maintest();"><strong>Start</strong></p></div></td>
        <td style="width: 33%;"><div class="alert alert-warning" role="alert"><p class="teststartstop click unselectable" onclick="$('#starttest').fadeOut('fast',function(){$('#wrapper').fadeIn('fast')});"><strong>Back</strong></p></div></td></tr></table>
</div>
</div>
<div id="maintest">
  <div class="jumbotron damaintest">
      <table style="width: 100%; height: 100%; background-color:#84a1ff"><tr style="width: 100%; height: 15%;"><td style="width: 66%;" colspan="4"><div class="alert alert-warning" role="alert"><p class="testmain" id="testlanguage"><strong></strong></p></div></td>
        <td style="width: 33%;" colspan="2"><div class="alert alert-warning" role="alert"><p class="testmain" id="testwordnumber"><strong></strong></p></div></td></tr>
        <tr style="width:100%; height: 10%;"><td style="width:100%" colspan="6"><p class="testmainbl" style="font-weight:bold;">Translate:</p></td></tr>
        <tr style="width:100%; height: 10%;"><td style="width:100%" colspan="6"><p class="testmainbl" id="totranslate">Cat</p></td></tr>
        <tr style="width:100%; height: 5%;"></tr>
        <tr style="width:100%; height: 10%;"><td style="width:100%" colspan="6"><input type="text" class="form-control" id="inputtestmeaning" placeholder="'poes'"></td></tr>
        <tr style="width:100%; height: 25%;"></tr>
        <tr style="width:100%; height: 25%;"><td style="width:33%" colspan="2" id="testfirstoption"></td>
        <td style="width:33%;" colspan="2" id="testsecondoption"></td>
        <td style="width:33%;" colspan="2"><div class="alert alert-info" role="alert"><p class="testmain click unselectable" id="testcontinue"><strong>Continue</strong></p></div></td>
        </tr>
      </table>
</div>
</div>
<div id="stoptest">
  <div class="jumbotron dastoptest">
      <div class="alert alert-warning" role="alert" onclick="updatewords();"><p class="teststartstop click unselectable"><strong>Done</strong></p></div>
</div>
</div>


<div class="modal fade" id="addword" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="addwordtitle">Add a Word or change one by entering it below</h4>
          </div>
          <div class="modal-body" id="addwordsbody">
            <p class="addwordmodaltext"><strong>Word:</strong></p>
            <input type="text" class="form-control" id="inputword" placeholder="cat"><br>
            <p class="addwordmodaltext"><strong>Meaning (seperated by ', ' and lowercase) :</strong></p>
            <input type="text" class="form-control" id="inputmeaning" placeholder="poes"><br>
            <table style="width: 100%"><tr style="width: 100%"><td style="width: 50%">
            <p class="addwordmodaltext"><strong>Difficulty (1: easy, 2: moderate, 3: hard) :</strong></p></td>
            <td style="width: 50%"><div class="form-group">
  <select class="selectpicker" id="inputdiff" style="width: 100%;font-size:130%;">
    <option class="shouldbeselected">1</option>
    <option class="shouldnotbeselected">2</option>
    <option class="shouldnotbeselected">3</option>
  </select>
</div></td>
</tr></table>
<button class="btn btn-primary btn-block" onclick="newWord();" style="font-size:145%;">Submit Word</button>
</div></div></div>
</div>

<div class="modal fade" id="addlanguage" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Add a language</h4>
          </div>
          <div class="modal-body" id="addlanguagebody">
            <p class="addwordmodaltext"><strong>Language:</strong></p>
            <input type="text" class="form-control" id="inputlanguage" placeholder="English"><br>

<button class="btn btn-primary btn-block" onclick="newLanguage();" style="font-size:145%;">Submit Language</button>
</div></div></div>
</div>

</body>
</html>
