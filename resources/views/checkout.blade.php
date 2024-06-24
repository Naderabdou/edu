<!DOCTYPE html>
<html>

<head>
    <title>Paymob Payment</title>
</head>

<body>
    <form action="{{ route('credit') }}" method="POST">
        @csrf
        <label for="amount">Amount:</label>
        <input type="text" name="amount" id="amount" required>
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" id="first_name" required>
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" id="last_name" required>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number" id="phone_number" required>
        <button type="submit">Pay</button>
    </form>
</body>

</html>
