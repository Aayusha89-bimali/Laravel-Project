<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Management</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: sans-serif; background: #f3f4f6; }
        nav { background: #fff; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #e5e7eb; }
        .brand { font-weight: 600; font-size: 1.125rem; }
        nav a { color: #6366f1; text-decoration: none; margin-left: 1rem; font-size: 0.9rem; }
        main { padding: 2rem; max-width: 1100px; margin: auto; }
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
        h1 { font-size: 1.5rem; }
        .btn { padding: 0.5rem 1rem; border-radius: 6px; border: none; cursor: pointer; font-size: 0.875rem; text-decoration: none; display: inline-block; }
        .btn-primary { background: #6366f1; color: #fff; }
        .btn-primary:hover { background: #4f46e5; }
        .btn-danger  { background: #ef4444; color: #fff; }
        .btn-warning { background: #f59e0b; color: #fff; }
        .btn-info    { background: #3b82f6; color: #fff; }
        .search-bar { display: flex; gap: 0.5rem; margin-bottom: 1.5rem; }
        .search-bar input { flex: 1; padding: 0.5rem 0.75rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.9rem; }
        .search-bar button { padding: 0.5rem 1rem; background: #6366f1; color: #fff; border: none; border-radius: 6px; cursor: pointer; }
        .alert { padding: 0.75rem 1rem; border-radius: 6px; margin-bottom: 1rem; background: #d1fae5; color: #065f46; }
        table { width: 100%; background: #fff; border-radius: 10px; border-collapse: collapse; box-shadow: 0 1px 8px rgba(0,0,0,0.06); }
        th { background: #f9fafb; padding: 0.75rem 1rem; text-align: left; font-size: 0.8rem; color: #6b7280; text-transform: uppercase; border-bottom: 1px solid #e5e7eb; }
        td { padding: 0.85rem 1rem; border-bottom: 1px solid #f3f4f6; font-size: 0.9rem; }
        tr:last-child td { border-bottom: none; }
        .badge { padding: 0.2rem 0.6rem; border-radius: 20px; font-size: 0.75rem; font-weight: 500; }
        .badge-admin { background: #ede9fe; color: #5b21b6; }
        .badge-user  { background: #dbeafe; color: #1e40af; }
        .actions { display: flex; gap: 0.4rem; }
        .pagination { margin-top: 1.5rem; display: flex; gap: 0.5rem; }
        .pagination a, .pagination span { padding: 0.4rem 0.8rem; border: 1px solid #e5e7eb; border-radius: 6px; font-size: 0.875rem; text-decoration: none; color: #374151; }
        .pagination .active span { background: #6366f1; color: #fff; border-color: #6366f1; }
        /* Modal */
        .modal-overlay { display:none; position:fixed; inset:0; background:rgba(0,0,0,0.45); z-index:50; align-items:center; justify-content:center; }
        .modal-overlay.open { display:flex; }
        .modal { background:#fff; border-radius:12px; padding:2rem; max-width:400px; width:100%; }
        .modal h2 { margin-bottom:0.5rem; }
        .modal p  { color:#6b7280; margin-bottom:1.5rem; font-size:0.9rem; }
        .modal-actions { display:flex; gap:0.75rem; justify-content:flex-end; }
        nav form button { background:none; border:1px solid #d1d5db; padding:0.4rem 0.9rem; border-radius:6px; cursor:pointer; font-size:0.875rem; }
    </style>
</head>
<body>
<nav>
    <span class="brand">MyApp</span>
    <div style="display:flex;align-items:center;gap:1rem">
        <a href="/dashboard">Dashboard</a>
        <a href="/users">Users</a>
        <span style="font-size:0.875rem;color:#6b7280">{{ Auth::user()->name }}</span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</nav>

<main>
    <div class="page-header">
        <h1>User Management</h1>
        <a href="{{ route('users.create') }}" class="btn btn-primary">+ Add User</a>
    </div>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('users.index') }}" class="search-bar">
        <input type="text" name="search" placeholder="Search by name, email or role..." value="{{ request('search') }}">
        <button type="submit">Search</button>
        @if(request('search'))
            <a href="{{ route('users.index') }}" class="btn" style="background:#e5e7eb;color:#374151">Clear</a>
        @endif
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td><span class="badge badge-{{ $user->role }}">{{ ucfirst($user->role) }}</span></td>
                <td>{{ $user->created_at->format('M d, Y') }}</td>
                <td>
                    <div class="actions">
                        <a href="{{ route('users.show', $user) }}" class="btn btn-info">View</a>
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">Edit</a>
                        <button class="btn btn-danger" onclick="openModal({{ $user->id }}, '{{ $user->name }}')">Delete</button>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center;color:#9ca3af;padding:2rem">No users found.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination">{{ $users->links() }}</div>
</main>

<!-- Delete Modal -->
<div class="modal-overlay" id="deleteModal">
    <div class="modal">
        <h2>Delete User</h2>
        <p id="modalText">Are you sure you want to delete this user? This action cannot be undone.</p>
        <div class="modal-actions">
            <button class="btn" style="background:#e5e7eb;color:#374151" onclick="closeModal()">Cancel</button>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Yes, Delete</button>
            </form>
        </div>
    </div>
</div>

<script>
function openModal(id, name) {
    document.getElementById('modalText').textContent = 'Are you sure you want to delete "' + name + '"?';
    document.getElementById('deleteForm').action = '/users/' + id;
    document.getElementById('deleteModal').classList.add('open');
}
function closeModal() {
    document.getElementById('deleteModal').classList.remove('open');
}
</script>
</body>
</html>