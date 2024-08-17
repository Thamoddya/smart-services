<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Service Center</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            background-color: #4e73df;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }

        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }

        .email-body {
            padding: 20px;
        }

        .email-body p {
            font-size: 16px;
            line-height: 1.5;
            margin: 0 0 20px;
        }

        .email-body .cta {
            display: inline-block;
            padding: 10px 20px;
            background-color: #1cc88a;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }

        .email-footer {
            background-color: #f4f4f4;
            color: #666666;
            padding: 20px;
            text-align: center;
            font-size: 12px;
        }

        .email-footer a {
            color: #4e73df;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Welcome to Our Service Center, {{ $customerName }}!</h1>
        </div>
        <div class="email-body">
            <p>Dear {{ $customerName }},</p>
            <p>We are thrilled to have you as a new customer at our service center. We are committed to providing you
                with the best service possible.</p>
            <p>If you have any questions or need assistance, feel free to contact us. We're here to help you with all
                your vehicle needs.</p>
            <p>As a token of our appreciation, here’s a special offer just for you:</p>
        </div>
        <div class="email-footer">
            <p>Thank you for choosing us. We look forward to serving you!</p>
            <p>Best regards,<br>Your Service Center Team</p>
            <p><a href="#">Unsubscribe</a> | <a href="#">Privacy Policy</a></p>
        </div>
    </div>
</body>

</html>
