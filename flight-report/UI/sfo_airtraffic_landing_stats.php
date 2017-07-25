<?php
/* Your Database Name */
date_default_timezone_set("America/Los_Angeles");
ini_set('memory_limit', '-1');

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
  $tablename = 'sfo_airtraffic_landing_stats';

   /* select all the weekly tasks from the table googlechart */
  $result = $mysqli->query("SELECT * FROM $tablename order by activity_period DESC");

  $rows = array();
  $table = array();
  $table['cols'] = array(
      array('label' => 'activity_period', 'type' => 'string'),
      array('label' => 'operating_airline', 'type' => 'string'),
      array('label' => 'operating_airline_iata_code', 'type' => 'string'),
      array('label' => 'published_airline', 'type' => 'string'),
      array('label' => 'arrival_departure', 'type' => 'string'),
      array('label' => 'published_airline_iata_code', 'type' => 'string'),
      array('label' => 'geo_summary', 'type' => 'string'),
      array('label' => 'geo_region', 'type' => 'string'),
      array('label' => 'landing_aircraft_type', 'type' => 'string'),
      array('label' => 'aircraft_body_type', 'type' => 'string'),
      array('label' => 'aircraft_manufacturer', 'type' => 'string'),
      array('label' => 'aircraft_model', 'type' => 'string'),
      array('label' => 'aircraft_version', 'type' => 'string'),
      array('label' => 'landing_count', 'type' => 'number'),
      array('label' => 'total_landed_weight', 'type' => 'number')
    );
    /* Extract the information from $result */
    foreach($result as $r) {
      $temp = array();
      $temp[] = array('v' => (string) $r['activity_period']); 
      $temp[] = array('v' => (string) $r['operating_airline']); 
      $temp[] = array('v' => (string) $r['operating_airline_iata_code']);
      $temp[] = array('v' => (string) $r['published_airline']);  
      $temp[] = array('v' => (string) $r['arrival_departure']); 
      $temp[] = array('v' => (string) $r['published_airline_iata_code']); 
      $temp[] = array('v' => (string) $r['geo_summary']); 
      $temp[] = array('v' => (string) $r['landing_aircraft_type']); 
      $temp[] = array('v' => (string) $r['aircraft_body_type']); 
      $temp[] = array('v' => (string) $r['aircraft_manufacturer']); 
      $temp[] = array('v' => (string) $r['aircraft_model']); 
      $temp[] = array('v' => (string) $r['aircraft_version']); 
      $temp[] = array('v' => (integer) $r['landing_count']); 
      $temp[] = array('v' => (integer) $r['total_landed_weight']);      

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



