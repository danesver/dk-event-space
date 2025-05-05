<?php include 'include/init.php'; ?>
<script src="https://code.highcharts.com/stock/highstock.js"></script>

<?php
     if (!isset($_SESSION['id'])) {
         redirect_to("../");
     }

    $event_completed =  Booking::count_completed();
    $upcoming_event =  Booking::count_booking();
    $upcoming_site_visit =  Booking::count_upomming_visit();
    $event_post =  EventWedding::count_all();


    // SQL query to fetch wedding types and booking count
    /*$sql = "SELECT wedding_type, COUNT(*) as booking_count FROM tblweddingbook GROUP BY wedding_type";
    $result = $db->query($sql);

    // Prepare data for Highcharts
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = ["name" => $row['wedding_type'], "y" => (int)$row['booking_count']];
    }*/

    // Fetch data from the database
    $sql = "SELECT wedding_type, wedding_status, COUNT(*) as booking_count 
    FROM tblweddingbook 
    
    GROUP BY wedding_type, wedding_status";
    $result = $db->query($sql);

    // Prepare data for Highcharts
    $data = [];
    $categories = []; // Store unique wedding types
    $seriesData = []; // Store wedding status-wise data

    while ($row = $result->fetch_assoc()) {
        $categories[$row['wedding_type']] = true; // Store unique wedding types
        $data[$row['wedding_status']][] = [
        "name" => $row['wedding_type'], 
        "y" => (int)$row['booking_count']
        ];
    }

    // Convert wedding types to an array
    $categories = array_keys($categories);

    // Prepare series data (stacked bars)
    $series = [];
    foreach ($data as $status => $values) {
        $series[] = [
        "name" => $status,
        "data" => array_map(function ($type) use ($values) {
            foreach ($values as $value) {
                if ($value["name"] === $type) {
                    return $value["y"];
                }
            }
            return 0; // Default to 0 if no data for this category
        }, $categories),
        "stack" => "events" // Group all statuses under one stack
        ];
    }



   // SQL Query to fetch data: month vs revenue
$sql = "SELECT DATE_FORMAT(wedding_date, '%Y-%m') AS month, SUM(amount) AS revenue
  FROM tblweddingbook
  GROUP BY month
  ORDER BY month";
  $result = $db->query($sql);

  // Initialize arrays for Highcharts
  $months = [];
  $revenues = [];

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Convert "YYYY-MM" to a timestamp in milliseconds
        $timestamp = strtotime($row['month'] . '-01') * 1000;
        $revenue = (int) $row['revenue'];

        // Store as [timestamp, revenue] for Highstock
        $revenueChart[] = [$timestamp, $revenue];
    }
}


  // SQL Query to fetch data: date vs number of bookings
  $sql = "SELECT wedding_date, COUNT(*) AS num_bookings
        FROM tblweddingbook
        WHERE wedding_status = 'Confirm Booking'
        GROUP BY wedding_date
        ORDER BY wedding_date";
  $result = $db->query($sql);

  // Initialize arrays for Highcharts
  $dates = [];
  $bookings = [];

  if ($result->num_rows > 0) {
    // Fetch data and populate arrays
    while($row = $result->fetch_assoc()) {
      $dates[] = $row['wedding_date'];
      $bookings[] = (int) $row['num_bookings'];
    }
  }


  // SQL Query to fetch data: day vs number of visits
  /*$sql = "SELECT visit_date, COUNT(*) AS num_visits
  FROM tblpageviews
  GROUP BY visit_date
  ORDER BY visit_date";
  $result = $db->query($sql);

  // Initialize arrays for Highcharts
  $dates = [];
  $visits = [];

  if ($result->num_rows > 0) {
  // Fetch data and populate arrays
  while($row = $result->fetch_assoc()) {
    $dates[] = $row['visit_date'];
    $visits[] = (int) $row['num_visits'];
    }
  }*/

  // Fetch counts from the database
    $sql = "
    SELECT 
        (SELECT COUNT(*) FROM users) AS total_users,
        (SELECT COUNT(*) FROM tblweddingbook WHERE wedding_status = 'Confirm Booking') AS confirmed_bookings,
        (SELECT COUNT(*) FROM tblweddingbook WHERE wedding_status = 'Confirm Visit') AS confirmed_visits
    ";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();

    // Prepare data for Highcharts
    $pieCharts = [
    ["name" => "Total Users", "y" => (int)$row['total_users']],
    ["name" => "Confirmed Bookings", "y" => (int)$row['confirmed_bookings']],
    ["name" => "Confirmed Visits", "y" => (int)$row['confirmed_visits']]
    ];
