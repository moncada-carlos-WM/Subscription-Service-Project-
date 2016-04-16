<?php
  require_once('vars.php');

  if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
      // The username/password weren't entered so send the authentication headers
      header('HTTP/1.1 401 Unauthorized');
      header('WWW-Authenticate: Basic realm="Mismatch"');
      exit('<h3>Adenola</h3>Sorry, you must enter your username and password to log in and access this page. If you ' .
          'aren\'t a registered member, please <a href="newsub.php">sign up</a>.');
  }

  // Connect to the database
$dbh = new PDO('mysql:host=localhost;dbname=survival', 'root', 'root');

  // Grab the user-entered log-in data
  $username = $_SERVER['PHP_AUTH_USER'];
  $password = $_SERVER['PHP_AUTH_PW'];

  // Look up the username and password in the database
  $query = "SELECT password, username FROM login WHERE username = 'username' AND password = SHA('password')";
  $stmt = $dbh->prepare($query);
  $stmt->execute();
  $username = $stmt ->fetchAll();

  if (($query) == 1) {
      // The log-in is OK so set the user ID and username variables
      $row = ($query);
      $username = $row['username'];
      $password = $row['password'];
  }
  else {
      // The username/password are incorrect so send the authentication headers
      header('HTTP/1.1 401 Unauthorized');
      header('WWW-Authenticate: Basic realm="Adenola"');
      exit('<h2>Adenola Family</h2>Sorry, you must enter a valid username and password to log in and access this page. If you ' .
          'aren\'t a registered member, please <a href="newsub.php">sign up</a>.');
  }

  // Confirm the successful log-in
  echo('<p class="login">You are logged in as ' . $username . '.</p>');
?>a