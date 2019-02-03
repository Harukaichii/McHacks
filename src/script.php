<?php
require_once 'McHacksUser.php';
require_once 'McHacksCard.php';
init();

/**
 * Creates cards and users tables. 
 */
function init() {
    $cities = fillCitiesArray();     
    try {
        $mchacksCard = new McHacksCard();
        $mchacksUser = new McHacksUser();
        $mchacksUser -> createUsersTable();
        echo 'Users table is created successfully.'.PHP_EOL;
        $mchacksCard -> createCardsTable();
        echo 'Cards table is created successfully.'.PHP_EOL;
        echo 'Inserting values.'.PHP_EOL;
		$mchacksUser -> insertAdmin();
        $mchacksCard -> insertDemoCards();
        echo PHP_EOL.'Demo values are saved to the database.'.PHP_EOL;       
    }
    catch(PDOException $e) {
        echo $e -> getMessage();
    }
}


