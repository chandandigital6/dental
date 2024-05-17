<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Appointment Created</title>
</head>
<body>
<div style="font-family: Arial, sans-serif;">
    <h2 style="color: #333;">New Appointment Created</h2>

    <p><strong>Appointment Details:</strong></p>
    <ul>
        <li><strong>Service:</strong> {{ $appointment->service }}</li>
        <li><strong>Doctor:</strong> {{ $appointment->doctor }}</li>
        <li><strong>Name:</strong> {{ $appointment->name }}</li>
        <li><strong>Email:</strong> {{ $appointment->email }}</li>
        <li><strong>Phone Number:</strong> {{ $appointment->number }}</li>
        <li><strong>Date:</strong> {{ $appointment->date ? $appointment->date->format('Y-m-d') : 'Not specified' }}</li>
        <li><strong>Time:</strong> {{ $appointment->time ?? 'Not specified' }}</li>
    </ul>

    <p style="color: #888;">This is an automated notification. Please do not reply to this email.</p>
</div>
</body>
</html>
