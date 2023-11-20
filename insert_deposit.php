<?php
// Include connection to the database
include 'connection.php';

// Retrieve variables from URL
$portfolio = $_GET['portfolio'];
$zig = $_GET['zig'];

// Query to get id_portfolio from portfolio table
$getPortfolioIdQuery = "SELECT id_portfolio FROM portfolio WHERE portfolio = '$portfolio'";
$resultPortfolioId = $conn->query($getPortfolioIdQuery);
$rowPortfolioId = $resultPortfolioId->fetch_assoc();
$id_portfolio = $rowPortfolioId['id_portfolio'];

// Query to get id_acc from accounts table using zig
$getAccountIdQuery = "SELECT id_acc FROM accounts WHERE zig = '$zig'";
$resultAccountId = $conn->query($getAccountIdQuery);
$rowAccountId = $resultAccountId->fetch_assoc();
$id_acc = $rowAccountId['id_acc'];

// Retrieve form data
$date = $_POST['date'];
$amount = $_POST['amount'];
$account2 = $_POST['account2'];

// First Insert query for debit transaction
$insertDebitQuery = "INSERT INTO transaction_journal (date_tj, id_acc, debit_credit, amount_tj) VALUES (?, ?, 'debit', ?)";
$stmtDebit = $conn->prepare($insertDebitQuery);
$stmtDebit->bind_param("sis", $date, $id_acc, $amount);
$stmtDebit->execute();

// Second Insert query for credit transaction
$insertCreditQuery = "INSERT INTO transaction_journal (date_tj, id_acc, debit_credit, amount_tj) VALUES (?, ?, 'credit', ?)";
$stmtCredit = $conn->prepare($insertCreditQuery);
$stmtCredit->bind_param("sis", $date, $account2, $amount);
$stmtCredit->execute();

// Construct URL for redirection
$redirectURL = "newportfolio1.php?portfolio=$portfolio&zig=$zig";

// Redirect to newportfolio1.php
header("Location: $redirectURL");
exit();
?>