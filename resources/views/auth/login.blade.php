@extends('layouts.auth.app')

@section('content')
<style>
/* ===== VARIABLES ===== */
:root {
    --primary: #7a90f1ff;
    --primary-dark: #3a56d4;
    --primary-light: #eef2ff;
    --success: #10b981;
    --danger: #ef4444;
    --dark: #1f2937;
    --light: #f9fafb;
    --gray-100: #f3f4f6;
    --gray-200: #e5e7eb;
    --gray-300: #d1d5db;
    --gray-400: #9ca3af;
    --gray-500: #6b7280;
    --gray-600: #4b5563;
    --gray-700: #374151;
    --radius: 0.5rem;
    --radius-lg: 0.75rem;
    --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    --transition: all 0.3s ease;
}

/* ===== RESET & BASE ===== */
* {
    box-sizing: border-box;
}

body.bg-light {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
    margin: 0;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    line-height: 1.5;
}

/* ===== LOGIN CARD ===== */
.login-card {
    background: white !important;
    box-shadow: var(--shadow-xl) !important;
    border: none !important;
    border-radius: var(--radius-lg) !important;
    width: 100%;
    max-width: 420px;
    margin: 0 auto;
    animation: cardEntrance 0.6s ease-out forwards;
}

/* ===== WEB TITLE ===== */
.web-title-section {
    text-align: center;
    padding: 1.5rem 0 0.5rem;
    background: linear-gradient(135deg, var(--primary), #394cf7ff);
    border-radius: var(--radius-lg) var(--radius-lg) 0 0;
}

.web-title {
    color: white !important;
    font-weight: 700 !important;
    font-size: 1.75rem !important;
    margin-bottom: 0 !important;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    letter-spacing: 0.5px;
}

.web-subtitle {
    color: rgba(255, 255, 255, 0.9) !important;
    font-size: 0.875rem !important;
    margin-bottom: 0 !important;
    font-weight: 400;
}

/* ===== LOGO SECTION ===== */
.logo-section {
    text-align: center;
    margin-bottom: 1.5rem !important;
    padding: 1.5rem 0;
    background: linear-gradient(135deg, var(--primary-light), white);
    border-bottom: 1px solid var(--gray-200);
}

.logo-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
}

.logo-icon-container {
    font-size: 2.5rem;
    color: var(--primary);
    background: white;
    width: 70px;
    height: 70px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    border: 2px solid var(--primary-light);
    box-shadow: 0 4px 12px rgba(67, 97, 238, 0.15);
    margin: 0 auto;
}

.logo-text {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.25rem;
}

.logo-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--dark);
    margin: 0;
}

.logo-subtitle {
    font-size: 0.875rem;
    color: var(--gray-500);
    margin: 0;
    font-weight: 400;
}

/* ===== CARD CONTENT ===== */
.card-content {
    padding: 2rem !important;
}

@media (max-width: 576px) {
    .card-content {
        padding: 1.5rem !important;
    }
}

/* ===== HEADER ===== */
.login-header {
    text-align: center;
    margin-bottom: 1.5rem !important;
}

.login-title {
    color: var(--dark) !important;
    font-weight: 600 !important;
    font-size: 1.25rem !important;
    margin-bottom: 0.375rem !important;
    line-height: 1.3;
}

.login-subtitle {
    color: var(--gray-500) !important;
    font-size: 0.875rem !important;
    margin-bottom: 0 !important;
}

/* ===== FORM CONTAINER ===== */
.form-container {
    width: 100%;
}

/* ===== FORM GROUPS ===== */
.form-group {
    margin-bottom: 1.5rem !important;
    width: 100%;
}

.form-label {
    display: block;
    margin-bottom: 0.5rem !important;
    color: var(--gray-700) !important;
    font-weight: 500 !important;
    font-size: 0.875rem !important;
    width: 100%;
}

/* ===== INPUT CONTAINER ===== */
.input-container {
    width: 100%;
    position: relative;
}

/* ===== INPUT GROUP ===== */
.input-group {
    display: flex;
    width: 100%;
    border-radius: var(--radius) !important;
    overflow: hidden;
    transition: var(--transition);
    border: 1px solid var(--gray-300) !important;
    background: white;
}

.input-group:focus-within {
    border-color: var(--primary) !important;
    box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
}

.input-group:hover {
    border-color: var(--gray-400) !important;
}

.input-group-text {
    background-color: var(--gray-50) !important;
    border: none !important;
    color: var(--gray-500) !important;
    padding: 0.75rem 1rem !important;
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 48px;
    transition: var(--transition) !important;
}

.input-group:focus-within .input-group-text {
    color: var(--primary) !important;
    background-color: var(--primary-light) !important;
}

/* ===== INPUT FIELD ===== */
.form-control {
    flex: 1;
    border: none !important;
    padding: 0.75rem 1rem !important;
    font-size: 0.9375rem !important;
    color: var(--gray-800) !important;
    transition: var(--transition) !important;
    background: transparent !important;
    width: 100%;
    min-width: 0;
}

.form-control:focus {
    outline: none !important;
    box-shadow: none !important;
}

.form-control::placeholder {
    color: var(--gray-400) !important;
}

