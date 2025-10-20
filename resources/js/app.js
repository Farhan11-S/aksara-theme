import.meta.glob([
  '../images/**',
  '../fonts/**',
]);

// Mobile menu functionality
document.addEventListener('DOMContentLoaded', function() {
  const mobileMenuButton = document.getElementById('mobileMenuButton');
  const mobileSidebar = document.getElementById('mobileSidebar');
  const mobileOverlay = document.getElementById('mobileOverlay');
  const closeSidebar = document.getElementById('closeSidebar');
  const mobileAboutToggle = document.getElementById('mobileAboutToggle');
  const mobileAboutSubmenu = document.getElementById('mobileAboutSubmenu');
  
  // Check if elements exist before adding event listeners
  if (!mobileMenuButton || !mobileSidebar || !mobileOverlay || !closeSidebar) {
    return;
  }
  
  // Toggle sidebar function
  function toggleSidebar() {
    const isOpen = mobileSidebar.classList.contains('sidebar-open');
    
    if (isOpen) {
      // Close sidebar
      mobileSidebar.classList.remove('sidebar-open');
      mobileOverlay.classList.remove('overlay-visible');
      mobileOverlay.classList.add('hidden');
      document.body.style.overflow = '';
    } else {
      // Open sidebar
      mobileSidebar.classList.add('sidebar-open');
      mobileOverlay.classList.remove('hidden');
      mobileOverlay.classList.add('overlay-visible');
      document.body.style.overflow = 'hidden';
    }
  }
  
  // Close sidebar function
  function closeMobileSidebar() {
    mobileSidebar.classList.remove('sidebar-open');
    mobileOverlay.classList.remove('overlay-visible');
    mobileOverlay.classList.add('hidden');
    document.body.style.overflow = '';
  }
  
  // Open/close sidebar with hamburger button
  mobileMenuButton.addEventListener('click', function(e) {
    e.stopPropagation();
    toggleSidebar();
  });
  
  // Close sidebar events
  closeSidebar.addEventListener('click', function(e) {
    e.stopPropagation();
    closeMobileSidebar();
  });
  
  mobileOverlay.addEventListener('click', function(e) {
    e.stopPropagation();
    closeMobileSidebar();
  });
  
  // Close sidebar when clicking on navigation links
  const sidebarLinks = mobileSidebar.querySelectorAll('a');
  sidebarLinks.forEach(link => {
    link.addEventListener('click', function(e) {
      setTimeout(() => {
        closeMobileSidebar();
      }, 150);
    });
  });
  
  // Toggle mobile About Us submenu
  if (mobileAboutToggle && mobileAboutSubmenu) {
    mobileAboutToggle.addEventListener('click', function(e) {
      e.stopPropagation();
      mobileAboutSubmenu.classList.toggle('hidden');
      const arrow = mobileAboutToggle.querySelector('svg');
      arrow.classList.toggle('rotate-180');
    });
  }
  
  // Close sidebar on escape key
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && mobileSidebar.classList.contains('sidebar-open')) {
      closeMobileSidebar();
    }
  });
  
  // Prevent sidebar from closing when clicking inside it
  mobileSidebar.addEventListener('click', function(e) {
    e.stopPropagation();
  });
});
