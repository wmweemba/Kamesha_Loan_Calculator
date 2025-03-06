<?php
/*
Plugin Name: Loan Repayment Calculator
Description: A plugin to calculate loan repayments based on the given criteria.
Version: 1.0
Author: William Mweemba
ShortCode: [loan_repayment_calculator]
*/

// Function to calculate loan repayment
function calculate_loan_repayment($loan_amount) {
    // Determine the repayment period based on the loan amount
    if ($loan_amount <= 2000) {
        $repayment_period = 1;
    } elseif ($loan_amount >= 2001 && $loan_amount <= 5000) {
        $repayment_period = 2;
    } elseif ($loan_amount >= 5001 && $loan_amount <= 19999) {
        $repayment_period = 3;
    } else {
        $repayment_period = 4;
    }

    // Calculate the equal installment amount
    $installment_amount = $loan_amount / $repayment_period;

    // Initialize variables
    $remaining_balance = $loan_amount;
    $total_interest_paid = 0;
    $total_amount_paid = 0;

    // Output buffer to capture the results
    $output = '';

    // Loop through each repayment period
    for ($month = 1; $month <= $repayment_period; $month++) {
        // Calculate interest for the current month
        $interest_amount = 0.10 * $remaining_balance;

        // Calculate total repayment for the current month
        $total_repayment = $installment_amount + $interest_amount;

        // Update the remaining balance
        $remaining_balance -= $installment_amount;

        // Update total interest paid and total amount paid
        $total_interest_paid += $interest_amount;
        $total_amount_paid += $total_repayment;

        // Add details for the current month to the output
        $output .= "<p><strong>Month $month:</strong></p>";
        $output .= "<p>Interest: K" . number_format($interest_amount, 2) . "</p>";
        $output .= "<p>Total Repayment: K" . number_format($total_repayment, 2) . "</p>";
        $output .= "<p>Remaining Balance: K" . number_format($remaining_balance, 2) . "</p>";
        $output .= "<hr>";
    }

    // Add final results to the output
    $output .= "<p><strong>Final Results:</strong></p>";
    $output .= "<p>Number of Repayments: $repayment_period</p>";
    $output .= "<p>Total repayment per payment: K" . number_format($total_repayment, 2) . "</p>";
    $output .= "<p>Overall total paid after all repayments: K" . number_format($total_amount_paid, 2) . "</p>";

    return $output;
}

// Shortcode to display the loan repayment calculator
function loan_repayment_calculator_shortcode() {
    // Check if the form has been submitted
    if (isset($_POST['loan_amount'])) {
        $loan_amount = floatval($_POST['loan_amount']);
        return calculate_loan_repayment($loan_amount);
    }

    // HTML form for user input
    $form = '
    <form method="post" action="">
        <label for="loan_amount">Enter the loan amount in Zambian Kwacha (K):</label>
        <input type="number" step="0.01" name="loan_amount" id="loan_amount" required>
        <button type="submit">Calculate</button>
    </form>
    ';

    return $form;
}

// Register the shortcode
add_shortcode('loan_repayment_calculator', 'loan_repayment_calculator_shortcode');