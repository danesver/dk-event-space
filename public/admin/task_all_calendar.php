<?php include 'include/init.php'; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<?php

    $booking = Booking::find_booking_all();
    if (!isset($_SESSION['id'])) { redirect_to("../");}
    $bdd = new PDO('mysql:host=localhost;dbname=qaca', 'qaca', 'qaca123');
    $sql = "SELECT id, title, location, start, end, color FROM events";
    $req = $bdd->prepare($sql);
    $req->execute();
    $events = $req->fetchAll();

    $booking_confirm =  Booking::ConfirmedBooking();
    $visit_confirm =  Booking::getConfrimVistBooking();
    //echo "<pre>";print_r($visit_confirm);exit;
?>

<?php $users_profile = Users::find_by_id($_SESSION['id']); ?>
<!doctype html>
<html lang="en">
<head>
   <meta charset='utf-8' />

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
    <link href='calendar/all.css' rel='stylesheet'>

    <link href='calendar/fullcalendar.min.css' rel='stylesheet' />

    <link href='calendar/fullcalendar.print.min.css' rel='stylesheet' media='print' />

    <script src='calendar/moment.min.js'></script>

    <script src='calendar/jquery.min.js'></script>

<!--     <script src="js/jquery-3.2.1.slim.min.js"></script>-->

    <script src="js/bootstrap.min.js"></script>

    <script src='calendar/fullcalendar.min.js'></script>
    <link rel="stylesheet" type="text/css"
          href="https://cdn.materialdesignicons.com/2.1.19/css/materialdesignicons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
    <style>

          #calendar {
            max-width:82%;
            margin: 0px auto;
            padding: 20px 20px;
              background: white;

          }

        .fc-content {
            background: green;
            color: white;
            padding:3px;

        }
        .fc-content-blue {
            background: #007bff;
            color: white;
            padding:3px;

        }

        .fc-title {
            text-transform: capitalize;
        }
        .btn-primary {
            background-color: #17B4BC;
            border-color: #17B4BC;
        }

          .btn-primary.disabled, .btn-primary:disabled {
              background-color: #17B4BC;
              border-color: #17B4BC;
          }

          .event-business {
                background-color: #FF4500;
                border-color: #D10000;
                color:rgb(45, 157, 75);
            }

            .event-personal {
                background-color: #4CAF50;
                border-color: #3E8E41;
                color:rgb(187, 29, 29);
            }
            .event-booking {
                border: 2px solid #FF4500 !important ;
                background-color: #FF4500  !important;
                font-weight: bold;
            }

            .event-visit {
                border: 2px solid #4CAF50 !important;
                font-style: italic;
            }

    </style>
</head>
<body>

<?php  include_once 'include/sidebar.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
      <h5 class="h4 mt-4 ml-3" style="text-align: center;">Wedding Calendar Activities</h5>
</div>

<div class="row">
    <div class="col-md-12">
        <div id="calendar"></div>
    </div>
</div>

</main>
</div>
</div>



        <!-- Modal -->
        <!--<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
            <form class="form-horizontal" method="POST" action="task_event_save.php">
            
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Event</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>

              <div class="modal-body">

                  <div class="form-group">
                      <label for="booking_id">Couple:</label>
                      <select class="custom-select form-control" id="booking_id" name="booking_id">
                          <?php foreach($booking as $booking_user) : ?>
                              <?php if ($booking_user->booking_id == $gallery->booking_id) : ?>
                                  <option value="<?= $booking_user->booking_id; ?>" selected><?= $booking_user->bride . ' + ' . $booking_user->groom; ?></option>
                              <?php else : ?>
                                  <option value="<?= $booking_user->booking_id; ?>"><?= $booking_user->bride . ' + ' . $booking_user->groom; ?></option>

                              <?php endif ?>

                          <?php endforeach; ?>
                      </select>
                  </div>

                  <div class="form-group">
                      <input type="text" name="title" class="form-control" id="title" placeholder="Event Title">
                  </div>

                  <div class="form-group">
                    <input type="text" name="location" class="form-control" id="location" placeholder="Location">
                  </div>

                  <div class="form-group">

                      <select name="color" class="form-control" id="color">

                          <option value="">Choose</option>

                          <option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
                          <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
                          <option style="color:#008000;" value="#008000">&#9724; Green</option>                       
                          <option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
                          <option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
                          <option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
                          <option style="color:#000;" value="#000">&#9724; Black</option>
                        </select>

                  </div>

                    <div class="form-group">
                        <label for="start" class="">Start date:</label>
                        <input type="text" name="start" class="form-control" id="start" readonly>
                    </div>

                  <div class="form-group">
                    <label for="end" class=" ">End date</label>
                      <input type="text" name="end" class="form-control" id="end" readonly>
                  </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </form>
            </div>
          </div>
        </div>-->
        
        
        
        <!-- Modal -->
        <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
            <form class="form-horizontal" method="POST" action="task_editEventTitle.php">

              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">View Event</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>

              <div class="modal-body">
                
                    <div class="form-group">
                        <label for="wedding_type"><b>Client Name</b></label>
                        <input type="text" name="location" class="form-control" id="location" placeholder="Location">
                    </div>
                    <div class="form-group">
                        <label for="wedding_type"><b>Type of Event</b></label>       
                        <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                    </div>
                    
                    
                     <div class="form-group">
                     <label for="wedding_type"><b>Visit Date</b></label>
                      <input type="text" name="visit_date" class="form-control" id="visit_date" placeholder="Visit Date">
                  </div>
                  
                  <div class="form-group">
                     <label for="wedding_type"><b>Visit Time</b></label>
                      <input type="text" name="visit_time" class="form-control" id="visit_time" placeholder="Visit Time">
                  </div>
                   

                  <div class="form-group">
                     <label for="wedding_type"><b>Envent Date</b></label>
                      <input type="text" name="event_date" class="form-control" id="event_date" placeholder="Event Date">
                  </div>
                  
                  <div class="form-group">
                     <label for="wedding_type"><b>Envent Slot</b></label>
                      <input type="text" name="event_slot" class="form-control" id="event_slot" placeholder="Event Slot">
                  </div>
                    
                  <input type="hidden" name="id" class="form-control" id="id">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </form>
            </div>
          </div>
        </div>
    </div>
