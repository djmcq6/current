<?php
include 'connection.php';

$urlPortfolio = isset($_GET['portfolio']) ? $_GET['portfolio'] : '';

echo "$urlPortfolio";
echo '<br><br>';

if (!isset($urlPortfolio)){
    exit;
}

$getPortfolioTable = "SELECT id_portfolio FROM portfolio WHERE portfolio = '$urlPortfolio'";

$result = $conn->query($getPortfolioTable);

if($result->num_rows > 0){
    while ($row = $result->fetch_assoc()) {
        $portfolioID = $row['id_portfolio'];
        echo $portfolioID;
        echo '<br><br>';
    }
} else {
    echo "No rows found for the provided portfolio.";
}

$urlZig = isset($_GET['zig']) ? $_GET['zig'] : '';
echo $urlZig;
echo '<br><br>';

$getAccountTable = "SELECT id_transactionAccountType, id_acc FROM accounts WHERE zig = '$urlZig' AND id_portfolio = '$portfolioID'";

$resultAccount = $conn->query($getAccountTable);

if($resultAccount->num_rows > 0){
    while ($row = $resultAccount->fetch_assoc()) {
        $transactionAccountTypeID = $row['id_transactionAccountType'];
        $idAcc = $row['id_acc'];
        echo $transactionAccountTypeID . '<br>';
        echo $idAcc;
        echo '<br><br>';
    }
} else {
    echo "No rows found for the provided zig and portfolio combination.";
}


$getAccountingTable = "SELECT id_accounting FROM transactionaccounttype WHERE id_transactionAccountType = '$transactionAccountTypeID'";
$resultAccounting = $conn->query($getAccountingTable);

if ($resultAccounting->num_rows > 0) {
    while ($rowAccounting = $resultAccounting->fetch_assoc()) {
        $idAccounting = $rowAccounting['id_accounting'];
        echo $idAccounting;
        echo '<br><br>';
    }
} else {
    echo "No rows found in transactionaccounttype for the provided transactionAccountTypeID.";
}

$getValueType = "SELECT account_type, primary_type FROM accounting WHERE id_accounting = '$idAccounting'";
$resultValueType = $conn->query($getValueType);

if ($resultValueType->num_rows > 0) {
    while ($rowValueType = $resultValueType->fetch_assoc()) {
        $accountType = $rowValueType['account_type'];
        $primaryType = $rowValueType['primary_type'];
        echo $accountType . '<br>';
        echo $primaryType . '<br><br>';
    }
} else {
    echo "No rows found in accounting for the provided id_accounting.";
}

$transactionValues = "SELECT * FROM transaction_journal WHERE id_acc = '$idAcc'";
$resultTransactionValues = $conn->query($transactionValues);

if ($resultTransactionValues->num_rows > 0) {
    while ($rowTransactionValues = $resultTransactionValues->fetch_assoc()) {
        $amountTj = $rowTransactionValues['amount_tj'];
        echo $amountTj . '<br><br>';
    }
} else {
    echo "No rows found in transaction_journal for the provided id_acc.";
}

if ($accountType === 'Book Value' && $primaryType === 'debit') {
    // Query to get the sum of amount_tj based on conditions
    $sumQuery = "SELECT SUM(CASE WHEN debit_credit = 'debit' THEN amount_tj ELSE 0 END) AS total_debits,
                        SUM(CASE WHEN debit_credit = 'credit' THEN amount_tj ELSE 0 END) AS total_credits
                 FROM transaction_journal WHERE id_acc = '$idAcc'";
    
    $resultSum = $conn->query($sumQuery);

    if ($resultSum->num_rows > 0) {
        $rowSum = $resultSum->fetch_assoc();
        $totalDebits = $rowSum['total_debits'];
        $totalCredits = $rowSum['total_credits'];

        $balance = $totalDebits - $totalCredits;
        echo "Total Debits: $totalDebits <br>";
        echo "Total Credits: $totalCredits <br>";
        echo "Balance: $balance <br>";
    } else {
        echo "No rows found for the provided conditions.";
    }
}

if ($accountType === 'Book Value' && $primaryType === 'credit') {
    // Query to get the sum of amount_tj based on conditions
    $sumQuery = "SELECT SUM(CASE WHEN debit_credit = 'credit' THEN amount_tj ELSE 0 END) AS total_credits,
                        SUM(CASE WHEN debit_credit = 'debit' THEN amount_tj ELSE 0 END) AS total_debits
                 FROM transaction_journal WHERE id_acc = '$idAcc'";
    
    $resultSum = $conn->query($sumQuery);

    if ($resultSum->num_rows > 0) {
        $rowSum = $resultSum->fetch_assoc();
        $totalCredits = $rowSum['total_credits'];
        $totalDebits = $rowSum['total_debits'];

        $balance = $totalCredits - $totalDebits;
        echo "Total Credits: $totalCredits <br>";
        echo "Total Debits: $totalDebits <br>";
        echo "Balance: $balance <br>";
    } else {
        echo "No rows found for the provided conditions.";
    }
}
?>


