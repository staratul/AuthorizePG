<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Details</title>
</head>
<body>
    <h2>Enter your card details</h2>
    <form action="process-payment.php" method="post">
        <label>Card Number:</label><br>
        <input type="text" name="card_number" required><br><br>
        
        <label>Expiration Date (YYYY-MM):</label><br>
        <input type="text" name="exp_date" required><br><br>
        
        <label>Card Code (CVV):</label><br>
        <input type="text" name="cvv" required><br><br>
        
        <label>Amount:</label><br>
        <input type="text" name="amount" value="5.00" readonly><br><br>

        <button type="submit">Submit Payment</button>
    </form>
</body>
</html>
