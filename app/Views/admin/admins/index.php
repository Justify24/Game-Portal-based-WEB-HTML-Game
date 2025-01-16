<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<style>
    .admin-header {
        background: linear-gradient(135deg, #4834d4 0%, #686de0 100%);
        padding: 2rem;
        border-radius: 15px;
        color: white;
        margin-bottom: 2rem;
    }

    .admin-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        overflow: hidden;
    }

    .table-responsive {
        padding: 1rem;
    }

    .table {
        margin-bottom: 0;
    }

    .table th {
        border-top: none;
        font-weight: 600;
        padding: 1rem;
        background: #f8f9fa;
        color: #2d3436;
    }

    .table td {
        padding: 1rem;
        vertical-align: middle;
    }

    .admin-avatar {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: #4834d4;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 1.1rem;
    }

    .btn-action {
        padding: 0.375rem 0.75rem;
        border-radius: 8px;
        font-size: 0.9rem;
        margin: 0 0.2rem;
    }

    .search-box {
        position: relative;
        max-width: 300px;
    }

    .search-box .form-control {
        padding-left: 2.5rem;
        border-radius: 10px;
        border: 1px solid rgba(0,0,0,0.1);
    }

    .search-box .bi-search {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
    }

    .modal-content {
        border-radius: 15px;
        border: none;
    }

    .modal-header {
        background: #4834d4;
        color: white;
        border-radius: 15px 15px 0 0;
    }

    .modal-body {
        padding: 1.5rem;
    }

    .form-control {
        border-radius: 10px;
        padding: 0.75rem 1rem;
        border: 1px solid rgba(0,0,0,0.1);
    }

    .form-control:focus {
        box-shadow: 0 0 0 3px rgba(72, 52, 212, 0.1);
        border-color: #4834d4;
    }
</style>

<div class="admin-header d-flex justify-content-between align-items-center">
    <div>
        <h4 class="mb-1">Admin Management</h4>
        <p class="mb-0">Manage administrator accounts</p>
    </div>
    <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addAdminModal">
        <i class="bi bi-person-plus me-2"></i>Add Admin
    </button>
</div>

<div class="admin-card">
    <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
        <div class="search-box">
            <i class="bi bi-search"></i>
            <input type="text" class="form-control" id="searchAdmin" placeholder="Search admin...">
        </div>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Admin</th>
                    <th>Email</th>
                    <th>Joined Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($admins as $admin): ?>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="admin-avatar me-2">
                                <?= strtoupper(substr($admin['name'], 0, 1)) ?>
                            </div>
                            <?= $admin['name'] ?>
                        </div>
                    </td>
                    <td><?= $admin['email'] ?></td>
                    <td><?= date('d M Y', strtotime($admin['created_at'])) ?></td>
                    <td>
                        <button class="btn btn-primary btn-action" 
                                onclick="editAdmin(<?= $admin['id'] ?>, '<?= $admin['name'] ?>', '<?= $admin['email'] ?>')">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <?php if($admin['id'] != session()->get('id')): ?>
                        <button class="btn btn-danger btn-action"
                                onclick="deleteAdmin(<?= $admin['id'] ?>)">
                            <i class="bi bi-trash"></i>
                        </button>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add Admin Modal -->
<div class="modal fade" id="addAdminModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Admin</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/admins/create') ?>" method="post">
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Add Admin</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Admin Modal -->
<div class="modal fade" id="editAdminModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Admin</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editAdminForm" action="" method="post">
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" name="name" id="editName" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="editEmail" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Leave blank to keep current password">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function editAdmin(id, name, email) {
    const modal = new bootstrap.Modal(document.getElementById('editAdminModal'));
    document.getElementById('editName').value = name;
    document.getElementById('editEmail').value = email;
    document.getElementById('editAdminForm').action = `<?= base_url('admin/admins/update/') ?>${id}`;
    modal.show();
}

function deleteAdmin(id) {
    if (confirm('Are you sure you want to delete this admin?')) {
        window.location.href = `<?= base_url('admin/admins/delete/') ?>${id}`;
    }
}

// Search functionality
document.getElementById('searchAdmin').addEventListener('keyup', function() {
    const searchValue = this.value.toLowerCase();
    const tableRows = document.querySelectorAll('tbody tr');
    
    tableRows.forEach(row => {
        const name = row.querySelector('td:first-child').textContent.toLowerCase();
        const email = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
        
        if (name.includes(searchValue) || email.includes(searchValue)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
</script>
<?= $this->endSection() ?> 