{{-- layouts/admin/partials/css/index.blade.php --}}
<style>
    /* ===== VARIABLES ===== */
    :root {
        --purple-light: #8B5CF6;
        --purple: #7C3AED;
        --purple-dark: #6D28D9;
        --teal: #2DD4BF;
        --teal-dark: #14B8A6;
        --shadow: 0 5px 20px rgba(139, 92, 246, 0.15);
    }

    /* ===== ANIMATIONS ===== */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* ===== CARD STYLES ===== */
    .pd-animated {
        border: none;
        border-radius: 16px;
        box-shadow: var(--shadow);
        overflow: hidden;
        transition: all 0.3s ease;
        background: white;
        margin-top: 20px;
        animation: fadeIn 0.6s ease-out;
    }

    .pd-animated:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(139, 92, 246, 0.2);
    }

    /* ===== HEADER CARD ===== */
    .pd-gradient {
        background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 50%, var(--purple-dark) 100%);
        border-bottom: none;
        padding: 1.25rem 1.5rem;
        color: white;
        font-size: 1.1rem;
    }

    .pd-gradient h5 {
        font-weight: 700;
        letter-spacing: 0.3px;
        margin: 0;
    }

    /* ===== BUTTONS ===== */
    .pd-add-btn {
        border: none !important;
        border-radius: 12px !important;
        padding: 0.75rem 1.75rem !important;
        font-weight: 600 !important;
        transition: all 0.3s ease !important;
        background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 100%) !important;
        color: white !important;
        box-shadow: 0 4px 14px rgba(139, 92, 246, 0.4) !important;
    }

    .pd-add-btn:hover {
        transform: translateY(-3px) !important;
        box-shadow: 0 8px 25px rgba(139, 92, 246, 0.5) !important;
    }

    .pd-btn {
        background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 100%);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 0.6rem 1.25rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .pd-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(139, 92, 246, 0.3);
    }

    .pd-btn-filter {
        background: linear-gradient(135deg, var(--teal) 0%, var(--teal-dark) 100%);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 0.65rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .pd-btn-filter:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(45, 212, 191, 0.35);
    }

    .pd-btn-reset {
        background: linear-gradient(135deg, #A0AEC0 0%, #718096 100%);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 0.65rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .pd-btn-reset:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(113, 128, 150, 0.35);
    }

    /* ===== FORM FILTER ===== */
    .pd-filter-form {
        display: flex;
        flex-wrap: wrap;
        align-items: flex-start;
        gap: 12px;
        width: 100%;
    }

    .pd-filter-form .form-group {
        margin-bottom: 0 !important;
        flex: 1;
        min-width: 180px;
    }

    .pd-search-input, .pd-select-input {
        border: 2px solid #E2E8F0;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
        background: #f8fafc;
        width: 100% !important;
    }

    .pd-search-input:focus, .pd-select-input:focus {
        border-color: var(--purple-light);
        background: white;
        box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.15);
        outline: none;
        transform: translateY(-2px);
    }

    .pd-button-group {
        display: flex;
        gap: 8px;
        align-items: center;
        flex-wrap: wrap;
        min-width: 200px;
    }

    /* ===== TABLE STYLES ===== */
    .table-responsive {
        border-radius: 12px;
        overflow: hidden;
        margin-top: 20px;
        border: 1px solid rgba(139, 92, 246, 0.1);
    }

    .table thead {
        background: linear-gradient(135deg, #8dd5e4ff 0%, #96c0bcff 100%);
    }

    .table thead th {
        color: white;
        font-weight: 700;
        border: none;
        padding: 1rem;
        text-transform: uppercase;
        font-size: 0.85rem;
        text-align: center;
    }

    .table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid rgba(139, 92, 246, 0.05);
    }

    .table tbody tr:hover {
        background: rgba(139, 92, 246, 0.05);
    }

    .table tbody td {
        padding: 1rem;
        vertical-align: middle;
        font-size: 0.95rem;
    }

    /* ===== IMAGE IN TABLE ===== */
    .table tbody td img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid rgba(139, 92, 246, 0.2);
        transition: all 0.4s ease;
        cursor: pointer;
    }

    .table tbody td img:hover {
        transform: scale(2.5);
        z-index: 100;
        position: relative;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        border: 2px solid var(--purple);
    }

    /* ===== BADGE STYLES ===== */
    .badge {
        padding: 0.4rem 0.8rem;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .badge-secondary {
        background: linear-gradient(135deg, #A0AEC0 0%, #718096 100%);
        color: white;
    }

    .badge-success {
        background: linear-gradient(135deg, #48BB78 0%, #38A169 100%);
        color: white;
    }

    .badge-primary {
        background: linear-gradient(135deg, #4299E1 0%, #3182CE 100%);
        color: white;
    }

    .badge-warning {
        background: linear-gradient(135deg, #ED8936 0%, #DD6B20 100%);
        color: white;
    }

    /* ===== ACTION BUTTONS ===== */
    .btn-sm {
        padding: 0.4rem 0.8rem;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        margin: 0 2px;
        min-width: 36px;
    }

    .btn-outline-primary {
        background: transparent;
        border: 2px solid #4299E1;
        color: #4299E1;
    }

    .btn-outline-primary:hover {
        background: #4299E1;
        color: white;
        transform: translateY(-2px);
    }

    .btn-outline-danger {
        background: transparent;
        border: 2px solid #FC8181;
        color: #FC8181;
    }

    .btn-outline-danger:hover {
        background: linear-gradient(135deg, #FC8181 0%, #F56565 100%);
        color: white;
        transform: translateY(-2px);
    }

    /* ===== PAGINATION ===== */
    .pagination {
        justify-content: center;
        margin-top: 20px;
    }

    .page-link {
        border: none;
        color: var(--purple);
        border-radius: 8px;
        margin: 0 4px;
        transition: all 0.3s ease;
    }

    .page-item.active .page-link {
        background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
    }

    .page-link:hover {
        background: rgba(139, 92, 246, 0.1);
        color: var(--purple-dark);
        transform: translateY(-2px);
    }

    /* ===== ALERT ===== */
    .alert-success {
        background: linear-gradient(135deg, #48BB78 0%, #38A169 100%);
        color: white;
        border-radius: 10px;
        border: none;
        margin-bottom: 20px;
        padding: 1rem 1.25rem;
        font-weight: 500;
    }

    .alert-success i {
        color: rgba(255, 255, 255, 0.9);
    }

    /* ===== NO DATA ===== */
    .text-muted {
        color: #A0AEC0;
        font-size: 1rem;
        text-align: center;
        padding: 2rem;
    }

    .text-muted i {
        font-size: 2rem;
        margin-bottom: 0.5rem;
        display: block;
        color: var(--purple);
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .pd-animated {
            border-radius: 12px;
            margin-top: 15px;
        }
        
        .pd-filter-form {
            flex-direction: column;
            gap: 8px;
        }
        
        .pd-filter-form .form-group {
            min-width: 100% !important;
        }
        
        .table tbody td img:hover {
            transform: scale(2);
        }
        
        .btn-sm {
            padding: 0.35rem 0.6rem;
            margin: 0 1px;
            min-width: 32px;
        }
    }
</style>