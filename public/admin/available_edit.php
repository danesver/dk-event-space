<?php include 'include/init.php'; ?>
<?php


    if (!isset($_SESSION['id'])) { redirect_to("../"); }

    $users = Availability::find_by_id($_GET['id']);

    if (isset($_POST['submit'])) {
        // Clean and retrieve data from the form
        $available_date_range = clean($_POST['available_date_range']);
        $available_start_time = clean($_POST['available_start_time']);
        $available_end_time = clean($_POST['available_end_time']);
        $not_available_dates_input = clean($_POST['dates']); // Get not available dates (comma-separated)
    
        
        
    
        // Create a DateTime object from the selected month (using the first day of the month)
        $start_date = new DateTime($available_date_range . "-01");
        $end_date = clone $start_date;
        $end_date->modify('first day of next month')->modify('-1 day');  // Get last day of the selected month
    
        // Loop through all the days of the selected month
        $current_date = $start_date;

         

        if ($users) {
             $users->available_date = $not_available_dates_input;  // Store full date
            $users->available_start_time = $available_start_time;
            $users->available_end_time = $available_end_time;
            $users->save();
              redirect_to("available.php");
              $session->message("
                <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                  <strong><i class='mdi mdi-check'></i></strong>Availability {$users->available_date} is successfully updated.
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                  </button>
                </div>");
            
        }
    }
?>
<?php $users_profile = Users::find_by_id($_SESSION['id']); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add New User - Administrator</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.materialdesignicons.com/2.1.19/css/materialdesignicons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="../css/bootstrap-datepicker.css">
     <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/style.css">
    <style>
        body {
            margin-bottom: 2%;
        }
        .box-shadow {
            box-shadow: 0 0 2px 1px rgba(0, 0, 0, 0.3);
            font-size: 12px;
        }
        .form-control {
            font-size: 12px;
        }
        .datepicker {
            font-size: 12px;
        }
        .custom-file-label {
            color: #212529;
        }
    </style>
</head>

<body>

<?php include_once 'include/sidebar.php'; ?>

<div class="container">

    <div class="row">

        <div class="col-lg-8 offset-2 pl-3 pb-3 box-shadow mt-4">
        
            <form method="post" action="" enctype="multipart/form-data">
            
                <h6 class="h6 mt-4 pb-2" style="border-bottom: 1px solid #dee2e6!important;">Edit Available Information
                    <a href="available.php" class="btn btn-sm btn-danger float-right" style="font-size: 12px;"><i class="mdi mdi-close-circle mr-2"></i> Cancel</a>

                    <button type="submit" name="submit" class="btn btn-sm btn-success float-right mr-2" style="font-size: 12px;"><i class="mdi mdi-account-plus mr-2"></i> Edit Available</button>
                </h6>

                <?php
                    if ($session->message()) {
                        echo ' <div class="form-group col-md-12">' . $session->message() . '</div>';
                    }
                ?>

                <div class="form-group" style="display:none;">
                    <label for="inputEmail">Available Month:</label>
                        
                        <input type="text" name="available_date_range" class="form-control" id="multiMonthPicker" placeholder="Pick months" value="<?= $users->available_date; ?>">

                </div>
                <div class="form-group">
                    <label for="inputEmail">Available Date</label>
                         <input type="date" name="dates" id="dates" class="form-control"  placeholder="Select Available Date"  value="<?= $users->available_date; ?>"/>

                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputFirstname">Available Start Time:</label> 
                        <input type="time" name="available_start_time" class="form-control" id="inputFirstname" value="<?= $users->available_start_time; ?>" placeholder="Enter Available Start Time">
                    </div>
                   <div class="form-group col-md-6">
                        <label for="inputLastname">Available End Time:</label>
                        <input type="time" name="available_end_time" class="form-control" id="inputLastname" value="<?= $users->available_end_time; ?>" placeholder="Enter Available End Time">
                    </div>
                   
                </div>

                  
            </form><!-- end of input form -->
        </div>
    </div>
</div>



<?php include_once 'include/footer.php';?>




<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery-3.2.1.slim.min.js"></script>
<script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="js/popper.min.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/moment@2/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/index.js"></script>

<script>
    let selectedMonths = [];

    // Initialize multi-month picker
    flatpickr("#multiMonthPicker", {
        mode: "multiple",
        plugins: [
            new monthSelectPlugin({
                shorthand: true,
                dateFormat: "Y-m",  // Example: 2025-04
                altFormat: "F Y",
                altInput: true
            })
        ],
        onChange: function(selectedDates, dateStr, instance) {
            // Store selected months (format YYYY-MM)
            selectedMonths = selectedDates.map(date => {
                const year = date.getFullYear();
                const month = ('0' + (date.getMonth() + 1)).slice(-2); // Add leading zero
                return `${year}-${month}`;
            });
            // When months change, reset dates picker input
            $('#dates').val('');
        }
    });

    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();

        $('#dates').daterangepicker({
            singleDatePicker: true,
            showDropdowns: false,
            autoUpdateInput: false,
            isInvalidDate: function(date) {
                if (selectedMonths.length === 0) {
                    return false; // If no month selected, allow all dates
                }
                const yearMonth = date.format('YYYY-MM');
                return !selectedMonths.includes(yearMonth); // Disable dates outside selected months
            }
        }, function(start) {
            $('#dates').val(start.format('YYYY-MM-DD'));
        });
    });
</script>

