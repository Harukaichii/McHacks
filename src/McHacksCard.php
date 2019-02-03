<?php

/**
 * Class responsible to handle CRUD actions for cards table.
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
     * Creates cards table.
     */
    function createCardsTable() {
        try {
            $sql = 'drop table if exists cards; '
                 . 'create table cards (id integer primary key auto_increment, '
				 . 'card_date datetime default now() not null, '
				 . "colour varchar (6) default 'ffffff' not null, "
                 . "story varchar(255) default '' not null, "
				 . "username varchar(50) not null, "
				 . "pattern varchar(255) not null, "
				 . "foreign key (username) references users(username) on delete cascade on update cascade)";
            $stmt = $this -> pdo ->prepare($sql);
            $stmt -> execute();
        }
        catch(PDOException $e) {
            echo $e -> getMessage();
        }
    }

	/*
	 * Inserts cards to display for the demo.
	 */
	function insertDemoCards() {
		try {
            $sql = 'insert into cards (card_date, colour, story, username, pattern) values (now(), "ffffff", ?, admin", "default.png")';
            $stmt = $this -> pdo -> prepare($sql);
            $stmt -> bindValue(1, "I made some bread today :)");
            $stmt -> execute();

			$sql = 'insert into cards (card_date, colour, story, username, pattern) values ("2019-01-25", "ffffff", ?, admin", "default.png")';
            $stmt = $this -> pdo -> prepare($sql);
            $stmt -> bindValue(1, "Today I have learned how to play my favourite song.");
            $stmt -> execute();

			$sql = 'insert into cards (card_date, colour, story, username, pattern) values ("2019-02-01", "ffffff", ?, admin", "default.png")';
            $stmt = $this -> pdo -> prepare($sql);
            $stmt -> bindValue(1, "Went to the mall with my friends and had a lot of fun.");
            $stmt -> execute();

			$sql = 'insert into cards (card_date, colour, story, username, pattern) values ("2019-02-02", "ffffff", ?, admin", "default.png")';
            $stmt = $this -> pdo -> prepare($sql);
            $stmt -> bindValue(1, "I ate a very tasty muffin today.");
            $stmt -> execute();

			$sql = 'insert into cards (card_date, colour, story, username, pattern) values ("2019-02-15", "ffffff", ?, admin", "default.png")';
            $stmt = $this -> pdo -> prepare($sql);
            $stmt -> bindValue(1, "That's my birthday today :)");
            $stmt -> execute();
        }
        catch(PDOException $e) {
            echo $e -> getMessage();
        }
	}
    
    /**
     * Saves card to the cards table.
     * @param $colour the colour of the card
     * @param $story the story of the card.
     * @param $username the username of the user.
     * @param $pattern the pattern on the card.
     */
    function saveCard($colour, $story, $username, $pattern) {
        try {
            $user = $this -> findUser($username)['username'];
            if(isset($user)){
				$sql = 'insert into cards (colour, story, username, pattern) values (?, ?, ?, ?)';
            	$stmt = $this -> pdo -> prepare($sql);
            	$stmt -> bindValue(1, $colour);
				$stmt -> bindValue(2, $story);
				$stmt -> bindValue(3, $username);
				$stmt -> bindValue(4, $pattern);
            	$stmt -> execute();
            }
        }
        catch(PDOException $e) {
            echo $e -> getMessage();
        }
    }

    
    /**
     * Returns the card created at the specified date.
     * @param $date the date of the card required.
     * @param $username the username of the user.
     * @return a card created at the specified date by the user.
     */
    function findCardForDate($date, $username) {
        try {
            $sql = 'select card_date, colour, story, username, pattern from cards '
                 . 'where date(card_date) = ? and username = ?';
            $stmt = $this -> pdo -> prepare($sql);
            $stmt -> bindParam(1, $date->format('Y-m-d'));
			$stmt -> bindParam(2, $username);
            $stmt = $this -> pdo -> prepare($sql);
            $stmt -> execute();
			return $stmt -> fetch();
        }
        catch(PDOException $e) {
            echo $e -> getMessage();
        }
    }

	/**
     * Returns the random card created by the user.
     * @param $username the username of the user.
     * @return a random card created by the user.
     */
    function findCardRandom($username) {
        try {
            $sql = 'select card_date, colour, story, username, pattern from cards '
                 . 'where username = ?';
            $stmt = $this -> pdo -> prepare($sql);
			$stmt -> bindParam(1, $username);
            $stmt = $this -> pdo -> prepare($sql);
            $stmt -> execute();
            $dbResult = $stmt -> fetchAll();
			$values = isset($dbResult) ? $dbResult : [];
			$count = count($values) - 1;
			if($count >= 0) {
				$index = rand(0, $count);
				for($i = 0; $i < $index; ++$i);
				return $dbResult[$i];
			}
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

    function findCardForMonth($month, $year, $user){
        try{
                $sql = 'select colour, story, username, pattern'
                . 'where month(date) = ? and year(date) = ? and user = ' ;
            	$stmt = $this -> pdo -> prepare($sql);
            	$stmt -> bindValue(1, $colour);
				$stmt -> bindValue(2, $story);
				$stmt -> bindValue(3, $username);
				$stmt -> bindValue(4, $pattern);
            	$stmt -> execute();
            }
        catch(PDOException $e) {
            echo $e -> getMessage();
        }
    
    }
}
