<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Quotation - {{ $quotation->quotation_number }}</title>
    <style>
        @page {
            margin: 0;
            padding: 0;
        }
        body { 
            font-family: 'Arial', sans-serif; 
            margin: 0;
            padding: 0;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 210mm;
            margin: 0 auto;
            padding: 20mm;
            position: relative;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #d4af37;
        }
        .company-name {
            font-size: 36px;
            font-weight: bold;
            color: #2c3e50;
            letter-spacing: 2px;
            margin-bottom: 5px;
        }
        .company-tagline {
            font-size: 18px;
            color: #7f8c8d;
            font-weight: normal;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }
        .contact-info {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }
        .client-details {
            background: #f8f9fa;
            padding: 20px;
            margin: 20px 0;
            border-left: 4px solid #d4af37;
        }
        .section-title {
            font-size: 20px;
            font-weight: bold;
            color: #2c3e50;
            margin: 30px 0 15px 0;
            padding-bottom: 5px;
            border-bottom: 2px solid #ecf0f1;
        }
        .menu-category {
            margin: 20px 0;
        }
        .category-title {
            font-size: 16px;
            font-weight: bold;
            color: #34495e;
            margin-bottom: 10px;
            background: #ecf0f1;
            padding: 8px 12px;
            border-radius: 4px;
        }
        .menu-items {
            margin-left: 20px;
        }
        .menu-item {
            margin: 5px 0;
            position: relative;
            padding-left: 15px;
        }
        .menu-item:before {
            content: "•";
            position: absolute;
            left: 0;
            color: #d4af37;
            font-weight: bold;
        }
        .pricing-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: #f8f9fa;
        }
        .pricing-table td {
            padding: 12px;
            border: 1px solid #ddd;
        }
        .pricing-table .label {
            font-weight: bold;
            background: #ecf0f1;
            width: 30%;
        }
        .total-section {
            text-align: right;
            margin: 30px 0;
            padding: 20px;
            background: #2c3e50;
            color: white;
            border-radius: 4px;
        }
        .total-amount {
            font-size: 24px;
            font-weight: bold;
        }
        .policies {
            margin: 30px 0;
            padding: 20px;
            background: #fff8e1;
            border-left: 4px solid #ffa000;
        }
        .policy-section {
            margin: 15px 0;
        }
        .policy-title {
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 5px;
        }
        .signature-section {
            margin: 50px 0 30px 0;
            padding-top: 20px;
            border-top: 2px dashed #bdc3c7;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #7f8c8d;
            border-top: 1px solid #ecf0f1;
            padding-top: 20px;
        }
        .fssai-logo {
            text-align: center;
            margin: 10px 0;
        }
        .fssai-text {
            font-family: 'Courier New', monospace;
            font-weight: bold;
            font-size: 14px;
            letter-spacing: 1px;
        }
        .page-break {
            page-break-before: always;
        }
        .quotation-number {
            position: absolute;
            top: 20px;
            right: 20px;
            background: #2c3e50;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
        }


        .menu-category {
    page-break-inside: avoid;
}

.policy-section {
    page-break-inside: avoid;
}

/* Ensure tables don't break across pages */
table {
    page-break-inside: avoid;
}

/* Better list styling */
ul {
    margin: 10px 0;
}

li {
    margin: 5px 0;
    page-break-inside: avoid;
}
    </style>
</head>
<body>
    <div class="container">
        <!-- Quotation Number Badge -->
        <div class="quotation-number">
            {{ $quotation->quotation_number }}
        </div>

        <!-- Header Section -->
       <div class="header">
    <img src="{{ storage_path('app/public/images/adens-logo.png') }}" style="height: 80px; margin-bottom: 10px;">
    <div class="company-tagline">CATERERS & EVENT PLANNERS</div>
    <!-- rest of header -->
