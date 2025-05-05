<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quotation</title>
    <style>
        /* Set page size and margins for dompdf */
        @page {
            size: A4;
            margin: 10mm; /* Reduced top, bottom, left, and right margins */
        }

        /* Global Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            width: 100%; /* Ensure the container takes up full width */
            padding: 10px; /* Reduced padding */
            box-sizing: border-box;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            page-break-inside: avoid; /* Prevent page break within the container */
        }

        /* Header Section */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px; /* Reduced margin */
            border-bottom: 1px solid #f4f4f4; /* Thinner border */
            padding-bottom: 5px; /* Reduced padding */
        }

        .header .logo {
            width: 80px; /* Further reduced logo size */
            height: auto;
        }

        .header .company-details {
            text-align: right;
            font-size: 10px; /* Reduced font size further */
        }

        .header .company-details h1 {
            margin: 0;
            color: #2c3e50;
            font-size: 18px; /* Reduced company name font size */
            font-weight: 700;
        }

        .header .company-details p {
            color: #7f8c8d;
            font-size: 9px; /* Reduced font size */
            margin: 0;
        }

        .header .quotation-info {
            text-align: center;
            font-size: 14px;
            color: #7f8c8d;
            margin-top: 5px; /* Reduced space above */
        }

        .quotation-info h2 {
            font-size: 18px; /* Reduced size */
            margin-bottom: 5px;
        }

        /* Customer Section */
        .customer-details {
            margin-bottom: 10px; /* Reduced margin */
        }

        .customer-details table {
            width: 100%;
            font-size: 12px; /* Reduced font size */
            margin-bottom: 5px; /* Reduced space between customer details and table */
        }

        .customer-details th, .customer-details td {
            padding: 5px 8px; /* Reduced padding */
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .customer-details th {
            background-color: #f2f2f2;
            color: #34495e;
        }

        /* Quotation Table */
        .quotation-details {
            margin-bottom: 10px; /* Reduced margin */
        }

        .quotation-details table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px; /* Reduced font size */
        }

        .quotation-details th, .quotation-details td {
            padding: 6px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .quotation-details th {
            background-color: #f5f5f5;
            color: #34495e;
            font-weight: 600;
        }

        .quotation-details td {
            color: #7f8c8d;
        }

        .quotation-details tr:last-child td {
            border-bottom: none;
        }

        .quotation-details td.total {
            font-weight: 700;
            font-size: 14px; /* Reduced font size */
            color: #e74c3c;
        }

        /* Total Section */
        .total {
            font-size: 16px;
            font-weight: 700;
            color: #e74c3c;
            margin-top: 10px; /* Reduced space above */
        }

        /* Footer Section */
        .footer {
            text-align: center;
            margin-top: 10px; /* Reduced margin */
            color: #7f8c8d;
            font-size: 10px; /* Reduced font size */
        }

        .footer p {
            margin: 5px;
        }

        .footer a {
            color: #3498db;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        /* Prevent page breaks in key sections */
        .quotation-info,
        .customer-details,
        .quotation-details,
        .total,
        .footer {
            page-break-inside: avoid; /* Prevent page break within these sections */
        }

    </style>
</head>
<body>

<div class="container">
    <!-- Header Section -->
    <div class="header">
        <!-- Company Logo -->
        <div class="logo">
            <img src="company_logo.png" alt="Company Logo" style="width: 100%;">
        </div>
        <!-- Company Details -->
        <div class="company-details">
            <h1>Qaca House</h1>
            <p>123 Main Street, City, Country</p>
            <p>Email: support@company.com | Phone: (123) 456-7890</p>
        </div>
    </div>

    <!-- Quotation Info Section -->
    <div class="quotation-info">
        <h2>Quotation for: 
            @if($wedding_type =='Other Event Type')
                {{$other_wedding_type}}
            @else
                {{$wedding_type}}
            @endif
        </h2>
        <p><strong>Event Date:</strong> {{ $wedding_date }}</p>
    </div>

    <!-- Customer Section -->
    <div class="customer-details">
        <table>
            <tr>
                <th>Customer Name</th>
                <td>{{ $customer_name }}</td>
            </tr>
            <tr>
                <th>Phone Number</th>
                <td>{{ $customer_phone }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $customer_email }}</td>
            </tr>
        </table>
    </div>

    <!-- Quotation Details Table -->
    <div class="quotation-details">
        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>
                        {{ $item->quotation_text }}
                    </td>
                    <td>${{ number_format($item->quotation_amount, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Total Section -->
    <div class="total">
        <p><strong>Total Amount: ${{ number_format($total_amount, 2) }}</strong></p>
    </div>

    <!-- Footer Section -->
    <div class="footer">
        <p>Thank you for choosing our services! For any queries, please <a href="mailto:support@company.com">contact us</a>.</p>
        <p>&copy; {{ date('Y') }} Qaca House. All Rights Reserved.</p>
    </div>
</div>

</body>
</html>
