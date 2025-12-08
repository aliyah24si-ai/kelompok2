{{-- layouts/admin/partials/css/show.blade.php --}}
<style>
    /* ===== VARIABLES ===== */
    :root {
        --purple-light: #8B5CF6;
        --purple: #7C3AED;
        --shadow: 0 5px 20px rgba(139, 92, 246, 0.15);
    }

    /* ===== CARD STYLES ===== */
    .pd-animated {
        border: none;
        border-radius: 16px;
        box-shadow: var(--shadow);
        overflow: hidden;
        background: white;
        margin-top: 20px;
    }

    .pd-gradient {
        background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 100%);
        border-bottom: none;
        padding: 1.25rem 1.5rem;
        color: white;
    }

    .pd-gradient h5 {
        font-weight: 700;
        letter-spacing: 0.3px;
        margin: 0;
    }

    /* ===== DETAIL CARD ===== */
    .detail-card {
        background: #f8fafc;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        border-left: 4px solid var(--purple);
        transition: all 0.3s ease;
    }

    .detail-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(139, 92, 246, 0.1);
    }

    .detail-label {
        color: #4A5568;
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 0.25rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .detail-value {
        color: #2D3748;
        font-size: 1rem;
        font-weight: 500;
        line-height: 1.5;
    }

    /* ===== PROFILE IMAGE ===== */
    .profile-img-container {
        text-align: center;
        padding: 2rem;
    }

    .profile-img {
        width: 250px;
        height: 250px;
        object-fit: cover;
        border-radius: 16px;
        border: 4px solid var(--purple-light);
        box-shadow: 0 8px 25px rgba(139, 92, 246, 0.3);
        transition: all 0.3s ease;
    }

    .profile-img:hover {
        transform: scale(1.03);
        box-shadow: 0 12px 30px rgba(139, 92, 246, 0.4);
    }

    /* ===== ACTION BUTTONS ===== */
    .action-buttons {
        display: flex;
        gap: 10px;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid #E2E8F0;
    }

    .pd-btn {
        background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 100%);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .pd-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(139, 92, 246, 0.3);
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .profile-img {
            width: 200px;
            height: 200px;
        }
        
        .detail-card {
            padding: 1rem;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .pd-btn {
            width: 100%;
            text-align: center;
        }
    }
</style>