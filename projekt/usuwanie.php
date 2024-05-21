<?php
session_start();
include 'config.php';
$id=$_GET['id'];
echo'
<html>
<head>
  <link rel="stylesheet" href="css.css">
    <link rel="shortcut icon" href=favicon.ico>
</head>
<body><b>
Czy napewno?
</b>
<form method="post" action="usuwanie2.php?id='.$id.'">
<input type="submit" name="tak" value="TAK">
</form>
<a href="indexa.php"><b>NIE</b></a>
</body>
</html>
';