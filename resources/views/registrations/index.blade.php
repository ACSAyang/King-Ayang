<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrations | Registration System</title>

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

        nav a {
            color: white;
            text-decoration: none;
            margin-right: 18px;
        }

        main {
            max-width: 1250px;
            margin: 30px auto;
            padding: 0 20px;
        }

        body.embedded main {
            max-width: none;
            width: 100%;
            margin: 0;
            padding: 20px;
        }

        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .top h1 {
            margin-top: 0;
            margin-bottom: 8px;
            font-size: 26px;
        }

        .top p {
            margin-bottom: 0;
        }

        .panel {
            background: white;
            padding: 20px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            overflow-x: auto;
        }

        .button {
            display: inline-block;
            padding: 9px 12px;
            border: 0;
            border-radius: 5px;
            background: #174a7c;
            color: white;
            text-decoration: none;
            cursor: pointer;
            font-size: 13px;
        }

        .approve {
            background: #15803d;
        }

        .reject {
            background: #b91c1c;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .errors {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px 25px;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1050px;
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #e8edf3;
            text-align: left;
            vertical-align: top;
            font-size: 13px;
        }

        th {
            background: #f8fafc;
        }

        .status {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 15px;
            text-transform: capitalize;
            background: #e2e8f0;
        }

        .pending {
            background: #fef3c7;
            color: #92400e;
        }

        .approved {
            background: #dcfce7;
            color: #166534;
        }

        .rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        .remarks {
            width: 180px;
            max-width: 100%;
            padding: 8px;
            border: 1px solid #cbd5e1;
            border-radius: 5px;
            margin-bottom: 7px;
        }

        .action-form {
            margin-bottom: 12px;
        }

        .muted {
            color: #64748b;
        }

        @media (max-width: 600px) {
            body.embedded main {
                padding: 12px;
            }

            .panel {
                padding: 12px;
            }

            .top h1 {
                font-size: 22px;
            }
        }
    </style>
</head>

<body class="{{ request()->boolean('embedded') ? 'embedded' : '' }}">

    @if (!request()->boolean('embedded'))
        <header>
            <h2>REGISTRATION SYSTEM</h2>
            <nav>
                <a href="{{ url('/') }}">Dashboard</a>
                <a href="{{ route('activities.index') }}">Activities</a>
                <a href="{{ route('registrations.index') }}">Registrations</a>
            </nav>
        </header>
    @endif

    <main>
        <div class="top">
            <div>
                <h1>Registration Management</h1>
                <p class="muted">
                    Review, approve, and reject participant registrations.
                </p>
            </div>

            <a class="button"
                href="{{ route('registrations.create') }}{{ request()->boolean('embedded') ? '?embedded=1' : '' }}">
                + Encode Participant
            </a>
        </div>

        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="errors">
                <strong>Please check the following:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="panel">
            <table>
                <thead>
                    <tr>
                        <th>Participant</th>
                        <th>Personnel Details</th>
                        <th>Contact Information</th>
                        <th>Activity</th>
                        <th>Status</th>
                        <th>Review / Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($registrations as $registration)
                        <tr>
                            <td>
                                <strong>{{ $registration->full_name }}</strong>
                                <br>
                                <span class="muted">ID: {{ $registration->id }}</span>
                            </td>

                            <td>
                                Service No.: {{ $registration->service_number ?: '—' }}
                                <br>
                                Rank: {{ $registration->rank ?: '—' }}
                                <br>
                                Unit: {{ $registration->unit ?: '—' }}
                            </td>

                            <td>
                                {{ $registration->email ?: 'No email' }}
                                <br>
                                {{ $registration->contact_number ?: 'No contact number' }}
                            </td>

                            <td>
                                {{ $registration->activity?->title ?? 'Activity unavailable' }}
                            </td>

                            <td>
                                <span class="status {{ $registration->status }}">
                                    {{ $registration->status }}
                                </span>

                                @if ($registration->remarks)
                                    <p class="muted">
                                        Remarks: {{ $registration->remarks }}
                                    </p>
                                @endif
                            </td>

                            <td>
                                @if ($registration->status === 'pending')
                                    <form class="action-form" method="POST"
                                        action="{{ route('registrations.status', $registration) }}{{ request()->boolean('embedded') ? '?embedded=1' : '' }}">
                                        @csrf
                                        @method('PATCH')

                                        <input type="hidden" name="status" value="approved">
                                        <input class="remarks" name="remarks" placeholder="Optional remarks">

                                        <br>

                                        <button class="button approve" type="submit">
                                            Approve
                                        </button>
                                    </form>

                                    <form class="action-form" method="POST"
                                        action="{{ route('registrations.status', $registration) }}{{ request()->boolean('embedded') ? '?embedded=1' : '' }}"
                                        onsubmit="return confirm('Reject this registration?');">
                                        @csrf
                                        @method('PATCH')

                                        <input type="hidden" name="status" value="rejected">
                                        <input class="remarks" name="remarks" placeholder="Reason (optional)">

                                        <br>

                                        <button class="button reject" type="submit">
                                            Reject
                                        </button>
                                    </form>
                                @else
                                    <span class="muted">Already reviewed</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No registrations found yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </section>
    </main>

</body>

</html>