</div>


        <!-- Client Details -->
        <div class="client-details">
            <table width="100%">
                <tr>
                    <td width="50%">
                        <strong>To:</strong><br>
                        <span style="font-size: 18px; font-weight: bold;">{{ $quotation->client_name }}</span>
                    </td>
                    <td width="50%" style="text-align: right;">
                        <strong>DATE:</strong> {{ $quotation->event_date }}<br>
                        <strong>PLACE:</strong> {{ $quotation->client_place }}
                    </td>
                </tr>
            </table>
        </div>

        <!-- Introduction Text -->
        <div style="margin: 25px 0; line-height: 1.8;">
            <p>Thank you for the opportunity to host your event. We at Adens Events are excited to share our exceptional food and services with you and your esteemed guests. We understand that planning an event can be a stressful experience, and we promise to do everything possible to make this process seamless for you.</p>
            
            <p>We have carefully considered all your concerns and requests while developing this proposal and quote. Our aim is to ensure that our food and services not only meet but exceed your high standards and personal preferences. Beyond our standard menu and food services, Adens Events also offers a variety of other services, including:</p>
            
            <ul style="columns: 2; margin: 15px 0 15px 20px;">
                <li>EVENT PLANNING</li>
                <li>DECORATIONS</li>
                <li>ENTERTAINMENT PROGRAMS</li>
                <li>PHOTOGRAPHY</li>
                <li>SECURITY SERVICES</li>
                <li>HOSPITALITY</li>
            </ul>
            
            <p>This proposal includes only the services you asked for. If you have any concerns or would like to add additional services, please don't hesitate to reach out to us.<br>
            We hope this proposal for the <strong>{{ $quotation->event_name }}</strong> Event in <strong>{{ $quotation->event_date }}</strong>, at <strong>{{ $quotation->client_place }}</strong>, aligns with your expectations. Our goal is to ensure an enjoyable and unforgettable experience for you and your guests.</p>
        </div>

        <!-- Event Details -->
        <div style="background: #2c3e50; color: white; padding: 15px; border-radius: 4px; margin: 25px 0;">
            <table width="100%">
                <tr>
                    <td width="33%"><strong>Event:</strong> {{ $quotation->event_name }}</td>
                    <td width="33%" style="text-align: center;"><strong>Date:</strong> {{ $quotation->event_date }}</td>
                    <td width="33%" style="text-align: right;"><strong>Time:</strong> {{ $quotation->event_time }}</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Page Break -->
    <div class="page-break"></div>

    <div class="container">
        <!-- Food Menu Section -->
        <div class="section-title">Food Menu</div>

        @php
            $groupedItems = $quotation->quotationItems->groupBy(function($item) {
                return $item->menuItem->category->name;
            });
        @endphp
        
        @foreach($groupedItems as $categoryName => $items)
        <div class="menu-category">
            <div class="category-title">{{ $categoryName }}</div>
            <div class="menu-items">
                @foreach($items as $item)
                <div class="menu-item">{{ $item->menuItem->name }}</div>
                @endforeach
            </div>
        </div>
        @endforeach

        <!-- Pricing Table -->
        <table class="pricing-table">
            <tr>
                <td class="label">Per Plate</td>
                <td>₹{{ number_format($quotation->per_plate_price, 0) }}/-</td>
                <td class="label">No. of People</td>
                <td><strong>{{ number_format($quotation->number_of_people) }} Nos</strong></td>
            </tr>
        </table>

        <!-- Total Amount -->
        <div class="total-section">
            Total Estimated Cost: <span class="total-amount">₹{{ number_format($quotation->total_amount, 2) }}</span>
        </div>

        <!-- FSSAI Logo -->
 <div class="fssai-logo">
                <img src="{{ asset('assets/images/fssai-logo.png') }}" style="height: 40px; display: block; margin: 0 auto;">
            </div>
    </div>

    <!-- Page Break -->
    <div class="page-break"></div>

    <div class="container">
        <!-- Company Policies -->
        <div class="section-title">Company Policies</div>

        <div class="policies">
            <div class="policy-section">
                <div class="policy-title">Guaranteed Minimum Guest Count & Time Duration:</div>
                <p>The fees and pricing quoted in this proposal are estimates based on the client's guaranteed minimum guest count and time duration. If additional guests are served or extra time is required beyond the estimate, the caterer reserves the right to charge a fair price for the additional services. If fewer guests attend or less time is required, the caterer will still be paid based on the guaranteed minimum.</p>
            </div>

            <div class="policy-section">
                <div class="policy-title">Deposit</div>
                <p>An initial deposit of 30% of the total estimated cost is required to confirm the booking. Refunds will be provided as follows:</p>
                <ul style="margin-left: 20px;">
                    <li>Cancellation within 31 days of the event: Full refund of the deposit.</li>
                    <li>Cancellation within 11 to 30 days of the event: 50% refund of the deposit.</li>
                    <li>Cancellation less than 11 days before the event: No refund of the deposit.</li>
                </ul>
            </div>

            <div class="policy-section">
                <div class="policy-title">Payment Terms</div>
                <ul style="margin-left: 20px;">
                    <li>The quoted final cost, minus the deposit, must be paid within 5 business days after the event.</li>
                    <li>Additional costs for extra services or guests will be billed within 5 business days after the event and must be paid within 20 business days.</li>
                    <li>Late payments will incur fair interest charges, and the caterer reserves the right to take legal action if necessary.</li>
                    <li>Pricing is based on current market rates for vegetables and meat. Final billing may reflect significant changes in market prices at the time of the event.</li>
                </ul>
            </div>
        </div>

        <!-- Signature Section -->
        <div class="signature-section">
            <p>I, ______, hereby agree to the caterer's services as listed and quoted in this proposal according to the terms and conditions herein.</p>
            
            <table width="100%" style="margin-top: 40px;">
                <tr>
                    <td width="50%">
                        <strong>Client's Signature:</strong><br><br>
                        _________________________
                    </td>
                    <td width="50%" style="text-align: right;">
                        <strong>Date:</strong><br><br>
                        _________________________
                    </td>
                </tr>
            </table>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="fssai-logo">
                <img src="{{ asset('assets/images/fssai-logo.png') }}" style="height: 40px; display: block; margin: 0 auto;">
            </div>
            <p>Thank you for choosing Adens Events! We look forward to serving you.</p>
            <p>This quotation is valid for 30 days from the date of issue.</p>
        </div>
    </div>
</body>
</html>