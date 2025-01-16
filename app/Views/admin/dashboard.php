<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<style>
    .dashboard-header {
        background: linear-gradient(135deg, #4834d4 0%, #686de0 100%);
        padding: 2rem;
        border-radius: 15px;
        color: white;
        margin-bottom: 2rem;
    }

    .clock {
        font-size: 2.5rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .date {
        font-size: 1.1rem;
        opacity: 0.9;
    }

    .stat-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        height: 100%;
        transition: all 0.3s ease;
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: #666;
        font-size: 0.9rem;
    }

    .recent-games {
        margin-top: 2rem;
    }

    .game-item {
        display: flex;
        align-items: center;
        padding: 1rem;
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }

    .game-item:last-child {
        border-bottom: none;
    }

    .game-cover {
        width: 60px;
        height: 60px;
        border-radius: 10px;
        object-fit: cover;
        margin-right: 1rem;
    }

    .game-info {
        flex: 1;
    }

    .game-title {
        font-weight: 500;
        margin-bottom: 0.25rem;
    }

    .game-date {
        font-size: 0.85rem;
        color: #666;
    }

    .status-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .status-active {
        background: rgba(72, 52, 212, 0.1);
        color: #4834d4;
    }

    .status-inactive {
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }
</style>

<div class="dashboard-header">
    <div class="clock" id="clock">00:00:00</div>
    <div class="date" id="date">Loading...</div>
</div>

<div class="row g-4">
    <!-- Total Games -->
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(72, 52, 212, 0.1); color: #4834d4;">
                <i class="bi bi-joystick"></i>
            </div>
            <div class="stat-value"><?= $totalGames ?></div>
            <div class="stat-label">Total Games</div>
        </div>
    </div>

    <!-- Active Games -->
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(25, 135, 84, 0.1); color: #198754;">
                <i class="bi bi-play-circle"></i>
            </div>
            <div class="stat-value"><?= $activeGames ?></div>
            <div class="stat-label">Active Games</div>
        </div>
    </div>

    <!-- Total Admins -->
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(13, 110, 253, 0.1); color: #0d6efd;">
                <i class="bi bi-people"></i>
            </div>
            <div class="stat-value"><?= $totalAdmins ?></div>
            <div class="stat-label">Total Admins</div>
        </div>
    </div>
</div>

<!-- Recent Games -->
<div class="card recent-games">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Recently Added Games</h5>
        <a href="<?= base_url('admin/games') ?>" class="btn btn-primary btn-sm">View All</a>
    </div>
    <div class="card-body p-0">
        <?php foreach($recentGames as $game): ?>
            <div class="game-item">
                <?php 
                // Bersihkan URL dari base_url yang mungkin sudah ada
                $coverUrl = str_replace(base_url(), '', $game['cover_url']);
                // Hapus slash ganda dan http://localhost:8080 jika ada
                $coverUrl = preg_replace('/^https?:\/\/[^\/]+/', '', $coverUrl);
                $coverUrl = ltrim($coverUrl, '/');
                ?>
                <img src="<?= base_url($coverUrl) ?>" 
                     class="game-cover"
                     alt="<?= $game['title'] ?>"
                     onerror="this.src='<?= base_url('assets/images/no-image.jpg') ?>'">
                <div class="game-info">
                    <div class="game-title"><?= $game['title'] ?></div>
                    <div class="game-date">Added <?= date('d M Y', strtotime($game['created_at'])) ?></div>
                </div>
                <span class="status-badge <?= $game['status'] === 'active' ? 'status-active' : 'status-inactive' ?>">
                    <?= ucfirst($game['status']) ?>
                </span>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
function updateClock() {
    const now = new Date();
    
    // Update clock
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');
    document.getElementById('clock').textContent = `${hours}:${minutes}:${seconds}`;
    
    // Update date
    const options = { 
        weekday: 'long', 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric' 
    };
    document.getElementById('date').textContent = now.toLocaleDateString('en-US', options);
}

// Update setiap detik
setInterval(updateClock, 1000);
// Update pertama kali
updateClock();
</script>
<?= $this->endSection() ?> 