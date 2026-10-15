<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User | Activity Management System</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px 16px;
            background: #f3f6fa;
            font-family: Arial, sans-serif;
            color: #25364a;
        }

        .container {
            max-width: 680px;
            margin: auto;
        }

        .card {
            background: white;
            border: 1px solid #e4eaf1;
            border-radius: 12px;
            overflow: hidden;
        }

        .header {
            background: #102c54;
            color: white;
            padding: 25px;
        }

        .header h1 {
            font-size: 22px;
            margin: 0 0 8px;
        }

        .header p {
            margin: 0;
            color: #d0dced;
            font-size: 13px;
        }

        form {
            padding: 25px;
        }

        .field {
            margin-bottom: 19px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: bold;
            color: #344860;
        }

        input,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccd5e0;
            border-radius: 6px;
            background: white;
            font-size: 14px;
        }

        input:focus,
        select:focus {
            outline: 2px solid #b7cbe6;
            border-color: #315d91;
        }

        .hint {
            color: #78879a;
            font-size: 11px;
            margin-top: 7px;
            line-height: 1.5;
        }

        .error {
            color: #b42318;
            font-size: 12px;
            margin-top: 6px;
        }

        .alert {
            padding: 12px;
            background: #fde7e7;
            color: #ad3333;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 25px;
        }

        .button {
            display: inline-block;
            border: 0;
            border-radius: 6px;
            padding: 12px 17px;
            background: #102c54;
            color: white;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
        }

        .secondary {
            background: white;
            color: #102c54;
            border: 1px solid #dce4ee;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">

            <div class="header">
                <h1>Create User Account</h1>
                <p>Create an account for authorized system personnel.</p>
            </div>

            <form method="POST" action="{{ route('users.store') }}">
                @csrf

                @if ($errors->any())
                    <div class="alert">
                        Please correct the errors below before submitting.
                    </div>
                @endif

                <div class="field">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" maxlength="255"
                        autocomplete="name" required>
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" maxlength="255"
                        autocomplete="email" required>
                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="role">Account Role</label>
                    <select id="role" name="role" required>
                        <option value="">Select a role</option>
                        <option value="staff" @selected(old('role') === 'staff')>
                            Staff
                        </option>
                        <option value="admin" @selected(old('role') === 'admin')>
                            Administrator
                        </option>
                    </select>
                    <div class="hint">
                        Administrators can manage user accounts. Staff can manage
                        activities and participant registrations.
                    </div>
                    @error('role')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" minlength="8" autocomplete="new-password"
                        required>
                    <div class="hint">Use at least 8 characters.</div>
                    @error('password')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" minlength="8"
                        autocomplete="new-password" required>
                </div>

                <div class="actions">
                    <button type="submit" class="button">
                        Create Account
                    </button>

                    <a href="{{ route('users.index') }}" class="button secondary">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
