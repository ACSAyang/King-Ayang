<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Available Activities | Registration System</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f3f6fa;
            color: #263445;
        }

        header {
            background: #102b4e;
            color: white;
            padding: 22px 30px;
        }

        header h2 {
            margin-top: 0;
        }

        header p {
            color: #cbd8e8;
        }

        main {
            max-width: 1100px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            padding: 23px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
        }

        .button {
            display: inline-block;
            background: #174a7c;
            color: white;
            padding: 11px 15px;
            border-radius: 6px;
            text-decoration: none;
        }

        .button:hover {
            background: #102b4e;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 13px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .muted {
            color: #64748b;
        }

        .empty {
            background: white;
            border: 1px solid #e2e8f0;
            padding: 25px;
            border-radius: 10px;
        }

        /* Embedded mode: display content inside the dashboard */
        body.embedded {
            background: transparent;
        }

        body.embedded main {
            max-width: none;
            width: 100%;
            margin: 0;
            padding: 20px;
        }

        body.embedded .card {
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.05);
        }

        @media (max-width: 650px) {
            .cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body class="{{ request()->boolean('embedded') ? 'embedded' : '' }}">

    @if (!request()->boolean('embedded'))
        <header>
            <h2>REGISTRATION SYSTEM</h2>
            <p>Activity Registration and Management</p>
        </header>
    @endif

    <main>
        <h1>Available Activities</h1>
        <p class="muted">Choose an activity to register as a participant.</p>

        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        @if ($activities->isEmpty())
            <div class="empty">
                <h3>No activities are currently open for registration.</h3>
                <p>Please check again later.</p>
            </div>
        @else
            <div class="cards">
                @foreach ($activities as $activity)
                    <article class="card">
                        <h2>{{ $activity->title }}</h2>

                        <p>
                            {{ $activity->description ?: 'No description provided.' }}
                        </p>

                        <p>
                            <strong>Venue:</strong>
                            {{ $activity->venue }}
                        </p>

                        <p>
                            <strong>Starts:</strong>
                            {{ $activity->start_date->format('M d, Y h:i A') }}
                        </p>

                        <p>
                            <strong>Ends:</strong>
                            {{ $activity->end_date->format('M d, Y h:i A') }}
                        </p>

                        <p>
                            <strong>Registration deadline:</strong>
                            {{ $activity->registration_deadline?->format('M d, Y') ?? 'Not specified' }}
                        </p>

                        @if ($activity->capacity !== null)
                            <p>
                                <strong>Maximum participants:</strong>
                                {{ $activity->capacity }}
                            </p>
                        @endif

                        <a class="button"
                            href="{{ route('registrations.public.create', $activity) }}{{ request()->boolean('embedded') ? '?embedded=1' : '' }}">
                            Register for This Activity
                        </a>
                    </article>
                @endforeach
            </div>
        @endif
    </main>

</body>

</html>