?>
<?php $users_profile = Users::find_by_id($_SESSION['id']); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard - Administrator</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
    <link href="css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.min.css">
<!--    <link href="css/bootstrap.css" rel="stylesheet">-->
    <link rel="stylesheet" type="text/css"
          href="https://cdn.materialdesignicons.com/2.1.19/css/materialdesignicons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
    <style>
        table.table.table-striped.table-bordered.table-sm {
            font-size:12px;
        }
        .tooltip {
            font-size: 12px;
        }

        td.special {
            padding: 0;
            padding-top: 8px;
            padding-left:6px;
            padding-bottom:6px;
            margin-top:5px;
            text-transform: capitalize;
        }
        .datepicker {
            font-size: 12px;
        }
        .alert-success {
            color: #fff;
            background-color: #49C8AE;
            border-color: none;
        }
        div.dataTables_wrapper div.dataTables_paginate {
            font-size: 11px;
        }

        .card-counter{
    box-shadow: 2px 2px 10px #DADADA;
    margin: 5px;
    padding: 0px 9px;
    background-color: #fff;
    height: 100px;
    border-radius: 5px;
    transition: .3s linear all;
  }

  .card-counter:hover{
    box-shadow: 4px 4px 20px #DADADA;
    transition: .3s linear all;
  }

  .card-counter.primary{
    background-color: #007bff;
    color: #FFF;
  }

  .card-counter.danger{
    background-color: #ef5350;
    color: #FFF;
  }  

  .card-counter.success{
    background-color: #66bb6a;
    color: #FFF;
  }  

  .card-counter.info{
    background-color: #26c6da;
    color: #FFF;
  }  

  .card-counter i{
    font-size: 5em;
    opacity: 0.9;
  }

  .card-counter .count-numbers{
    position: absolute;
    right: 35px;
    top: 20px;
    font-size: 32px;
    display: block;
  }

  .card-counter .count-name{
    position: absolute;
    right: 35px;
    top: 65px;
    text-transform: capitalize;
    opacity: 0.8;
    display: block;
    font-size: 16px;
  }

    </style>
</head>

<body>

<?php include_once 'include/sidebar.php'; ?>


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h4 class="h4 mt-4">WELCOME, <?= ucfirst($users_profile->firstname) . ' ' . ucfirst($users_profile->lastname); ?></h4>
</div>
<!-- <div class="row">
    <div class="col-lg-3">
        <div class="card bg-light mb-3" style="max-width: 18rem;">
            <div class="card-header">TOTAL CUSTOMERS</div>
            
                <div class="card-body">
                <h5 class="card-title"><?=  $user_count; ?></h5>
                    <p class="card-text"></p>
               </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="card bg-light mb-3" style="max-width: 18rem;">
            <div class="card-header">TOTAL BOOKING</div>
                <div class="card-body">
                <h5 class="card-title"><?=  $booking_count; ?></h5>
                    <p class="card-text"></p>
               </div>
        </div>
    </div>
       

    <div class="col-lg-3">
        <div class="card bg-light mb-3" style="max-width: 18rem;">
            <div class="card-header">TOTAL PHOTOS</div>
                <div class="card-body">
                <h5 class="card-title"><?=  $gallery_count; ?></h5>
                    <p class="card-text"></p>
                </div>
        </div>
    </div>
       

    <div class="col-lg-3">
        <div class="card bg-light mb-3" style="max-width: 18rem;">
            <div class="card-header">TOTAL BLOGS</div>
                <div class="card-body">
                <h5 class="card-title"><?=  $event_post; ?></h5>
                    <p class="card-text"></p>
               </div>
        </div>
    </div>
       
       
    
