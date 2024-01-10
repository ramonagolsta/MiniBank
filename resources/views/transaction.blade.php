

<form action="{{ route('make.transaction') }}" method="POST">
    @csrf
    <label for="recipient_account_number">Recipient Account Number:</label>
    <input type="text" name="recipient_account_number" required>

    <label for="amount">Amount:</label>
    <input type="number" name="amount" required step="0.01">

    <button type="submit">Make Transaction</button>
</form>

