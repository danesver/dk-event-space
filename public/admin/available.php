<?php include 'include/init.php'; ?>
<?php

     if (!isset($_SESSION['id'])) {
         redirect_to("../");
     }
     $users =  Availability::find_all();

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
            padding-top: 20px;
            padding-left:6px;
            /*padding-bottom:10px !important;*/
            margin-top:10px;
            text-transform: capitalize;
        }
        .datepicker {
            font-size: 12px;
        }
      
        div.dataTables_wrapper div.dataTables_paginate {
            font-size: 11px;
        }

    </style>
</head>

<body>

<?php include_once 'include/sidebar.php';  ?>


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h4 class="h4 mt-4 ml-3">Available Management</h4>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a class="btn btn-md btn-success" style="font-size: 12px;" href="available_add.php"><i class="mdi mdi-account-plus mr-2"></i> Add Available</a>
        </div>
    </div>
</div>
<?php
    if ($session->message()) {
        echo $session->message();
    }
?>

<!-- Month Filter Dropdown -->
<select id="monthFilter" class="form-control" style="width:200px; margin-bottom:10px;">
    <option value="">-- All Month --</option>
    <option value="January">January</option>
    <option value="February">February</option>
    <option value="March">March</option>
    <option value="April">April</option>
    <option value="May">May</option>
    <option value="June">June</option>
    <option value="July">July</option>
    <option value="August">August</option>
    <option value="September">September</option>
    <option value="October">October</option>
    <option value="November">November</option>
    <option value="December">December</option>
</select>

<table id="example" class="table table-striped table-hover table-bordered table-sm" cellspacing="0" width="100%" style="background: white;padding: 0 5px;">

    <thead>
        <tr>
             <th>Month</th>
            <th>Date</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Availability</th>
            <th>Actions</th>
        </tr>
    </thead>
    
    <tbody>

    <?php  foreach ($users as $user) : ?>
        
        <?php 
            if( $user->id == $_SESSION['id']) {
                continue;
            } 
        ?>

        <tr>
            <td class="special">
                 <?= date('F', strtotime($user->available_date)); ?>
            </td>
            <td class="special"> <?= $user->available_date; ?></td>
           <td class="special"> <?= $user->available_start_time; ?></td>
           <td class="special"> <?= $user->available_end_time; ?></td>
           <td class="special">Available</td>
            <td>
               <a href="available_edit.php?id=<?= $user->id; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="
                    Edit This Available"><i class="mdi mdi-pencil"></i></a>

                <a href="available_delete.php?id=<?= $user->id; ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete This Available"><i class="mdi mdi-delete"></i></a>
            </td>
        </tr>

    <?php endforeach; ?>


</main>
</div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery-3.2.1.slim.min.js"></script>
<script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="js/popper.min.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap4.min.js"></script>
<script>
$(document).ready(function() {
    var table = $('#example').DataTable();

    $('[data-toggle="tooltip"]').tooltip();

    // Custom month filter
    $('#monthFilter').on('change', function() {
        var selectedMonth = $(this).val(); // Get selected month
        
        if (selectedMonth) {
            // Apply search to the Month column (assuming it's the first column - 0)
            table.column(0).search('^' + selectedMonth + '$', true, false).draw();
        } else {
            // If no month selected, reset the filter
            table.column(0).search('').draw();
        }
    });
});
</script>


</body>
</html>
