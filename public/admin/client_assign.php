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
         #payment_section,
        #attachment_section,
        #remaining_amount_section {
            display: none;
        }
    </style>
<?php
    if (!isset($_SESSION['id'])) { redirect_to("../"); }

    $booking_id = $_GET['booking'];
    $user_id = $_GET['user_id'];

    $accounts =  Accounts::find_by_user_id($user_id);
    $account_detail =  Account_Details::find_by_user_id($user_id);
    $booking_detail =  Booking::find_by_booking_id($booking_id);
 	$categories = Category::find_all();
 	
    if (isset($_POST['confirm'])) {

        if ($booking_detail) {
            $firstname = clean($_POST['firstname']);
            $lastname = clean($_POST['lastname']);
            $email = clean($_POST['email']);
            $wedding_date = clean($_POST['wedding_date']);           
            $phone = clean($_POST['phone']);
            $city = clean($_POST['city']);
            $wedding_type = clean($_POST['wedding_type']);
            $other_wedding_type = clean($_POST['other_wedding_type']);
         
            $description = clean($_POST['description']);
            $visit_time = clean($_POST['visit_time']);
            $visit_date = clean($_POST['visit_date']);
            $amount = clean($_POST['amount']);
            
            $no_of_guest = clean($_POST['no_of_guest']);
            $other_no_of_guests = clean($_POST['other_no_of_guests']);
            $event_slot = clean($_POST['event_slot']);
            $seating_arrangement = clean($_POST['seating_arrangement']);
            $av_requirements = clean($_POST['av_requirements']);
            $special_requests = clean($_POST['special_requests']);
            $textarea = clean($_POST['textarea']);
            $av_requirements_string = '';
            
            if (!empty($_POST['av_requirements'])) {
                $av_requirements_string = implode(', ', $_POST['av_requirements']);
            }


            $status = "Confirm Booking";

            $booking_detail->wedding_type = $wedding_type;
            $booking_detail->other_wedding_type = $other_wedding_type;

            $booking_detail->user_email = $booking_detail->user_email = $email;
            $booking_detail->wedding_date = $wedding_date;

            
            $booking_detail->wedding_status = $status;
            $booking_detail->other_no_of_guests = $other_no_of_guests;
            $booking_detail->no_of_guest =  $no_of_guest;
            $booking_detail->event_slot =  $event_slot;
            $booking_detail->textarea =  $textarea;
            $booking_detail->seating_arrangement =  $seating_arrangement;
            $booking_detail->av_requirements =  $av_requirements_string;
            $booking_detail->special_requests =  $special_requests;
            $booking_detail->firstname = $firstname;
            $booking_detail->lastname = $lastname;
            $booking_detail->phone = $phone;
            $booking_detail->city = $city;
            $booking_detail->visit_time = $visit_time;
            $booking_detail->visit_date = $visit_date;
            $booking_detail->amount = $amount;
           
            $booking_detail->location = $location;
            $booking_detail->description = $description;

            $booking_detail->update_booking($booking_id);
            $booking_detail->save_booking();

            
         	 
            if ($booking_detail->save_booking()) {
            }

           redirect_to("client.php");

            $session->message("
            <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-approval'></i></strong> {$booking_detail->firstname} {$booking_detail->lastname} has been successfully modify.
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");

        }
    }

    if (isset($_POST['cancel'])) {

        if ($booking_detail) {
            $status = "Cancel Booking";
            $account_detail->status = $status;
            
            $booking_detail->wedding_status = $status;
            $booking_detail->update_booking($booking_id);
            $account_detail->save_account();
            redirect_to("client.php");
            $session->message("
            <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-approval'></i></strong> {$booking_detail->firstname} {$booking_detail->lastname} has been successfully updated.
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");

        }
    }
    if (isset($_POST['visit'])) {

        if ($booking_detail) {
            $status = clean($_POST['wedding_status']);

            $firstname = clean($_POST['firstname']);
            $lastname = clean($_POST['lastname']);
            $email = clean($_POST['email']);
            $wedding_date = clean($_POST['wedding_date']);           
            $phone = clean($_POST['phone']);
            $city = clean($_POST['city']);
            $wedding_type = clean($_POST['wedding_type']);
            
            $other_wedding_type = clean($_POST['other_wedding_type']);

            $organizer_id = clean(@$_POST['organizer_id']);
            $description = clean($_POST['description']);
            $visit_time = clean($_POST['visit_time']);
            $visit_date = clean($_POST['visit_date']);
            $amount = clean($_POST['amount']);
            
            $remaing_amount = clean($_POST['remaing_amount']);
            $payment = clean($_POST['payment']);
            
            $no_of_guest = clean($_POST['no_of_guest']);
            $other_no_of_guests = clean($_POST['other_no_of_guests']);
            $event_slot = clean($_POST['event_slot']);
            $seating_arrangement = clean($_POST['seating_arrangement']);
            $av_requirements = clean($_POST['av_requirements']);
            $special_requests = clean($_POST['special_requests']);
            $textarea = clean($_POST['textarea']);
            $av_requirements_string = '';
            $special_requests_string = '';
            
            if ($_POST['wedding_status'] == 'Confirm Booking' && (empty($_POST['payment']))) {
                $session->message("
                    <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
                        <strong><i class='mdi mdi-account-alert'></i></strong> Please fill out all required payment information.
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                        </button>
                    </div>
                ");
                
                header("Location: client_assign.php?booking=$booking_id&user_id=$user_id");
                exit();
            }
        
            if (!empty($_POST['av_requirements'])) {
                $av_requirements_string = implode(', ', $_POST['av_requirements']);
            }

            if (!empty($_POST['special_requests'])) {
                $special_requests_string = implode(', ', $_POST['special_requests']);
            }


            $booking_detail->wedding_type = $wedding_type;
            $booking_detail->other_wedding_type = $other_wedding_type;
            

            $booking_detail->user_email = $booking_detail->user_email = $email;
            $booking_detail->wedding_date = $wedding_date;
            $booking_detail->organizer_id = $organizer_id;
            
            
            if (isset($_FILES['payment_attachment'])) {
                $uploadDir = 'upload/'; // Your desired upload directory (make sure it's writable)
                $fileTmpPath = $_FILES['payment_attachment']['tmp_name'];
                $fileName = $_FILES['payment_attachment']['name'];
                $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
            
                // Generate a unique name to avoid conflicts
                $newFileName = uniqid('attachment_', true) . '.' . $fileExtension;
                $destPath = $uploadDir . $newFileName;
            
                // Optional: validate file type and size
                $allowedFileTypes = ['jpg', 'jpeg', 'png', 'pdf'];
                if (in_array(strtolower($fileExtension), $allowedFileTypes)) {
                    if (move_uploaded_file($fileTmpPath, $destPath)) {
                        // Save file path or name to database field
                        $booking_detail->payment_attachment = $newFileName;
                    } else {
                        echo "Error moving the file.";
                    }
                } else {
                    echo "Invalid file type.";
                }
            }

            $booking_detail->remaing_amount = $remaing_amount;
            $booking_detail->payment = $payment;
            
            
            $booking_detail->wedding_status = $status;
            $booking_detail->other_no_of_guests = $other_no_of_guests;
            $booking_detail->no_of_guest =  $no_of_guest;
            $booking_detail->event_slot =  $event_slot;
            $booking_detail->textarea =  $textarea;
            $booking_detail->seating_arrangement =  $seating_arrangement;
            $booking_detail->av_requirements =  $av_requirements_string;
            $booking_detail->special_requests =  $special_requests_string;
            $booking_detail->firstname = $firstname;
            $booking_detail->lastname = $lastname;
            $booking_detail->phone = $phone;
            $booking_detail->city = $city;
            $booking_detail->visit_time = $visit_time;
            $booking_detail->visit_date = $visit_date;
            $booking_detail->amount = $amount;
           
            $booking_detail->location = $location;
            $booking_detail->description = $description;

            $account_detail->status = $status;
            $booking_detail->wedding_status = $status;
            $booking_detail->update_booking($booking_id);
           // $account_detail->save_account();
            
             exit;
            redirect_to("client.php");
            $session->message("
            <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-approval'></i></strong> {$booking_detail->firstname} {$booking_detail->lastname} has been successfully updated.
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");

        }
    }

    if (isset($_POST['pending_booking'])) {

        if ($booking_detail) {
            $status = "Pending Booking";

            
            $firstname = clean($_POST['firstname']);
            $lastname = clean($_POST['lastname']);
            $email = clean($_POST['email']);
            $wedding_date = clean($_POST['wedding_date']);           
            $phone = clean($_POST['phone']);
            $city = clean($_POST['city']);
            $wedding_type = clean($_POST['wedding_type']);
            
            $other_wedding_type = clean($_POST['other_wedding_type']);

            $organizer_id = clean($_POST['organizer_id']);
            $description = clean($_POST['description']);
            $visit_time = clean($_POST['visit_time']);
            $visit_date = clean($_POST['visit_date']);
            $amount = clean($_POST['amount']);
            
            $no_of_guest = clean($_POST['no_of_guest']);
            $other_no_of_guests = clean($_POST['other_no_of_guests']);
            $event_slot = clean($_POST['event_slot']);
            $seating_arrangement = clean($_POST['seating_arrangement']);
            $av_requirements = clean($_POST['av_requirements']);
            $special_requests = clean($_POST['special_requests']);
            $textarea = clean($_POST['textarea']);
            $av_requirements_string = '';
            
            if (!empty($_POST['av_requirements'])) {
                $av_requirements_string = implode(', ', $_POST['av_requirements']);
            }


            $booking_detail->wedding_type = $wedding_type;
            $booking_detail->other_wedding_type = $other_wedding_type;
            
            $booking_detail->user_email = $booking_detail->user_email = $email;
            $booking_detail->wedding_date = $wedding_date;
            $booking_detail->organizer_id = $organizer_id;
            
            $booking_detail->wedding_status = $status;
            $booking_detail->other_no_of_guests = $other_no_of_guests;
            $booking_detail->no_of_guest =  $no_of_guest;
            $booking_detail->event_slot =  $event_slot;
            $booking_detail->textarea =  $textarea;
            $booking_detail->seating_arrangement =  $seating_arrangement;
            $booking_detail->av_requirements =  $av_requirements_string;
            $booking_detail->special_requests =  $special_requests;
            $booking_detail->firstname = $firstname;
            $booking_detail->lastname = $lastname;
            $booking_detail->phone = $phone;
            $booking_detail->city = $city;
            $booking_detail->visit_time = $visit_time;
            $booking_detail->visit_date = $visit_date;
            $booking_detail->amount = $amount;
           
            $booking_detail->location = $location;
            $booking_detail->description = $description;


            $account_detail->status = $status;
            $booking_detail->wedding_status = $status;
            $booking_detail->update_booking($booking_id);
            $account_detail->save_account();
            redirect_to("client.php");
            $session->message("
            <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-approval'></i></strong> {$booking_detail->firstname} {$booking_detail->lastname} has been successfully updated.
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
        <title>Edit Client Information - Administrator</title>
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

                <form method="post" action="" enctype="multipart/form-data">

                    <h4 class="h4 mt-4 pb-2" style="border-bottom: 1px solid #dee2e6!important;">Client Information
						<a href="client.php" class="btn btn-sm btn-light float-right mr-2 active" style="font-size: 12px;">
							<span class="mdi mdi-arrow-left"></span> Back 
						</a>

                    </h4>
                    <?php
                    if ($session->message()) {
                        echo $session->message();
                    }
                ?>
                    <div class="form-row">

                        <div class="form-group col-md-4">
                            <label for="inputFirstname">First Name <span style="color:red">*</span></label>
                            <input type="text" name="firstname" class="form-control" id="inputFirstname" value="<?= $booking_detail->firstname; ?>" placeholder="Enter firstname">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="inputLastname">Last Name <span style="color:red">*</span></label>
                            <input type="text" name="lastname" class="form-control" id="inputLastname" value="<?= $booking_detail->lastname; ?>" placeholder="Enter lastname">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="inputLastname">Phone <span style="color:red">*</span></label>
                            <input type="text" class="form-control" value="<?= $booking_detail->phone; ?>" id="inputPhone" name="phone" placeholder="Enter Phone Number">
                        </div>

                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-4">
                            <label for="inputPhone">Email <span style="color:red">*</span></label>
                            <input type="text" name="email" class="form-control" id="inputEmail" value="<?= $booking_detail->user_email; ?>" placeholder="Enter email">
                    
                        </div>

                        <div class="form-group col-md-4">
                            <label for="inputcity">City <span style="color:red">*</span></label>
                            <input type="text" class="form-control" value="<?= $booking_detail->city; ?>" id="inputcity" name="city" placeholder="Enter City">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="inputPhone">Event Type <span style="color:red">*</span></label>
                            <select class="form-control" id="wedding_type" name="wedding_type">
                                 <option value="Wedding" <?php if ($booking_detail->wedding_type == 'Wedding') { echo "selected";} ?>>Wedding</option>
                                <option value="Corporate Meeting" <?php if ($booking_detail->wedding_type == 'Corporate Meeting') { echo "selected";} ?>>Corporate Meeting</option>
                                <option value="Conference"  <?php if ($booking_detail->wedding_type == 'Conference') { echo "selected";} ?>>Conference</option>
                                <option value="Workshop"  <?php if ($booking_detail->wedding_type == 'Workshop') { echo "selected";} ?> >Workshop</option>
                                <option value="Birthday Party"  <?php if ($booking_detail->wedding_type == 'Birthday Party') { echo "selected";} ?>>Birthday Party</option>
                                <option value="Private Dinner"  <?php if ($booking_detail->wedding_type == 'Private Dinner') { echo "selected";} ?>>Private Dinner</option>
                                <option value="Product Launch"  <?php if ($booking_detail->wedding_type == 'Product Launch') { echo "selected";} ?>>Product Launch</option>
                                <option value="Charity Event"  <?php if ($booking_detail->wedding_type == 'Charity Event') { echo "selected";} ?>>Charity Event</option>
                                <option value="Other Event Type"  <?php if ($booking_detail->wedding_type == 'Other Event Type') { echo "selected";} ?>>Other</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4" id="other_wedding_field" <?php if ($booking_detail->wedding_type != 'Other Event Type'){?> style="display:none;" <?php } ?> >
                            <label for="inputPhone">Other Event Type  <span style="color:red">*</span></label>
                            <input type="number" class="form-control" name="other_wedding_type" id="other_wedding_type" value="<?=$booking_detail->other_wedding_type;?>" placeholder="Other Event Type">
                                
                        </div>

                    </div>


                    <div class="form-row">

                        <div class="form-group col-md-4">
                            <label for="inputPhone">Number of Guests  <span style="color:red">*</span></label>
                            <select class="custom-select form-control" id="no_of_guest" name="no_of_guest">
                                <option value="">Number of Guests</option>
                                <option value="1-50" <?php if ($booking_detail->no_of_guest == '1-50') { echo "selected";} ?>>1-50</option>
                                <option value="51-60" <?php if ($booking_detail->no_of_guest == '51-60') { echo "selected";} ?>>51-60</option>
                                <option value="61-70" <?php if ($booking_detail->no_of_guest == '61-70') { echo "selected";} ?>>61-70</option>
                                <option value="71-80" <?php if ($booking_detail->no_of_guest == '71-80') { echo "selected";} ?>>71-80</option>
                                <option value="81-90" <?php if ($booking_detail->no_of_guest == '81-90') { echo "selected";} ?>>81-90</option>
                                <option value="91-100" <?php if ($booking_detail->no_of_guest == '91-100') { echo "selected";} ?>>91-100</option>
                                <option value="Others" <?php if ($booking_detail->no_of_guest == 'Others') { echo "selected";} ?>>Others</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4" id="other_guests_field" <?php if ($booking_detail->no_of_guest != 'Others'){?> style="display:none;" <?php } ?> >
                            <label for="inputPhone">Please Specify Number of Guests  <span style="color:red">*</span></label>
                            <input type="number" class="form-control" name="other_no_of_guests" id="other_no_of_guests" value="<?=$booking_detail->other_no_of_guests;?>" placeholder="Please specify number of guests">
                                
                        </div>



                        <div class="form-group col-md-4">
                            <label for="inputPhone">Event Date  <span style="color:red">*</span></label>
                            <input type="date" class="form-control"
                                   name="wedding_date" value="<?= $booking_detail->wedding_date; ?>" id="wedding_dates"
                                   placeholder="Wedding Date">
                        </div>
                        
                        <div class="form-group col-md-4">
                            <label for="inputPhone">Event Slot  <span style="color:red">*</span></label>
                            <select class="custom-select form-control" id="event_slot" name="event_slot">
                                <option value="">Event Slot</option>
                                <option value="Slot 1 (8am - 1pm)" <?php if ($booking_detail->event_slot == 'Slot 1 (8am - 1pm)') { echo "selected";} ?>>Slot 1 (8am - 1pm)</option>
                                <option value="Slot 2 (6pm - 11pm)" <?php if ($booking_detail->event_slot == 'Slot 2 (6pm - 11pm)') { echo "selected";} ?>  >Slot 2 (6pm - 11pm)</option>
                                <option value="Other timing - discuss later" <?php if ($booking_detail->event_slot == 'Other timing - discuss later') { echo "selected";} ?>>Other timing - discuss later</option>
                              </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="inputPhone">Seating Arrangement  <span style="color:red">*</span></label>
                                <select class="custom-select form-control" id="seating_arrangement" name="seating_arrangement">
                                    <option value="banquet_style" <?php if ($booking_detail->seating_arrangement == 'banquet_style') { echo "selected";} ?>>Banquet Style – (weddings, gala dinners, private dinners, and charity events)</option>
                                    <option value="u_shape" <?php if ($booking_detail->seating_arrangement == 'u_shape') { echo "selected";} ?>>U-Shape – (corporate meetings, conferences, and workshops requiring discussions or presentations)</option>
                                    <option value="boardroom" <?php if ($booking_detail->seating_arrangement == 'boardroom') { echo "selected";} ?>>Boardroom (high-level corporate meetings, small workshops, or executive discussions)</option>
                                    <option value="cocktail_standing" <?php if ($booking_detail->seating_arrangement == 'cocktail_standing') { echo "selected";} ?>>Cocktail/Standing (social events, product launches, and birthday parties)</option>
                                    <option value="cabaret_style" <?php if ($booking_detail->seating_arrangement == 'cabaret_style') { echo "selected";} ?>>Cabaret Style (workshops, conferences, or casual corporate meetings requiring space for team discussions)</option>
                                    <option value="custom" <?php if ($booking_detail->seating_arrangement == 'custom') { echo "selected";} ?>>Custom (others)</option>
                                </select>
                        </div>

                        <div class="form-group col-md-8">
                            <label for="inputPhone">Special Requests or Additional Services  <span style="color:red">*</span></label>
                            <?php
                            // Assuming $booking_detail->av_requirements contains a comma-separated string
                            $special_requests_array = explode(', ', $booking_detail->special_requests); // Convert string to array
                            
                            ?>
                            <select class="custom-select form-control" multiple id="special_requests" name="special_requests[]">
                                <option value="Onsite Staff" <?php if(in_array('Onsite Staff', $special_requests_array)) { echo "selected";} ?>>Onsite staff</option>
                                <option value="Built-in Decoration" <?php if(in_array('Built-in Decoration', $special_requests_array)) { echo "selected";} ?>>Built-in Decoration</option>
                                <option value="Valet Parking" <?php if(in_array('Valet Parking', $special_requests_array)) { echo "selected";} ?>>Valet Parking</option>
                                <option value="Additional Decoration Services" <?php if(in_array('Additional Decoration Services', $special_requests_array)) { echo "selected";} ?>>Additional Decoration Services</option>
                                <option value="Photography" <?php if(in_array('Photography', $special_requests_array)) { echo "selected";} ?>>Photography</option>
                                <option value="Videography" <?php if(in_array('Videography', $special_requests_array)) { echo "selected";} ?>>Videography</option>
                              </select>
                        </div>

                    </div>


                    <div class="form-row form-group">
                        
                        
                        <div class="col-md-12">
                            <label for="wedding_date"><b>Audio/Visual Requirements  <span style="color:red">*</span></b></label>
                        </div>
                        

                        <div class="input-group col-md-12">
                            <?php
                            // Assuming $booking_detail->av_requirements contains a comma-separated string
                            $av_requirements_array = explode(', ', $booking_detail->av_requirements); // Convert string to array
                            
                            ?>
                             <!-- Checkbox for 2 Microphones -->
                            <input type="checkbox" class="form-group col-md-2" name="av_requirements[]" value="2 Microphones" 
                                <?php if (in_array('2 Microphones', $av_requirements_array)) { echo "checked"; } ?>> 2 Microphones <br>

                            <!-- Checkbox for Sound system (basic) - default checked -->
                            <input type="checkbox" class="form-group col-md-2" name="av_requirements[]" value="Sound system (basic)" 
                                <?php if (in_array('Sound system (basic)', $av_requirements_array)) { echo "checked"; } ?>> Sound system (basic) <br>

                            <!-- Checkbox for Stage lighting (basic) - default checked -->
                            <input type="checkbox" class="form-group col-md-2" name="av_requirements[]" value="Stage lighting (basic)" 
                                <?php if (in_array('Stage lighting (basic)', $av_requirements_array)) { echo "checked"; } ?>> Stage lighting (basic) <br>

                            <!-- Checkbox for Projector and Screen -->
                            <input type="checkbox" class="form-group col-md-2" name="av_requirements[]" value="Projector and Screen" 
                                <?php if (in_array('Projector and Screen', $av_requirements_array)) { echo "checked"; } ?>> Projector and Screen <br>

                            <!-- Checkbox for LED Screen -->
                            <input type="checkbox" class="form-group col-md-2" name="av_requirements[]" value="LED Screen" 
                                <?php if (in_array('LED Screen', $av_requirements_array)) { echo "checked"; } ?>> LED Screen <br>

                            <!-- Checkbox for Sound system (customized) -->
                            <input type="checkbox" class="form-group col-md-2" name="av_requirements[]" value="Sound system (customized)" 
                                <?php if (in_array('Sound system (customized)', $av_requirements_array)) { echo "checked"; } ?>> Sound system (customized) <br>

                            <!-- Checkbox for Livestream/Video Conferencing Setup -->
                            <input type="checkbox" class="form-group col-md-2" name="av_requirements[]" value="Livestream/Video Conferencing Setup" 
                                <?php if (in_array('Livestream/Video Conferencing Setup', $av_requirements_array)) { echo "checked"; } ?>> Livestream/Video Conferencing Setup <br>

                            <!-- Checkbox for Other -->
                            <input type="checkbox" class="form-group col-md-2" name="av_requirements[]" value="Other" 
                                <?php if (in_array('Other', $av_requirements_array)) { echo "checked"; } ?>> Other <br>

                        
                        </div>


                    </div>


                    

					<div class="form-row">
						

	                    <div class="col form-group">
	                        <label for="Inputexpectation_visitor">Expected Visitor Date</label>
	                        <input type="date" name="visit_date" value="<?= $booking_detail->visit_date; ?>" class="form-control" value="" id="Inputexpectation_visitor" placeholder="Enter expected visitor">
                    	</div>
                    	
                        <div class="col form-group">
	                        <label for="inputLocation">Expected Visitor Time</label>
	                        <input type="time" name="visit_time" value="<?= $booking_detail->visit_time; ?>" class="form-control" value="" id="inputLocation" placeholder="Enter location">
	                    </div>
                    	<div class="col form-group">
	                        <label for="inputcash_advanced">Amount</label>
	                        <input type="text" name="amount" class="form-control" value="<?= $booking_detail->amount; ?>" id="inputcash_advanced" placeholder="Enter cash advanced">
                    	</div>

                    </div>
                    <div class="form-group">
                        <label for="Inputdescription">Status  <span style="color:red">*</span></label>
                        
                        <select class="custom-select form-control" id="wedding_status" name="wedding_status">
                            <option value="Pending Visit" <?php if ($booking_detail->wedding_status == 'Pending Visit') { echo "selected";} ?>>Pending Visit</option>
                            <option value="Confirm Visit" <?php if ($booking_detail->wedding_status == 'Confirm Visit') { echo "selected";} ?>>Confirm Visit</option>
                            <option value="Pending Booking" <?php if ($booking_detail->wedding_status == 'Pending Booking') { echo "selected";} ?>>Pending Booking</option>
                            <option value="Confirm Booking" <?php if ($booking_detail->wedding_status == 'Confirm Booking') { echo "selected";} ?>>Confirm Booking</option>
                            <option value="Cancel Booking" <?php if ($booking_detail->wedding_status == 'Cancel Booking') { echo "selected";} ?>>Cancel Booking</option>
                        </select>
                    </div>
                    <div class="form-group" id="payment_section">
                        <label for="Inputdescription">Payment Mode  <span style="color:red">*</span></label>
                        
                        
                        <select class="custom-select form-control" id="payment" name="payment">
                            <option value=''>Select Payment Mode  <span style="color:red">*</span></option>
                            <option value="Full Payment" <?php if ($booking_detail->payment == 'Full Payment') { echo "selected";} ?>>Full Payment</option>
                            <option value="Half Payment" <?php if ($booking_detail->payment == 'Half Payment') { echo "selected";} ?>>Half Payment</option>
                        </select>
                    </div>
                    <div class="form-group" id="attachment_section">
                        <label for="Inputdescription">Payment Attachment  <span style="color:red">*</span></label>
                        <input type="file" name="payment_attachment" class="form-control" value="<?= $booking_detail->payment_attachment; ?>" id="inputcash_advanced" placeholder="Payment Attachment">
                        <?php if (!empty($booking_detail->payment_attachment)) : ?>
                                <a href="upload/<?= htmlspecialchars($booking_detail->payment_attachment); ?>" target="_blank">
                                    View Payment Attachment
                                </a>
                            <?php endif; ?>


                       
                    </div>
                    <div class="form-group" id="remaining_amount_section">
                        <label for="Inputdescription">Remaing Amount  <span style="color:red">*</span></label>
                        <input type="number" name="remaing_amount" class="form-control" value="<?= $booking_detail->remaing_amount; ?>" id="remaing_amount" placeholder="Remaing Payment">
                       
                    </div>
					<div class="form-group">
                        <label for="Inputdescription">Description  <span style="color:red">*</span></label>
                        <textarea name="description" class="form-control" id="Inputdescription" placeholder="Enter expected visitor description" rows="5"><?= $booking_detail->description; ?></textarea>
                    </div>

                    <div class="form-row">
                        
                            <label for=""><b>Your Message</b></label>
                            
                            <textarea name="textarea" id="textarea" cols="30" rows="10"
                            placeholder="Your Message" class="form-control" ><?=$booking_detail->textarea;?></textarea>
                        
                    </div><!-- end of form-row -->

                   
                    <button type="submit" name="visit" class="btn btn-sm btn-secondary float-right mr-2 mt-2" style="font-size: 12px; background:green" value="">
                    	<i class="mdi mdi-check mr-2"></i> Save
					</button>
					<!--<button type="submit" name="confirm" class="btn btn-sm btn-primary float-right mr-2" style="font-size: 12px;">
                    	<i class="mdi mdi-check mr-2"></i> Confirm Booking
                    </button>
                    <?php if($booking_detail->wedding_status == 'Pending Visit'){ ?>
                        <button type="submit" name="visit"  class="btn btn-sm btn-secondary float-right mr-2" style="font-size: 12px; background:green" value="">
                            <i class="mdi mdi-check mr-2"></i> Confirm Visit
                        </button>
                    <?php } ?>

                    <?php if($booking_detail->wedding_status == 'Confirm Visit'){ ?>
                        <button type="submit" name="pending_booking"  class="btn btn-sm btn-secondary float-right mr-2" style="font-size: 12px; background:green" value="">
                            <i class="mdi mdi-check mr-2"></i> Pending Booking
                        </button>
                    <?php } ?>-->
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

    document.getElementById('wedding_type').addEventListener('change', function() {
        var otherField = document.getElementById('other_wedding_field');
        if (this.value === 'Other Event Type') {
            otherField.style.display = 'block'; // Show the input field
        } else {
            otherField.style.display = 'none'; // Hide the input field
        }
    });
    
</script>

<script>
    function toggleFields() {
        const weddingStatus = document.getElementById('wedding_status').value;
        const payment = document.getElementById('payment').value;

        // Show/hide payment and attachment sections
        const showPaymentFields = (weddingStatus === 'Confirm Booking');
        document.getElementById('payment_section').style.display = showPaymentFields ? 'block' : 'none';
        document.getElementById('attachment_section').style.display = showPaymentFields ? 'block' : 'none';

        // Show remaining amount only if payment is "Half Payment"
        const showRemaining = (payment === 'Half Payment' && showPaymentFields);
        document.getElementById('remaining_amount_section').style.display = showRemaining ? 'block' : 'none';
    }

    // Initial call
    document.addEventListener('DOMContentLoaded', function () {
        toggleFields();

        document.getElementById('wedding_status').addEventListener('change', toggleFields);
        document.getElementById('payment').addEventListener('change', toggleFields);
    });
</script>
</body>
</html>
