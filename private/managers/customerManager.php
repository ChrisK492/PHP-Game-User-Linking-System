<?php

class customerManager
{
    public static function getAllCustomers(): array
    {
        global $con;
        $stmt = $con->prepare("SELECT customer.*, country.name AS landnaam, COUNT(customer_has_game.game_id) AS aantal_games FROM ratjetoe.customer JOIN country ON country.id = customer.country_id LEFT JOIN customer_has_game ON customer.id = customer_has_game.customer_id GROUP BY customer.id ORDER BY customer.id ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function insertCustomer($firstname, $lastname, $email, $premium_member, $country_id)
    {
        global $con;
        $stmt = $con->prepare("INSERT INTO customer (firstname, lastname, email, premium_member, country_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bindValue(1, $firstname);
        $stmt->bindValue(2, $lastname);
        $stmt->bindValue(3, $email);
        $stmt->bindValue(4, $premium_member);
        $stmt->bindValue(5, $country_id);
        $stmt->execute();
    }

    public static function deleteCustomerById($id)
    {
        global $con;
        $stmt = $con->prepare("DELETE FROM customer WHERE id = ?");
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }

    public static function deleteGameKoppeling($customer_id)
    {
        global $con;
        $stmt = $con->prepare("DELETE FROM customer_has_game WHERE customer_id = ?");
        $stmt->bindValue(1, $customer_id);
        $stmt->execute();
    }

    public static function updateCustomerById($id, $firstname, $lastname, $email, $premium_member, $country_id)
    {
        global $con;
        $stmt = $con->prepare("UPDATE customer SET firstname = ?, lastname = ?, email = ?, premium_member = ?, country_id = ? WHERE id = ?");
        $stmt->bindValue(1, $firstname);
        $stmt->bindValue(2, $lastname);
        $stmt->bindValue(3, $email);
        $stmt->bindValue(4, $premium_member);
        $stmt->bindValue(5, $country_id);
        $stmt->bindValue(6, $id);

        $stmt->execute();
    }

    public static function getCustomerByID($id): object
    {
        global $con;
        $stmt = $con->prepare("SELECT ratjetoe.customer.*, country.name as landnaam from customer JOIN country on customer.country_id = country.id  WHERE customer.id = ?");
        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetchObject();
    }
}
