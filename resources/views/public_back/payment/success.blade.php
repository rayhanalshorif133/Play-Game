<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success - Robi</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .success-card {
            margin: 5% auto; /* Center the card */
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 500px; /* Limit max width for large screens */
        }
        .success-icon {
            font-size: 80px;
            color: #28a745;
            margin: 20px 0;
            animation: pulse 1.5s infinite;
        }
        .details {
            margin-top: 30px;
        }
        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
            }
        }
        @media (max-width: 576px) {
            .success-icon {
                font-size: 60px; /* Smaller icon size on small screens */
            }
            .success-card {
                padding: 20px; /* More padding on smaller screens */
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card success-card text-center">
        <div class="card-body">
            <div class="success-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h1 class="display-4">Payment Successful!</h1>
            <p class="lead">Thank you for your payment. Your transaction has been processed successfully.</p>

            <div class="details">
                <h5>Transaction Details:</h5>
                <p><strong>MSISDN:</strong> +8801886912118</p>
                <p><strong>Amount Charged:</strong> $3.00</p>
                <p><strong>Transaction ID:</strong> C-7813cc0d-bbfe-4ee2-8b83-7ff76fdb1730</p>
                <p><strong>Status:</strong> Charged</p>
                <p><strong>Charge Mode:</strong> Standard</p>
            </div>

            <a href="/" class="btn btn-success btn-lg">Return to Home</a>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
