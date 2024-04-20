{{-- FILEPATH: /home/lange/projects/eventsFullApi/resources/views/mail/pending-subscriptions.blade.php --}}

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pending Subscriptions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        p {
            color: #666;
            line-height: 1.5;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        .divider {
            border-top: 1px solid #ccc;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <h1>Pending Subscriptions</h1>

    <p>Hello {{ $user->name }},</p>

    <p>Here are the events you have pending subscriptions to:</p>

    <ul>
        @foreach ($events as $event)
            <li>Event: {{ $event->name }}</li>
            <li>Description: {{ $event->description }}</li>
            <li>Date: {{ $event->dt_start }} to {{ $event->dt_end }}</li>
            <div class="divider"></div>
        @endforeach
    </ul>



    <p>Thank you for your subscriptions!</p>
</body>
</html>
