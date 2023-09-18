<?php
$curr = getcwd();
$dir = str_replace(dirname(getcwd()),'',getcwd());
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="dist/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="dist/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="dist/css/style.css">
    <title>Dashboard</title>
</head>
<body>
<div id="app">
</div>
<script type="text/javascript">
    var url = 'http://<?=$_SERVER['HTTP_HOST'].'/'.stripcslashes($dir)?>/';
</script>
<script type="text/javascript" src="dist/js/materialize.min.js"></script>
<script type="text/javascript" src="dist/js/app.bundle.js"></script>
</body>
</html>