<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/html" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Add Subscriber</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<h2>New Subscriber</h2>
<?php

if (isset($_POST['submit'])) {

// Grab the score data from the POST
    $name = $_POST['name'];
    $username = $_POST['username'];
    $Address = $_POST['Address'];
    $CC = $_POST['CC'];

    if (!empty($name) && !empty($username) && (!empty($Address) && (!empty($CC)))) ;
    {


        $dbh = new PDO('mysql:host=localhost;dbname=survival', 'root', 'root');
        $query = "INSERT INTO subs VALUES (0,:name,:username,:Address,:CC)";
        // Write the data to the database
        $stmt = $dbh->prepare($query);
        $result = $stmt->execute(
            array($name, $username, $Address, $CC)
        );
        // Confirm success with the user
        echo '<p>Thanks for subscribing to Ahmed!</p>';
        echo '<p><strong>Name:</strong> ' . $name . '<br />';
        echo '<strong>Username:</strong> ' . $username . '</p>';
        echo '<p><a href="home.php">&lt;&lt; Back to home page</a></p>';
        // Clear the score data to clear the form
        $name = "";
        $username = "";
        $Address = "";
        $CC = "";
    }
}
else {
    echo '<p class="error">Please enter all info to sign up.</p>';
}


?>
<hr/>
<form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php if (!empty($name)) echo $name; ?>"/>
    <br/>
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" value="<?php if (!empty($username)) echo $username; ?>"/>
    <br/>
    <label for = "Address">Address:</label>
    <input type="text" id="Address" name="Address" value="<?php if (!empty($Address)) echo $Address; ?>"/>
    <br/>
    <label for="CC">CC:</label>
    <input type="text" id="CC" name="CC" value="<?php if(!empty($CC)) echo $CC; ?>"/>
    <br/>
    <hr/>
    <input type="submit" value="Add" name="submit"/>
</form>
</body>
</html>
