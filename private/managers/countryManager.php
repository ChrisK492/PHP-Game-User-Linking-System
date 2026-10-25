<?php

class countryManager{
    public static function getAllCountries() : array{
        global $con;
        $stmt = $con->prepare("SELECT * FROM country");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}





?>