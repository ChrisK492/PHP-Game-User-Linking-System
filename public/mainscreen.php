<?php

// klantenscherm

require_once "../private/autoloader.php";
require_once "checklogin.php";

if (isset($_GET["id"])) {
  customerManager::deleteGameKoppeling($_GET["id"]);
  customerManager::deleteCustomerById($_GET["id"]);
  header("location: mainscreen.php");
  exit();
}

$customers = customerManager::getAllCustomers();

$premiumOrNot = "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel='stylesheet' href='mainscreen.css'>
</head>

<body>
  <div id='navbar'>
    <a id='nav-titel'>Radjetoe</a>
    <a id='nav-active'>Home</a>
    <a href='addCustomer.php'>Klant toevoegen</a>
    <a class='uitlogknop' href='logout.php' onclick='return confirm("weet je zeker dat je wil uitloggen?")'>Uitlogen</a>
  </div>
  <div id='alles-container'>
    <h1>Klanten</h1>
    <a href='addCustomer.php' id='toevoeg-button'>+ Toevoegen</a>
    <div id="table-wrapper">
      <table class="table">
        <thead id='thead'>
          <tr>
            <th>Voornaam</th>
            <th>Achternaam</th>
            <th>Email</th>
            <th>Premium</th>
            <th>Land</th>
            <th>Aantal games</th>
            <th></th>

          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($customers as $c) {

            if ($c->premium_member == 1) {
              $premiumOrNot = "Ja";
            } else {
              $premiumOrNot = "Nee";
            }

            echo
            "
    <tr>
    <td class='td'>$c->firstname</td>
    <td class='td'>$c->lastname</td>
    <td class='td'>$c->email</td>
    <td class='td'>$premiumOrNot</td>
    <td class='td'>$c->landnaam</td>
    <td class='td'>$c->aantal_games</td>
    <td class='td'><button class='muisover-knop'>Opties ▼</button>
    <div class='vakje'>
    <a href='editCustomer.php?id=$c->id'class='wijzig-knop'>🖍 Wijzigen</a><br><br><br>
    <a href='mainscreen.php?id=$c->id'class='verwijder-knop'>✖ Verwijderen</a><br><br><br>
    <a href='addGameToCustomer.php?id=$c->id'class='koppel-knop'>☍ Game koppelen</a><br><br><br>
    <a href='emailPage.php?id=$c->id'class='email-knop'>✉ Aantal games mailen</a>
    </div>
    </td>
   </tr>
     ";
          }


          ?>
        </tbody>
      </table>
    </div>
  </div>
  <script src='scripts/ClickonButton.js'></script>
</body>

</html>