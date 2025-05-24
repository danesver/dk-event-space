<!DOCTYPE html>
<html>
<head>
    <style>
        @page {
            margin: 0;
            size: A4;
        }

        body { 
            font-family: Arial, sans-serif; 
            margin: 0;
            padding-top: 50px;
            line-height: 1.4;
        }

        .fixed-header {
            position: fixed;
            top: 0px;
            left: 0;
            right: 0;
            height: 300px;
            padding: 0 50px;
        }

    .header-logo {
        width: 100%; /* Full width */
        height: 200px; /* Fixed height */
        object-fit: contain; /* Maintain aspect ratio */
        display: block;
        margin: 0 -50px; /* Counteract parent padding */
        padding: 10px 0;
    }

    /* Adjust header container to accommodate full-width logo */
    .header {
        margin: 0 -50px; /* Offset parent's padding */
        padding: 0;
        text-align: center;
        overflow: hidden; /* Prevent horizontal scroll */
    }

    /* Existing fixed-header padding should remain */
    .fixed-header {
        padding: 0 50px;
    }

        .header-info {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 380px;
            margin-bottom: 100px;
            page-break-inside: auto;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
            page-break-inside: avoid;
        }

        thead {
            display: table-header-group;
        }

        .main-item {
            background-color: #f5f5f5;
        }

        .total {
            font-weight: bold;
            text-align: right;
            margin-top: 20px;
        }

        .page-break {
            page-break-before: always;
        }

        .payment {
            margin-top: 30px;
        }
         .payment,.contact, .terms{
            margin-right: 50px;   
            margin-left: 50px;
         }

        .footer {
            position: fixed;
            bottom: -60px;
            left: 0;
            right: 0;
            height: 50px;
            text-align: center;
            border-top: 1px solid #000;
        }
    </style>
</head>
<body>
    <!-- Fixed Header -->
    <div class="fixed-header">
        <div class="header">
    <img src="<?=public_path();?>/images/logo-pdf.png" alt="Header Image" class="header-logo" />
</div>

        <div class="header-info">
            <div class="quotation-info" style="float:left;width:50%;">
                <strong>QUOTATION</strong><br>
                No. 000-008<br>
                Date: {{ \Carbon\Carbon::parse(date('Y-m-d'))->format('jS M Y') }}

            </div>

            <div class="client-info" style="float:right;width:50%;text-align: right;">
                <strong>CLIENT</strong><br>
                {{ $customer_name }}<br>
                {{ $customer_phone }}<br>
                {{ \Carbon\Carbon::parse($wedding_date)->format('jS M Y') }}<br>
                {{ $event_slot }}
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>DESCRIPTION</th>
                <th>PRICE (RM)</th>
                <th>TOTAL (RM)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->quotation_text ?? 'N/A' }}</td>
                <td>{{ number_format($item->quotation_amount, 2) }}</td>
                <td>{{ number_format($item->quotation_amount * ($item->quantity ?? 1), 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
        <div class="page-break"></div>



    <!-- Payment Section -->
    <div class="payment">
        <h3>Payment Method :</h3>
        <p>Bank Name : Insta Productions<br>
        Bank Account : Public Bank 3238957013<br>
        Booking fee : 50% from Total Quote 
        <div class="total" style="display: inline-block;
            border-bottom: 1px solid black;
            padding-bottom: 2px;
            margin-left: 20;text-align:right;">
            <strong>Total : RM{{ number_format($total_amount, 2) }}</strong>
        </div></p>
        
        
    </div>

    <!-- Contact Section -->
    <div class="contact">
        <h3>Contact Us :</h3>
        <p>+601-26169014<br>
        LOT 28167, BATU 4, JIN GOMBAK, KAMPUNG KUANTAN,<br>
        53000 KUALA LUMPUR, WILAYAH PERSEKETUAN KL<br>
        elpalaciodelinsta@gmail.com</p>
    </div>

    <!-- Terms Section -->
    <div class="terms">
        <p>Terms and Conditions :<br>
        Quotation valid for 30 days from issued date.</p>
    </div>

    <!-- Total Section -->
    

    <!-- Footer -->
    <div class="footer">
        Page <span class="page-number"></span>
    </div>
</body>
</html>