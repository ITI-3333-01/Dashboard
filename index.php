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

<html>
<head>
</head>
  <h1 style="text-align:center,font-size:34px, font-color:#532c6d"><br> Big Data, One Byte at a Time: <br>Collecting and Aggregating <br>Live Network Data  

    <h2 style="font-style:bold">Project Abstract</h2>
    
    <h3 style:"text-indent:30px">The proliferation of digital data has spawned new technologies and procedures to collect, aggregate, and analyze this data known as Big Data and Business Analytics. This project is intended to more fully understand these trends and model the procedures by collecting real-time network data that is flowing into and out of the Boone Business Building at Trevecca Nazarene University. This project requires the design and architecting of hardware and software to collect and store billions of data points for later retrieval by common industry de facto standard analytics subsystems. Students from information technology, mathematics, and business will benefit from exposure to the technological, analytical, organizational, and communication components of a Big Data and Business Analytics project using real-time data.<br><h/3>
<h3 style:"text-indent:30px">There are two FLARE projects summarized in the narrative that follows to more clearly represent the holistic objective of the greater goal. However, the details of assessment, outcomes, and budgets are only for project one. Each of the two projects is a three credit hour project with a combined six hours across two years. Although project two is dependent upon successful completion of project one, this foundational project one can stand alone. It is understood that the approval of project one in no way guarantees the approval of project two.</h3>
</html>
<?php
  mysql_free_result($result);
  mysql_close($dbconn);
  include('footer.html');
?>
