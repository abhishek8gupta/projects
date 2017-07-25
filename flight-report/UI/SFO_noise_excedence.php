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
  $tablename = 'SFO_noise_excedence';

   /* select all the weekly tasks from the table googlechart */
  $result = $mysqli->query("SELECT * FROM $tablename order by year DESC");

  $rows = array();
  $table = array();
  $table['cols'] = array(
      array('label' => 'year', 'type' => 'string'),
      array('label' => 'month', 'type' => 'string'),
      array('label' => 'airline_code', 'type' => 'string'),
      array('label' => 'airline', 'type' => 'string'),
      array('label' => 'total_noise_exceedances', 'type' => 'number'),
      array('label' => 'total_operations_per_month', 'type' => 'number'),
      array('label' => 'exceedances_per_1000_operations', 'type' => 'number'),
      array('label' => 'noise_exceedance_quality_rating_score', 'type' => 'string')
    );
    /* Extract the information from $result */
    foreach($result as $r) {
      $temp = array();
      $temp[] = array('v' => (integer) $r['year']); 
      $temp[] = array('v' => (string) $r['month']); 
      $temp[] = array('v' => (string) $r['airline_code']); 
      $temp[] = array('v' => (string) $r['airline']);
      $temp[] = array('v' => (integer) $r['total_noise_exceedances']); 
      $temp[] = array('v' => (integer) $r['total_operations_per_month']); 
      $temp[] = array('v' => (integer) $r['exceedances_per_1000_operations']); 
      $temp[] = array('v' => (string) $r['noise_exceedance_quality_rating_score']);      

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



