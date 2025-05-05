<?php include 'include/init.php'; ?>
<?php
     if (!isset($_SESSION['id'])) {
         redirect_to("../");
     }
     $booking =  Booking::getPendingBooking();
     $confrimVisit =  Booking::getConfrimVistBooking();
     $booking_pending =  Booking::pendingBooking();
     $booking_confirm =  Booking::ConfirmedBooking();
     $booking_cancel =  Booking::CancelBooking();
     
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
        body {
            margin-bottom: 3%;
        }
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
      
        div.dataTables_wrapper div.dataTables_paginate {
            font-size: 11px;
        }

        .btn.btn-sm.btn-light.active:hover {
            background: white;
        }

    </style>
    <style>
        

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
    font-size: 2em;
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

<div class="row" style="justify-content: center; margin-top: 20px;">
    <div class="col-lg-2" onclick="showDIv(1);">
      <div class="card-counter primary">
        <i class="mdi mdi-account-multiple"></i>
        <span class="count-numbers"><?php echo count($booking);?></span>
        <span class="count-name">Pending Visit</span>
      </div>
    </div>
    <div class="col-lg-2"  onclick="showDIv(2);">
      <div class="card-counter success">
        <i class="mdi mdi-account-multiple"></i>
        <span class="count-numbers"><?php echo count($confrimVisit);?></span>
        <span class="count-name">Confirm Visit</span>
      </div>
    </div>
    <div class="col-lg-2" onclick="showDIv(3);">
      <div class="card-counter info">
        <i class="mdi mdi-account-multiple"></i>
        <span class="count-numbers"><?php echo count($booking_pending);?></span>
        <span class="count-name">Pending Booking</span>
      </div>
    </div>
    <div class="col-lg-2" onclick="showDIv(4);">
      <div class="card-counter primary">
        <i class="mdi mdi-account-multiple"></i>
        <span class="count-numbers"><?php echo count($booking_confirm);?></span>
        <span class="count-name">Confirm Booking</span>
      </div>
    </div>
    <div class="col-lg-2" onclick="showDIv(5);">
      <div class="card-counter danger">
        <i class="mdi mdi-account-multiple"></i>
        <span class="count-numbers"><?php echo count($booking_cancel);?></span>
        <span class="count-name">Cancelled</span>
      </div>
    </div>
</div>

<?php
    if ($session->message()) {
        echo $session->message();
    }
?>
<div id="pending-div">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h6 class="h4 mt-4 ml-3">Pending Vist</h6>
        <div class="btn-toolbar mb-md-0">
            <div class="btn-group mr-2">
                <a class="btn btn-md btn-success" style="font-size: 12px;" href="client_add.php"><i class="mdi mdi-account-plus mr-2"></i> Add New Client</a>
            </div>
        </div>
    </div>
    <table id="pending" class="table table-striped table-bordered table-hover table-sm" cellspacing="0" width="100%" style="background: white;padding: 0 5px;">

        <thead>
            <tr>
                <th>Full Name</th>
                <th>Phone </th>
                <th>Email</th>
                <th>Event Type</th>
                <th>Event Date</th>            
                <th>Event Slot</th>
                <th>Visit Date & Time</th>
                <th>Status</th>
                <th>Quotation</th>
                <th>Tools</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($booking as $bookWedding) : ?>
            
            <tr>
                
                <td class=""><?= $bookWedding->firstname . ' ' . $bookWedding->lastname;?></td>
            
                <td class="">
                    <?= (empty($bookWedding->phone)) ?  '-' :  $bookWedding->phone; ?>
                </td>
                
                <td class=""><?= (empty($bookWedding->user_email)) ?  '-' :  $bookWedding->user_email; ?></td>
                
                <td class=""><?= $bookWedding->wedding_type; ?></td>
                

                <td class=""><?= (empty($bookWedding->wedding_date)) ?  'N/A' :  $bookWedding->wedding_date; ?></td>
                <td class=""> <?= $bookWedding->event_slot; ?></td>
                <td class=""> <?= $bookWedding->visit_date; ?> <?= $bookWedding->visit_time; ?></td>
                <td class=""> <?= $bookWedding->wedding_status; ?></td>
                <td class="">
                    <?php if($bookWedding->pdf){?>
                        <a  href="<?='https://test.muhammadamirzia.com/ultratesting/public/'.$bookWedding->pdf;?>" target='_blank' >View</a>
                    <?php } ?>
                </td>
            
                <td>

                    <a href="client_assign.php?booking=<?= $bookWedding->booking_id; ?>&user_id=<?= $bookWedding->user_id; ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Assign user to weddings"><i class="mdi mdi-clipboard-account"></i></a>

                </td>
            </tr>

        <?php endforeach; ?>
    </tbody>
    </table>
