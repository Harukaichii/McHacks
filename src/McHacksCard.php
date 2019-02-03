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

			$sql = 'insert into cards (card_date, colour, story, username, pattern) values (now(), "ffffff", ?, admin", "default.png")';
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
     * Returns all cards created at the specified date.
     * @param $date the date of cards required.
     * @return the list of all cards created at the specified date.
     */
    function findCardForDate($date) {
        try {
			$dt = new DateTime($date);

            $sql = 'select card_date, colour, story, username, pattern from cards '
                 . 'where date(card_date) = ?';
            $stmt = $this -> pdo -> prepare($sql);
            $stmt -> bindParam(1, $dt->format('Y-m-d'));
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
