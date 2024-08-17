<!DOCTYPE html>
<html>

<head>
    <style>
        /* Basic reset */
        body,
        h1,
        p,
        ul,
        li {
            margin: 0;
            padding: 0;
        }

        /* Ensure responsiveness */
        @media only screen and (max-width: 600px) {
            .container {
                width: 100% !important;
            }

            .img-fluid {
                width: 100% !important;
                height: auto !important;
            }
        }

        /* Email container */
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 8px;
            font-family: Arial, sans-serif;
        }

        /* Header */
        .header {
            text-align: center;
            padding-bottom: 20px;
        }

        .header h1 {
            color: #333;
        }

        /* Content */
        .content {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .content p {
            color: #555;
            line-height: 1.6;
        }

        .content ul {
            list-style-type: none;
            padding: 0;
        }

        .content li {
            padding: 8px 0;
            border-bottom: 1px solid #ddd;
        }

        .content li:last-child {
            border-bottom: none;
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: #fff;
            border-radius: 0 0 8px 8px;
        }

        .footer p {
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Vehicle Added Successfully</h1>
        </div>
        <!-- Content -->
        <div class="content">
            <p>Hello {{ $customer->name }},</p>
            <p>We are pleased to inform you that your vehicle with the following details has been successfully added to
                our system:</p>
            <ul>
                <li><strong>Vehicle ID:</strong> {{ $vehicle->vehicle_id }}</li>
                <li><strong>Vehicle Number:</strong> {{ $vehicle->vehicle_number }}</li>
                <li><strong>Model Name:</strong> {{ $vehicle->model_name }}</li>
                <li><strong>Color:</strong> {{ $vehicle->color }}</li>
            </ul>
            <p>Thank you for choosing our service center!</p>
        </div>
        <!-- Footer -->
        <div class="footer">
            <p>&copy; {{ date('Y') }} Service Center. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
