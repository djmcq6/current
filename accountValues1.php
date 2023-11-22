<?php
// accountValues1.php

function getBalanceForAccount($idAcc1, $conn) {
    $query = "SELECT 
                a.*, 
                tat.*, 
                ac.account_type, 
                ac.primary_type
              FROM accounts a
              INNER JOIN transactionaccounttype tat ON a.id_transactionAccountType = tat.id_transactionAccountType
              INNER JOIN accounting ac ON tat.id_accounting = ac.id_accounting
              WHERE a.id_acc = '$idAcc1'";

    $result = $conn->query($query);

    if ($result === false) {
        return 'Error executing query: ' . $conn->error;
    } else {
        if ($result->num_rows === 0) {
            return '-';//if Values Is BLANK
        } else {
            $accountingRule = '';
            while ($row = $result->fetch_assoc()) {
                $accountingRule = $row['id_accounting'];
            }

            if ($accountingRule == 1) {
                $sumQuery = "SELECT SUM(CASE WHEN debit_credit = 'debit' THEN amount_tj ELSE 0 END) AS total_debits,
                                    SUM(CASE WHEN debit_credit = 'credit' THEN amount_tj ELSE 0 END) AS total_credits
                             FROM transaction_journal WHERE id_acc = '$idAcc1'";

                $resultSum = $conn->query($sumQuery);

                if ($resultSum->num_rows > 0) {
                    $rowSum = $resultSum->fetch_assoc();
                    $totalDebits = $rowSum['total_debits'];
                    $totalCredits = $rowSum['total_credits'];

                    $balance = $totalDebits - $totalCredits;
                    return $balance;
                } else {
                    return 'No rows found for the provided conditions.';
                }
            } elseif ($accountingRule == 3) {
                $sumQuery = "SELECT SUM(CASE WHEN debit_credit = 'credit' THEN amount_tj ELSE 0 END) AS total_credits,
                                    SUM(CASE WHEN debit_credit = 'debit' THEN amount_tj ELSE 0 END) AS total_debits
                             FROM transaction_journal WHERE id_acc = '$idAcc1'";
            
                $resultSum = $conn->query($sumQuery);
            
                if ($resultSum->num_rows > 0) {
                    $rowSum = $resultSum->fetch_assoc();
                    $totalCredits = $rowSum['total_credits'];
                    $totalDebits = $rowSum['total_debits'];
            
                    $balance = $totalCredits - $totalDebits;
                    return $balance;
                } else {
                    return 'No rows found for the provided conditions.';
                }
            } else {
                return 'Rule Not Set';
            }
        }
    }
}
?>
