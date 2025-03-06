def calculate_loan_repayment(loan_amount):
    # Determine the repayment period based on the loan amount
    if loan_amount <= 2000:
        repayment_period = 1
    elif 2001 <= loan_amount <= 5000:
        repayment_period = 2
    elif 5001 <= loan_amount <= 19999:
        repayment_period = 3
    else:
        repayment_period = 4

    # Calculate the equal installment amount
    installment_amount = loan_amount / repayment_period

    # Initialize variables
    remaining_balance = loan_amount
    total_interest_paid = 0
    total_amount_paid = 0

    # Loop through each repayment period
    for month in range(1, repayment_period + 1):
        # Calculate interest for the current month
        interest_amount = 0.10 * remaining_balance

        # Calculate total repayment for the current month
        total_repayment = installment_amount + interest_amount

        # Update the remaining balance
        remaining_balance -= installment_amount

        # Update total interest paid and total amount paid
        total_interest_paid += interest_amount
        total_amount_paid += total_repayment

        # Print details for the current month
        print(f"Month {month}:")
        print(f"  Interest: K{interest_amount:.2f}")
        print(f"  Total Repayment: K{total_repayment:.2f}")
        print(f"  Remaining Balance: K{remaining_balance:.2f}")
        print("---------------")

    # Print final results (excluding "Interest amount per payment")
    print("\nFinal Results:")
    print(f"Number of Repayments: {repayment_period}")
    print(f"Total repayment per payment: K{total_repayment:.2f}")
    print(f"Overall total paid after all repayments: K{total_amount_paid:.2f}")


# Example usage
loan_amount = float(input("Enter the loan amount in Zambian Kwacha (K): "))
calculate_loan_repayment(loan_amount)