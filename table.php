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
      google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);

      function drawTable() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Domain Name');
        data.addColumn('number', 'Total Packets');
        data.addColumn('percentage', 'Ratio');
        data.addRows([
        <?php 
        $exec = mysql_query("SELECT SUM(ip_count) AS ip_count, dns_root AS dns FROM dump_info GROUP BY dns_root ORDER BY SUM(ip_count) DESC LIMIT 6;"); 
            
        if (!$exec) {
          die("Database query failed: " . mysql_error());
        } 
 
        while($row = mysql_fetch_array($exec)){
          echo "['".$row["dns"]."', ".$row["ip_count"].", ".$row["ratio"]." ],";
        }
      ?>
        ]);

        var table = new google.visualization.Table(document.getElementById('table_div'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
      }
    </script>
  </head>
  <body>
    <div id="table_div"></div>
  </body>
</html>

<html>
<head>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js">
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
