<script>
    // Common JavaScript functions for all pages
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-dismiss alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert:not(.alert-permanent)');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
        
        // Enable tooltips
        $('[data-toggle="tooltip"]').tooltip();
        
        // Enable popovers
        $('[data-toggle="popover"]').popover();
        
        // Sidebar search
        $('[data-widget="sidebar-search"]').on('submit', function(e) {
            e.preventDefault();
            // Implement search functionality here
        });
    });
    
    // Global delete confirmation
    function confirmDelete(event, message = 'Apakah Anda yakin ingin menghapus data ini?') {
        if (!confirm(message)) {
            event.preventDefault();
            return false;
        }
        return true;
    }
    
    // Global form validation
    function validateForm(formId) {
        const form = document.getElementById(formId);
        if (!form) return true;
        
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                isValid = false;
            } else {
                field.classList.remove('is-invalid');
            }
        });
        
        return isValid;
    }
    
    // Image preview function
    function previewImage(input, previewId) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById(previewId);
                if (preview) {
                    preview.innerHTML = `
                        <img src="${e.target.result}" alt="Preview" class="img-thumbnail mt-2" style="max-width: 200px;">
                    `;
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>