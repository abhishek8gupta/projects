<?php
/* Your Database Name */
date_default_timezone_set("America/Los_Angeles");

$DB_NAME = 'I590';

/* Database Host */
$DB_HOST = '172.19.220.166';

/* Your Database User Name and Passowrd */
$DB_USER = 'abhigupt';
$DB_PASS = 'admin111';

  /* Establish the database connection */
  $mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
  }

  // $tablename = $_POST["name"];
  $tablename = 'la_airport_cargo_volume';

   /* select all the weekly tasks from the table googlechart */
  $result = $mysqli->query("SELECT * FROM $tablename where aircargotons != 0 order by dataextractdate, reportperiod DESC");

  $rows = array();
  $table = array();
  $table['cols'] = array(

    array('label' => 'dataextractdate', 'type' => 'string'),
    array('label' => 'reportperiod', 'type' => 'string'),
    array('label' => 'domestic_international', 'type' => 'string'),
    array('label' => 'cargotype', 'type' => 'string'),
    array('label' => 'aircargotons', 'type' => 'number')
    );
    /* Extract the information from $result */
    foreach($result as $r) {

      $temp = array();
      $temp[] = array('v' => (string) $r['dataextractdate']); 
      $temp[] = array('v' => (string) $r['reportperiod']); 
      $temp[] = array('v' => (string) $r['domestic_international']); 
      $temp[] = array('v' => (string) $r['cargotype']); 
      $temp[] = array('v' => (integer) $r['aircargotons']); 

      $rows[] = array('c' => $temp);
    }

$table['rows'] = $rows;

// convert data into JSON format
$jsonTable = json_encode($table);
//echo $jsonTable;


?>

<button type="button" onclick="history.back();">Back</button>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);

      function drawTable() {
        var data = new google.visualization.DataTable(<?=$jsonTable?>);

        var table = new google.visualization.Table(document.getElementById('table_div'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
      }
    </script>
  </head>
  <body>
    <div id="table_div"></div>
  </body>
</html>



