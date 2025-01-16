<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Game Portal Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #4834d4 0%, #686de0 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .register-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            overflow: hidden;
            width: 100%;
            max-width: 400px;
            margin: 2rem 0;
        }

        .register-header {
            background: #4834d4;
            padding: 2rem;
            text-align: center;
            color: white;
        }

        .register-header i {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .register-body {
            padding: 2rem;
        }

        .form-control {
            border-radius: 10px;
            padding: 0.75rem 1rem;
            border: 1px solid rgba(0,0,0,0.1);
            margin-bottom: 1rem;
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(72, 52, 212, 0.1);
            border-color: #4834d4;
        }

        .btn-register {
            background: #4834d4;
            border: none;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-weight: 500;
            width: 100%;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-register:hover {
            background: #686de0;
            transform: translateY(-2px);
        }

        .alert {
            border: none;
            border-radius: 10px;
            margin-bottom: 1rem;
        }

        .login-link {
            text-align: center;
            margin-top: 1rem;
            color: #666;
        }

        .login-link a {
            color: #4834d4;
            text-decoration: none;
            font-weight: 500;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .form-label {
            font-weight: 500;
            color: #2d3436;
            margin-bottom: 0.5rem;
        }

        .password-toggle {
            position: relative;
        }

        .password-toggle .bi {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #666;
        }

        .validation-message {
            font-size: 0.875rem;
            color: #666;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="register-card">
                    <div class="register-header">
                        <i class="bi bi-controller"></i>
                        <h4 class="mb-0">Create Admin Account</h4>
                    </div>
                    <div class="register-body">
                        <?php if(session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?= base_url('admin/create') ?>" method="post">
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="name"
                                       name="name" 
                                       value="<?= old('name') ?>"
                                       required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" 
                                       class="form-control" 
                                       id="email"
                                       name="email" 
                                       value="<?= old('email') ?>"
                                       required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="password-toggle">
                                    <input type="password" 
                                           class="form-control" 
                                           id="password"
                                           name="password" 
                                           required>
                                    <i class="bi bi-eye-slash" id="togglePassword"></i>
                                </div>
                                <div class="validation-message">
                                    Password must be at least 8 characters
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <div class="password-toggle">
                                    <input type="password" 
                                           class="form-control" 
                                           id="confirm_password"
                                           name="confirm_password" 
                                           required>
                                    <i class="bi bi-eye-slash" id="toggleConfirmPassword"></i>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-register">
                                <i class="bi bi-person-plus me-2"></i>
                                Register
                            </button>
                        </form>

                        <div class="login-link">
                            Already have an account? 
                            <a href="<?= base_url('admin/login') ?>">Login here</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Password visibility toggle
        document.getElementById('togglePassword').addEventListener('click', function() {
            const password = document.getElementById('password');
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });

        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            const password = document.getElementById('confirm_password');
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });

        // Password validation
        document.getElementById('password').addEventListener('input', function() {
            const validation = document.querySelector('.validation-message');
            if (this.value.length < 8) {
                validation.style.color = '#dc3545';
            } else {
                validation.style.color = '#198754';
            }
        });

        // Auto-hide alerts
        document.querySelectorAll('.alert').forEach(alert => {
            setTimeout(() => {
                alert.classList.remove('show');
                setTimeout(() => alert.remove(), 150);
            }, 5000);
        });
    </script>
</body>
</html>