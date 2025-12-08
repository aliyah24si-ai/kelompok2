{{-- layouts/admin/partials/css/form.blade.php --}}
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
    .card-body {
        padding: 1.5rem 2rem;
    }

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

    /* ===== FORM GROUP ===== */
    .form-group {
        margin-bottom: 1.5rem;
    }

    label {
        font-weight: 600;
        color: #4A5568;
        margin-bottom: 0.5rem;
        display: block;
    }

    .required::after {
        content: " *";
        color: #F56565;
    }

    /* ===== FILE INPUT ===== */
    .custom-file-label {
        border: 2px solid #E2E8F0;
        border-radius: 12px;
        padding: 0.75rem 1rem;
        background-color: #F7FAFC;
        cursor: pointer;
        transition: all 0.3s ease;
        display: block;
        position: relative;
    }

    .custom-file-label::after {
        content: "Pilih File";
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 100%);
        color: white;
        padding: 0.4rem 1rem;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .custom-file-label:hover {
        border-color: var(--purple-light);
        background-color: #fff;
    }

    /* ===== IMAGE PREVIEW ===== */
    #imagePreview {
        margin-top: 1rem;
        text-align: center;
    }

    #imagePreview img {
        max-width: 200px;
        max-height: 200px;
        border-radius: 12px;
        border: 3px solid var(--purple-light);
        box-shadow: 0 4px 15px rgba(139, 92, 246, 0.2);
        padding: 5px;
        background: white;
        transition: all 0.3s ease;
    }

    #imagePreview img:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 20px rgba(139, 92, 246, 0.3);
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

    .btn-outline-secondary {
        border: 2px solid #A0AEC0;
        color: #4A5568;
        border-radius: 12px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-outline-secondary:hover {
        background: #4A5568;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(74, 85, 104, 0.2);
    }

    /* ===== VALIDATION ERRORS ===== */
    .is-invalid {
        border-color: #FC8181 !important;
    }

    .invalid-feedback {
        color: #F56565;
        font-size: 0.875rem;
        margin-top: 0.5rem;
        font-weight: 500;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .card-body {
            padding: 1.25rem;
        }
        
        .mt-3 {
            flex-direction: column;
        }
        
        .btn {
            width: 100%;
            text-align: center;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Image preview
        const fileInput = document.querySelector('input[type="file"][name="foto"]');
        const imagePreview = document.getElementById('imagePreview');
        
        if (fileInput && imagePreview) {
            fileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.innerHTML = `
                            <div class="mb-2">
                                <strong>Preview:</strong>
                            </div>
                            <img src="${e.target.result}" alt="Preview Foto" class="img-fluid">
                            <div class="mt-2 text-muted" style="font-size: 0.85rem;">
                                ${file.name} (${(file.size / 1024).toFixed(2)} KB)
                            </div>
                        `;
                    }
                    reader.readAsDataURL(file);
                } else {
                    imagePreview.innerHTML = '';
                }
            });
        }
    });
</script>