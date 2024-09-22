<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Error</title>
</head>
<body>
    <h1>Payment Failed!</h1>
    <p>Error Code: <?php echo $_GET['error_code']; ?></p>
    <p>Error Message: <?php echo $_GET['error_message']; ?></p>
</body>
</html>
