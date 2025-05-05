<?php include 'include/init.php'; ?>
    <!-- Include jQuery (make sure it's loaded first) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Select2 CSS (stable version 4.0.13) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <!-- Include Select2 JS (stable version 4.0.13) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <style>
        select.form-control:not([size]):not([multiple]) {
            height: calc(2rem) !important;
        }
    </style>
<?php
    if (!isset($_SESSION['id'])) { redirect_to("../"); }

    
    $booking_detail =  Quotation::get_quotation_amount();
 	
 	
    if (isset($_POST['confirm'])) {



        if ($booking_detail) {

            foreach ($_POST['quotation_id'] as $key => $item) {
                $quotation_id = $item;
                $amountList = $_POST['quotation_amount']; 
                $booking_save =  Quotation::find_by_quotation_id($quotation_id);


                //$booking_save =  new Quotation();
                $booking_save->quotation_amount = $amountList[$key];
                


                $booking_save->update_quotation($quotation_id);
                $booking_save->save_quotation();

            }
           redirect_to("quotation.php");

            $session->message("
            <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-approval'></i></strong> {$account_detail->firstname} {$account_detail->lastname} has been successfully modify.
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
        <title>Edit Quotation Information - Administrator</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/dashboard.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdn.materialdesignicons.com/2.1.19/css/materialdesignicons.min.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
        <link rel="stylesheet" href="../css/bootstrap-datepicker.css">
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
        </style>
    </head>

<body>

<?php include_once 'include/sidebar.php'; ?>

    <div class="container">

        <div class="row">

            <div class="col-lg-8 offset-2 pl-3 pb-3 box-shadow mt-4">

                <form method="post" action="">

                    <h4 class="h4 mt-4 pb-2" style="border-bottom: 1px solid #dee2e6!important;">Quotation Information
						<a href="client.php" class="btn btn-sm btn-light float-right mr-2 active" style="font-size: 12px;">
							<span class="mdi mdi-arrow-left"></span> Back 
						</a>

                    </h4>
                    <table class="table table-striped table-bordered table-hover table-sm" cellspacing="0" width="100%" style="background: white;padding: 0 5px;">
                        <thead>
                            <tr>
                                <th>Sr</th>
                                <th>Type </th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sr_no = 1; // Initialize serial number ?>
                            <?php foreach ($booking_detail as $item) : ?>
                            <tr>
                                <td><?=$sr_no++;?></td> 
                                <td><?=$item->quotation_type;?>  - <?=$item->quotation_text;?></td>
                                <input type="hidden" name="quotation_id[]"  value="<?=$item->quotation_id;?>" placeholder="quotation_id">
                                <td><input type="number" name="quotation_amount[]"  value="<?=$item->quotation_amount;?>" placeholder="Amount"></td>
                            </tr>
                            <?php endforeach; ?>
                            
                        </tbody>
                    </table>
                   
                    <button type="submit" name="confirm" class="btn btn-sm btn-primary float-right mr-2" style="font-size: 12px;">
                    	<i class="mdi mdi-check mr-2"></i> Save
                    </button>
                </form><!-- end of input form -->
            </div>
        </div>
    </div>
</main>
</div>
</div>
<script>
var $jq = jQuery.noConflict();
$jq(document).ready(function() {
$jq('#special_requests').select2();
});
</script>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery-3.2.1.slim.min.js"></script>
<script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="js/popper.min.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="../js/bootstrap-datepicker.min.js"></script>
<script>
    $(document).ready(function() {
     //   $('#wedding_date').datepicker();
    });
</script>

<script>
    // jQuery to show the input field when "Others" is selected
    document.getElementById('no_of_guest').addEventListener('change', function() {
        var otherField = document.getElementById('other_guests_field');
        if (this.value === 'Others') {
            otherField.style.display = 'block'; // Show the input field
        } else {
            otherField.style.display = 'none'; // Hide the input field
        }
    });
</script>
</body>
</html>