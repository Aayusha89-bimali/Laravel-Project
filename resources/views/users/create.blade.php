<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create User</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: sans-serif; background: #f3f4f6; }
        nav { background: #fff; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #e5e7eb; }
        .brand { font-weight: 600; }
        nav a { color: #6366f1; text-decoration: none; margin-left: 1rem; font-size: 0.9rem; }
        nav form button { background:none; border:1px solid #d1d5db; padding:0.4rem 0.9rem; border-radius:6px; cursor:pointer; font-size:0.875rem; }
        main { padding: 2rem; max-width: 600px; margin: auto; }
        h1 { font-size: 1.5rem; margin-bottom: 1.5rem; }
        .card { background: #fff; border-radius: 12px; padding: 2rem; box-shadow: 0 1px 8px rgba(0,0,0,0.06); }
        label { display: block; font-size: 0.875rem; margin-bottom: 4px; color: #374151; margin-top: 1rem; }
        input, select { width: 100%; padding: 0.6rem 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem; }
        input:focus, select:focus { outline: 2px solid #6366f1; border-color: transparent; }
        .error { color: #dc2626; font-size: 0.8rem; margin-top: 4px; }
        .actions { display: flex; gap: 1rem; margin-top: 1.5rem; }
        .btn { padding: 0.6rem 1.2rem; border-radius: 6px; border: none; cursor: pointer; font-size: 0.9rem; text-decoration: none; }
        .btn-primary { background: #6366f1; color: #fff; }
        .btn-secondary { background: #e5e7eb; color: #374151; }
    </style>
</head>
<body>
<nav>
    <span class="brand">MyApp</span>
    <div style="display:flex;align-items:center;gap:1rem">
        <a href="/dashboard">Dashboard</a>
        <a href="/users">Users</a>
        <form method="POST" action="{{ route('logout') }}">@csrf<button>Logout</button></form>
    </div>
</nav>
<main>
    <h1>Create New User</h1>
    <div class="card">
        <form method="POST" action="{{ route('users.store') }}">
            @csrf
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name') <p class="error">{{ $message }}</p> @enderror

            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
            @error('email') <p class="error">{{ $message }}</p> @enderror

            <label>Password</label>
            <input type="password" name="password" required>
            @error('password') <p class="error">{{ $message }}</p> @enderror

            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" required>

            <label>Role</label>
            <select name="role" required>
                <option value="">Select role</option>
                <option value="user"  {{ old('role') == 'user'  ? 'selected' : '' }}>User</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            @error('role') <p class="error">{{ $message }}</p> @enderror

            <div class="actions">
                <button type="submit" class="btn btn-primary">Create User</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</main>
</body>
</html>