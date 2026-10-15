<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Activities | Registration System</title>

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
            margin-right: 18px;
        }

        .container {
            max-width: 1150px;
            margin: 25px auto;
            padding: 0 20px;
        }

        body.embedded .container {
            max-width: none;
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

        h1 {
            margin: 0 0 8px;
            font-size: 25px;
            color: #102b4e;
        }

        .top p {
            margin: 0;
            color: #64748b;
            font-size: 14px;
        }

        .button {
            display: inline-block;
            background: #174a7c;
            color: white;
            padding: 10px 14px;
            border: 0;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
            font-size: 13px;
            white-space: nowrap;
        }

        .button:hover {
            background: #0f365f;
        }

        .panel {
            background: white;
            padding: 20px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            overflow-x: auto;
            box-shadow: 0 2px 5px rgba(15, 23, 42, .03);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px;
        }

        th,
        td {
            padding: 13px;
            border-bottom: 1px solid #e8edf3;
            text-align: left;
            font-size: 13px;
        }

        th {
            background: #f8fafc;
            color: #475569;
        }

        tbody tr:hover {
            background: #f8fafc;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .actions form {
            margin: 0;
        }

        .delete {
            background: #b91c1c;
        }

        .delete:hover {
            background: #991b1b;
        }

        .status {
            text-transform: capitalize;
        }

        @media (max-width: 600px) {
            body.embedded .container {
                padding: 14px;
            }

            .panel {
                padding: 12px;
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
            <nav>
                <a href="{{ url('/') }}">Dashboard</a>
                <a href="{{ route('activities.index') }}">Activities</a>
            </nav>
        </header>
    @endif

    <main class="container">
        <div class="top">
            <div>
                <h1>Activities Management</h1>
                <p>Create and manage registered activities.</p>
            </div>

            <a class="button"
                href="{{ route('activities.create') }}{{ request()->boolean('embedded') ? '?embedded=1' : '' }}">
                + Add Activity
            </a>
        </div>

        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <section class="panel">
            <table>
                <thead>
                    <tr>
                        <th>Activity</th>
                        <th>Venue</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($activities as $activity)
                        <tr>
                            <td>{{ $activity->title }}</td>
                            <td>{{ $activity->venue }}</td>
                            <td>{{ $activity->start_date->format('M d, Y h:i A') }}</td>
                            <td>{{ $activity->end_date->format('M d, Y h:i A') }}</td>
                            <td class="status">{{ $activity->status }}</td>
                            <td>
                                <div class="actions">
                                    <a class="button"
                                        href="{{ route('activities.edit', $activity) }}{{ request()->boolean('embedded') ? '?embedded=1' : '' }}">
                                        Edit
                                    </a>

                                    <form method="POST" action="{{ route('activities.destroy', $activity) }}"
                                        onsubmit="return confirm('Delete this activity?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="button delete" type="submit">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                No activities found. Click “Add Activity” to create your first one.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </section>
    </main>

</body>

</html>
