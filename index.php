<?php 
 include('header.html');
?>
<!DOCTYPE html>
<html>
<body>

<h2>Number Field</h2>
<p>The <strong>input type="number"</strong> defines a numeric input field.</p>
<p>You can use the min and max attributes to add numeric restrictions in the input field:</p>

<form action="/graph.php" method="get">
  Quantity (between 1 and 5):
  <input type="number" name="quantity" min="1" max="5">
  <input type="submit">
</form>

<p><b>Note:</b> type="number" is not supported in IE9 and earlier.</p>

</body>
</html>

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
