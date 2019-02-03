<?php

/**
 * Class responsible to handle CRUD actions for users table.
 */
class McHacksUser {
    private $pdo;
    
    /**
     * Connects to the database and sets up PDO object.
     */
    function __construct() {
        include 'db.info.php';

        $this -> pdo = new PDO("mysql:host=$host;dbname=$dbname", 
                                $dbuser, $dbpassword);
        $this -> pdo -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    
    /**
     * Creates users table.
     */
    function createUsersTable() {
        try {
            $sql = 'drop table if exists users; '
                 . 'create table users (username varchar(50) primary key, '
                 . "password varchar(255) default '' not null)";
            $stmt = $this -> pdo ->prepare($sql);
            $stmt -> execute();
        }
        catch(PDOException $e) {
            echo $e -> getMessage();
        }
    }
    
    /**
     * Adds a user to users table.
     * @param $username the username of the user.
     * @param $password the hashed password.
     */
    function insertUser($username, $password) {
        try {
            $user = $this -> findUser($username)['username'];
            if(!isset($user)){
                $sql = 'insert into users (username, password) values (?, ?)';
                $stmt = $this -> pdo -> prepare($sql);
                $stmt -> bindValue(1, $username);
                $stmt -> bindValue(2, $password);
                $stmt -> execute();
            }
        }
        catch(PDOException $e) {
            echo $e -> getMessage();
        }
    }

	/**
     * Adds the admin user to users table.
     */
	function insertAdmin() {
		try {
            $sql = 'insert into users (username, password) values (?, ?)';
            $stmt = $this -> pdo -> prepare($sql);
            $stmt -> bindValue(1, "admin");
            $stmt -> bindValue(2, "password");
            $stmt -> execute();
        }
        catch(PDOException $e) {
            echo $e -> getMessage();
        }
	}
    
    /**
     * Returns the hashed password for the specific user.
     * @param $username the user whose password is required.
     * @return the hashed password for the specific user.
     */
    function getPassword($username) {
        try {
            return $this -> findUser($username)['password'];
        }
        catch(PDOException $e) {
            echo $e -> getMessage();
        }
    }
    
    /**
     * Returns all information for the specified user.
     * If this user does not exist, null is returned.
     * @param $username the user whose information is required.
     * @return all information for the specified user.
     */
    function findUser($username) {
        try {
            $sql = 'select username, password, count from users '
                 . 'where username = ?';
            $stmt = $this -> pdo -> prepare($sql);
            $stmt -> bindParam(1, $username);
            $stmt -> execute();
            return $stmt -> fetch();
        }
        catch(PDOException $e) {
            echo $e -> getMessage();
        }
    }
       
    /**
     * Unsets PDO object value to get it garbage collected.
     */
    function __destruct() {
        unset($this -> pdo);
    }
}
