<?php include 'include/init.php'; ?>
    <!-- Include jQuery (make sure it's loaded first) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Select2 CSS (stable version 4.0.13) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <!-- Include Select2 JS (stable version 4.0.13) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<?php

    $count = 0;
    $error = '';
    $firstname = $lastname = $email = $wedding_date = $bride = $groom = $phone = $city = '';
    if (!isset($_SESSION['id'])) { redirect_to("../"); }

    // $booking_id = $_GET['booking'];
    // $user_id = $_GET['user_id'];
    $category = Category::find_all();

    $accounts =  new Accounts();
    $account_detail =  new Account_Details();
    $booking_detail =  new Booking();

    if (isset($_POST['submit'])) {

        $user_password1 = htmlspecialchars($_POST['user_password1']);
        $user_password2 = htmlspecialchars($_POST['user_password2']);

        if ($user_password1 != $user_password2) {
              redirect_to("client_add.php");
            $session->message("
            <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-alert-circle-outline'></i></strong>  Password is mismatched. Please Try Again!
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");
            die();
        }

        

        if ($booking_detail) {

            $firstname = clean($_POST['firstname']);
            $lastname = clean($_POST['lastname']);
            $email = clean($_POST['email']);
            $wedding_date = clean($_POST['wedding_date']);
            $phone = clean($_POST['phone']);
            $city = clean($_POST['city']);
            $wedding_type = clean($_POST['wedding_type']);
            $organizer_id = clean($_POST['organizer_id']);
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
             if (empty($firstname) || empty($lastname) || empty($email)) {
                redirect_to("client_add.php");
                $session->message("
                <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
                  <strong><i class='mdi mdi-account-alert mr-2'></i></strong> Please Fill up all the information.
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                  </button>
                </div>");
                die();
            }

            // if($error == '' ) {
               
                $account_detail->firstname = $firstname;
                $account_detail->lastname = $lastname;
                $account_detail->phone = $phone;
                $account_detail->city = $city;
                $account_detail->status =  'pending';
                $account_detail->datetime_created  = date("y-m-d h:m:i");
            
                if ($account_detail->save()) {
                    $account_detail->user_id = mysqli_insert_id($db->connection);
                    if($account_detail->update()) {
                        $accounts->user_id = $account_detail->user_id;
                        $accounts->user_email= $email;
                        $accounts->user_password = $user_password1;
                        $accounts->user_password= md5($user_password1);

                        if($accounts->save()) {
                            $booking_detail->user_id = $accounts->user_id;
                            
                            $booking_detail->wedding_type = $wedding_type;
                            $booking_detail->user_email = $email;
                            $booking_detail->wedding_date = $wedding_date;
                            $booking_detail->organizer_id = $organizer_id;
                            
                            
                            $booking_detail->no_of_guest =  $no_of_guest;

                            $booking_detail->other_no_of_guests = $other_no_of_guests;
                            $booking_detail->event_slot =  $event_slot;
                            $booking_detail->textarea =  $textarea;
                            $booking_detail->seating_arrangement =  $seating_arrangement;
                            $booking_detail->av_requirements =  $av_requirements_string;
                            $booking_detail->special_requests =  $special_requests;
                            $booking_detail->wedding_status =  'Pending';
                            
                            $booking_detail->save();
                            redirect_to("client.php");
                            $session->message("
                            <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                              <strong><i class='mdi mdi-alert-circle-outline'></i></strong>  New Client has been added.
                              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                <span aria-hidden=\"true\">&times;</span>
                              </button>
                            </div>");
                            die();
                         }
                    }
                }
            // }
        }
    }


?>
<?php $users_profile = Users::find_by_id($_SESSION['id']); ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Add New Client Information - Administrator</title>
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

<?php include 'include/sidebar.php'; ?>

    <div class="container">

        <div class="row">

            <div class="col-lg-8 offset-2 pl-3 pb-3 box-shadow mt-4">
            
                <form action="client_add.php" method="post">
                    <h4 class="h4 mt-4 pb-2" style="border-bottom: 1px solid #dee2e6!important;">New Client Information
                        <a href="client.php" class="btn btn-sm btn-danger float-right" style="font-size: 12px;"><i class="mdi mdi-close-circle mr-2"></i> Cancel</a>
                        <button type="submit" name="submit" class="btn btn-sm btn-success float-right mr-2" style="font-size: 12px;"><i class="mdi mdi-account-plus mr-2"></i> Save Client</button>
                    </h4>
                    <div class="form-row">
                        <?php
                            if ($session->message()) {
                                echo ' <div class="form-group col-md-12">' . $session->message() . '</div>';
                            }
                        ?>
                        <div class="form-group col-md-6">
                            <label for=""><b>First Name</b></label>
                            <input type="text" name="firstname" 
                            class="form-control" 
                            id="inputFirstname"  
                            placeholder="Enter First Name" 
                            value="<?= $firstname;?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for=""><b>Last Name</b></label>
                            <input type="text" name="lastname" class="form-control" id="inputLastname" placeholder="Enter ast Name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for=""><b>Email</b></label>
                        <input type="text" name="email" class="form-control" id="inputEmail" placeholder="Enter email">
                    </div>

                     <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="user_password1" class="form-control" id="inputPassword1"  placeholder="Enter email">
                    </div>

                    <div class="form-group">
                        <label for="">Confirm Password</label>
                        <input type="password" name="user_password2" class="form-control" id="inputPassword2" placeholder="Re-enter password">
                    </div> 

                    <div class="form-row form-group">

                        

                        <div class="col-md-6">
                            <label for="wedding_type"><b>Type of Event</b></label>
                        </div>

                        <div class="col-md-6">
                            <label for="wedding_date"><b>Number of Guest</b></label>
                        </div>
                        

                        <div class="input-group col-md-6">
                            <select class="custom-select form-control" id="wedding_type" name="wedding_type">
                                <option value="">Type of Event</option>
                                <option value="wedding">Wedding</option>
                                <option value="corporate_meeting">Corporate Meeting</option>
                                <option value="conference">Conference</option>
                                <option value="workshop">Workshop</option>
                                <option value="birthday_party">Birthday Party</option>
                                <option value="private_dinner">Private Dinner</option>
                                <option value="product_launch">Product Launch</option>
                                <option value="charity_event">Charity Event</option>
                                <option value="other">Other</option>
                              </select>
                        </div>

                        <div class="input-group col-md-6">
                            <select class="custom-select form-control" id="no_of_guest" name="no_of_guest">
                                <option value="">Number of Guests</option>
                                <option value="1-50">1-50</option>
                                <option value="51-60">51-60</option>
                                <option value="61-70">61-70</option>
                                <option value="71-80">71-80</option>
                                <option value="81-90">81-90</option>
                                <option value="91-100">91-100</option>
                                <option value="Others">Others</option>
                              </select>

                                <!-- Hidden input field for "Others" selection -->
                                <div class="input-group col-md-6" id="other_guests_field" style="display:none;">
                                    <input type="number" class="form-control" name="other_no_of_guests" id="other_no_of_guests" placeholder="Please specify number of guests">
                                </div>
                        </div>

                    </div>


                    <div class="form-row form-group">
                        
                        <div class="col-md-6">
                            <label for="wedding_date"><b>Event Date</b></label>
                        </div>

                        <div class="col-md-6">
                            <label for="wedding_date"><b>Event Slot</b></label>
                        </div>

                        <div class="input-group col-md-6">
                            <input type="text" class="form-control"
                                   name="wedding_date" value="<?= $booking_detail->wedding_date; ?>" data-provide="datepicker" id="wedding_date"
                                   placeholder="Wedding Date">
                            <div class="input-group-append">
                                    <span class="input-group-text"
                                          style="background: white;">
                                        <i style="color:#19b5bc;" class="mdi mdi-calendar-check"
                                            id="review" aria-hidden="true"></i>
                                    </span>
                            </div>
                        </div>

                        <div class="input-group col-md-6">
                            <select class="custom-select form-control" id="event_slot" name="event_slot">
                                <option value="">Event Slot</option>
                                <option value="Slot 1 (8am - 1pm)">Slot 1 (8am - 1pm)</option>
                                <option value="Slot 2 (6pm - 11pm)">Slot 2 (6pm - 11pm)</option>
                                <option value="Other timing - discuss later">Other timing - discuss later</option>
                              </select>
                        </div>


                    </div>


                    <div class="form-row form-group">
                        

                        

                        <div class="col-md-6">
                            <label for="wedding_date"><b>Seating Arrangement</b></label>
                        </div>

                        
                        <div class="col-md-6">
                            <label for="wedding_date"><b>Audio/Visual Requirements</b></label>
                        </div>
                        

                        <div class="input-group col-md-6">
                            <select class="custom-select form-control" id="seating_arrangement" name="seating_arrangement">
                                    <option value="">Seating Arrangement</option>
                                    <option value="banquet_style">Banquet Style – (weddings, gala dinners, private dinners, and charity events)</option>
                                    <option value="u_shape">U-Shape – (corporate meetings, conferences, and workshops requiring discussions or presentations)</option>
                                    <option value="boardroom">Boardroom (high-level corporate meetings, small workshops, or executive discussions)</option>
                                    <option value="cocktail_standing">Cocktail/Standing (social events, product launches, and birthday parties)</option>
                                    <option value="cabaret_style">Cabaret Style (workshops, conferences, or casual corporate meetings requiring space for team discussions)</option>
                                    <option value="custom">Custom (others)</option>
                              </select>
                        </div>

                        <div class="input-group col-md-6">
                            <input type="checkbox" class="form-group col-md-2" name="av_requirements[]" value="2 Microphones" checked>2 Microphones <br>
                            <input type="checkbox" class="form-group col-md-2" name="av_requirements[]" value="Sound system (basic)" checked>Sound system (basic)<br>
                            <input type="checkbox" class="form-group col-md-2" name="av_requirements[]" value="Stage lighting (basic)" checked>Stage lighting (basic)<br>
                            <input type="checkbox" class="form-group col-md-2" name="av_requirements[]" value="Projector and Screen"> Projector and Screen<br>
                            <input type="checkbox" class="form-group col-md-2" name="av_requirements[]" value="LED Screen">LED Screen<br>
                            <input type="checkbox" class="form-group col-md-2" name="av_requirements[]" value="Sound system (customized)">Sound system (customized)<br>
                            <input type="checkbox" class="form-group col-md-2" name="av_requirements[]" value="Livestream/Video Conferencing Setup"> Livestream/Video Conferencing Setup<br>
                            <input type="checkbox" class="form-group col-md-2" name="av_requirements[]" value="Other"> Other<br>
                        
                        </div>


                    </div>


                    <div class="form-row form-group">
                        


                        <div class="col-md-12">
                            <label for="wedding_date"><b>Special Requests or Additional Services</b></label>
                        </div>


                        
                        
                        <div class="input-group col-md-12">
                            <select class="custom-select form-control" multiple id="special_requests" name="special_requests">
                                <option value="">Special Requests or Additional Services</option>
                                <option value="Onsite staff" selected>Onsite staff</option>
                                <option value="Built-in Decoration" selected>Built-in Decoration</option>
                                <option value="Valet Parking" selected>Valet Parking</option>
                                <option value="Additional Decoration Services">Additional Decoration Services</option>
                                <option value="Photography">Photography</option>
                                <option value="Videography">Videography</option>
                              </select>
                        </div>


                    </div>

                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for=""><b>Phone</b></label>
                            <input type="text" class="form-control" value="<?= $account_detail->phone; ?>" id="inputPhone" name="phone" placeholder="Enter Phone Number">
                        </div>
                        <div class="form-group col-md-6">
                            <label for=""><b>City</b></label>
                            <input type="text" class="form-control" value="<?= $account_detail->city; ?>" id="inputcity" name="city" placeholder="Enter City">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for=""><b>Assigned Person</b></label>
                            <select class="form-control" id="inputOrganizer" name="organizer_id">
                                <option value="1">Big Day Planners</option>
                                <option value="2">Joyful Events</option>
                                <option value="3">Roses and Co</option>
                            </select>
                        </div><!-- form-group col-md-6 -->
                    </div><!-- end of form-row -->

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for=""><b>Your Message</b></label>
                            
                            <textarea name="textarea" id="textarea" cols="30" rows="10"
                            placeholder="Your Message" class="form-control" ></textarea>
                        </div><!-- form-group col-md-6 -->
                    </div><!-- end of form-row -->


                </form><!-- end of input form -->
            </div>
        </div>
    </div>

</main>
</div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script>
var $jq = jQuery.noConflict();
$jq(document).ready(function() {
$jq('#special_requests').select2();
});
</script>
<script src="js/jquery-3.2.1.slim.min.js"></script>
<script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="js/popper.min.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="../js/bootstrap-datepicker.min.js"></script>
<script>
  
  
    $(document).ready(function() {
        $('#wedding_date').datepicker();
        $('[data-toggle="tooltip"]').tooltip();
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

