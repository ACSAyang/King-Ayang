<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management | Activity Management System</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px;
            font-family: Arial, sans-serif;
            background: #f3f6fa;
            color: #25364a;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        h1 {
            margin: 0 0 8px;
            color: #102c54;
            font-size: 25px;
        }

        .subtitle {
            margin: 0;
            color: #78879a;
            font-size: 13px;
        }

        .button {
            display: inline-block;
            border: 0;
            border-radius: 6px;
            padding: 12px 16px;
            background: #102c54;
            color: white;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
        }

        .button:hover {
            background: #1d426f;
        }

        .secondary {
            background: white;
            color: #102c54;
            border: 1px solid #dce4ee;
        }

        .panel {
            background: white;
            border: 1px solid #e4eaf1;
            border-radius: 10px;
            overflow: hidden;
        }

        .panel-heading {
            padding: 20px 22px;
            border-bottom: 1px solid #e4eaf1;
        }

        .panel-heading h2 {
            margin: 0 0 6px;
            color: #102c54;
            font-size: 16px;
        }

        .panel-heading p {
            margin: 0;
            color: #78879a;
            font-size: 12px;
        }

        .alert {
            padding: 13px 16px;
            margin-bottom: 20px;
            border-radius: 6px;
            background: #e7f6ec;
            color: #176b3c;
            font-size: 13px;
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th {
            background: #f8fafc;
            color: #78879a;
            padding: 14px 20px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .5px;
            white-space: nowrap;
        }

        td {
            padding: 16px 20px;
            border-top: 1px solid #edf1f6;
            font-size: 13px;
        }

        .name {
            color: #102c54;
            font-weight: bold;
        }

        .role {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            text-transform: capitalize;
        }

        .admin {
            background: #e9effb;
            color: #315d91;
        }

        .staff {
            background: #e5f5eb;
            color: #187447;
        }

        .empty {
            padding: 35px;
            text-align: center;
            color: #78879a;
        }

        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 22px;
        }

        @media (max-width: 600px) {
            body {
                padding: 16px;
            }

            .header {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="header">
            <div>
                <h1>User Management</h1>
                <p class="subtitle">
                    Manage administrator and staff accounts.
                </p>
            </div>

            <a href="{{ route('users.create') }}" class="button">
                + Create User
            </a>
        </div>

        @if (session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <div class="panel">
            <div class="panel-heading">
                <h2>System Users</h2>
                <p>Total registered accounts: {{ $users->count() }}</p>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email Address</th>
                            <th>Role</th>
                            <th>Account Created</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td class="name">
                                    {{ $user->name }}
                                    @if ($user->id === auth()->id())
                                        <span style="color:#78879a;font-weight:normal;">
                                            (You)
                                        </span>
                                    @endif
                                </td>

                                <td>{{ $user->email }}</td>

                                <td>
                                    <span class="role {{ $user->role === 'admin' ? 'admin' : 'staff' }}">
                                        {{ $user->role }}
                                    </span>
                                </td>

                                <td>{{ $user->created_at?->format('d M Y') ?? '—' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="empty">
                                    No user accounts found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="actions">
            <a href="{{ route('dashboard') }}" class="button secondary">
                ← Back to Dashboard
            </a>
        </div>

    </div>
</body>

</html>
