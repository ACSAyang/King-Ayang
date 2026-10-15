<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Encode Participant | Registration System</title>

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

        body.embedded {
            background: #f3f6fa;
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
            max-width: 850px;
            margin: 30px auto;
            padding: 0 20px;
        }

        body.embedded main {
            max-width: none;
            width: 100%;
            margin: 0;
            padding: 20px;
        }

        .page-heading {
            margin-top: 0;
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

        input,
        select {
            width: 100%;
            padding: 11px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font: inherit;
        }

        input:focus,
        select:focus {
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
            font-size: 14px;
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

        .form-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
        }

        @media (max-width: 600px) {
            body.embedded main {
                padding: 12px;
            }

            .panel {
                padding: 16px;
            }

            .grid {
                grid-template-columns: 1fr;
                gap: 0;
            }
        }
    </style>
</head>

<body class="{{ request()->boolean('embedded') ? 'embedded' : '' }}">

    @if (!request()->boolean('embedded'))
        <header>
            <h2>REGISTRATION SYSTEM</h2>
            <a href="{{ route('registrations.index') }}">
                &larr; Back to Registrations
            </a>
        </header>
    @endif

    <main>
        <h1 class="page-heading">Encode Participant</h1>
        <p>Enter the participant's details and select an activity.</p>

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
            @if ($activities->isEmpty())
                <p>No active activities are available. Please create an activity first.</p>

                <a class="button"
                    href="{{ route('activities.create') }}{{ request()->boolean('embedded') ? '?embedded=1' : '' }}">
                    Create Activity
                </a>
            @else
                <form method="POST"
                    action="{{ route('registrations.store') }}{{ request()->boolean('embedded') ? '?embedded=1' : '' }}">
                    @csrf

                    <div class="field">
                        <label for="activity_id">Activity *</label>

                        <select id="activity_id" name="activity_id" required>
                            <option value="">Select an activity</option>

                            @foreach ($activities as $activity)
                                <option value="{{ $activity->id }}" @selected((string) old('activity_id') === (string) $activity->id)>
                                    {{ $activity->title }} — {{ $activity->venue }}
                                </option>
                            @endforeach
                        </select>

                        @error('activity_id')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

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

                    <p><strong>Registration status:</strong> Pending approval</p>

                    <div class="form-actions">
                        <button class="button" type="submit">
                            Submit Registration
                        </button>

                        <a class="button secondary"
                            href="{{ route('registrations.index') }}{{ request()->boolean('embedded') ? '?embedded=1' : '' }}">
                            Cancel
                        </a>
                    </div>
                </form>
            @endif
        </section>
    </main>

</body>

</html>
