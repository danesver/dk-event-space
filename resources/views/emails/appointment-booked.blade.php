<html>
<body>
    <h1>Appointment Confirmation</h1>
    <p>Thank you for booking an appointment with us!</p>

    <h3>Appointment Details:</h3>
    <p><strong>First Name:</strong> {{ $data['firstname'] }}</p>
    <p><strong>Last Name:</strong> {{ $data['lastname'] }}</p>
    <p><strong>Email:</strong> {{ $data['user_email'] }}</p>
    <p><strong>Phone Number:</strong> {{ $data['phone'] }}</p>
    <p><strong>Wedding Type:</strong> {{ $data['wedding_type'] }}</p>
    <p><strong>Number of Guests:</strong> {{ $data['no_of_guest'] }}</p>
    <p><strong>Wedding Date:</strong> {{ $data['wedding_date'] }}</p>
    <p><strong>Event Slot:</strong> {{ $data['event_slot'] }}</p>
    <p><strong>Seating Arrangement:</strong> {{ $data['seating_arrangement'] }}</p>
    <p><strong>Special Requests:</strong> {{ $data['special_requests'] }}</p>

    @if ($data['visit_date'])
        <h3>Visit Details:</h3>
        <p><strong>Visit Date:</strong> {{ $data['visit_date'] }}</p>
        <p><strong>Visit Time:</strong> {{ $data['visit_time'] }}</p>
    @endif
</body>
</html>
