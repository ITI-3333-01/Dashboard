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
$result = mysql_query("SELECT * FROM dumps WHERE time >DATE_SUB(CURDATE(), INTERVAL 1 hour) ORDER BY total DESC LIMIT 5;"); 
/**/
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
mysql_free_result($result);
mysql_close($dbconn);
echo "MYSQL_CLOSE Success: $rowcnt <br>";
/*footer code*/
include('footer.html');
?>
