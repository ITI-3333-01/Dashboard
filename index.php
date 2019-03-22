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
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Domain', 'Total Packets'],
        <?php 
            /*$exec = mysql_query("SELECT ip_count,dns WHERE time >DATE_SUB(CURDATE(), INTERVAL 1 hour) FROM dump_info ORDER BY ip_count DESC LIMIT 6;")
*/$exec = mysql_query("SELECT ip_count,dns FROM dump_info WHERE time >DATE_SUB(CURRENT_TIMESTAMP(), INTERVAL 1 minute) ORDER BY ip_count DESC LIMIT 6;");
            
               if (!$exec) {
    die("Database query failed: " . mysql_error());
}
 
/* $row = mysql_fetch_array($exec);
             if (!$row) {
    die("Database fetch failed: " . mysql_error());
}*/
  while($row = mysql_fetch_array($exec)){
    echo "['".$row["dns"]."', ".$row["ip_count"]."],";
  }
 ?>
        ]);
          var piechart_options = {title:'Total packets by time (Last Hour)',
                       width:700,
                       height:500};
        var piechart = new google.visualization.PieChart(document.getElementById('piechart_div'));
        piechart.draw(data, piechart_options);
        /*var options = {
          title: 'Total packets by time'
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);*/
      }
        
        //Second pie chart
    </script>
        <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Domain', 'Total Packets'],
        <?php 
$exec = mysql_query("SELECT ip_count,dns FROM dump_info ORDER BY ip_count DESC LIMIT 6;"); 
            
               if (!$exec) {
    die("Database query failed: " . mysql_error());
} 
 
/* $row = mysql_fetch_array($exec);
             if (!$row) {
    die("Database fetch failed: " . mysql_error());
}*/
  while($row = mysql_fetch_array($exec)){
  echo "['".$row["dns"]."', ".$row["ip_count"]."],";
  }
 ?>
        ]);
        var piechart_options = {title:'Total packets (All Time)',
                       width:700,
                       height:500};
        var piechart = new google.visualization.PieChart(document.getElementById('piechart_two_div'));
        piechart.draw(data, piechart_options);  
        
      }
                </script>
  </head>
  <body>
  <table class="columns">
      <tr>
        <td><div id="piechart_div" style="border: 1px solid #ccc"></div></td>
        <td><div id="piechart_two_div" style="border: 1px solid #ccc"></div></td>
      </tr>
    </table>
  </body>
<?php
    mysql_free_result($result);
mysql_close($dbconn);
/*footer code*/
include('footer.html');
?>
