<!-- resources/views/emails/wedding_reminder.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding Reminder</title>
    <style>
        /* Add some basic styles for the email */
        body {
            font-family: Arial, sans-serif;
            color: #333;
            padding: 20px;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            font-size: 24px;
            color: #4CAF50;
        }
        .details {
            margin-top: 20px;
            font-size: 16px;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #777;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="email-container">
        <div class="header">
            <h2>Visit Reminder</h2>
        </div>

        <div class="details">
            <p>Dear {{ $name }},</p>
            <p>This is a friendly reminder about your upcoming visit!</p>
            
            <p><strong>Event Date:</strong> {{ \Carbon\Carbon::parse($eventDate)->format('l, F j, Y') }}</p>
            <p><strong>Status:</strong> {{ ucfirst($status) }}</p>
            <p><strong>Wedding Type:</strong> {{ ucfirst($type) }}</p>

            <p>We look forward to celebrating with you!</p>
        </div>

        <div class="footer">
            <p>Best regards,</p>
            <p>Your Wedding Planner Team</p>
        </div>
    </div>

</body>
</html>
