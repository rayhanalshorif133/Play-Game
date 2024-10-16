<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failed - Robi</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .failed-card {
            margin: 5% auto; /* Center the card */
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 500px; /* Limit max width for large screens */
        }
        .failed-icon {
            font-size: 80px;
            color: #dc3545; /* Bootstrap danger color (Red) */
            margin: 20px 0;
            animation: shake 0.5s;
        }
        .details {
            margin-top: 30px;
        }
        @keyframes shake {
            0% { transform: translate(1px, 1px) rotate(0deg); }
            25% { transform: translate(-1px, -2px) rotate(-1deg); }
            50% { transform: translate(-1px, 2px) rotate(1deg); }
            75% { transform: translate(1px, 2px) rotate(0deg); }
            100% { transform: translate(1px, -1px) rotate(-1deg); }
        }
        @media (max-width: 576px) {
            .failed-icon {
                font-size: 60px; /* Smaller icon size on small screens */
            }
            .failed-card {
                padding: 20px; /* More padding on smaller screens */
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card failed-card text-center">
        <div class="card-body">
            <div class="failed-icon">
                <i class="fas fa-times-circle"></i>
            </div>
            <h1 class="display-4">Payment Failed</h1>
            <p class="lead">We're sorry, but your payment could not be processed.</p>

            <div class="details">
                <h5>Error Details:</h5>
                <p><strong>Error Code:</strong> 1001</p> <!-- Replace with actual error code -->
                <p><strong>Error Message:</strong> Insufficient funds. Please try again.</p> <!-- Replace with actual error message -->
            </div>

            <a href="/" class="btn btn-danger btn-lg">Return to Home</a>
            <a href="/retry" class="btn btn-outline-danger btn-lg">Try Again</a>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