<script>

$(document).ready(function() {

$('#calendar').fullCalendar({
    themeSystem: 'bootstrap4',
    header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,listMonth'
    },
    // defaultDate: '2016-01-12',
    editable: true,
    navLinks: true, // can click day/week names to navigate views
    weekNumbers: true,
    eventLimit: true, // allow "more" link when too many events
    selectable: true,
    selectHelper: true,

    select: function(start, end) {
        $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
        $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
        $('#ModalAdd').modal('show');
    },

    eventRender: function(event, element) {
        // Add class based on event type
        if (event.eventType === 'booking') {
            element.addClass('event-booking');
            $('.event-booking .fc-content').addClass('event-booking');
            $('.event-booking .fc-title').addClass('event-booking');
            element.find('.fc-content, .fc-title').addClass('event-booking');


        } else if (event.eventType === 'visit') {
            element.addClass('event-visit');
        }

        // Apply inline styles based on event type (optional, if needed)
        if (event.eventType === 'booking') {
            element.css('background-color', '#FF4500'); // Orange for booking
        } else if (event.eventType === 'visit') {
            element.css('background-color', '#4CAF50'); // Green for visit
        }

        // Bind double click event for editing
        element.bind('dblclick', function() {
            $('#ModalEdit #id').val(event.id);
            $('#ModalEdit #title').val(event.title);
            $('#ModalEdit #location').val(event.location);
            $('#ModalEdit #event_date').val(event.event_date);
            $('#ModalEdit #event_slot').val(event.event_slot);
            $('#ModalEdit #visit_date').val(event.visit_date);
            $('#ModalEdit #visit_time').val(event.visit_time);

            $('#ModalEdit').modal('show');
        });
    },

    eventDrop: function(event, delta, revertFunc) { // When changing position
        edit(event);
    },
    eventResize: function(event, dayDelta, minuteDelta, revertFunc) { // When changing length
        edit(event);
    },
    events: [
        <?php foreach($booking_confirm as $event): 

        $start = $event->wedding_date;
        $end = $event->wedding_date;

        ?>
        {
            id: '<?php echo @$event->id; ?>',
            title: '<?php echo $event->wedding_type; ?>',
            location: '<?php echo $event->firstname.' '.$event->lastname; ?>',
            event_date: '<?php echo $event->wedding_date; ?>',
            event_slot:'<?php echo $event->event_slot; ?>',
            visit_date: '<?php echo $event->visit_date; ?>',
            visit_time: '<?php echo $event->visit_time; ?>',
            start: '<?php echo $start; ?>',
            end: '<?php echo $end; ?>',
            eventType: 'booking',
            color: '#008000',
            eventBackgroundColor: '#FF0000',  // Background color
            eventTextColor: '#FFFFFF',        // Text color (white)
            eventBorderColor: '#D10000'      // Border color
        },
        <?php endforeach; ?>
        <?php foreach($visit_confirm as $event): 

        $start = $event->visit_date;
        $end = $event->visit_date;

        ?>
        {
            id: '<?php echo @$event->id; ?>',
            title: '<?php echo $event->wedding_type; ?>',
            location: '<?php echo $event->firstname.' '.$event->lastname; ?>',
            event_date: '<?php echo $event->wedding_date; ?>',
            event_slot: '<?php echo $event->event_slot; ?>',
            visit_date: '<?php echo $event->visit_date; ?>',
            visit_time: '<?php echo $event->visit_time; ?>',
            start: '<?php echo $start; ?>',
            end: '<?php echo $end; ?>',
            eventType: 'visit',
            color: '#008000',
            eventBackgroundColor: '#00FF00',  // Background color
            eventTextColor: '#000000',        // Text color (black)
            eventBorderColor: '#007300'      // Border color
        },
        <?php endforeach; ?>
    ]
});
        
        function edit(event){
            start = event.start.format('YYYY-MM-DD HH:mm:ss');
            if(event.end){
                end = event.end.format('YYYY-MM-DD HH:mm:ss');
            }else{
                end = start;
            }
            
            id =  event.id;
            
            Event = [];
            Event[0] = id;
            Event[1] = start;
            Event[2] = end;
            
            $.ajax({
             url: 'task_editEventDate.php',
             type: "POST",
             data: {Event:Event},
             success: function(rep) {
                    if(rep === 'OK'){
                        alert('Saved');
                    }else{
                        alert('Could not be saved. try again.'); 
                    }
                }
            });
        }
       
       
       
       $('.fa-chevron-left').addClass('mdi mdi-arrow-left');
    $('.fa-chevron-right').addClass('mdi mdi-arrow-right');
 
    });

</script>
</body>
</html>
