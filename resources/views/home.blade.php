@extends('layouts.app')

@section('content')
<style>
    /* Basic table styling */
.table-content {
    margin-top: 20px;
    background-color: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}
.swal2-checkbox{
    display:none !important;
}
.table {
    width: 100%;
    border-collapse: collapse;
    font-size: 16px;
}

.table thead {
    background-color: #1b7261; /* Green background */
    color: white;
}

.table th, .table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.table tbody tr:hover {
    background-color: #f1f1f1; /* Highlight row on hover */
    cursor: pointer;
}

.table td a {
    color: #1b7261; /* Green link color */
    text-decoration: none;
    font-weight: 600;
}

.table td a:hover {
    text-decoration: underline;
}

.table .status {
    font-weight: bold;
    color: #e74c3c; /* Default color for Pending status */
}

.table .status.pending {
    color: #f39c12; /* Yellow color for Pending status */
}

.table .status.confirmed {
    color: #2ecc71; /* Green color for Confirmed Booking */
}
.table .status.other {
    color:rgb(230, 47, 47); /* Green color for Confirmed Booking */
}

.table .status.visited {
    color: #3498db; /* Blue color for Visited status */
}

.table .table-responsive {
    margin-top: 30px;
}
.table tbody tr td {
    padding: 10px 5px;
    text-align: center;
    font-size:12px;
}
.table thead tr th {
    color: white;
    padding: 10px 5px;
    text-align: center;
    font-size:14px;
}
.table-responsive {
    position: static;
    overflow: auto !important;
}
input[type=text], input[type=email], input[type=tel], input[type=number], input[type=password], input[type=url], textarea {
    outline: none;
    background-color: #fff;
    height: 50px;
    width: 90%;
    line-height: 50px;
    font-size: 16px;
    color: var(--rr-common-black);
    padding-left: 15px;
    padding-right: 15px;
    border: 1px solid;
    resize: none;
    font-family: var(--rr-ff-p);
}
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<main>
<section class="cart-area pt-40 pb-120">
            <div class="container container-small">
                <div class="row">
                    <div class="rr-section-title-wrapper mb-40">
                        <span class="rr-section-subtitle wow rrfadeLeft" data-wow-duration=".9s" data-wow-delay=".5s" style="visibility: visible; animation-duration: 0.9s; animation-delay: 0.5s; animation-name: rrfadeLeft;">Appointment</span>
                        <h3 class="rr-section-title wow rrfadeRight" data-wow-duration=".9s" data-wow-delay=".7s" style="visibility: visible; animation-duration: 0.9s; animation-delay: 0.7s; animation-name: rrfadeRight;">Hi To My Events.</h3>
                    </div>
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-content table-responsive">
                                <thead>
                                    <tr>

                                        <th>Full Name</th>
                                        <th>Phone </th>
                                        <th>Email</th>
                                        <th>Event Type</th>
                                        <th>Event Date</th>            
                                        <th>Event Slot</th>
                                        <th>Visit Date & Time</th>
                                        <th>Quotation</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($myEvents as $item)
                                    <tr>
                                        <td>{{$item->firstname}} {{$item->lastname}}</td>
                                        <td>{{$item->phone}}</td>
                                        <td>{{$item->user_email}}</td>
                                        <td>
                                            @if($item->wedding_type =='Other Event Type')
                                                {{$item->other_wedding_type}}
                                            @else
                                                {{$item->wedding_type}}
                                            @endif
                                        </td>
                                        <td>{{$item->wedding_date}}</td>
                                        <td>{{$item->event_slot}}</td>
                                        <td>{{$item->visit_date}} {{$item->visit_time}}</td>
                                        <td>
                                            @if($item->pdf)
                                                <a  href="{{ asset($item->pdf) }}" target='_blank' >View</a>
                                            @endif
                                        </td>
                                        @if($item->wedding_status == 'Pending Booking' || $item->wedding_status == 'Pending Visit')
                                            <td class="status pending">{{$item->wedding_status}}</td>
                                        @elseif($item->wedding_status == 'Confirm Visit' || $item->wedding_status == 'Confirm Booking')
                                            <td class="status confirmed">{{$item->wedding_status}}</td>
                                        @else
                                            <td class="status other">{{$item->wedding_status}}</td>
                                        @endif
                                        
                                        <td style="display: flex;">
                                            <!--<div class="dropdown position-relative">
                                                <button class="btn btn-secondary dropdown-toggle" 
                                                        type="button" 
                                                        id="dropdownMenuButton{{$item->booking_id}}" 
                                                        data-bs-toggle="dropdown" 
                                                        aria-expanded="false" 
                                                        data-bs-display="static"
                                                        style="padding: 5px 8px; margin: 5px;">
                                                    Actions
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton{{$item->booking_id}}">
                                                    @if($item->wedding_status == 'Pending Visit' && $item->wedding_status != 'Cancel Booking')
                                                        <li>
                                                            <button class="dropdown-item" 
                                                                    onclick="confrimVisit({{$item->booking_id}})">
                                                                Confirm Visit:Schedule a date for site visit
                                                            </button>
                                                        </li>
                                                    @endif

                                                    @if($item->wedding_status != 'Confirm Booking' && $item->wedding_status != 'Cancel Booking')
                                                        <li>
                                                            <button class="dropdown-item" 
                                                                    onclick="confrimBooking({{$item->booking_id}})">
                                                                Confirm Booking:After site visit
                                                            </button>
                                                        </li>
                                                    @endif

                                                    @if($item->wedding_status != 'Cancel Booking')
                                                        <li>
                                                            <button class="dropdown-item" 
                                                                    onclick="cancelBooking({{$item->booking_id}})">
                                                                    Cancel Booking
                                                            </button>
                                                        </li>
                                                    @endif
                                                    
                                                </ul>
                                                
                                                
                                            </div>-->
                                                @if($item->wedding_status == 'Pending Visit' && $item->wedding_status != 'Cancel Booking')
                                                    <a onclick="confrimVisit({{$item->booking_id}})" class="dropdown-item" >
                                                                       <i class="fas fa-map-marker-alt" style="font-size: 20px;margin-top: 12px;" title="Site Visit"></i>  
                                                    </a>
                                                @endif   
                                                <a href="{{ route('book-appointment-edit', ['id' => $item->booking_id]) }}" class="dropdown-item" >
                                                               <i class="fa fa-edit" style="font-size: 20px; margin-top: 12px;" title="Edit Booking"></i>  
                                                </a>
                                                @if($item->wedding_status != 'Cancel Booking')
                                                    <a onclick="cancelBooking({{$item->booking_id}})" class="dropdown-item" >
                                                                   <i class="fas fa-calendar-times" style="font-size: 20px; margin-top: 12px;" title="Cancel Booking"></i>  
                                                    </a>
                                                @endif
                                                

                                        </td>
                                    </tr>
                                    @endforeach
                                   
                                </tbody>
                            </table>
                        </div>
                      
                    </div>
                </div>
            </div>
        </section>
