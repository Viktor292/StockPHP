<?php
namespace Database;
class Dao {

    private $host = 'localhost'; 
    private $db_name = 'storage'; 
    private $user = 'root'; 
    private $password = ''; 

    public function createDatabase() 
    {
        $connection = mysqli_connect($this->host, $this->user, $this->password, $this->db_name);
        $query = 'CREATE DATABASE IF NOT EXISTS `storage`';
        $result = mysqli_query($connection, $query);
        $connection->close();

        return $result;
    }

    public function createUserTable() 
    {
        $connection = mysqli_connect($this->host, $this->user, $this->password, $this->db_name);
        $query = 'CREATE TABLE IF NOT EXISTS `users` (
            `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `login` varchar(40) NOT NULL,
            `password` varchar(40) NOT NULL
          )';
        $result = mysqli_query($connection, $query);
        $connection->close();
       
        return $result;
    }

    public function findAll($userId) 
    {
        $connection = mysqli_connect($this->host, $this->user, $this->password, $this->db_name);
        $query = 'SELECT * FROM `goods'.$userId.'`';
        $result = mysqli_query($connection, $query);
        $connection->close();

        return $result;
    }

    public function update($userId, $id, $name, $typeNumber, $number, $price, $allPrice, $resultPrice) 
    {
        $connection = mysqli_connect($this->host, $this->user, $this->password, $this->db_name);
        $query = 'UPDATE goods'.$userId.' SET name = "'.$name.'", typenumber = "'.$typeNumber.'", number = '.$number.', price = '.$price.', allprice = '.$allPrice.', resultprice = '.$resultPrice.' WHERE id = '.$id;
        $result = mysqli_query($connection, $query);
        $connection->close();

        return $result;
    }

    public function remove($userId, $id) 
    {
        $connection = mysqli_connect($this->host, $this->user, $this->password, $this->db_name);
        $query = 'DELETE FROM goods'.$userId.' WHERE id = '.$id.';';
        $result = mysqli_query($connection, $query);
        $connection->close();

        return $result;
    }

    public function removeAll($userId) 
    {
        $connection = mysqli_connect($this->host, $this->user, $this->password, $this->db_name);
        $query = 'TRUNCATE TABLE goods'.$userId.'';
        $result = mysqli_query($connection, $query);
        $connection->close();

        return $result;
    }

    
    public function add($userId, $name, $typeNumber, $number, $price, $allPrice, $resultPrice) 
    {
        $connection = mysqli_connect($this->host, $this->user, $this->password, $this->db_name);
        $query = 'INSERT INTO goods'.$userId.' (name, typenumber, number, price, allprice, resultprice) VALUES ("'.$name.'", "'.$typeNumber.'", '.$number.', '.$price.', '.$allPrice.', '.$resultPrice.');';
        $result = mysqli_query($connection, $query);
        $connection->close();
       
        return $result;
    }

    public function checkLogin($login, $password) 
    {
        $connection = mysqli_connect($this->host, $this->user, $this->password, $this->db_name);
        $query = 'SELECT id FROM users WHERE login="'. $login . '" AND password="'.$password.'";';
        $result = mysqli_query($connection, $query);
        $connection->close();

        return $result;
    }

    public function createUser($login, $password) 
    {
        $connection = mysqli_connect($this->host, $this->user, $this->password, $this->db_name);
        $query = 'INSERT INTO users (login, password) VALUES ("'.$login.'", "'.$password .'");';
        mysqli_query($connection, $query);
        $userId = mysqli_insert_id($connection);
        $connection->close();
       
        return $userId;
    }

    public function createTable($userId) 
    {
        $connection = mysqli_connect($this->host, $this->user, $this->password, $this->db_name);
        $query = 'CREATE TABLE `goods'.$userId.'` (
            `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `name` varchar(40) NOT NULL,
            `typenumber` varchar(40) NOT NULL,
            `number` int(11) NOT NULL,
            `price` int(11) NOT NULL,
            `allprice` int(11) NOT NULL,
            `resultprice` int(11) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
          ';
        $result = mysqli_query($connection, $query);
        $connection->close();
       
        return $result;
    }

}
?>
