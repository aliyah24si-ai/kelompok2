{{-- layouts/admin/partials/css/dashboard.blade.php --}}
<style>
    /* ===== VARIABLES ===== */
    :root {
        --purple-light: #8B5CF6;
        --purple: #7C3AED;
        --purple-dark: #6D28D9;
        --teal: #2DD4BF;
        --teal-dark: #14B8A6;
        --blue: #3B82F6;
        --green: #10B981;
        --shadow: 0 5px 20px rgba(139, 92, 246, 0.15);
        --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    /* ===== STAT CARD STYLES ===== */
    .stat-card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s ease;
        position: relative;
        box-shadow: var(--shadow-sm);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    }

    .stat-card .card-body {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        padding: 1.5rem;
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: white;
    }

    .stat-card-blue .stat-icon {
        background: linear-gradient(135deg, #3B82F6 0%, #1D4ED8 100%);
    }

    .stat-card-purple .stat-icon {
        background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple-dark) 100%);
    }

    .stat-card-teal .stat-icon {
        background: linear-gradient(135deg, var(--teal) 0%, var(--teal-dark) 100%);
    }

    .stat-card-green .stat-icon {
        background: linear-gradient(135deg, var(--green) 0%, #059669 100%);
    }

    .stat-content {
        flex: 1;
    }

    .stat-title {
        color: #6B7280;
        font-size: 0.875rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        margin: 0 0 0.5rem 0;
        text-transform: uppercase;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
        color: #1F2937;
    }

    /* ===== ANIMATIONS ===== */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes slideInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* ===== CARD STYLES ===== */
    .pd-animated {
        border: none;
        border-radius: 16px;
        box-shadow: var(--shadow-sm);
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
        font-weight: 600;
    }

    .pd-gradient h5 {
        font-weight: 700;
        letter-spacing: 0.3px;
        margin: 0;
        display: flex;
        align-items: center;
    }

    /* ===== TABLE STYLES ===== */
    .card-body .table {
        margin-bottom: 0;
    }

    .table-hover tbody tr:hover {
        background-color: #f8fafc;
    }

    .table th {
        border-top: none;
        border-bottom: 2px solid #E5E7EB;
        color: #6B7280;
        font-weight: 600;
        padding: 1rem;
    }

    .table td {
        padding: 0.875rem 1rem;
        vertical-align: middle;
        color: #374151;
    }

    /* ===== DETAIL CARD ===== */
    .detail-card {
        background: #f8fafc;
        border-radius: 12px;
        padding: 1rem 1.25rem;
        margin-bottom: 0.75rem;
        border-left: 4px solid var(--purple);
        transition: all 0.3s ease;
    }

    .detail-card:last-child {
        margin-bottom: 0;
    }

    .detail-card:hover {
        transform: translateX(4px);
        box-shadow: 0 2px 8px rgba(139, 92, 246, 0.1);
    }

    .detail-label {
        color: #6B7280;
        font-size: 0.875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        margin-bottom: 0.5rem;
    }

    .detail-value {
        color: #1F2937;
        font-size: 1rem;
        margin: 0;
    }

    /* ===== STAT BOX ===== */
    .stat-box {
        padding: 2rem 1rem;
        border-radius: 12px;
        background: linear-gradient(135deg, #f8fafc 0%, #f0f9ff 100%);
        transition: all 0.3s ease;
    }

    .stat-box:hover {
        transform: scale(1.05);
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
    }

    .stat-box h4 {
        margin: 0 0 0.5rem 0;
        font-size: 2.5rem;
        font-weight: 700;
    }

    .stat-box p {
        font-size: 0.95rem;
        margin: 0;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .stat-card .card-body {
            flex-direction: column;
            text-align: center;
            gap: 1rem;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            font-size: 1.5rem;
        }

        .stat-value {
            font-size: 1.5rem;
        }

        .detail-card {
            padding: 0.875rem 1rem;
        }
    }

    /* ===== BADGE CUSTOM ===== */
    .badge {
        padding: 0.5rem 0.875rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.8rem;
        letter-spacing: 0.3px;
    }

    /* ===== BUTTON HOVER ===== */
    .btn-primary {
        background: linear-gradient(135deg, var(--blue) 0%, #1D4ED8 100%);
        border: none;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
    }

    /* ===== CONTENT HEADER ===== */
    .content-header .d-flex {
        animation: slideInUp 0.5s ease-out;
    }

    .content-header h1 {
        font-weight: 700;
        color: #1F2937;
        font-size: 2rem;
    }

    .content-header span {
        font-size: 0.95rem;
        margin-top: 0.5rem;
    }
</style>
