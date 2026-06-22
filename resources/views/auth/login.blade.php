<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: sans-serif;
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .card {
            background: #fff;
            border-radius: 12px;
            padding: 2rem;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        }
        h1 { font-size: 1.5rem; margin-bottom: 1.5rem; text-align: center; }
        label { display: block; font-size: 0.875rem; margin-bottom: 4px; color: #374151; }
        input[type="email"],
        input[type="password"],
        input[type="text"] {
            width: 100%;
            padding: 0.6rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-size: 1rem;
        }
        input:focus { outline: 2px solid #6366f1; border-color: transparent; }
        .error { color: #dc2626; font-size: 0.8rem; margin-top: -0.75rem; margin-bottom: 0.75rem; }
        .row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem; }
        button {
            width: 100%;
            padding: 0.7rem;
            background: #6366f1;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
        }
        button:hover { background: #4f46e5; }
        .toggle-pw { font-size: 0.8rem; color: #6366f1; cursor: pointer; user-select: none; }
    </style>
</head>
<body>
<div class="card">
    <h1>Sign in</h1>

    @if ($errors->any())
        <div class="error" style="margin-bottom:1rem">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label for="email">Email address</label>
        <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email') }}"
            required
            autofocus
        >
        @error('email') <p class="error">{{ $message }}</p> @enderror

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
        @error('password') <p class="error">{{ $message }}</p> @enderror

        <span class="toggle-pw" onclick="
            const p = document.getElementById('password');
            p.type = p.type === 'password' ? 'text' : 'password';
            this.textContent = p.type === 'password' ? 'Show password' : 'Hide password';
        ">Show password</span>

        <div class="row" style="margin-top:1rem">
            <label style="display:flex;align-items:center;gap:6px;margin:0">
                <input type="checkbox" name="remember"> Remember me
            </label>
        </div>

        <button type="submit">Log in</button>
    </form>
</div>
</body>
</html>