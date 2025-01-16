<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Game Management</h4>
    <a href="<?= base_url('admin/games/new') ?>" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Add New Game
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Cover</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($games as $index => $game): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td>
                            <?php if ($game['cover_url']): ?>
                                <img src="<?= base_url($game['cover_url']) ?>" 
                                     alt="<?= esc($game['title']) ?>" 
                                     class="img-thumbnail"
                                     style="width: 80px; height: 80px; object-fit: cover;">
                            <?php else: ?>
                                <div class="bg-secondary text-white d-flex align-items-center justify-content-center" 
                                     style="width: 80px; height: 80px;">
                                    No Image
                                </div>
                            <?php endif; ?>
                        </td>
                        <td><?= esc($game['title']) ?></td>
                        <td><?= esc($game['description']) ?></td>
                        <td>
                            <span class="badge bg-<?= $game['status'] === 'active' ? 'success' : 'danger' ?>">
                                <?= ucfirst($game['status']) ?>
                            </span>
                        </td>
                        <td>
                            <a href="<?= base_url('admin/games/edit/' . $game['id']) ?>" 
                               class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <button onclick="deleteGame(<?= $game['id'] ?>)" 
                                    class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function deleteGame(id) {
    if (confirm('Are you sure you want to delete this game?')) {
        window.location.href = `<?= base_url('admin/games/delete/') ?>/${id}`;
    }
}
</script>

<style>
.card {
    border-radius: 15px;
    box-shadow: 0 0 15px rgba(0,0,0,0.05);
}

.table th {
    background: #f8f9fa;
    font-weight: 600;
}

.img-thumbnail {
    border-radius: 10px;
    border: 1px solid #dee2e6;
}

.btn-sm {
    padding: 0.25rem 0.5rem;
    border-radius: 5px;
}

.badge {
    padding: 0.5em 0.8em;
    border-radius: 6px;
}
</style>
<?= $this->endSection() ?> 