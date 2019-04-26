<?php
  $page = $_SERVER['PHP_SELF'];
  $sec = "60";
  include('header.html');
  $servername= "localhost";
  $username="flare";
  $password="Flare-3333";
  $database="flare";
  /* COMMENT: Connect to the mysql server */
  $dbconn = mysql_connect($servername, $username, $password);
  if(!$dbconn) {
    die("Connection failed: " . mysql_error());
  }
  /* COMMENT: Select the database within the server */
  $dbselect = mysql_select_db($database, $dbconn);
  if (!$dbselect) {
    die("Database select failed: " . mysql_error());
  }
?>


  <?php 
    include('home.html');  
    ?>
    
<?php
  mysql_free_result($result);
  mysql_close($dbconn);
  include('footer.html');
?>
