<?php
session_start();
include 'config.php';

if(isset($_POST['submit'])){

    if($_POST['haslo']!=$_POST['phaslo'])
    {
        echo'<script>alert("hasła nie są identyczne")</script>';
    }
    else {

        $uppercase = preg_match('@[A-Z]@', $_POST['haslo']);
        $lowercase = preg_match('@[a-z]@', $_POST['haslo']);
        $number    = preg_match('@[0-9]@', $_POST['haslo']);
        $specialChars = preg_match('@[^\w]@', $_POST['haslo']);

        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($_POST['haslo']) < 8) {
            echo 'Hasło powinno mieć conajmniej 8 znaków, conajmniej jedną duża litere i znak specjalny.';
        }else{
            $nazwa = mysqli_real_escape_string($conn, $_POST['nazwa']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $haslo = mysqli_real_escape_string($conn, md5($_POST['haslo']));
            $phaslo = mysqli_real_escape_string($conn, md5($_POST['phaslo']));

            $select = mysqli_query($conn, "SELECT * FROM `uzytkownik` WHERE email = '$email' AND haslo = '$haslo'") or die('query failed');

            if (mysqli_num_rows($select) > 0) {
                $message[] = 'Użytkownik już istenieje!';
            } else {
                mysqli_query($conn, "INSERT INTO `uzytkownik`(nazwa, email, haslo) VALUES('$nazwa', '$email', '$haslo')") or die('query failed');
                $message[] = 'Zarejestrowano pomyślnie!';
                header('location:login.php');
            }
        }

    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css.css">
    <link rel="shortcut icon" href=favicon.ico>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
<a href="index.php">
    <img class="image" style="float: left" src =i.png>
</a>
<?php
if(isset($message)){
    foreach($message as $message){
        echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
    }
}
?>

<div class="form-container">

    <b>
    <form action="" method="post">
        <h3>Zarejestruj się</h3>
        <input type="text" name="nazwa" required placeholder="Wprowadź nazwe" class="box">
        <input type="email" pattern="[a-z0-9_.-]+@[a-z0-9_.-]+\.\w{2,4}" name="email" required placeholder="Wprowadź email" class="box">
        <input type="text" name="haslo" required placeholder="Wprowadź hasło" class="box">
        <input type="password" name="phaslo" required placeholder="Potwierdz hasło" class="box">
        <input type="submit" name="submit" class="btn" value="Zarejestruj się">
        <p>Masz już konto? <a href="login.php">ZALOGUJ SIE TUTAJ</a></p>
    </form>
    </b>
</div>

</body>
</html>