<html>
  <head>
    <meta charset="UTF-8">
    <link href="styles.css" type="text/css" rel="stylesheet">
    <title><?php echo $title; ?></title>
  </head> 
  
  <body>
    <hr/>
    <div id="container">
        <?php echo $header; ?>
        <form method="POST" action="">  
            <div>
                <label>Enter username:<input type='text' name='user' 
                    class="form-control <?php echo $input; ?>" 
                    value="<?php if (isset($_POST['user'])) 
                                 echo $_POST['user']; ?>" 
                    required />
                </label>
            </div>
            <div>
                <label>Enter password:<input type='password' name='pwd' 
                    class="form-control txt-input" 
                    value="<?php if (isset($_POST['pwd'])) 
                                 echo $_POST['pwd']; ?>" 
                    required />
                </label>
            </div>
            <div><input class="btn btn-red" type="submit" value="Submit" 
                        name="submit"/>
            </div>
        </form>
    </div>
    <?php echo $back; ?>