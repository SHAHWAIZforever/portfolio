// Optimized scroll visibility handler
let isScrolling = false;
let fadeElements = [];

// Function to update fade elements list
function updateFadeElements() {
  fadeElements = Array.from(document.querySelectorAll('.fade-up, .fade-up-1, .fade-up-2, .fade-up-3, .fade-left, .fade-right, .fade-down, .fade-up-slow, .hid, .fade-up-4, .fade-up-5'));
}

// Handle scroll visibility check
function handleScroll() {
  if (isScrolling) return;

  isScrolling = true;
  requestAnimationFrame(() => {
    const windowHeight = window.innerHeight;

    fadeElements = fadeElements.filter(element => {
      const rect = element.getBoundingClientRect();
      if (rect.top <= windowHeight && rect.bottom >= -50) {
        // Add 'visible' class and remove element from the list to avoid future checks
        element.classList.add('visible');
        return false; // Remove from fadeElements array
      }
      return true;
    });

    isScrolling = false;
  });
}

// Initialize
window.addEventListener('load', () => {
  updateFadeElements();
  handleScroll(); // Initial check
});

// Scroll/resize handlers
window.addEventListener('scroll', handleScroll, { passive: true });
window.addEventListener('resize', handleScroll, { passive: true });

// Optional: reduce mobile event listeners
window.addEventListener('touchmove', handleScroll, { passive: true });

// // .>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>



 // Wait for the page to fully load
 window.onload = function() {
    gsap.from(".yourDiv", {
        opacity: 0,     // Start as invisible
        y: 90,          // Start 50px lower than its final position
        duration: 1.5,    // Duration of the animation
        ease: "power2.out"  // Easing for smooth motion
      }); 
  };