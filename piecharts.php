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
  <h1 style="text-align:center"><br>Pie Charts</h1>
    <h3 style="text-align:center">This pie charts represents the ratio of the top 6 website visited in the last hour and in the last 7 days <br><br> </h2>
    
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Domain', 'Total Packets'],
      <?php 
        $exec = mysql_query("SELECT SUM(ip_count) AS ip_count, dns_root AS dns FROM dump_info WHERE time > DATE_SUB(now(), INTERVAL 1 hour) GROUP BY dns_root ORDER BY SUM(ip_count) DESC LIMIT 6;");
            
        if (!$exec) {
          die("Database query failed: " . mysql_error());
        }
        while($row = mysql_fetch_array($exec)){
          echo "['".$row["dns"]."', ".$row["ip_count"]."],";
        }
      ?>
      ]);

      var piechart_options = {title:'Total packets by time (Last Hour)',width:600, height:650};
      var piechart = new google.visualization.PieChart(document.getElementById('piechart_div'));
      piechart.draw(data, piechart_options);
      }
</script>

<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Domain', 'Total Packets'],
      <?php 
        $exec = mysql_query("SELECT SUM(ip_count) AS ip_count, dns_root AS dns FROM dump_info GROUP BY dns_root ORDER BY SUM(ip_count) DESC LIMIT 6;"); 
            
        if (!$exec) {
          die("Database query failed: " . mysql_error());
        } 
 
        while($row = mysql_fetch_array($exec)){
          echo "['".$row["dns"]."', ".$row["ip_count"]."],";
        }
      ?>
      ]);

      var piechart_options = {title:'Total packets (Last 7 days)',width:600, height:650};
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
  include('footer.html');
?>
