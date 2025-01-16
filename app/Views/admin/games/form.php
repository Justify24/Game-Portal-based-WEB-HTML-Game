<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3"><?= isset($game) ? 'Edit Game' : 'Add New Game' ?></h1>
    <a href="<?= base_url('admin/games') ?>" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="<?= isset($game) ? base_url('admin/games/update/' . $game['id']) : base_url('admin/games/create') ?>" 
              method="post" 
              enctype="multipart/form-data">
            
            <div class="mb-3">
                <label for="title" class="form-label">Game Title</label>
                <input type="text" 
                       class="form-control" 
                       id="title" 
                       name="title" 
                       value="<?= old('title', $game['title'] ?? '') ?>" 
                       required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" 
                          id="description" 
                          name="description" 
                          rows="4" 
                          required><?= old('description', $game['description'] ?? '') ?></textarea>
            </div>

            <div class="mb-3">
                <label for="embed_url" class="form-label">Game Embed URL</label>
                <input type="url" 
                       class="form-control" 
                       id="embed_url" 
                       name="embed_url" 
                       value="<?= old('embed_url', $game['embed_url'] ?? '') ?>" 
                       required>
                <div class="form-text">Enter the URL where the game can be embedded from</div>
            </div>

            <div class="mb-3">
                <label for="cover" class="form-label">Cover Image</label>
                <?php if(isset($game) && $game['cover_url']): ?>
                    <div class="mb-2">
                        <img src="<?= base_url($game['cover_url']) ?>" alt="Current cover" style="max-width: 200px;">
                    </div>
                <?php endif; ?>
                <input type="file" 
                       class="form-control" 
                       id="cover" 
                       name="cover" 
                       accept="image/jpeg,image/png,image/webp"
                       <?= isset($game) ? '' : 'required' ?>>
                <div class="form-text">Format yang didukung: JPG, PNG, WebP. Maksimal 2MB.</div>
            </div>

            <div class="mb-3">
                <label for="how_to_play" class="form-label">How to Play</label>
                <textarea class="form-control" 
                          id="how_to_play" 
                          name="how_to_play" 
                          rows="3"><?= old('how_to_play', $game['how_to_play'] ?? '') ?></textarea>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="active" <?= (old('status', $game['status'] ?? '') === 'active') ? 'selected' : '' ?>>Active</option>
                    <option value="inactive" <?= (old('status', $game['status'] ?? '') === 'inactive') ? 'selected' : '' ?>>Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> <?= isset($game) ? 'Update' : 'Save' ?> Game
            </button>
        </form>
    </div>
</div>
<?= $this->endSection() ?> 