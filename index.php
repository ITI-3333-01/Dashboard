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

      function drawChart1() {

        var data = google.visualization.arrayToDataTable([
          ['Domain', 'Total Packets'],
        <?php 
//WHERE time >DATE_SUB(CURDATE(), INTERVAL 1 hour)
$exec = mysql_query("SELECT total,time FROM dumps  ORDER BY total DESC LIMIT 6;"); 
               if (!$exec) {
    die("Database query failed: " . mysql_error());
}
  while($row = mysql_fetch_array($exec)){
  echo "['".$row["time"]."', ".$row["total"]."],";
  }
 ?>
        ]);
        var options = {
          title: 'Total packets by time', width:400,
                       height:300
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart1'));
        chart.draw(data, options);
      }
        function drawChart2() {

        var data = google.visualization.arrayToDataTable([
          ['Domain', 'Total Packets'],
        <?php 
//WHERE time >DATE_SUB(CURDATE(), INTERVAL 1 hour)
$exec = mysql_query("SELECT total,time FROM dumps  ORDER BY total DESC LIMIT 6;"); 
               if (!$exec) {
    die("Database query failed: " . mysql_error());
}
  while($row = mysql_fetch_array($exec)){
  echo "['".$row["time"]."', ".$row["total"]."],";
  }
 ?>
        ]);
        var options = {
          title: 'Total packets by time', width:400, 
                       height:300
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart2'));
        chart.draw(data, options);
      }
    </script>
  </head>
 <body>
    <div id="piechar1t" style="width: 900px; height: 500px;"></div>
  </body>
<?php
    mysql_free_result($result);
mysql_close($dbconn);
/*footer code*/
include('footer.html');
?>
