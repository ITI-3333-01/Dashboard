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
echo "MYSQL_CONNECT Success <br>";
/* COMMENT: Select the database within the server */
$dbselect = mysql_select_db($database, $dbconn);
if (!$dbselect) {
    die("Database select failed: " . mysql_error());
}
echo "MYSQL_SELECT_DB Success <br>";
/* COMMENT: Setup the query to SELECT * from dumps */
$result = mysql_query("SELECT * FROM dumps ORDER BY total DESC LIMIT 5;"); 
/*WHERE time >DATE_SUB(CURDATE(), INTERVAL 1 hour) */
if (!result) {
    die("Database select failed: " . mysql_error());
}
echo "MYSQL_QUERY Success <br>";
/* COMMENT: Loop through all rows returned */
$rowcnt = 0;
while ($row = mysql_fetch_assoc($result)) {
    echo $row["total"]. "<br>";
    $rowcnt++;
}
?>





/*PIE CHART WORK BY MEHDI*/
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
 $query = "SELECT time, total FROM dumps ORDER BY DESC LIMIT 5";
 $exec = mysqli_query($con,$query);
 //while($row = mysqli_fetch_array($exec)){
 $row = mysqli_fetch_array($exec);
 echo $row;
            //echo "['".$row["time"]."', ".$row["total"]."],";
// }
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
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
<?php
    mysql_free_result($result);
mysql_close($dbconn);
echo "MYSQL_CLOSE Success: $rowcnt <br>";
 
/*footer code*/
include('footer.html');
?>
