<?php
 class userManager{
    public static function getAllUsers() : array{
        global $con;
        $stmt = $con->prepare("SELECT * FROM user");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function getUserByEmail($email) : object|false{
        global $con;
        $stmt = $con->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->bindValue(1, $email);
        $stmt->execute();
        return $stmt->fetchObject();
    }
 }
?>