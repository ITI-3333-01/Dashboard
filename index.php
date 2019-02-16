<?php
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
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Domain', 'Total Packets'],
        <?php 
$exec = mysql_query("SELECT total,time FROM dumps WHERE time >DATE_SUB(CURDATE(), INTERVAL 1 hour) ORDER BY total DESC LIMIT 6;"); 
            
               if (!$exec) {
    die("Database query failed: " . mysql_error());
}
 
/* $row = mysql_fetch_array($exec);
             if (!$row) {
    die("Database fetch failed: " . mysql_error());
}*/
  while($row = mysql_fetch_array($exec)){
  echo "['".$row["time"]."', ".$row["total"]."],";
  }
 ?>
        ]);
        var options = {
          title: 'Total packets by time'
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px; clear:both"></div>
      <div id="piechart" style="width: 900px; height: 500px; clear:both"></div>
  </body>
<?php
    mysql_free_result($result);
mysql_close($dbconn);
/*footer code*/
include('footer.html');
?>
