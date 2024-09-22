<?php

require 'vendor/autoload.php'; // Composer's autoload file for Authorize.Net SDK

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
use net\authorize\api\constants\ANetEnvironment;

function processPayment($cardNumber, $expDate, $cvv, $amount) {
    // API credentials
    $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
    $merchantAuthentication->setName(''); // Replace with your API login ID
    $merchantAuthentication->setTransactionKey(''); // Replace with your transaction key

    // Set transaction reference ID
    $refId = 'ref' . time();

    // Credit card info
    $creditCard = new AnetAPI\CreditCardType();
    $creditCard->setCardNumber($cardNumber);
    $creditCard->setExpirationDate($expDate);
    $creditCard->setCardCode($cvv);

    // Payment info
    $paymentOne = new AnetAPI\PaymentType();
    $paymentOne->setCreditCard($creditCard);

    // Transaction request
    $transactionRequestType = new AnetAPI\TransactionRequestType();
    $transactionRequestType->setTransactionType("authCaptureTransaction");
    $transactionRequestType->setAmount($amount);
    $transactionRequestType->setPayment($paymentOne);

    // Create transaction request
    $request = new AnetAPI\CreateTransactionRequest();
    $request->setMerchantAuthentication($merchantAuthentication);
    $request->setRefId($refId);
    $request->setTransactionRequest($transactionRequestType);

    // Execute transaction
    $controller = new AnetController\CreateTransactionController($request);
    $response = $controller->executeWithApiResponse(ANetEnvironment::SANDBOX); // <-- Use ANetEnvironment here

    var_dump($response);
    // Handle response
    if ($response != null) {
        $tresponse = $response->getTransactionResponse();
        if ($tresponse != null && $tresponse->getMessages() != null) {
            // Success
            header('Location: success.php?transaction_id=' . $tresponse->getTransId());
            exit;
        } else if ($tresponse != null && $tresponse->getErrors() != null) {
            // Failure
            header('Location: error.php?error_code=' . $tresponse->getErrors()[0]->getErrorCode() . '&error_message=' . $tresponse->getErrors()[0]->getErrorText());
            exit;
        }
    } else {
        // General error
        header('Location: error.php?error_code=E00000&error_message=No Response from Gateway');
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cardNumber = $_POST['card_number'];
    $expDate = $_POST['exp_date'];
    $cvv = $_POST['cvv'];
    $amount = $_POST['amount'];

    processPayment($cardNumber, $expDate, $cvv, $amount);
}
?>
