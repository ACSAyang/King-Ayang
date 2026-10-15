<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Activity Management System</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            font-family: Arial, sans-serif;
            background: #eef2f7;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            padding: 35px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(15, 35, 65, 0.12);
        }

        .brand {
            text-align: center;
            margin-bottom: 28px;
        }

        .brand-mark {
            width: 64px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            border-radius: 50%;
            background: #102c54;
            color: white;
            font-size: 23px;
            font-weight: bold;
        }

        h1 {
            margin: 0 0 8px;
            color: #102c54;
            font-size: 23px;
        }

        .subtitle {
            margin: 0;
            color: #68778b;
            font-size: 13px;
        }

        label {
            display: block;
            margin: 18px 0 7px;
            color: #24364b;
            font-size: 14px;
            font-weight: bold;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccd5e0;
            border-radius: 6px;
            font-size: 15px;
        }

        input:focus {
            outline: 2px solid #9bbce8;
            border-color: #244e83;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 16px 0;
            color: #4d5b6d;
            font-size: 13px;
        }

        .remember label {
            margin: 0;
            font-weight: normal;
        }

        button {
            width: 100%;
            padding: 13px;
            margin-top: 10px;
            border: none;
            border-radius: 6px;
            background: #102c54;
            color: white;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #1b4478;
        }

        .error {
            margin-top: 6px;
            color: #b42318;
            font-size: 13px;
        }

        .success {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 6px;
            background: #e8f6ec;
            color: #176b36;
            font-size: 13px;
        }

        .footer {
            margin-top: 25px;
            text-align: center;
            color: #7b8796;
            font-size: 12px;
        }
    </style>
</head>

<body>

    <div class="login-card">
        <div class="brand">
            <div class="brand-mark">AMS</div>
            <h1>Activity Management System</h1>
            <p class="subtitle">Authorized Personnel Login</p>
        </div>

        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="error">
                Please check your email and password and try again.
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf

            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}"
                placeholder="Enter your email" autocomplete="username" required autofocus>

            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password"
                autocomplete="current-password" required>

            <div class="remember">
                <input type="checkbox" id="remember" name="remember" value="1">
                <label for="remember">Remember me</label>
            </div>

            <button type="submit">Sign In</button>
        </form>

        <div class="footer">
            Authorized access only
        </div>
    </div>

</body>

</html>
