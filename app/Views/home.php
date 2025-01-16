<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        
        .navbar {
            background-color: rgba(33, 37, 41, 0.98);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                        url('https://images.unsplash.com/photo-1511512578047-dfb367046420?ixlib=rb-4.0.3') center/cover;
            height: 80vh;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at center, transparent 0%, rgba(0,0,0,0.8) 100%);
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero h1 {
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        .hero p {
            font-size: 1.25rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
        }

        .btn-hero {
            padding: 0.8rem 2rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: transform 0.3s;
        }

        .btn-hero:hover {
            transform: translateY(-2px);
        }

        .game-card {
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            height: 100%;
            background: white;
        }

        .game-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }

        .game-cover {
            height: 200px;
            object-fit: cover;
            width: 100%;
            transition: transform 0.3s ease;
        }

        .game-card:hover .game-cover {
            transform: scale(1.05);
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #2d3436;
        }

        .card-text {
            color: #636e72;
            font-size: 0.9rem;
        }

        .modal-xl {
            max-width: 95%;
        }

        .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .modal-header {
            border-bottom: 1px solid rgba(0,0,0,0.1);
            padding: 1.5rem;
        }

        .modal-body {
            padding: 0;
        }

        .game-frame {
            width: 100%;
            height: 85vh;
            border: none;
            border-radius: 0 0 15px 15px;
        }

        .game-info {
            padding: 1.5rem;
            background: #f8f9fa;
            border-radius: 0 0 15px 15px;
        }

        .btn-fullscreen {
            background-color: #4834d4;
            border: none;
            padding: 0.5rem 1.2rem;
            transition: all 0.3s ease;
        }

        .btn-fullscreen:hover {
            background-color: #686de0;
            transform: translateY(-2px);
        }

        .about-section {
            background: white;
            padding: 5rem 0;
        }

        .about-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .section-title {
            font-weight: 700;
            color: #2d3436;
            margin-bottom: 3rem;
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50%;
            height: 3px;
            background: #4834d4;
            border-radius: 2px;
        }

        @media (max-width: 768px) {
            .hero {
                height: 60vh;
            }
            
            .hero h1 {
                font-size: 2rem;
            }

            .modal-xl {
                max-width: 100%;
                margin: 0;
            }

            .game-frame {
                height: 70vh;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?= base_url() ?>">
                <i class="bi bi-controller me-2 fs-3"></i>
                <span class="fs-4 fw-bold">Game Portal</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url() ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#games">Games</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero d-flex align-items-center">
        <div class="container text-center hero-content">
            <h1 class="display-4 fw-bold mb-4">Welcome to Game Portal</h1>
            <p class="lead mb-4">Discover and play amazing games for free!</p>
            <a href="#games" class="btn btn-primary btn-lg btn-hero">
                Start Playing <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </section>

    <!-- Games Grid -->
    <section class="py-5" id="games">
        <div class="container">
            <h2 class="text-center section-title mb-5">Featured Games</h2>
            <div class="row g-4">
                <?php foreach($games as $game): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="game-card" data-bs-toggle="modal" data-bs-target="#gameModal<?= $game['id'] ?>">
                        <?php 
                        $coverUrl = str_replace(base_url(), '', $game['cover_url']);
                        $coverUrl = ltrim($coverUrl, '/');
                        ?>
                        <img src="<?= base_url($coverUrl) ?>" 
                             class="game-cover" 
                             alt="<?= $game['title'] ?>"
                             onerror="this.onerror=null; this.src='<?= base_url('assets/images/no-image.jpg') ?>';">
                        <div class="card-body">
                            <h5 class="card-title"><?= $game['title'] ?></h5>
                            <p class="card-text"><?= substr($game['description'], 0, 100) ?>...</p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Game Modals -->
    <?php foreach($games as $game): ?>
    <div class="modal fade" id="gameModal<?= $game['id'] ?>" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold"><?= $game['title'] ?></h5>
                    <div>
                        <button type="button" class="btn btn-primary btn-fullscreen me-2" onclick="toggleFullscreen('gameFrame<?= $game['id'] ?>')">
                            <i class="bi bi-arrows-fullscreen"></i> Fullscreen
                        </button>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                </div>
                <div class="modal-body">
                    <iframe id="gameFrame<?= $game['id'] ?>" 
                            class="game-frame" 
                            src="<?= $game['embed_url'] ?>" 
                            allowfullscreen></iframe>
                    <div class="game-info">
                        <h4 class="fw-bold mb-3">About <?= $game['title'] ?></h4>
                        <p class="mb-4"><?= $game['description'] ?></p>
                        <?php if($game['how_to_play']): ?>
                        <h5 class="fw-bold mb-2">How to Play:</h5>
                        <p class="mb-0"><?= $game['how_to_play'] ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <!-- About Section -->
    <section class="about-section" id="about">
        <div class="container">
            <div class="about-content text-center">
                <h2 class="section-title">About Game Portal</h2>
                <p class="lead">Game Portal is your destination for free online games. We offer a wide selection of games that you can play directly in your browser. No downloads required!</p>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Fullscreen function
        function toggleFullscreen(frameId) {
            const iframe = document.getElementById(frameId);
            
            if (!document.fullscreenElement) {
                if (iframe.requestFullscreen) {
                    iframe.requestFullscreen();
                } else if (iframe.webkitRequestFullscreen) {
                    iframe.webkitRequestFullscreen();
                } else if (iframe.msRequestFullscreen) {
                    iframe.msRequestFullscreen();
                }
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.webkitExitFullscreen) {
                    document.webkitExitFullscreen();
                } else if (document.msExitFullscreen) {
                    document.msExitFullscreen();
                }
            }
        }

        document.addEventListener('keydown', function(e) {
            if (document.fullscreenElement && e.key === 'Escape') {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                }
            }
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                document.querySelector('.navbar').style.backgroundColor = 'rgba(33, 37, 41, 0.98)';
            } else {
                document.querySelector('.navbar').style.backgroundColor = 'rgba(33, 37, 41, 0.8)';
            }
        });
    </script>
</body>
</html> 