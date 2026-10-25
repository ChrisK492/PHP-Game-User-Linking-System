<?php

class gamesManager
{
    public static function getAllGames(): array
    {
        global $con;
        $stmt = $con->prepare("SELECT * FROM game");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

   public static function GamesNOTofUser($id): array
{
    global $con;

    $stmt = $con->prepare("
        SELECT
            game.id AS gameid,
            game.name AS gamename
        FROM game
        WHERE game.id NOT IN (
            SELECT game_id
            FROM customer_has_game
            WHERE customer_id = ?
        )
    ");

    $stmt->bindValue(1, $id);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_OBJ);
}


    public static function getAllGamesByPersonID($id): array
    {
        global $con;
        $stmt = $con->prepare("SELECT ratjetoe.customer_has_game.*, game.*, platform.name as platform FROM ratjetoe.customer JOIN customer_has_game on customer_has_game.customer_id = customer.id JOIN game on customer_has_game.game_id = game.id JOIN platform on game.platform_id = platform.id WHERE customer.id = ?");
        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function deleteGameFromPerson($customerId, $gameId){
        global $con;
        $stmt = $con->prepare("DELETE FROM customer_has_game WHERE customer_id = ? AND game_id = ?");
        $stmt->bindValue(1, $customerId);
        $stmt->bindValue(2, $gameId);
        $stmt->execute();

    }

    public static function addGameToPerson($customerId, $gameId){
        global $con;
        $stmt = $con->prepare("INSERT INTO customer_has_game (customer_id, game_id) VALUES (?, ?)");
        $stmt->bindValue(1, $customerId);
        $stmt->bindValue(2, $gameId);
        $stmt->execute();
    }
}
