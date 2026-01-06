<?php
require_once 'Acces_BD/session_config.php';

// Rediriger si déjà connecté
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
    header('Location: IHM/accueil.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Gestion École</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            overflow-x: hidden;
        }

        /* Animated Gradient Background */
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(-45deg, #667eea, #764ba2, #f093fb, #4facfe);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
            position: relative;
            overflow: hidden;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Floating Shapes Animation */
        .shape {
            position: absolute;
            opacity: 0.1;
            animation: float 20s infinite ease-in-out;
        }

        .shape-1 {
            width: 300px;
            height: 300px;
            background: white;
            border-radius: 50%;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape-2 {
            width: 200px;
            height: 200px;
            background: white;
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            bottom: 20%;
            right: 15%;
            animation-delay: 4s;
        }

        .shape-3 {
            width: 150px;
            height: 150px;
            background: white;
            border-radius: 50%;
            bottom: 30%;
            left: 20%;
            animation-delay: 2s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-50px) rotate(180deg); }
        }

        /* Login Card with Glassmorphism */
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 3rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            max-width: 480px;
            width: 90%;
            position: relative;
            z-index: 10;
            animation: slideInUp 0.8s ease-out;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Logo Section */
        .logo-section {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .logo-circle {
            width: 100px;
            height: 100px;
            margin: 0 auto 1.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .logo-circle i {
            font-size: 3rem;
            color: white;
        }

        .app-title {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .app-subtitle {
            color: #718096;
            font-size: 1rem;
            font-weight: 500;
        }

        /* Form Styling */
        .form-section h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 2rem;
            text-align: center;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-label {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
        }

        .form-label i {
            margin-right: 0.5rem;
            color: #667eea;
        }

        .form-control {
            padding: 0.875rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            outline: none;
            transform: translateY(-2px);
        }

        /* Password Toggle */
        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #718096;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: #667eea;
        }

        /* Submit Button */
        .btn-login {
            width: 100%;
            padding: 1rem;
            font-size: 1.1rem;
            font-weight: 700;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            position: relative;
            overflow: hidden;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.5);
        }

        .btn-login:active {
            transform: translateY(-1px);
        }

        /* Alert Messages */
        .alert-custom {
            border-radius: 12px;
            border: none;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            animation: slideInDown 0.5s ease-out;
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-danger {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #991b1b;
            border-left: 4px solid #dc2626;
        }

        .alert-success {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #065f46;
            border-left: 4px solid #059669;
        }

        /* Demo Credentials */
        .demo-credentials {
            background: linear-gradient(135deg, #e0f2fe 0%, #bfdbfe 100%);
            border-radius: 16px;
            padding: 1.5rem;
            margin-top: 2rem;
            border-left: 4px solid #0369a1;
        }

        .demo-credentials h6 {
            font-weight: 700;
            color: #0369a1;
            margin-bottom: 1rem;
            font-size: 1rem;
        }

        .credential-item {
            background: white;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            margin-bottom: 0.75rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .credential-item:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .credential-item:last-child {
            margin-bottom: 0;
        }

        .credential-label {
            font-weight: 600;
            color: #2d3748;
            font-size: 0.9rem;
        }

        .credential-value {
            font-family: 'Courier New', monospace;
            color: #0369a1;
            font-size: 0.85rem;
            background: #e0f2fe;
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
        }

        /* Footer */
        .login-footer {
            text-align: center;
            margin-top: 2rem;
            color: #718096;
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .login-card {
                padding: 2rem 1.5rem;
            }

            .app-title {
                font-size: 1.75rem;
            }

            .logo-circle {
                width: 80px;
                height: 80px;
            }

            .logo-circle i {
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Animated Shapes -->
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>

        <!-- Login Card -->
        <div class="login-card">
            <!-- Logo Section -->
            <div class="logo-section">
                <div class="logo-circle">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h1 class="app-title">Gestion École</h1>
                <p class="app-subtitle">Système de gestion académique</p>
            </div>

            <!-- Alerts -->
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-custom" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <?php 
                    echo htmlspecialchars($_SESSION['error']); 
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success alert-custom" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <?php 
                    echo htmlspecialchars($_SESSION['success']); 
                    unset($_SESSION['success']);
                    ?>
                </div>
            <?php endif; ?>

            <!-- Login Form -->
            <form action="Gestion_Actions/login.php" method="POST" class="form-section">
                <h2>
                    <i class="fas fa-sign-in-alt me-2" style="color: #667eea;"></i>
                    Connexion
                </h2>

                <div class="form-group">
                    <label for="username" class="form-label">
                        <i class="fas fa-user"></i>
                        Nom d'utilisateur
                    </label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="username" 
                        name="username" 
                        placeholder="Entrez votre nom d'utilisateur"
                        required 
                        autocomplete="username"
                    >
                </div>

                <div class="form-group" style="position: relative;">
                    <label for="password" class="form-label">
                        <i class="fas fa-lock"></i>
                        Mot de passe
                    </label>
                    <input 
                        type="password" 
                        class="form-control" 
                        id="password" 
                        name="password" 
                        placeholder="Entrez votre mot de passe"
                        required 
                        autocomplete="current-password"
                    >
                    <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i>
                    <span>Se Connecter</span>
                </button>
            </form>

            <!-- Demo Credentials -->
            <div class="demo-credentials">
                <h6>
                    <i class="fas fa-info-circle me-2"></i>
                    Comptes de Démonstration
                </h6>
                <div class="credential-item" onclick="fillCredentials('admin', 'admin123')">
                    <span class="credential-label">
                        <i class="fas fa-shield-alt me-2" style="color: #667eea;"></i>
                        Administrateur
                    </span>
                    <span class="credential-value">admin / admin123</span>
                </div>
                <div class="credential-item" onclick="fillCredentials('prof1', 'prof123')">
                    <span class="credential-label">
                        <i class="fas fa-chalkboard-teacher me-2" style="color: #11998e;"></i>
                        Professeur
                    </span>
                    <span class="credential-value">prof1 / prof123</span>
                </div>
                <div class="credential-item" onclick="fillCredentials('etudiant1', 'etudiant123')">
                    <span class="credential-label">
                        <i class="fas fa-user-graduate me-2" style="color: #4facfe;"></i>
                        Étudiant
                    </span>
                    <span class="credential-value">etudiant1 / etudiant123</span>
                </div>
            </div>

            <!-- Footer -->
            <div class="login-footer">
                <i class="fas fa-shield-alt me-1"></i>
                Connexion sécurisée • © <?php echo date('Y'); ?> Gestion École
            </div>
        </div>
    </div>

    <script>
        // Password Toggle
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        // Auto-fill credentials
        function fillCredentials(username, password) {
            document.getElementById('username').value = username;
            document.getElementById('password').value = password;
            
            // Add highlight animation
            const usernameInput = document.getElementById('username');
            const passwordInput = document.getElementById('password');
            
            usernameInput.style.borderColor = '#667eea';
            passwordInput.style.borderColor = '#667eea';
            
            setTimeout(() => {
                usernameInput.style.borderColor = '';
                passwordInput.style.borderColor = '';
            }, 1000);
        }

        // Add enter key support for credential items
        document.querySelectorAll('.credential-item').forEach(item => {
            item.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    this.click();
                }
            });
        });
    </script>
</body>
</html>
