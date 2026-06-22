<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: sans-serif; background: #f3f4f6; }
        nav { background: #fff; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #e5e7eb; }
        .brand { font-weight: 600; font-size: 1.125rem; }
        nav a { color: #6366f1; text-decoration: none; margin-left: 1rem; font-size: 0.9rem; }
        nav form button { background:none; border:1px solid #d1d5db; padding:0.4rem 0.9rem; border-radius:6px; cursor:pointer; font-size:0.875rem; }
        main { padding: 2rem; max-width: 1000px; margin: auto; }
        h1 { font-size: 1.5rem; margin-bottom: 0.5rem; }
        p  { color: #6b7280; margin-bottom: 2rem; }
        .stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 2rem; }
        .stat-card { background: #fff; border-radius: 12px; padding: 1.5rem; box-shadow: 0 1px 8px rgba(0,0,0,0.06); text-align: center; }
        .stat-card .number { font-size: 2.5rem; font-weight: 600; margin: 0.5rem 0; }
        .stat-card .label  { font-size: 0.875rem; color: #6b7280; }
        .c-purple { color: #6366f1; }
        .c-red    { color: #ef4444; }
        .c-blue   { color: #3b82f6; }
        .c-green  { color: #10b981; }
        .card { background: #fff; border-radius: 12px; padding: 1.5rem; box-shadow: 0 1px 8px rgba(0,0,0,0.06); }
        .badge { padding: 0.2rem 0.6rem; border-radius: 20px; font-size: 0.75rem; }
        .badge-admin { background: #ede9fe; color: #5b21b6; }
        .badge-user  { background: #dbeafe; color: #1e40af; }
    </style>
</head>
<body>
<nav>
    <span class="brand">MyApp</span>
    <div style="display:flex;align-items:center;gap:1rem">
        <a href="/dashboard">Dashboard</a>
        @if(Auth::user()->isAdmin())
            <a href="/users">User Management</a>
        @endif
        <span style="font-size:0.875rem;color:#6b7280">
            {{ Auth::user()->name }}
            <span class="badge badge-{{ Auth::user()->role }}">{{ ucfirst(Auth::user()->role) }}</span>
        </span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</nav>

<main>
    <h1>Welcome back, {{ Auth::user()->name }}!</h1>
    <p>You are logged in as <strong>{{ ucfirst(Auth::user()->role) }}</strong>.</p>

    @if(Auth::user()->isAdmin())
    <div class="stats">
        <div class="stat-card">
            <div class="label">Total Users</div>
            <div class="number c-purple">{{ $stats['total'] }}</div>
        </div>
        <div class="stat-card">
            <div class="label">Admin Users</div>
            <div class="number c-red">{{ $stats['admins'] }}</div>
        </div>
        <div class="stat-card">
            <div class="label">Regular Users</div>
            <div class="number c-blue">{{ $stats['users'] }}</div>
        </div>
        <div class="stat-card">
            <div class="label">New This Month</div>
            <div class="number c-green">{{ $stats['monthly'] }}</div>
        </div>
    </div>
    @endif

    <div class="card">
        <p style="margin:0">
            @if(Auth::user()->isAdmin())
                You have full admin access. Go to <a href="/users" style="color:#6366f1">User Management</a> to manage users.
            @else
                You can view and update your own profile. Admin features are restricted.
            @endif
        </p>
    </div>
</main>
</body>
</html>