<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<style>
    .profile-header {
        background: linear-gradient(135deg, #4834d4 0%, #686de0 100%);
        padding: 2rem;
        border-radius: 15px;
        color: white;
        margin-bottom: 2rem;
    }

    .profile-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        overflow: hidden;
    }

    .profile-avatar-large {
        width: 100px;
        height: 100px;
        background: rgba(255,255,255,0.2);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        font-weight: 600;
        color: white;
        margin-bottom: 1rem;
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

    .btn-save {
        background: #4834d4;
        border: none;
        border-radius: 10px;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        color: white;
        transition: all 0.3s ease;
    }

    .btn-save:hover {
        background: #686de0;
        transform: translateY(-2px);
    }
</style>

<div class="profile-header">
    <div class="profile-avatar-large">
        <?= strtoupper(substr($admin['name'], 0, 1)) ?>
    </div>
    <h4 class="mb-1">My Profile</h4>
    <p class="mb-0">Manage your account information</p>
</div>

<div class="profile-card">
    <div class="card-body p-4">
        <form action="<?= base_url('admin/profile/update') ?>" method="post">
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control" name="name" value="<?= $admin['name'] ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" class="form-control" name="email" value="<?= $admin['email'] ?>" required>
            </div>

            <div class="mb-4">
                <label class="form-label">New Password</label>
                <input type="password" class="form-control" name="password" placeholder="Leave blank to keep current password">
                <small class="text-muted">Only fill this if you want to change your password</small>
            </div>

            <button type="submit" class="btn btn-save">
                <i class="bi bi-check2-circle me-2"></i>Save Changes
            </button>
        </form>
    </div>
</div>
<?= $this->endSection() ?> 