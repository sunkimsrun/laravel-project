

<!-- //not working yet -->




<!-- <!DOCTYPE html>
<html>
<head>
    <title>Add Guest & Hotel</title>
</head>
<body>

    <h1>Add a Guest</h1>
    @if (session('guest_message'))
        <p style="color: green;">{{ session('guest_message') }}</p>
    @endif
    <form method="POST" action="{{ url('/post/guests') }}">
        @csrf
        <label>Name:</label><br>
        <input type="text" name="name" required><br>

        <label>Phone Number:</label><br>
        <input type="text" name="phone_number"><br>

        <label>Address:</label><br>
        <input type="text" name="address"><br><br>

        <button type="submit">Add Guest</button>
    </form>

    <hr>

    <h1>Add a Hotel</h1>
    @if (session('hotel_message'))
        <p style="color: green;">{{ session('hotel_message') }}</p>
    @endif
    <form method="POST" action="{{ url('/post/hotels') }}">
        @csrf
        <label>Hotel Name:</label><br>
        <input type="text" name="name" required><br>

        <label>Location:</label><br>
        <input type="text" name="location" required><br>

        <label>Rating:</label><br>
        <input type="number" name="rating" step="0.1" required><br>

        <label>Contact Info:</label><br>
        <input type="text" name="contact_info" required><br><br>

        <button type="submit">Add Hotel</button>
    </form>

</body>
</html> -->
