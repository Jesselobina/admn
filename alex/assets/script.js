// Enhanced JavaScript utilities with SweetAlert integration

// Sidebar toggle functionality
document.addEventListener('DOMContentLoaded', function() {
    const toggleSidebar = document.getElementById('toggle-sidebar');
    if (toggleSidebar) {
        toggleSidebar.addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const sidebarTexts = document.querySelectorAll('.sidebar-text, .menu-text, .menu-label');
            
            if (sidebar && mainContent) {
                sidebar.classList.toggle('w-60');
                sidebar.classList.toggle('w-16');
                mainContent.classList.toggle('ml-60');
                mainContent.classList.toggle('ml-16');
                
                sidebarTexts.forEach(text => {
                    text.classList.toggle('hidden');
                });
            }
        });
    }

    // Module dropdown functionality
    document.querySelectorAll('.module-toggle').forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.stopPropagation();
            const dropdown = this.closest('.module-dropdown');
            const submenu = dropdown.querySelector('.module-submenu');
            const arrow = dropdown.querySelector('.dropdown-arrow');
            
            // Close other dropdowns
            document.querySelectorAll('.module-submenu').forEach(menu => {
                if (menu !== submenu && !menu.contains(submenu)) {
                    menu.classList.add('hidden');
                }
            });
            document.querySelectorAll('.dropdown-arrow').forEach(arr => {
                if (arr !== arrow) {
                    arr.classList.remove('rotate-180');
                }
            });
            
            // Toggle current dropdown
            if (submenu) {
                submenu.classList.toggle('hidden');
            }
            if (arrow) {
                arrow.classList.toggle('rotate-180');
            }
        });
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', function() {
        document.querySelectorAll('.module-submenu').forEach(menu => {
            menu.classList.add('hidden');
        });
        document.querySelectorAll('.dropdown-arrow').forEach(arrow => {
            arrow.classList.remove('rotate-180');
        });
    });

    // User dropdown functionality
    const userDropdownToggle = document.querySelector('.dropdown-toggle');
    if (userDropdownToggle) {
        userDropdownToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            const dropdown = this.nextElementSibling;
            if (dropdown) {
                dropdown.classList.toggle('hidden');
            }
        });
    }

    // Close user dropdown when clicking outside
    document.addEventListener('click', function() {
        const userDropdown = document.querySelector('.dropdown-toggle + ul');
        if (userDropdown) {
            userDropdown.classList.add('hidden');
        }
    });

    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert-auto-hide');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => {
                if (alert.parentNode) {
                    alert.parentNode.removeChild(alert);
                }
            }, 500);
        }, 5000);
    });
});

// Active button functionality
function setActiveButton(button) {
    if (!button) return;
    
    // Remove active class from all buttons in the same container
    const buttons = button.parentElement.querySelectorAll('button');
    buttons.forEach(btn => {
        btn.classList.remove('bg-red-500', 'text-white');
        btn.classList.add('bg-gray-200', 'text-gray-700');
    });
    
    // Add active class to clicked button
    button.classList.remove('bg-gray-200', 'text-gray-700');
    button.classList.add('bg-red-500', 'text-white');
}

// SweetAlert confirmation for delete actions
function confirmDelete(itemName, callback) {
    Swal.fire({
        title: 'Are you sure?',
        text: `You are about to delete ${itemName}. This action cannot be undone.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#E63946',
        cancelButtonColor: '#6B7280',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel',
        background: '#ffffff',
        backdrop: 'rgba(0,0,0,0.4)'
    }).then((result) => {
        if (result.isConfirmed && typeof callback === 'function') {
            // Show loading state
            Swal.fire({
                title: 'Deleting...',
                text: 'Please wait while we process your request',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Execute callback
            callback();
        }
    });
}

// Success message with SweetAlert
function showSuccess(message, title = 'Success!') {
    Swal.fire({
        icon: 'success',
        title: title,
        text: message,
        confirmButtonColor: '#E63946',
        background: '#ffffff',
        timer: 3000,
        timerProgressBar: true,
        showConfirmButton: false
    });
}

// Error message with SweetAlert
function showError(message, title = 'Error!') {
    Swal.fire({
        icon: 'error',
        title: title,
        text: message,
        confirmButtonColor: '#E63946',
        background: '#ffffff'
    });
}

// Form validation
function validateForm(formData, requiredFields) {
    for (const field of requiredFields) {
        if (!formData.get(field) || formData.get(field).toString().trim() === '') {
            showError(`${field.replace('_', ' ')} is required`);
            return false;
        }
    }
    return true;
}

// API call function
async function apiCall(url, method = 'GET', data = null) {
    try {
        const options = {
            method: method,
            headers: {
                'Content-Type': 'application/json',
            },
            credentials: 'same-origin'
        };
        
        if (data && (method === 'POST' || method === 'PUT')) {
            options.body = JSON.stringify(data);
        }
        
        const response = await fetch(url, options);
        const result = await response.json();
        
        if (!response.ok) {
            throw new Error(result.message || 'API call failed');
        }
        
        return result;
    } catch (error) {
        showError(error.message);
        throw error;
    }
}

// Form submission handler
function handleFormSubmit(formId, successCallback, errorCallback) {
    const form = document.getElementById(formId);
    if (!form) return;

    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const submitButton = this.querySelector('button[type="submit"]');
        const originalText = submitButton.innerHTML;
        
        // Show loading state
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Processing...';
        submitButton.disabled = true;
        
        try {
            const response = await apiCall(this.action, this.method, Object.fromEntries(formData));
            showSuccess(response.message || 'Operation completed successfully');
            if (successCallback) successCallback(response);
        } catch (error) {
            if (errorCallback) errorCallback(error);
        } finally {
            // Restore button state
            submitButton.innerHTML = originalText;
            submitButton.disabled = false;
        }
    });
}

// Data table functionality
function initializeDataTable(tableId, options = {}) {
    const table = document.getElementById(tableId);
    if (!table) return;

    // Check if search input already exists
    let searchInput = table.parentElement.querySelector('.table-search-input');
    if (!searchInput) {
        searchInput = document.createElement('input');
        searchInput.type = 'text';
        searchInput.placeholder = 'Search...';
        searchInput.className = 'mb-4 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 table-search-input';
        table.parentElement.insertBefore(searchInput, table);
    }

    searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = table.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });
}

// Export functions for global use
window.setActiveButton = setActiveButton;
window.confirmDelete = confirmDelete;
window.showSuccess = showSuccess;
window.showError = showError;
window.validateForm = validateForm;
window.apiCall = apiCall;
window.handleFormSubmit = handleFormSubmit;
window.initializeDataTable = initializeDataTable;