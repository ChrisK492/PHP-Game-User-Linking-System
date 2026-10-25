<?php
require_once "../private/autoloader.php";
require_once "checklogin.php";

$personId = $_GET['id'];

$person_info = customerManager::getCustomerByID($personId);
$email = $person_info->email;
$gamesVanCustomer = gamesManager::getAllGamesByPersonID($personId);


$html = "<h1>Games:</h1>";

foreach ($gamesVanCustomer as $GVC) {
    $html .= "<p>" . $GVC->name . "</p>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel='stylesheet' href='emailPage.css'>

<body>
    <div id='navbar'>
        <a id='nav-titel'>Radjetoe</a>
        <a href='mainscreen.php'>Home</a>
        <a href='addCustomer.php'>Klant toevoegen</a>
    <a class='uitlogknop' href='logout.php' onclick='return confirm("weet je zeker dat je wil uitloggen?")'>Uitlogen</a>
    </div>

    <?php

    // versturen van email via de manager
    $succes = EmailManager::sendEmail(
        $email,
        "Alle games van $person_info->firstname",
        "$html"
    );

    if ($succes) {
        echo "<p id='mailsucces'>Email sturen naar $email is gelukt!</p>";
        echo "<a id='backbtn' href='mainscreen.php'>Ga terug naar hoofdscherm ⬅</a>";
    } else {
        echo "<p id='mailerror'>Email sturen is mislukt! Check of het email van de customer nog bestaat</p>";
        echo "<a id='backbtn' href='mainscreen.php'>Ga terug naar hoofdscherm ⬅</a>";
    }
    ?>
</body>
</head>

</html>