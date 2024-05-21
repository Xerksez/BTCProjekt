<?php
session_start();
include 'config.php';


if(isset($_POST['submit'])){

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $haslo= mysqli_real_escape_string($conn, md5($_POST['haslo']));

    $select = mysqli_query($conn, "SELECT * FROM `uzytkownik` WHERE email = '$email' AND haslo = '$haslo'") or die('query failed');

    if(mysqli_num_rows($select) > 0){
        $row = mysqli_fetch_assoc($select);
        $_SESSION['id'] = $row['id'];
        $_SESSION['email']=$row['email'];
        $query="Select czyadmin from uzytkownik where email = '$email'";
        $result=mysqli_query($conn,$query);
        $record=mysqli_fetch_assoc($result);

if($record['czyadmin']==1)
{
    $_SESSION['admin']=1;
    header('location:indexa.php');
}
else
{
    $_SESSION['admin']=0;
    header('location:index.php');
}
    }else{
        $message[] = 'błędny email lub hasło!';
    }

}

?>

    <!DOCTYPE html>
    <html lang="en">
<head>
    <link rel="stylesheet" href="css.css">
    <link rel="shortcut icon" href=favicon.ico>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>


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

    <form action="" method="post">
        <b>
        <div class="login-box">
        <h3>Zaloguj się</h3>
            <div class="textbox">
        <input type="email" name="email" required placeholder="Podaj email" class="box">
            </div>
                <div class="textbox">
        <input type="password" name="haslo" required placeholder="Podaj hasło" class="box">
                </div>
        <input type="submit" name="submit" class="btn" value="Zaloguj">
        <p>Nie masz konta? <a href="rejestracja.php">Zarejestruj się już teraz!</a></p>
            </b>
    </form>

</div>
</div>

</body>
    </html>
