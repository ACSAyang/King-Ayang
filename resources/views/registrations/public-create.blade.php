<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Participant Registration | Registration System</title>

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
            padding: 20px 30px;
        }

        header h2 {
            margin-top: 0;
        }

        header a {
            color: white;
            text-decoration: none;
        }

        main {
            max-width: 800px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .panel {
            background: white;
            padding: 25px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .field {
            margin-bottom: 17px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 11px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font: inherit;
        }

        input:focus {
            outline: 2px solid #93c5fd;
            border-color: #174a7c;
        }

        .button {
            display: inline-block;
            padding: 11px 16px;
            border: 0;
            border-radius: 6px;
            background: #174a7c;
            color: white;
            cursor: pointer;
            text-decoration: none;
            font: inherit;
        }

        .button:hover {
            opacity: 0.9;
        }

        .secondary {
            background: #64748b;
        }

        .error {
            color: #b91c1c;
            font-size: 13px;
            margin-top: 5px;
        }

        .alert {
            padding: 12px;
            border-radius: 6px;
            background: #fee2e2;
            color: #991b1b;
            margin-bottom: 16px;
        }

        .activity-info {
            background: #eff6ff;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 22px;
        }

        .muted {
            color: #64748b;
        }

        /* Embedded mode: blend into the dashboard content area */
        body.embedded {
            background: transparent;
        }

        body.embedded main {
            width: 100%;
            max-width: none;
            margin: 0;
            padding: 20px;
        }

        body.embedded .panel {
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.05);
        }

        @media (max-width: 600px) {
            .grid {
                grid-template-columns: 1fr;
                gap: 0;
            }

            body.embedded main {
                padding: 12px;
            }

            .panel {
                padding: 18px;
            }
        }
    </style>
</head>

<body class="{{ request()->boolean('embedded') ? 'embedded' : '' }}">

    @if (!request()->boolean('embedded'))
        <header>
            <h2>REGISTRATION SYSTEM</h2>
            <a href="{{ route('registrations.public.index') }}">
                &larr; Back to Activities
            </a>
        </header>
    @endif

    <main>
        <h1>Participant Registration</h1>
        <p class="muted">Complete the form below to submit your registration.</p>

        <section class="activity-info">
            <h2>{{ $activity->title }}</h2>
            <p><strong>Venue:</strong> {{ $activity->venue }}</p>
            <p><strong>Start:</strong> {{ $activity->start_date->format('M d, Y h:i A') }}</p>
            <p><strong>End:</strong> {{ $activity->end_date->format('M d, Y h:i A') }}</p>
        </section>

        @if ($errors->any())
            <div class="alert">
                <strong>Please correct the following errors:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="panel">
            <form method="POST"
                action="{{ route('registrations.public.store', $activity) }}{{ request()->boolean('embedded') ? '?embedded=1' : '' }}">
                @csrf

                <input type="hidden" name="activity_id" value="{{ $activity->id }}">

                <div class="field">
                    <label for="full_name">Full Name *</label>
                    <input id="full_name" name="full_name" maxlength="255" value="{{ old('full_name') }}" required>
                    @error('full_name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="grid">
                    <div class="field">
                        <label for="service_number">Service / Personnel Number</label>
                        <input id="service_number" name="service_number" value="{{ old('service_number') }}">
                        @error('service_number')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="rank">Rank</label>
                        <input id="rank" name="rank" value="{{ old('rank') }}">
                        @error('rank')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="unit">Unit / Office</label>
                        <input id="unit" name="unit" value="{{ old('unit') }}">
                        @error('unit')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="contact_number">Contact Number</label>
                        <input id="contact_number" name="contact_number" type="tel"
                            value="{{ old('contact_number') }}">
                        @error('contact_number')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="field">
                    <label for="email">Email Address</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}">
                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <p>
                    <strong>Note:</strong> Your registration will be marked as pending
                    until reviewed by registration staff.
                </p>

                <button class="button" type="submit">Submit Registration</button>

                <a class="button secondary"
                    href="{{ route('registrations.public.index') }}{{ request()->boolean('embedded') ? '?embedded=1' : '' }}">
                    Cancel
                </a>
            </form>
        </section>
    </main>

</body>

</html>
