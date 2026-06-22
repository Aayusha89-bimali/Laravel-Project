<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Details</title>
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
        .field { padding: 0.85rem 0; border-bottom: 1px solid #f3f4f6; display: flex; }
        .field:last-child { border-bottom: none; }
        .field-label { font-size: 0.8rem; color: #9ca3af; width: 140px; flex-shrink: 0; padding-top: 2px; }
        .field-value { font-size: 0.95rem; color: #111827; }
        .badge { padding: 0.2rem 0.6rem; border-radius: 20px; font-size: 0.75rem; }
        .badge-admin { background: #ede9fe; color: #5b21b6; }
        .badge-user  { background: #dbeafe; color: #1e40af; }
        .actions { display: flex; gap: 1rem; margin-top: 1.5rem; }
        .btn { padding: 0.6rem 1.2rem; border-radius: 6px; border: none; cursor: pointer; font-size: 0.9rem; text-decoration: none; }
        .btn-warning { background: #f59e0b; color: #fff; }
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
    <h1>User Details</h1>
    <div class="card">
        <div class="field">
            <span class="field-label">ID</span>
            <span class="field-value">{{ $user->id }}</span>
        </div>
        <div class="field">
            <span class="field-label">Name</span>
            <span class="field-value">{{ $user->name }}</span>
        </div>
        <div class="field">
            <span class="field-label">Email</span>
            <span class="field-value">{{ $user->email }}</span>
        </div>
        <div class="field">
            <span class="field-label">Role</span>
            <span class="field-value">
                <span class="badge badge-{{ $user->role }}">{{ ucfirst($user->role) }}</span>
            </span>
        </div>
        <div class="field">
            <span class="field-label">Created At</span>
            <span class="field-value">{{ $user->created_at->format('M d, Y h:i A') }}</span>
        </div>
        <div class="field">
            <span class="field-label">Updated At</span>
            <span class="field-value">{{ $user->updated_at->format('M d, Y h:i A') }}</span>
        </div>
        <div class="actions">
            <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">Edit User</a>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</main>
</body>
</html>