</div>

<div id="confirm-div" style="display:none;">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h6 class="h4 mt-4 ml-3">Confirmed Visit</h6>
        <div class="btn-toolbar mb-md-0">
            <div class="btn-group mr-2">
                <a class="btn btn-md btn-success" style="font-size: 12px;" href="client_add.php"><i class="mdi mdi-account-plus mr-2"></i> Add New Client</a>
            </div>
        </div>
    </div>
    <table id="confirmedVisit" class="table table-striped table-hover table-bordered table-sm" cellspacing="0" width="100%" style="background: white;padding: 0 5px;">

        <thead>
            <tr>
                <th>Full Name</th>
                <th>Phone </th>
                <th>Email</th>
                <th>Event Type</th>
                <th>Event Date</th>            
                <th>Event Slot</th>
                <th>Visit Date & Time</th>
                <th>Status</th>
                <th>Quotation</th>
                <th>Tools</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($confrimVisit as $booking_confirm_row) : ?>
            
            <tr>
                
                <td class=""><?= $booking_confirm_row->firstname . ' ' . $booking_confirm_row->lastname;?></td>
            
                <td class="">
                    <?= (empty($booking_confirm_row->phone)) ?  '-' :  $booking_confirm_row->phone; ?>
                </td>
                
                <td class=""><?= (empty($booking_confirm_row->user_email)) ?  '-' :  $booking_confirm_row->user_email; ?></td>
                
                <td class=""><?= $booking_confirm_row->wedding_type; ?></td>
                

                <td class=""><?= (empty($booking_confirm_row->wedding_date)) ?  'N/A' :  $booking_confirm_row->wedding_date; ?></td>
                <td class=""> <?= $booking_confirm_row->event_slot; ?></td>
                <td class=""> <?= $booking_confirm_row->visit_date; ?> <?= $booking_confirm_row->visit_time; ?></td>
                <td class=""> <?= $booking_confirm_row->wedding_status; ?></td>
                <td class=""> 
                    <?php if($booking_confirm_row->pdf){?>
                        <a  href="https://test.muhammadamirzia.com/ultratesting/public/<?=$booking_confirm_row->pdf;?>" target='_blank' >View</a>
                    <?php } ?>
                </td>
                <td>

                    <a href="client_assign.php?booking=<?= $booking_confirm_row->booking_id; ?>&user_id=<?= $booking_confirm_row->user_id; ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Assign user to weddings"><i class="mdi mdi-clipboard-account"></i></a>
                </td>
            </tr>

        <?php endforeach; ?>
    </tbody>
    </table>
</div>


