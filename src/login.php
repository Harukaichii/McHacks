<?php
require 'McHacksUser.php';
$title = 'Login';
$header = "<h2  class='header-login'>Welcome to the Login Page!</h2>";
$back = "<div class='btn btn-back-login'> <a href='index.php'>Back</a></div>";
$input = 'txt-input-login';
include_once 'form.html.php';
login();

/**
 * Performs the necessary actions to login the user.
 */
function login() {
    $mcuser = new McHacksUser();
    $invalidMsg = "<p class='error'>Invalid username or password. "
                . "Please try again.</p>";
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(!empty($_POST['user']) && !empty($_POST['pwd'])) {
		    $user = htmlentities($_POST['user']);       
		    $password = htmlentities($_POST['pwd']);
		    if(password_verify($password, $mcuser -> getPassword($user))) {
		        session_start();
		        session_regenerate_id();
		        $_SESSION['user'] = $user;
		        header('location: index.php');
		    } 
		    else
		        echo $invalidMsg; 
        }
        else
            echo $invalidMsg; 
    }   
}
?>
    </body>
</html>

