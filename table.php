<?php 
 include('header.html');
?>
<!DOCTYPE html>
<html>
<body>

<h2>Number Field</h2>
<p>The <strong>input type="number"</strong> defines a numeric input field.</p>
<p>You can use the min and max attributes to add numeric restrictions in the input field:</p>

<form action="/piecharts.php" method="get">
  Quantity (between 1 and 5):
  <input type="number" name="qtyy" id="qtyy" min="1" max="5">
  <input type="submit">
</form>

<p><b>Note:</b> type="number" is not supported in IE9 and earlier.</p>

</body>
</html>

<?php
  $page = $_SERVER['PHP_SELF'];
  $sec = "60";
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
    <h1 style="text-align:center"><br>Tables</h1>
    <h3 style="text-align:center">This table represents the top 6 visited websites and the amount of data that has been sent/received by this website <br><br> </h2>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);

      function drawTable() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Domain Name');
        data.addColumn('number', 'Total Packets');
     //   data.addColumn('number', 'Ratio (%)');
        data.addRows([
        <?php 
        $exec = mysql_query("SELECT SUM(ip_count) AS ip_count, dns_root AS dns FROM dump_info GROUP BY dns_root ORDER BY SUM(ip_count) DESC LIMIT 6;"); 
            
        if (!$exec) {
          die("Database query failed: " . mysql_error());
        } 
 
        while($row = mysql_fetch_array($exec)){
          echo "['".$row["dns"]."', ".$row["ip_count"].",],";
        }
      ?>
        ]);

        var table = new google.visualization.Table(document.getElementById('table_div'));

        table.draw(data, {showRowNumber: true, width: '80%', height: '80%'});
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
