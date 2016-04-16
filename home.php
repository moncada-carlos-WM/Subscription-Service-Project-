<?php

 require_once ('vars.php');

?>








<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Adenola Survival</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<h2>Adenola family survival</h2>
<p>Welcome, Adenola Survivals<a href="newsub.php">Subscribe to become apart.</a>.</p>
<hr />
<?php
// Retrieve the score data from MySQL
$query = "SELECT * FROM survival ORDER BY subs DESC";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt ->fetchAll();


// Loop through the array of score data, formatting it as HTML
echo '<table>';
foreach ($result as $row) {
    $i = 0;
    if($i == 0) {
        echo '<tr><td colspan="2" class="username">Top Score:' . $row['username'] . '</td></tr>';

    }


    echo '<tr><td class="userinfo">';
    echo '<span class="username">' . $row['username'] . '</span><br />';
    echo '<strong>Name:</strong> ' . $row['name'] . '<br />';
    echo '<strong>Date:</strong> ' . $row['date'] . '</td></tr>';
    if (is_file($filepath) && filesize($filepath) > 0) {
        echo '<td><img src="' . $filepath . '" alt="S" /></td></tr>';
    } else {
        echo '<td><img src="images/unverified.gif" alt="Unverified score" /></td></tr>';
    }
    $i++;
}

echo '</table>';
?>
</body>
</html>







