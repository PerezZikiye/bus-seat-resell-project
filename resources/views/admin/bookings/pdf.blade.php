<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bookings PDF</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #999; padding: 8px; font-size: 12px; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h2>Bookings Report</h2>
    <table>
        <thead>
            <tr>
                <th>User</th>
                <th>From</th>
                <th>To</th>
                <th>Date</th>
                <th>Time</th>
                <th>Seats</th>
                <th>Amount</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $booking->user->name ?? 'N/A' }}</td>
                    <td>{{ $booking->from }}</td>
                    <td>{{ $booking->to }}</td>
                    <td>{{ $booking->travel_date }}</td>
                    <td>{{ $booking->travel_time }}</td>
                    <td>{{ $booking->seats }}</td>
                    <td>₦{{ number_format($booking->amount, 2) }}</td>
                    <td>{{ ucfirst($booking->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
