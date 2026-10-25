<?php

require_once "../private/autoloader.php";
require_once "checklogin.php";



$GamesUserDoesntOwn = gamesManager::GamesNOTofUser($_GET["id"]);
$customer_info = customerManager::getCustomerByID($_GET["id"]);
$GamesPersonDOESown = gamesManager::getAllGamesByPersonID($_GET["id"]);
$CustomerID = $_GET["id"];

if (isset($_GET["iddelete"])) {
    gamesManager::deleteGameFromPerson($CustomerID, $_GET["iddelete"]);
    header("location: AddGameToCustomer.php?id=$CustomerID");
    exit();
}

if ($_POST) {
    if (!empty($_POST["game_id"])) {
        gamesManager::addGameToPerson($CustomerID, $_POST["game_id"]);
        header("location: AddGameToCustomer.php?id=$CustomerID");
        exit();
    }
}

//var dump result:
// object(stdClass)[4]
//   public 'game_id' => int 1
//   public 'gamename' => string 'GTA' (length=3)



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href='AddGameToCustomer.css'>
</head>

<body>
    <div id='navbar'>
        <a id='nav-titel'>Radjetoe</a>
        <a href='mainscreen.php'>Home</a>
        <a href='addCustomer.php'>Klant toevoegen</a>
        <a class='uitlogknop' href='logout.php' onclick='return confirm("weet je zeker dat je wil uitloggen?")'>Uitlogen</a>

    </div>
    <div id="alles-container">
        <h2><?php echo "$customer_info->firstname" ?></h2>
        <form method="post">
            <?php


            // als games die hij niet bezit leeg is (alle games bezit). Dan dropdown weg van games toevoegen
            if (!empty($GamesUserDoesntOwn)) { ?>

                <div class="dropdown">
                    <input type="text" class='text-input' placeholder="kies een game" readonly id="dropdownBtn" class="input">

                    <ul id="dropdownMenu">
                        <?php
                        foreach ($GamesUserDoesntOwn as $gno) {
                            echo "
                <li data-value='$gno->gameid'>$gno->gamename</li>
                ";
                        }
                        ?>
                    </ul>

                    <input type="hidden" name="game_id" id="dropdownValue" value="">
                </div>
                <input type="submit" class="opslaanknop" value='toevoegen'>
        </form>
    <?php }

            // als gamespersonDoesown leeg is (persoon heeft geen games), toon dan de tabel ook niet
            if (!empty($GamesPersonDOESown)) { ?>
        <div id="table-wrapper">
            <table class="table">
                <thead id='thead'>
                    <tr>
                        <th>Naam</th>
                        <th>Platform</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($GamesPersonDOESown as $gpdo) {
                        echo
                        "
    <tr>
    <td class='td'>$gpdo->name</td>
    <td class='td'>$gpdo->platform</td>
    <td class='td'><a class='verwijder-knop' href='AddGameToCustomer.php?id=$CustomerID&iddelete=$gpdo->id'>X</a></td>


   </tr>
     ";
                    }
                    ?>
                </tbody>
            </table>
        <?php
            }

        ?>


        </div>


        <script src='scripts/dropdown.js'></script>
</body>

</html>