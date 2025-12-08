{{-- layouts/admin/partials/css/edit.blade.php --}}
<style>
    /* ===== VARIABLES ===== */
    :root {
        --purple-light: #8B5CF6;
        --purple: #7C3AED;
        --purple-dark: #6D28D9;
        --shadow: 0 5px 20px rgba(139, 92, 246, 0.15);
    }

    /* ===== CARD FORM ===== */
    .pd-animated {
        border: none;
        border-radius: 20px;
        box-shadow: var(--shadow);
        overflow: hidden;
        background: white;
        margin-top: 20px;
    }

    /* ===== HEADER CARD ===== */
    .pd-gradient {
        background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 50%, var(--purple-dark) 100%);
        border-bottom: none;
        padding: 1.25rem 1.5rem;
        color: white;
    }

    .pd-gradient h5 {
        font-weight: 700;
        letter-spacing: 0.5px;
        margin: 0;
    }

    /* ===== FORM STYLING ===== */
    .form-control, .form-select {
        border: 2px solid #E2E8F0;
        border-radius: 12px;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--purple-light);
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.15);
        outline: none;
        transform: translateY(-2px);
    }

    /* ===== BUTTONS ===== */
    .pd-btn {
        background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 100%);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
    }

    .pd-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(139, 92, 246, 0.4);
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .card-body {
            padding: 1.25rem;
        }
        
        .btn {
            width: 100%;
            text-align: center;
        }
    }
</style>