</div> -->

    <div class="row">
    <div class="col-lg-4">
      <div class="card-counter primary">
        <i class="mdi mdi-account-multiple"></i>
        <span class="count-numbers"><?=  $event_completed; ?></span>
        <span class="count-name">Events Completed</span>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card-counter success">
        <i class="mdi mdi-book-open-page-variant"></i>
        <span class="count-numbers"><?=  $upcoming_event; ?></span>
        <span class="count-name">Upcoming Events</span>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card-counter danger">
        <i class="mdi mdi-image-multiple"></i>
        <span class="count-numbers"><?=  $upcoming_site_visit; ?></span>
        <span class="count-name">Upcoming Site Visit</span>
      </div>
    </div>

  </div>

  <div class="row mb-20" style="margin-top: 20px;">
    <div class="col-lg-12">
      <div id="container"></div>
    </div>
  </div>

  <div class="row mt-10" style="margin-top: 20px;">
    <div class="col-lg-12">
      <div id="monthly-revenue"></div>
    </div>
  </div>

  <div class="row mt-10" style="margin-top: 20px;">
    <div class="col-lg-6">
      <div id="date-wise-booking"></div>
    </div>
    <div class="col-lg-6">
      <div id="container-pie"></div>
    </div>
  </div>



<?php include_once 'include/footer.php';?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<script>
      /*  document.addEventListener('DOMContentLoaded', function () {
            var chart = Highcharts.chart('visitor-data', {
                chart: {
                    type: 'line'  // Change to 'bar' for bar chart
                },
                title: {
                    text: 'Number of Page Visits per Day'
                },
                xAxis: {
                    categories: <?php echo json_encode($dates); ?>,
                    title: {
                        text: 'Date'
                    }
                },
                yAxis: {
                    title: {
                        text: 'Number of Visits'
                    }
                },
                series: [{
                    name: 'Visits',
                    data: <?php echo json_encode($visits); ?>
                }]
            });
        });*/
    </script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var chart = Highcharts.chart('date-wise-booking', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Confirmed Event by Day'
                },
                xAxis: {
                    categories: <?php echo json_encode($dates); ?>,
                    title: {
                        text: 'Event Date'
                    }
                },
                yAxis: {
                    title: {
                        text: 'Number of Bookings'
                    }
                },
                series: [{
                    name: 'Bookings',
                    data: <?php echo json_encode($bookings); ?>
                }]
            });
        });
</script>



<script>

console.log(<?php echo json_encode($data); ?>);
   document.addEventListener('DOMContentLoaded', function () {
    var chart = Highcharts.stockChart('monthly-revenue', { // Use Highstock instead of Highcharts
        chart: {
            type: 'spline'
        },
        rangeSelector: {
            enabled: true, // Enables range selector
            selected: 1 // Default selection (e.g., 6 months)
        },
        title: {
            text: 'Monthly Revenue from Events'
        },
        xAxis: {
            type: 'datetime', // Important: Use datetime for proper formatting
            labels: {
                format: '{value:%Y-%m}', // Display as YYYY-MM
                rotation: -45
            },
            scrollbar: {
                enabled: true
            }
        },
         yAxis: {
                    title: {
                text: 'Revenue (in $)'
            }
        },
        series: [{
            name: 'Revenue',
            data: <?php echo json_encode($revenueChart); ?>, // Use timestamp-based data
            tooltip: {
                valuePrefix: '$',
                xDateFormat: '%Y-%m' // Display dates correctly in tooltip
            }
        }]
    });
});


</script>


<script type="text/javascript">
    // Data from PHP
    var categories = <?php echo json_encode($categories); ?>;
    var series = <?php echo json_encode($series); ?>;

    // Create Highcharts stacked bar chart
    Highcharts.chart('container', {
        chart: {
            type: 'column' // Stacked column chart
        },
        title: {
            text: 'Total Events by Type and Status'
        },
        xAxis: {
            categories: categories, // Wedding types
            title: {
                text: 'Wedding Type'
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Number of Bookings'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold'
                }
            }
        },
        legend: {
            align: 'right',
            verticalAlign: 'top',
            floating: true,
            backgroundColor: '#FFFFFF',
            borderWidth: 1
        },
        tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true
                }
            }
        },
        series: series
    });
</script>

<script type="text/javascript">
    // Data from PHP
    var chartData = <?php echo json_encode($pieCharts); ?>;

    // Create Highcharts Pie Chart
    Highcharts.chart('container-pie', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'User and Booking Statistics'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y}</b> ({point.percentage:.1f}%)'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.y} ({point.percentage:.1f}%)'
                }
            }
        },
        series: [{
            name: 'Count',
            colorByPoint: true,
            data: chartData
        }]
    });
</script>