</main>

@endsection


@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    var dateAvailability = @json($dateAvailability);
</script>
<script>

    // Function to handle Confirm Visit action
function confrimVisit(id) {
    Swal.fire({
        title: 'Please Select Visit Date & Time',
        html: `
            <label for="visit_date" style="text-align:left;">Visit Date:</label>
            <input type="text" id="visit_date" class="swal2-input form-control" placeholder="Select a Date" required>
            <label for="visit_time"  style="text-align:left;">Visit Time:</label>
            <input type="text" id="visit_time" class="swal2-input form-control" placeholder="Select a Time" required>
        `,
        didOpen: () => {
            // Initialize flatpickr for visit_date
            flatpickr("#visit_date", {
                dateFormat: "Y-m-d",
                enable: dateAvailability.map(item => item.available_date), // Only available dates
                onChange: function(selectedDates, dateStr, instance) {
                    // Find the matching availability
                    const selected = dateAvailability.find(item => item.available_date === dateStr);

                    if (selected) {
                        // Setup time picker with min and max time
                        flatpickr("#visit_time", {
                            enableTime: true,
                            noCalendar: true,
                             disableMobile: true,
                            dateFormat: "H:i",
                            time_24hr: true,
                            minTime: selected.available_start_time.slice(0,5), // "09:00"
                            maxTime: selected.available_end_time.slice(0,5)    // "13:00"
                        });
                    }
                }
            });

            // Initialize time field empty first
            flatpickr("#visit_time", {
                enableTime: true,
                disableMobile: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true,
            });
        },
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: 'Confirm Visit',
        cancelButtonText: 'Cancel',
        preConfirm: () => {
            const visitDate = document.getElementById('visit_date').value;
            const visitTime = document.getElementById('visit_time').value;

            if (!visitDate || !visitTime) {
                Swal.showValidationMessage('Please select both visit date and time');
            }

            return { visitDate, visitTime };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $("#loading").show();
            const visitDate = result.value.visitDate;
            const visitTime = result.value.visitTime;

            submitFormVisit(id, visitDate, visitTime);
        }
    });
}
    // Function to handle Confirm Booking action
    function confrimBooking(id){
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to confirm the booking?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Confirm Booking!',
            cancelButtonText: 'No, Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
               $("#loading").show();
                // Submit form using AJAX
                submitForm(id);
            }
        });
    }

    function cancelBooking(id){
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to cancel the booking?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Cancel Booking!',
            cancelButtonText: 'No, Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
               $("#loading").show();
                // Submit form using AJAX
                submitFormCancel(id);
            }
        });
    }

    function submitFormCancel(id) {

            
        // AJAX form submission
        fetch('save-booking-cancel', {
            method: 'POST',
            body: JSON.stringify({ id: id }), // Stringify the body as JSON
            headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
        })
        .then(response => response.json())
        .then(data => {
            // Handle success or error
            $("#loading").hide();
            if (data.success) {
            
            Swal.fire({
                title: 'Success!',
                text: 'Your booking is cancelled',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                console.log(result);
                if (result.isConfirmed) {
                    // Redirect to the home page after "OK" is clicked
                    window.location.href = '<?php echo url('/my-events');?>';  // Adjust the URL to your home page URL
                }
            });
            } else {
                Swal.fire('Error!', 'There was an issue with the submission. Please try again.', 'error');
            }
        })
        .catch(error => {
                $("#loading").hide();
                Swal.fire('Error!', 'Something went wrong. Please try again.', 'error');
            });
        }

    function submitForm(id) {

    
        // AJAX form submission
        fetch('save-booking-confrimation', {
            method: 'POST',
            body: JSON.stringify({ id: id }), // Stringify the body as JSON
            headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
        })
        .then(response => response.json())
        .then(data => {
            // Handle success or error
            $("#loading").hide();
            if (data.success) {
            
            Swal.fire({
                title: 'Success!',
                text: 'Your booking is confrimed',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                console.log(result);
                if (result.isConfirmed) {
                    // Redirect to the home page after "OK" is clicked
                    window.location.href = '<?php echo url('/my-events');?>';  // Adjust the URL to your home page URL
                }
            });
            } else {
                Swal.fire('Error!', 'There was an issue with the submission. Please try again.', 'error');
            }
        })
        .catch(error => {
                $("#loading").hide();
                Swal.fire('Error!', 'Something went wrong. Please try again.', 'error');
            });
    }


    function submitFormVisit(id,visit_date,visit_time) {

            
        // AJAX form submission
        fetch('save-booking-visit', {
            method: 'POST',
            body: JSON.stringify({ id: id,visit_date:visit_date,visit_time:visit_time }), // Stringify the body as JSON
            headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
        })
        .then(response => response.json())
        .then(data => {
            // Handle success or error
            $("#loading").hide();
            if (data.success) {
            
            Swal.fire({
                title: 'Success!',
                text: 'Your booking is visit confrimed',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                console.log(result);
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Manager will contact you within 3 days to confirm the visit date, thanks for your request.',
                        icon: 'success',
                        timer: 5000,  // 5 seconds
                        timerProgressBar: true,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = '<?php echo url('/my-events');?>';  // Adjust the URL accordingly
                    });

                    // Ensure redirection even if the user doesn't interact
                    setTimeout(() => {
                        window.location.href = '<?php echo url('/my-events');?>';
                    }, 5000);
                }
            });
            } else {
                Swal.fire('Error!', 'There was an issue with the submission. Please try again.', 'error');
            }
        })
        .catch(error => {
                $("#loading").hide();
                Swal.fire('Error!', 'Something went wrong. Please try again.', 'error');
            });
        }
</script>


@endsection