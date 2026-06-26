<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: sans-serif; background: #f3f4f6; min-height: 100vh; }
        nav {
            background: #fff;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e5e7eb;
            margin-bottom: 0;
        }
        .brand { font-weight: 700; font-size: 1.125rem; color: #111827; }
        nav a { color: #6366f1; text-decoration: none; margin-left: 1rem; font-size: 0.9rem; }
        nav a:hover { text-decoration: underline; }
        .nav-right { display: flex; align-items: center; gap: 0.75rem; }
        .logout-btn {
            background: none;
            border: 1px solid #d1d5db;
            padding: 0.35rem 0.85rem;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.875rem;
            color: #374151;
        }
        .logout-btn:hover { background: #f9fafb; }
        main { padding: 2rem; max-width: 1100px; margin: 0 auto; }
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.25rem;
        }
        h1 { font-size: 1.5rem; color: #111827; }
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 0.875rem;
            text-decoration: none;
            display: inline-block;
            font-weight: 500;
        }
        .btn-primary  { background: #6366f1; color: #fff; }
        .btn-primary:hover  { background: #4f46e5; }
        .btn-danger   { background: #ef4444; color: #fff; }
        .btn-danger:hover   { background: #dc2626; }
        .btn-warning  { background: #f59e0b; color: #fff; }
        .btn-warning:hover  { background: #d97706; }
        .btn-info     { background: #3b82f6; color: #fff; }
        .btn-info:hover     { background: #2563eb; }
        .btn-secondary { background: #e5e7eb; color: #374151; }
        .alert-success {
            padding: 0.75rem 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
        .search-bar {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1.25rem;
        }
        .search-bar input {
            flex: 1;
            padding: 0.55rem 0.85rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 0.9rem;
            outline: none;
        }
        .search-bar input:focus { border-color: #6366f1; }
        .search-bar button {
            padding: 0.55rem 1.1rem;
            background: #6366f1;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.9rem;
        }
        .search-bar button:hover { background: #4f46e5; }
        .clear-btn {
            padding: 0.55rem 1rem;
            background: #e5e7eb;
            color: #374151;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.875rem;
        }
        .table-wrapper {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 1px 8px rgba(0,0,0,0.07);
            overflow: hidden;
        }
        table { width: 100%; border-collapse: collapse; }
        thead th {
            background: #f9fafb;
            padding: 0.75rem 1rem;
            text-align: left;
            font-size: 0.78rem;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid #e5e7eb;
        }
        tbody td {
            padding: 0.9rem 1rem;
            border-bottom: 1px solid #f3f4f6;
            font-size: 0.9rem;
            color: #374151;
        }
        tbody tr:last-child td { border-bottom: none; }
        tbody tr:hover { background: #fafafa; }
        .badge {
            padding: 0.2rem 0.65rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .badge-admin { background: #ede9fe; color: #5b21b6; }
        .badge-user  { background: #dbeafe; color: #1e40af; }
        .actions { display: flex; gap: 0.4rem; flex-wrap: wrap; }
        .empty-row td {
            text-align: center;
            padding: 3rem 1rem;
            color: #9ca3af;
            font-size: 0.95rem;
        }
        .pagination-wrapper { margin-top: 1.25rem; }
        /* Delete Modal */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.45);
            z-index: 100;
            align-items: center;
            justify-content: center;
        }
        .modal-overlay.open { display: flex; }
        .modal {
            background: #fff;
            border-radius: 14px;
            padding: 2rem;
            max-width: 420px;
            width: 90%;
            box-shadow: 0 8px 32px rgba(0,0,0,0.18);
        }
        .modal h2 { font-size: 1.2rem; margin-bottom: 0.5rem; color: #111827; }
        .modal p  { color: #6b7280; margin-bottom: 1.5rem; font-size: 0.9rem; line-height: 1.5; }
        .modal-actions { display: flex; gap: 0.75rem; justify-content: flex-end; }
    </style>
</head>
<body>

<nav>
    <span class="brand">MyApp</span>
    <div class="nav-right">
        <a href="/dashboard">Dashboard</a>
        @if(Auth::user()->isAdmin())
            <a href="/users">Users</a>
        @endif
        <span style="font-size:0.875rem;color:#6b7280">{{ Auth::user()->name }}</span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>
</nav>

<main>
    <div class="page-header">
        <h1>User Management</h1>
        <a href="{{ route('users.create') }}" class="btn btn-primary">+ Add User</a>
    </div>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('users.index') }}" class="search-bar">
        <input
            type="text"
            name="search"
            placeholder="Search by Name, Email or Role..."
            value="{{ request('search') }}"
        >
        <button type="submit">Search</button>
        @if(request('search'))
            <a href="{{ route('users.index') }}" class="clear-btn">✕ Clear</a>
        @endif
    </form>

    <div class="table-wrapper">
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
                    <td><strong>{{ $user->name }}</strong></td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="badge badge-{{ $user->role }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('users.show', $user) }}" class="btn btn-info">View</a>
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">Edit</a>
                            <button
                                class="btn btn-danger"
                                onclick="openModal({{ $user->id }}, '{{ addslashes($user->name) }}')"
                            >Delete</button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr class="empty-row">
                    <td colspan="6">No users found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        {{ $users->links() }}
    </div>
</main>

<!-- Delete Confirmation Modal -->
<div class="modal-overlay" id="deleteModal">
    <div class="modal">
        <h2>Delete User</h2>
        <p id="modalText">Are you sure you want to delete this user?</p>
        <div class="modal-actions">
            <button
                class="btn btn-secondary"
                onclick="closeModal()"
            >Cancel</button>
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
    document.getElementById('modalText').textContent =
        'Are you sure you want to delete "' + name + '"? This action cannot be undone.';
    document.getElementById('deleteForm').action = '/users/' + id;
    document.getElementById('deleteModal').classList.add('open');
}
function closeModal() {
    document.getElementById('deleteModal').classList.remove('open');
}
// Close modal when clicking outside
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});
</script>
</body>
</html>