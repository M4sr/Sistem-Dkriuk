<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul']; ?> - <?= $data['pengaturan']['nama_toko']; ?></title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --primary-red: #A30D11;
            --dark-red: #8B0A0D;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1562967914-608f82629710?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            overflow: hidden;
            position: relative;
        }

        /* Particle System */
        .particle {
            position: absolute;
            color: rgba(255, 255, 255, 0.2);
            font-size: 24px;
            pointer-events: none;
            z-index: 1;
            animation: floatParticle linear infinite;
        }

        @keyframes floatParticle {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }

            10% {
                opacity: 0.4;
            }

            90% {
                opacity: 0.4;
            }

            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 30px;
            padding: 50px 40px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            animation: fadeInScale 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
            position: relative;
            z-index: 10;
        }

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .logo-wrapper {
            width: 120px;
            height: 120px;
            background: var(--primary-red);
            border-radius: 25px;
            margin: 0 auto 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-weight: 700;
            font-size: 0.85rem;
            color: #444;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
        }

        .input-group-text {
            background: #f8f9fa;
            border-right: none;
            border-radius: 12px 0 0 12px;
            color: #6c757d;
            padding-left: 20px;
            padding-right: 15px;
        }

        .form-control {
            background: #f8f9fa;
            border-left: none;
            border-radius: 0 12px 12px 0;
            padding: 12px 20px 12px 0;
            font-weight: 500;
            border: 1px solid #dee2e6;
        }

        .form-control:focus {
            background: #fff;
            box-shadow: none;
            border-color: #dee2e6;
        }

        .btn-login {
            background: var(--primary-red);
            border: none;
            border-radius: 15px;
            padding: 14px;
            font-weight: 800;
            font-size: 1rem;
            letter-spacing: 1px;
            color: #fff;
            transition: 0.3s;
            box-shadow: 0 10px 20px rgba(163, 13, 17, 0.3);
            margin-top: 20px;
        }

        .btn-login:hover {
            background: var(--dark-red);
            transform: translateY(-2px);
            box-shadow: 0 15px 25px rgba(163, 13, 17, 0.4);
            color: #fff;
        }

        .btn-back {
            color: #6c757d;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-back:hover {
            color: var(--primary-red);
        }

        .alert-premium {
            border-radius: 15px;
            border: none;
            font-size: 0.85rem;
            font-weight: 600;
            background: #fee2e2;
            color: #991b1b;
        }

        /* Mobile Optimization */
        @media (max-width: 576px) {
            .login-card {
                margin: 0 20px;
                padding: 40px 25px;
                border-radius: 25px;
            }
            .logo-wrapper {
                width: 100px;
                height: 100px;
                margin-bottom: 20px;
            }
            h3.fw-800 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>

    <div class="login-card text-center">
        <!-- Logo Section -->
        <div class="logo-wrapper">
            <?php
            $logo_path = !empty($data['pengaturan']['logo']) ? BASEURL . '/assets/img/logo/' . $data['pengaturan']['logo'] : '';
            ?>
            <img src="<?= $logo_path; ?>" class="img-fluid" alt="Logo"
                onerror="this.src='https://ui-avatars.com/api/?name=<?= urlencode($data['pengaturan']['nama_toko']); ?>&background=fff&color=A30D11&size=256'">
        </div>

        <h3 class="fw-800 mb-1" style="font-weight: 800; letter-spacing: -1px; color: #1a1a1a;">
            <?= strtoupper($data['pengaturan']['nama_toko']); ?>
        </h3>
        <p class="text-muted small mb-4">Silakan masuk ke Panel Administrasi</p>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-premium mb-4 animate__animated animate__shakeX">
                <i class="fas fa-exclamation-circle me-2"></i>
                <?php
                if ($_GET['error'] == 'wrong_pass')
                    echo 'Password yang Anda masukkan salah!';
                elseif ($_GET['error'] == 'not_found')
                    echo 'Username tidak ditemukan!';
                else
                    echo 'Terjadi kesalahan, silakan coba lagi.';
                ?>
            </div>
        <?php endif; ?>

        <form action="<?= BASEURL; ?>/admin/proses_login" method="post" class="text-start">
            <div class="mb-4">
                <label class="form-label"><i class="fas fa-user-circle me-2 text-muted"></i> USERNAME ADMIN</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-at"></i></span>
                    <input type="text" name="username" class="form-control" placeholder="Masukkan username" required
                        autocomplete="off">
                </div>
            </div>

            <div class="mb-2">
                <label class="form-label"><i class="fas fa-lock me-2 text-muted"></i> PASSWORD</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password"
                        required>
                </div>
            </div>



            <button type="submit" class="btn btn-login w-100 shadow-sm">
                MASUK SEKARANG <i class="fas fa-arrow-right ms-2"></i>
            </button>
        </form>

        <div class="mt-4">
            <a href="<?= BASEURL; ?>" class="btn-back">
                <i class="fas fa-home me-1"></i> Kembali ke Beranda
            </a>
        </div>
    </div>

    <!-- Animate.css for alerts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <script>
        // Fried Chicken Particle Generator
        function createParticles() {
            // Create a dedicated container for particles to prevent flexbox layout bugs
            let container = document.getElementById('particle-container');
            if (!container) {
                container = document.createElement('div');
                container.id = 'particle-container';
                container.style.position = 'absolute';
                container.style.top = '0';
                container.style.left = '0';
                container.style.width = '100%';
                container.style.height = '100%';
                container.style.overflow = 'hidden';
                container.style.pointerEvents = 'none';
                container.style.zIndex = '0';
                document.body.prepend(container);
            }

            const particleCount = 20;
            const icons = ['fa-drumstick-bite', 'fa-hotdog', 'fa-hamburger'];

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('i');
                const icon = icons[Math.floor(Math.random() * icons.length)];

                particle.className = `fas ${icon} particle`;

                // Random properties
                const startX = Math.random() * 100; // 0 to 100%
                const size = Math.random() * (40 - 15) + 15; // 15 to 40px
                const duration = Math.random() * (15 - 8) + 8; // 8 to 15s
                const delay = Math.random() * 10; // 0 to 10s

                particle.style.left = `${startX}%`;
                particle.style.fontSize = `${size}px`;
                particle.style.animationDuration = `${duration}s`;
                particle.style.animationDelay = `-${delay}s`; // Start mid-animation

                container.appendChild(particle);
            }
        }

        document.addEventListener('DOMContentLoaded', createParticles);
    </script>
</body>

</html>