<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Activity | Registration System</title>

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
            background: #f8fafc;
        }

        header {
            background: #102b4e;
            color: white;
            padding: 20px 30px;
        }

        header a {
            color: white;
            text-decoration: none;
        }

        main {
            max-width: 850px;
            margin: 25px auto;
            padding: 0 20px;
        }

        body.embedded main {
            max-width: none;
            margin: 0;
            padding: 20px;
        }

        h1 {
            margin: 0 0 8px;
            font-size: 25px;
            color: #102b4e;
        }

        .intro {
            margin: 0 0 20px;
            color: #64748b;
            font-size: 14px;
        }

        .panel {
            background: white;
            padding: 25px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(15, 23, 42, .03);
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
            font-size: 13px;
            color: #334155;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 11px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font: inherit;
            font-size: 14px;
            background: white;
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: 2px solid #bfdbfe;
            border-color: #174a7c;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        .button {
            display: inline-block;
            background: #174a7c;
            color: white;
            padding: 11px 16px;
            border: 0;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            font-size: 13px;
        }

        .button:hover {
            background: #0f365f;
        }

        .secondary {
            background: #64748b;
        }

        .secondary:hover {
            background: #475569;
        }

        .error {
            color: #b91c1c;
            font-size: 13px;
            margin-top: 5px;
        }

        .form-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 5px;
        }

        @media(max-width: 600px) {
            .grid {
                grid-template-columns: 1fr;
                gap: 0;
            }

            body.embedded main {
                padding: 14px;
            }

            .panel {
                padding: 18px;
            }

            h1 {
                font-size: 21px;
            }
        }
    </style>
</head>

<body class="{{ request()->boolean('embedded') ? 'embedded' : '' }}">

    @if (!request()->boolean('embedded'))
        <header>
            <h2>REGISTRATION SYSTEM</h2>
            <a href="{{ route('activities.index') }}">← Back to Activities</a>
        </header>
    @endif

    <main>
        <h1>Add Activity</h1>
        <p class="intro">Enter the details of the new activity.</p>

        <section class="panel">
            <form method="POST" action="{{ route('activities.store') }}">
                @csrf

                <div class="field">
                    <label for="title">Activity Title *</label>
                    <input id="title" name="title" value="{{ old('title') }}" required>
                    @error('title')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="description">Description</label>
                    <textarea id="description" name="description">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="venue">Venue *</label>
                    <input id="venue" name="venue" value="{{ old('venue') }}" required>
                    @error('venue')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="grid">
                    <div class="field">
                        <label for="start_date">Start Date and Time *</label>
                        <input type="datetime-local" id="start_date" name="start_date" value="{{ old('start_date') }}"
                            required>
                        @error('start_date')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="end_date">End Date and Time *</label>
                        <input type="datetime-local" id="end_date" name="end_date" value="{{ old('end_date') }}"
                            required>
                        @error('end_date')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="registration_deadline">Registration Deadline</label>
                        <input type="date" id="registration_deadline" name="registration_deadline"
                            value="{{ old('registration_deadline') }}">
                        @error('registration_deadline')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="capacity">Maximum Participants</label>
                        <input type="number" id="capacity" name="capacity" min="1"
                            value="{{ old('capacity') }}">
                        @error('capacity')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="field">
                    <label for="status">Status *</label>
                    <select id="status" name="status" required>
                        <option value="active" @selected(old('status', 'active') === 'active')>Active</option>
                        <option value="completed" @selected(old('status') === 'completed')>Completed</option>
                        <option value="cancelled" @selected(old('status') === 'cancelled')>Cancelled</option>
                    </select>
                    @error('status')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-actions">
                    <button class="button" type="submit">Save Activity</button>

                    <a class="button secondary"
                        href="{{ route('activities.index') }}{{ request()->boolean('embedded') ? '?embedded=1' : '' }}">
                        Cancel
                    </a>
                </div>
            </form>
        </section>
    </main>

</body>

</html>