<div id="pending-booking-div" style="display:none;">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h6 class="h4 mt-4 ml-3">Pending Booking</h6>
        <div class="btn-toolbar mb-md-0">
            <div class="btn-group mr-2">
                <a class="btn btn-md btn-success" style="font-size: 12px;" href="client_add.php"><i class="mdi mdi-account-plus mr-2"></i> Add New Client</a>
            </div>
        </div>
    </div>
    <table id="pendingBooking" class="table table-striped table-hover table-bordered table-sm" cellspacing="0" width="100%" style="background: white;padding: 0 5px;">

        <thead>
            <tr>
                <th>Full Name</th>
                <th>Phone </th>
                <th>Email</th>
                <th>Event Type</th>
                <th>Event Date</th>            
                <th>Event Slot</th>
                <th>Visit Date & Time</th>
                <th>Status</th>
                <th>Quotation</th>
                <th>Tools</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($booking_pending as $booking_confirm_row) : ?>
            
            <tr>
                
                <td class=""><?= $booking_confirm_row->firstname . ' ' . $booking_confirm_row->lastname;?></td>
            
                <td class="">
                    <?= (empty($booking_confirm_row->phone)) ?  '-' :  $booking_confirm_row->phone; ?>
                </td>
                
                <td class=""><?= (empty($booking_confirm_row->user_email)) ?  '-' :  $booking_confirm_row->user_email; ?></td>
                
                <td class=""><?= $booking_confirm_row->wedding_type; ?></td>
                

                <td class=""><?= (empty($booking_confirm_row->wedding_date)) ?  'N/A' :  $booking_confirm_row->wedding_date; ?></td>
                <td class=""> <?= $booking_confirm_row->event_slot; ?></td>
                <td class=""> <?= $booking_confirm_row->visit_date; ?> <?= $booking_confirm_row->visit_time; ?></td>
                <td class=""> <?= $booking_confirm_row->wedding_status; ?></td>
                <td class=""> 
                    <?php if($booking_confirm_row->pdf){?>
                        <a  href="https://test.muhammadamirzia.com/ultratesting/public/<?=$booking_confirm_row->pdf;?>" target='_blank' >View</a>
                    <?php } ?>
                </td>
                <td>

                    <a href="client_assign.php?booking=<?= $booking_confirm_row->booking_id; ?>&user_id=<?= $booking_confirm_row->user_id; ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Assign user to weddings"><i class="mdi mdi-clipboard-account"></i></a>

                </td>
            </tr>

        <?php endforeach; ?>
    </tbody>
    </table>
</div>
<div id="confirmed-div" style="display:none;">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h6 class="h4 mt-4 ml-3">Confirmed Booking</h6>
        <div class="btn-toolbar mb-md-0">
            <div class="btn-group mr-2">
                <a class="btn btn-md btn-success" style="font-size: 12px;" href="client_add.php"><i class="mdi mdi-account-plus mr-2"></i> Add New Client</a>
            </div>
        </div>
    </div>
    <table id="confirmed" class="table table-striped table-hover table-bordered table-sm" cellspacing="0" width="100%" style="background: white;padding: 0 5px;">

        <thead>
            <tr>
                <th>Full Name</th>
                <th>Phone </th>
                <th>Email</th>
                <th>Event Type</th>
                <th>Event Date</th>            
                <th>Event Slot</th>
                <th>Visit Date & Time</th>
                <th>Status</th>
                <th>Quotation</th>
                <th>Tools</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($booking_confirm as $booking_confirm_row) : ?>
            
            <tr>
                
                <td class=""><?= $booking_confirm_row->firstname . ' ' . $booking_confirm_row->lastname;?></td>
            
                <td class="">
                    <?= (empty($booking_confirm_row->phone)) ?  '-' :  $booking_confirm_row->phone; ?>
                </td>
                
                <td class=""><?= (empty($booking_confirm_row->user_email)) ?  '-' :  $booking_confirm_row->user_email; ?></td>
                
                <td class=""><?= $booking_confirm_row->wedding_type; ?></td>
                

                <td class=""><?= (empty($booking_confirm_row->wedding_date)) ?  'N/A' :  $booking_confirm_row->wedding_date; ?></td>
                <td class=""> <?= $booking_confirm_row->event_slot; ?></td>
                <td class=""> <?= $booking_confirm_row->visit_date; ?> <?= $booking_confirm_row->visit_time; ?></td>
                <td class=""> <?= $booking_confirm_row->wedding_status; ?></td>
                <td class=""> 
                    <?php if($booking_confirm_row->pdf){?>
                        <a  href="https://test.muhammadamirzia.com/ultratesting/public/<?=$booking_confirm_row->pdf;?>" target='_blank' >View</a>
                    <?php } ?>
                </td>
                <td>

                    <a href="client_assign.php?booking=<?= $booking_confirm_row->booking_id; ?>&user_id=<?= $booking_confirm_row->user_id; ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Assign user to weddings"><i class="mdi mdi-clipboard-account"></i></a>

                    <!--<a href="client_edit.php?booking=<?= $booking_confirm_row->booking_id; ?>&user_id=<?= $booking_confirm_row->user_id; ?>" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit client account information"><i class="mdi mdi-account-edit"></i></a>-->

                    <!--<a href="client_manage_account_details.php?booking_id=<?= $booking_confirm_row->booking_id; ?>&user_id=<?= $booking_confirm_row->user_id; ?>" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Enter client workbook to manage all wedding details"><i class="mdi mdi-account-card-details"></i></a>-->

                </td>
            </tr>

        <?php endforeach; ?>
    </tbody>
    </table>
