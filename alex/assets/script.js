document.addEventListener('DOMContentLoaded', function() {
    // --- Sidebar toggle functionality ---
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

    // --- Module dropdown functionality ---
    document.querySelectorAll('.module-toggle').forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.stopPropagation(); // Prevent the document click handler from closing it immediately
            const dropdown = this.closest('.module-dropdown');
            const submenu = dropdown.querySelector('.module-submenu');
            const arrow = dropdown.querySelector('.dropdown-arrow');
            
            // Close other open dropdowns
            document.querySelectorAll('.module-submenu').forEach(otherSubmenu => {
                if (otherSubmenu !== submenu) {
                    otherSubmenu.classList.add('hidden');
                    otherSubmenu.closest('.module-dropdown').querySelector('.dropdown-arrow').classList.remove('rotate-180');
                }
            });
            
            // Toggle current dropdown
            submenu.classList.toggle('hidden');
            arrow.classList.toggle('rotate-180');
        });
    });

    // --- Auto-expand active module dropdown on page load ---
    const activeModule = document.querySelector('.module-toggle.active-sidebar-item');
    if (activeModule) {
        const submenu = activeModule.closest('.module-dropdown').querySelector('.module-submenu');
        const arrow = activeModule.querySelector('.dropdown-arrow');
        if (submenu) {
            submenu.classList.remove('hidden');
        }
        if (arrow) {
            arrow.classList.add('rotate-180');
        }
    }
    
    // --- User profile dropdown functionality ---
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

    // --- Global click listener to close dropdowns ---
    document.addEventListener('click', function() {
        // Close user dropdown
        const userDropdown = document.querySelector('.dropdown-toggle + ul');
        if (userDropdown && !userDropdown.classList.contains('hidden')) {
            userDropdown.classList.add('hidden');
        }
    });
});

// --- SweetAlert Functions (if needed) ---
function confirmDelete(itemName, callback) {
    Swal.fire({
        title: 'Are you sure?',
        text: `You are about to delete ${itemName}. This action cannot be undone.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#E63946',
        cancelButtonColor: '#6B7280',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed && typeof callback === 'function') {
            callback();
        }
    });
}