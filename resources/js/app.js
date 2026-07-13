import './bootstrap';

// Mobile menu toggle
document.addEventListener('DOMContentLoaded', function() {
    const pageLoader = document.getElementById('page-loader');
    if (pageLoader) {
        window.addEventListener('load', function() {
            pageLoader.classList.add('opacity-0', 'pointer-events-none');
            setTimeout(function() {
                if (pageLoader && pageLoader.parentNode) {
                    pageLoader.parentNode.removeChild(pageLoader);
                }
            }, 500);
        });
    }

    // Navbar scroll behavior
    const navbar = document.getElementById('navbar');
    const logoDefault = document.getElementById('logo-default');
    const logoWhite = document.getElementById('logo-white');
    const navLinks = document.querySelectorAll('.nav-link');
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    
    function updateNavbar() {
        if (window.scrollY > 50) {
            // Scrolled state - white background, dark text, regular logo
            navbar.classList.add('bg-white', 'shadow-md');
            navbar.classList.remove('bg-transparent');
            
            if (logoDefault && logoWhite) {
                logoDefault.classList.remove('hidden');
                logoWhite.classList.add('hidden');
            }
            
            navLinks.forEach(link => {
                link.classList.remove('text-white');
                link.classList.add('text-gray-700');
            });
            
            if (mobileMenuButton) {
                mobileMenuButton.classList.remove('text-white');
                mobileMenuButton.classList.add('text-gray-700');
            }
        } else {
            // Top of page - transparent background, white text, white logo
            navbar.classList.remove('bg-white', 'shadow-md');
            navbar.classList.add('bg-transparent');
            
            if (logoDefault && logoWhite) {
                logoDefault.classList.add('hidden');
                logoWhite.classList.remove('hidden');
            }
            
            navLinks.forEach(link => {
                link.classList.add('text-white');
                link.classList.remove('text-gray-700');
            });
            
            if (mobileMenuButton) {
                mobileMenuButton.classList.add('text-white');
                mobileMenuButton.classList.remove('text-gray-700');
            }
        }
    }
    
    // Run on page load
    updateNavbar();
    
    // Run on scroll
    window.addEventListener('scroll', updateNavbar);
    
    // Mobile menu
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuClose = document.getElementById('mobile-menu-close');
    
    if (mobileMenuButton) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }
    
    if (mobileMenuClose) {
        mobileMenuClose.addEventListener('click', function() {
            mobileMenu.classList.add('hidden');
        });
    }
    
    // Dropdown menus (both desktop and mobile)
    const dropdowns = document.querySelectorAll('.dropdown');
    dropdowns.forEach(dropdown => {
        const button = dropdown.querySelector('.dropdown-button');
        const menu = dropdown.querySelector('.dropdown-menu, .mobile-dropdown-menu');
        const arrow = button ? button.querySelector('svg') : null;
        
        if (button && menu) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                // Toggle current dropdown
                const isHidden = menu.classList.contains('hidden');
                menu.classList.toggle('hidden');
                
                // Rotate arrow icon
                if (arrow) {
                    if (isHidden) {
                        arrow.style.transform = 'rotate(180deg)';
                    } else {
                        arrow.style.transform = 'rotate(0deg)';
                    }
                }
            });
        }
    });
    
    // Close all dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown')) {
            dropdowns.forEach(dropdown => {
                const menu = dropdown.querySelector('.dropdown-menu, .mobile-dropdown-menu');
                const button = dropdown.querySelector('.dropdown-button');
                const arrow = button ? button.querySelector('svg') : null;
                if (menu) {
                    menu.classList.add('hidden');
                }
                if (arrow) {
                    arrow.style.transform = 'rotate(0deg)';
                }
            });
        }
    });
    
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Hero Slider Functionality
    const slides = document.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.slider-dot');
    const prevButton = document.querySelector('.slider-prev');
    const nextButton = document.querySelector('.slider-next');
    let currentSlide = 0;
    let slideInterval;

    function showSlide(index) {
        // Hide all slides
        slides.forEach(slide => {
            slide.classList.remove('active');
            slide.style.opacity = '0';
            slide.style.transition = 'opacity 1s ease-in-out';
            slide.style.transform = 'scale(1.02)';
        });

        // Remove active class from all dots
        dots.forEach(dot => {
            dot.classList.remove('active');
            dot.classList.remove('bg-white');
            dot.classList.add('bg-white/50');
        });

        // Show current slide
        if (slides[index]) {
            slides[index].classList.add('active');
            slides[index].style.opacity = '1';
            slides[index].style.transform = 'scale(1)';
        }

        // Highlight current dot
        if (dots[index]) {
            dots[index].classList.add('active');
            dots[index].classList.add('bg-white');
            dots[index].classList.remove('bg-white/50');
        }

        currentSlide = index;
    }

    function nextSlide() {
        let next = (currentSlide + 1) % slides.length;
        showSlide(next);
    }

    function prevSlide() {
        let prev = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(prev);
    }

    function startAutoSlide() {
        slideInterval = setInterval(nextSlide, 5000); // Change slide every 5 seconds
    }

    function stopAutoSlide() {
        clearInterval(slideInterval);
    }

    // Initialize slider
    if (slides.length > 0) {
        showSlide(0);
        startAutoSlide();

        // Next button
        if (nextButton) {
            nextButton.addEventListener('click', () => {
                stopAutoSlide();
                nextSlide();
                startAutoSlide();
            });
        }

        // Previous button
        if (prevButton) {
            prevButton.addEventListener('click', () => {
                stopAutoSlide();
                prevSlide();
                startAutoSlide();
            });
        }

        // Dot navigation
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                stopAutoSlide();
                showSlide(index);
                startAutoSlide();
            });
        });

        // Pause on hover
        const heroSlider = document.querySelector('.hero-slider');
        if (heroSlider) {
            heroSlider.addEventListener('mouseenter', stopAutoSlide);
            heroSlider.addEventListener('mouseleave', startAutoSlide);
            let startX = 0;
            let endX = 0;
            heroSlider.addEventListener('touchstart', function(e) {
                startX = e.changedTouches[0].screenX;
            });
            heroSlider.addEventListener('touchend', function(e) {
                endX = e.changedTouches[0].screenX;
                if (endX - startX > 50) {
                    stopAutoSlide();
                    prevSlide();
                    startAutoSlide();
                } else if (startX - endX > 50) {
                    stopAutoSlide();
                    nextSlide();
                    startAutoSlide();
                }
            });
        }
    }
});
