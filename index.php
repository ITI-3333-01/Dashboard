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
/*Pie CHART*/
//include the library
    include "libchart/libchart/classes/libchart.php";
 
    //new pie chart instance
    $chart = new PieChart( 500, 300 );
 
    //data set instance
    $dataSet = new XYDataSet();
    
    //actual data
    //get data from the database
    
    //include database connection
    include 'db_connect.php';
 
    //query all records from the database
    $query = "select * from dumps";
 
    //execute the query
    $result = $mysqli->query( $query );
 
    //get number of rows returned
    $num_results = $result->num_rows;
 
    if( $num_results > 0){
    
        while( $row = $result->fetch_assoc() ){
            extract($row);
            $dataSet->addPoint(new Point("{$error} {$total})", $total));
        }
    
        //finalize dataset
        $chart->setDataSet($dataSet);
 
        //set chart title
        $chart->setTitle("Pie Chart test");
        
        //render as an image and store under "generated" folder
        $chart->render("testpie/1.png");
    
        //pull the generated chart where it was stored
        echo "<img alt='Pie chart'  src='testpie/1.png' style='border: 1px solid gray;'/>";
    
    }else{
        echo "No programming languages found in the database.";
    }
/*footer code*/
include('footer.html');
?>
