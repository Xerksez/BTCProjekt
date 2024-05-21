<?php
session_start();
include 'config.php';
$id=$_GET['id'];
$ido=$_GET['ido'];
echo'
<html>
<head>
  <link rel="stylesheet" href="css.css">
    <link rel="shortcut icon" href=favicon.ico>
</head>
<body>
<a href="index.php">
<img class="image" style="float: left" src =i.png>
</a>
<b>
Czy napewno?
</b>
<form method="post" action="usuwanie4.php?id='.$id.'&ido='.$ido.'">
<input type="submit" name="tak" value="TAK">
</form>
<a href="szczegoly.php?id='.$id.'"><b>NIE</b></a>
</body>
</html>
';