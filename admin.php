<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Adenola Survival</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<h2>Subscribers</h2>
<p>List of subscribers.</p>
<hr />
​
<?php
require_once ('vars.php');

require_once ('authorize.php');

// Retrieve the score data from MySQL
$query = "SELECT * FROM subs ORDER BY score DESC, date ASC";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt ->fetchAll();
// Loop through the array of score data, formatting it as HTML

echo '<table>';
foreach ($result as $row) {
    // Display the score data
    echo '<tr class="userrow"><td><strong>' . $row['name'] . '</strong></td>';
    echo '<td>' . $row['date'] . '</td>';
    echo '<td>' . $row['username'] . '</td>';
    echo '<td><a href="removesub.php?id=' . $row['id'] . '&amp;date=' . $row['date'] .
        '&amp;name=' . $row['name'] . '&amp;username=' . $row['username'] .
         '">Remove</a>';
    if($row['approved']== 0){
        echo ' / <a href="approvesub.php?id=' . $row['id'] . '&amp;date=' . $row['date'] .
            '&amp;name=' . $row['name'] . '&amp;username=' . $row['username'] .
            '">Approve</a></>';
    }
    echo '</td></tr>';
}
echo '</table>';
?>
</body>
</html>