/* ===== REMEMBER ME SECTION ===== */
.remember-section {
    margin-bottom: 1.5rem !important;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.form-check {
    display: flex;
    align-items: center;
    margin: 0 !important;
}

.form-check-input {
    width: 18px !important;
    height: 18px !important;
    margin-right: 0.5rem !important;
    border: 2px solid var(--gray-300) !important;
    border-radius: 4px !important;
    transition: var(--transition) !important;
    cursor: pointer;
    flex-shrink: 0;
}

.form-check-input:checked {
    background-color: var(--primary) !important;
    border-color: var(--primary) !important;
}

.form-check-label {
    color: var(--gray-600) !important;
    font-size: 0.875rem !important;
    cursor: pointer;
    user-select: none;
    white-space: nowrap;
}

/* ===== SUBMIT BUTTON ===== */
.submit-section {
    width: 100%;
}

.submit-btn {
    width: 100%;
    padding: 0.875rem 1rem !important;
    background: var(--primary) !important;
    border: none !important;
    border-radius: var(--radius) !important;
    color: white !important;
    font-weight: 600 !important;
    font-size: 0.9375rem !important;
    transition: var(--transition) !important;
    cursor: pointer;
    display: block;
}

.submit-btn:hover {
    background: var(--primary-dark) !important;
    transform: translateY(-1px);
    box-shadow: var(--shadow) !important;
}

.submit-btn:active {
    transform: translateY(0);
}

/* ===== FOOTER ===== */
.login-footer {
    margin-top: 1.5rem !important;
    padding-top: 1.5rem;
    border-top: 1px solid var(--gray-200);
    width: 100%;
    text-align: center;
}

.footer-text {
    color: var(--gray-500) !important;
    font-size: 0.8125rem !important;
    margin-bottom: 0 !important;
}

/* ===== ANIMATIONS ===== */
@keyframes cardEntrance {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

/* ===== PASSWORD TOGGLE ===== */
.password-toggle-btn {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: var(--gray-400);
    cursor: pointer;
    padding: 0.5rem;
    font-size: 0.875rem;
    z-index: 2;
}

.password-toggle-btn:hover {
    color: var(--primary);
}

/* ===== VALIDATION STATES ===== */
.form-control.is-invalid {
    border-color: var(--danger) !important;
}

.invalid-feedback {
    display: block;
    color: var(--danger) !important;
    font-size: 0.75rem !important;
    margin-top: 0.25rem !important;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 576px) {
    .login-card {
        margin: 0 0.5rem;
    }
    
    .card-content {
        padding: 1.25rem !important;
    }
    
    .web-title {
        font-size: 1.5rem !important;
    }
    
    .login-title {
        font-size: 1.125rem !important;
    }
    
    .logo-icon-container {
        width: 60px;
        height: 60px;
        font-size: 2rem;
    }
    
    .remember-section {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .submit-btn {
        padding: 0.75rem 1rem !important;
    }
}

/* ===== UTILITY ===== */
.w-100 {
    width: 100% !important;
}

.mb-0 {
    margin-bottom: 0 !important;
}

.text-center {
    text-align: center !important;
}

.d-block {
    display: block !important;
}

.d-flex {
    display: flex !important;
}

.align-items-center {
    align-items: center !important;
}

.justify-content-between {
    justify-content: space-between !important;
}
</style>

    <div class="login-card bg-white shadow border-0 rounded border-light">
        <!-- Web Title Section -->
        <div class="web-title-section">
            <h1 class="web-title">Lembaga Desa</h1>
            <p class="web-subtitle">Sistem Informasi Desa</p>
        </div>

        <!-- Logo Section -->
        <div class="logo-section">
            <div class="logo-container">
                <div class="logo-icon-container">
                    <i class="fas fa-building"></i>
                </div>
                <div class="logo-text">
                    <h2 class="logo-title">Login</h2>
                    <p class="logo-subtitle">Akses Sistem Desa</p>
                </div>
            </div>
        </div>

        <div class="card-content p-4 p-lg-5">
            <!-- Header -->
            <div class="login-header text-center mb-4">
                <h3 class="mb-0 login-title">Masuk ke Dashboard</h3>
                <p class="login-subtitle">Masukkan kredensial Anda untuk mengakses sistem</p>
            </div>

            <!-- Alerts -->
            @if(session('success'))
                <div class="alert alert-success mb-3">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger mb-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('login.process') }}" method="POST" class="form-container" id="loginForm">
                @csrf
                
                <!-- Email Field -->
                <div class="form-group mb-4">
                    <label for="email" class="form-label d-block">Alamat Email</label>
                    <div class="input-container">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   name="email"
                                   id="email"
                                   placeholder="Masukkan email Anda"
                                   value="{{ old('email') }}"
                                   autofocus
                                   required>
                        </div>
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Password Field -->
                <div class="form-group mb-4">
                    <label for="password" class="form-label d-block">Kata Sandi</label>
                    <div class="input-container">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   name="password"
                                   id="password"
                                   placeholder="Masukkan kata sandi"
                                   required>
                            <button type="button" class="password-toggle-btn" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="remember-section d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="remember" name="remember">
                        <label class="form-check-label mb-0" for="remember">
                            Ingat saya
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="submit-section">
                    <button type="submit" class="submit-btn btn btn-primary w-100" id="loginBtn">
                        Masuk
                    </button>
                </div>
            </form>

            <!-- Footer -->
            <div class="login-footer">
                <p class="footer-text mb-0">
                    Butuh bantuan? Hubungi administrator sistem
                </p>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Password visibility toggle
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        
        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.innerHTML = type === 'password' ? 
                    '<i class="fas fa-eye"></i>' : 
                    '<i class="fas fa-eye-slash"></i>';
            });
        }
        
        // Form submission
        const form = document.getElementById('loginForm');
        const submitBtn = document.getElementById('loginBtn');
        
        if (form && submitBtn) {
            form.addEventListener('submit', function(e) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = 'Sedang masuk...';
            });
        }
        
        // Auto focus email field
        const emailInput = document.getElementById('email');
        if (emailInput && !emailInput.value) {
            emailInput.focus();
        }
    });
    </script>
@endsection


