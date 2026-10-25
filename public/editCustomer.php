<?php

require_once "../private/autoloader.php";
require_once "checklogin.php";


$countries = countryManager::getAllCountries();

$premium_member_checkbox = isset($_POST["premium_member"]) ? 1 : 0;

$error = "";

$customer_info = customerManager::getCustomerByID($_GET["id"]);


if ($_POST) {
    if ($_POST["firstname"] !== "" && $_POST["lastname"] !== "" && $_POST["email"] !== "" && $_POST["country"] !== "") {
        customerManager::updateCustomerById($_GET["id"], $_POST["firstname"], $_POST["lastname"], $_POST["email"], $premium_member_checkbox, $_POST["country"]);
        header("location: mainscreen.php");
        exit();
    } else {
        $error = "niet alle tekst velden zijn ingevuld, er is niet opgeslagen!";
    }
}




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel='stylesheet' href='add&UpdateCustomer.css'>
</head>

<body>
    <div id='navbar'>
        <a id='nav-titel'>Radjetoe</a>
        <a href='mainscreen.php'>Home</a>
        <a>Klant toevoegen</a>
        <a class='uitlogknop' href='logout.php' onclick='return confirm("weet je zeker dat je wil uitloggen?")'>Uitlogen</a>

    </div>
    <div id='alles-container'>
        <form method='post'>
            <?php if ($error) {
                echo "<p id='error'>$error</p>";
            } ?>
            Voornaam:<input type='text' value='<?php echo "$customer_info->firstname" ?>' class='text-input' name='firstname'>
            Achternaam:<input type='text' value='<?php echo "$customer_info->lastname" ?>' class='text-input' name='lastname'>
            Email:<input type='email' value='<?php echo "$customer_info->email" ?>' class='text-input' name='email'>
            Land:<div class="dropdown">
                <input type="text" class='text-input' value='<?php echo "$customer_info->landnaam" ?>' readonly id="dropdownBtn" class="input">

                <ul id="dropdownMenu">
                    <?php
                    foreach ($countries as $c) {
                        echo "
                <li data-value='$c->id'>$c->name</li>
                ";
                    }
                    ?>
                </ul>

                <input type="hidden" name="country" id="dropdownValue" value="<?php echo $customer_info->country_id; ?>">
            </div>
            Premium klant:<input type='checkbox' value='1' <?php if ($customer_info->premium_member == 1) echo "checked"; ?> name='premium_member'>
            <br><br>
            <input type='submit' id='opslaanknop' value="opslaan">




        </form>
        <script src='scripts/dropdown.js'></script>
    </div>
</body>

</html>