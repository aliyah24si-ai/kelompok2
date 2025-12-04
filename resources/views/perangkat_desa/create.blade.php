@extends('adminlte::page')

@section('title', 'Tambah Perangkat Desa')

@section('content_header')
    <h1 class="m-0">Tambah Perangkat Desa</h1>
@stop

@section('content')
    <div class="card pd-animated">
        <div class="card-header pd-gradient">
            <h5 class="m-0" style="color: #fff;">Tambah Perangkat Desa</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('perangkat_desa.store') }}" method="post" enctype="multipart/form-data">
                @include('perangkat_desa.partials.form')
                <div class="mt-3">
                    <a href="{{ route('perangkat_desa.index') }}" class="btn btn-outline-secondary">Batal</a>
                    <button class="btn pd-btn">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
    <style>
        /* ===== VARIABLES ===== */
        :root {
            --purple-light: #8B5CF6;
            --purple: #7C3AED;
            --purple-dark: #6D28D9;
            --shadow: 0 5px 20px rgba(139, 92, 246, 0.15);
        }

        /* ===== CARD CREATE ===== */
        .pd-animated {
            border: none;
            border-radius: 20px;
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: all 0.4s ease;
            background: white;
            margin-top: 20px;
        }

        /* ===== HEADER CARD ===== */
        .pd-gradient {
            background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 50%, var(--purple-dark) 100%) !important;
            border-bottom: none;
            padding: 1.25rem 1.5rem;
            color: white;
        }

        .pd-gradient h5 {
            font-weight: 700;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin: 0;
        }

        /* ===== FORM STYLING ===== */
        .card-body {
            padding: 1.5rem 2rem;
        }

        form {
            animation: fadeIn 0.6s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ===== FORM GROUP ===== */
        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        label {
            font-weight: 600;
            color: #4A5568;
            margin-bottom: 0.5rem;
            display: block;
            font-size: 0.95rem;
        }

        .required::after {
            content: " *";
            color: #F56565;
        }

        /* ===== INPUT STYLING ===== */
        .form-control, .form-select {
            border: 2px solid #E2E8F0;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background-color: #fff;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--purple-light);
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.15);
            outline: none;
            transform: translateY(-2px);
        }

        .form-control:hover, .form-select:hover {
            border-color: #CBD5E0;
        }

        /* ===== FILE INPUT ===== */
        .custom-file-input {
            opacity: 0;
            position: absolute;
            z-index: -1;
        }

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

        /* ===== TOMBOL AKSI ===== */
        .mt-3 {
            display: flex;
            gap: 10px;
            margin-top: 2rem !important;
            padding-top: 1.5rem;
            border-top: 1px solid #E2E8F0;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-outline-secondary {
            background: transparent;
            border: 2px solid #A0AEC0;
            color: #4A5568;
        }

        .btn-outline-secondary:hover {
            background: #4A5568;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(74, 85, 104, 0.2);
        }

        .pd-btn {
            background: linear-gradient(135deg, var(--purple-light) 0%, var(--purple) 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
        }

        .pd-btn:hover {
            background: linear-gradient(135deg, var(--purple) 0%, var(--purple-dark) 100%);
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 8px 20px rgba(139, 92, 246, 0.4);
        }

        /* ===== VALIDATION ERRORS ===== */
        .is-invalid {
            border-color: #FC8181 !important;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23FC8181'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23FC8181' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }

        .invalid-feedback {
            color: #F56565;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            font-weight: 500;
            background: linear-gradient(135deg, rgba(252, 129, 129, 0.1) 0%, rgba(245, 101, 101, 0.05) 100%);
            padding: 0.5rem 0.75rem;
            border-radius: 8px;
            border-left: 4px solid #F56565;
            animation: slideInRight 0.3s ease;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(-10px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* ===== DATE INPUT ===== */
        input[type="date"] {
            position: relative;
        }

        input[type="date"]::-webkit-calendar-picker-indicator {
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%237C3AED' viewBox='0 0 24 24'%3E%3Cpath d='M20 3h-1V1h-2v2H7V1H5v2H4c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 18H4V8h16v13z'/%3E%3C/svg%3E");
            background-size: 16px;
            background-repeat: no-repeat;
            background-position: center;
            padding: 0.5rem;
            cursor: pointer;
            opacity: 0.7;
            transition: opacity 0.3s ease;
        }

        input[type="date"]::-webkit-calendar-picker-indicator:hover {
            opacity: 1;
        }

        /* ===== LOADING STATE ===== */
        .btn-loading {
            position: relative;
            color: transparent;
        }

        .btn-loading::after {
            content: "";
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin-left: -10px;
            margin-top: -10px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
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
    
    <!-- JavaScript untuk Image Preview -->
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
            
            // Form loading state
            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function() {
                    const submitBtn = this.querySelector('.pd-btn');
                    if (submitBtn) {
                        submitBtn.classList.add('btn-loading');
                        submitBtn.disabled = true;
                    }
                });
            }
        });
    </script>
@stop