</div>

<div id="cancel-div" style="display:none;">


    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h6 class="h4 mt-4 ml-3">Cancelled</h6>
        <div class="btn-toolbar mb-md-0">
            <div class="btn-group mr-2">
                <a class="btn btn-md btn-success" style="font-size: 12px;" href="client_add.php"><i class="mdi mdi-account-plus mr-2"></i> Add New Client</a>
            </div>
        </div>
    </div>
    <table id="cancelBooking" class="table table-striped table-hover table-bordered table-sm" cellspacing="0" width="100%" style="background: white;padding: 0 5px;">

        <thead>
            <tr>
                <th>Full Name</th>
                <th>Phone </th>
                <th>Email</th>
                <th>Event Type</th>
                <th>Event Date</th>            
                <th>Event Slot</th>
                <th>Visit Date & Time</th>
                <th>Status</th>
                <th>Quotation</th>
                <th>Tools</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($booking_cancel as $booking_confirm_row) : ?>
            
            <tr>
                
                <td class=""><?= $booking_confirm_row->firstname . ' ' . $booking_confirm_row->lastname;?></td>
            
                <td class="">
                    <?= (empty($booking_confirm_row->phone)) ?  '-' :  $booking_confirm_row->phone; ?>
                </td>
                
                <td class=""><?= (empty($booking_confirm_row->user_email)) ?  '-' :  $booking_confirm_row->user_email; ?></td>
                
                <td class=""><?= $booking_confirm_row->wedding_type; ?></td>
                

                <td class=""><?= (empty($booking_confirm_row->wedding_date)) ?  'N/A' :  $booking_confirm_row->wedding_date; ?></td>
                <td class=""> <?= $booking_confirm_row->event_slot; ?></td>
                <td class=""> <?= $booking_confirm_row->visit_date; ?> <?= $booking_confirm_row->visit_time; ?></td>
                <td class=""> <?= $booking_confirm_row->wedding_status; ?></td>
                <td class=""> 
                    <?php if($booking_confirm_row->pdf){?>
                        <a  href="https://test.muhammadamirzia.com/ultratesting/public/<?=$booking_confirm_row->pdf;?>" target='_blank' >View</a>
                    <?php } ?>
                </td>
                <td>

                    <a href="client_assign.php?booking=<?= $booking_confirm_row->booking_id; ?>&user_id=<?= $booking_confirm_row->user_id; ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Assign user to weddings"><i class="mdi mdi-clipboard-account"></i></a>

                </td>
            </tr>

        <?php endforeach; ?>
    </tbody>
    </table>
</div>

</main>
</div>
</div>

<script src="js/jquery-3.2.1.slim.min.js"></script>
<script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="js/popper.min.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#pending').DataTable();
        $('#confirmed').DataTable();
        $('#confirmedVisit').DataTable();
        
        $('#pendingBooking').DataTable();
        $('#cancelBooking').DataTable();
        $('[data-toggle="tooltip"]').tooltip();
    });

    function showDIv(div){
        if(div == 1){
            $('#cancel-div').hide();
            $('#confirmed-div').hide();
            $('#pending-booking-div').hide();
            $('#confirm-div').hide();
            $('#pending-div').show();
        }else if(div == 2){
            $('#cancel-div').hide();
            $('#confirmed-div').hide();
            $('#pending-booking-div').hide();
            $('#confirm-div').show();
            $('#pending-div').hide();
        }else if(div == 3){
            $('#cancel-div').hide();
            $('#confirmed-div').hide();
            $('#pending-booking-div').show();
            $('#confirm-div').hide();
            $('#pending-div').hide();
        }else if(div == 4){
            $('#cancel-div').hide();
            $('#confirmed-div').show();
            $('#pending-booking-div').hide();
            $('#confirm-div').hide();
            $('#pending-div').hide();
        }else if(div == 5){
            $('#cancel-div').show();
            $('#confirmed-div').hide();
            $('#pending-booking-div').hide();
            $('#confirm-div').hide();
            $('#pending-div').hide();
        }
    }
</script>

</body>
</html>
