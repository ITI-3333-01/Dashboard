<?php
// Connecting, selecting database
$link = mysql_connect('mysql_host', 'mysql_user', 'mysql_password')
    or die('Could not connect: ' . mysql_error());

mysql_select_db('my_database') or die('Could not select database');

// Performing SQL query
$query = 
'SELECT total, time FROM `dumps` group by time ORDER BY total DESC LIMIT 5';
$result = mysql_query($query) or die('Query failed: ' . mysql_error());

// Printing results inside an HTML infographic tag
echo "<infographic-piechart  width='300'  height='300'>\n";
echo "<infographic-data>\n";
while ($row = mysql_fetch_array($result)) {
    echo "<infographic-pieslice value='" . 
         $row['total'] . "'>" . 
         $row['time'] . 
         "</infographic-pieslice>\n";
}
echo "<infographic-data>\n";
echo "</infographic-piechart>\n";

// Free resultset
mysql_free_result($result);

// Closing connection
mysql_close($link);
?>
