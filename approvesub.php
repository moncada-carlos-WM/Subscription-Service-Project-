<?php
require_once ('authorize.php');
?>
​
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Approve Subscriber</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<h2>Ahmed Survival - Approve subscriber</h2>
​
<?php
require_once ('vars.php');

if (isset($_GET['id']) && isset($_GET['date']) && isset($_GET['name']) && isset($_GET['username']) ) {
    // Grab the score data from the GET
    $id = $_GET['id'];
    $date = $_GET['date'];
    $name = $_GET['name'];
    $username = $_GET['username'];
    $Address = $_GET['Address'];
    $CC = $_GET['CC'];
}
else if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['username'])) {
    // Grab the score data from the POST
    $id = $_POST['id'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $Address = $_POST['Address'];
    $CC = $_POST['CC'];
}
else {
    echo '<p class="error">Sorry, not able to add subscription.</p>';
}

if (isset($_POST['submit'])) {
    if ($_POST['confirm'] == 'Yes') {

        // Approve the score by setting the approved column in the database
        $query = "UPDATE subs SET approved = 1 WHERE id = :id";

        $stmt = $dbh->prepare($query);
        $stmt->execute(array('id' => $id));
        // Confirm success with the user
        echo '<p>Your Subscription ' . $username . ' for ' . $name . ' was successfully approved.';
    }
    else {
        echo '<p class="error">Sorry,there was a problem approving your subscription.</p>';
    }
}
else if (isset($id) && isset($name) && isset($date) && isset($username)) {
    echo '<p>Are you sure you want to approve the following subscriber?</p>';
    echo '<p><strong>Name: </strong>' . $name . '<br /><strong>Date: </strong>' . $date .
        '<br /><strong>username: </strong>' . $username . '</p>';
    echo '<form method="post" action="approvesub.php">';
    echo '<input type="radio" name="confirm" value="Yes"/> Yes ';
    echo '<input type="radio" name="confirm" value="No" checked="checked"/> No <br />';
    echo '<input type="submit" value="Submit" name="submit"/>';
    echo '<input type="hidden" name="id" value="' . $id . '" />';
    echo '<input type="hidden" name="name" value="' . $name . '" />';
    echo '<input type="hidden" name="username" value="' . $username . '" />';
    echo '</form>';
}

echo '<p><a href="admin.php">&lt;&lt; Back to admin page</a></p>';
?>
​
</body>
</html>