<!-- // inlogscherm -->


<?php
$error = "";


require_once "../private/autoloader.php";



if ($_POST) {
    $user = userManager::getUserByEmail($_POST["email"]);

    if ($user !== false) {
        if (password_verify($_POST["password"], $user->password_hash)) {
            session_start();
            $_SESSION["id"] = $user->id;
            $_SESSION["email"] = $user->email;
            header("location: mainscreen.php");
            exit();
        } else {
            $error = "kan niet inloggen met deze gegevens!";
        }
    }

    if($user == false){
    $error = "kan niet inloggen met deze gegevens!";
}
}





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel='stylesheet' href='login.css'>
</head>

<body>
    <form method="POST" class='inlogscherm'>
        <img class='logo' src='images/logo.png'>


        <p class='error'><?php if($error !== ""){echo "$error";}?></p>
        
        <label>Emailadres:</label><br>
        <input class='inlog-input' type='text' name='email'><br>
        <label>Wachtwoord:</label><br>
        <input class='inlog-input' type='password' name='password'><br>
        <input type='submit' class='login-knop' value='inloggen'>
    </form>
    <script src='scripts/ErrorHandler.js'></script>
</body>

</html>