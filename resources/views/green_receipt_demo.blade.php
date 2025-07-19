<!DOCTYPE html>
<html>
<head>
    <title>Green Receipt Demo</title>
</head>
<body>
    <h1>🌿 Green Receipt Demo</h1>

    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <form method="POST" action="/green-receipt-demo">
        @csrf
        <label for="category">Enter Purchase Category:</label><br>
        <input type="text" name="category" placeholder="e.g., Fashion" required>
        <button type="submit">Check Impact</button>
    </form>

    @if(isset($result))
        <hr>
        <h2>Result:</h2>
        <p><strong>Category:</strong> {{ $result['category'] }}</p>
        <p><strong>Carbon Impact:</strong> {{ $result['carbon_impact'] }}</p>
        <p><strong>Message:</strong> {{ $result['message'] }}</p>
        <p><strong>Suggestion:</strong> {{ $result['suggestion'] }}</p>
    @endif
</body>
</html>
