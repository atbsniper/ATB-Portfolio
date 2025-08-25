<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?></title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- AOS Animations -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    
    <!-- Force Cyberpunk Styles -->
    <style>
        /* Critical CSS to override WordPress defaults */
        html, body {
            background: #000 !important;
            color: #cccccc !important;
        }
        
        .blog-post {
            background: linear-gradient(135deg, rgba(17, 17, 17, 0.95) 0%, rgba(10, 10, 10, 0.95) 100%) !important;
            border: 1px solid rgba(255, 30, 30, 0.3) !important;
            border-radius: 12px !important;
            padding: 2rem !important;
            margin-bottom: 2rem !important;
            color: #cccccc !important;
        }
        
        .blog-post h2 {
            color: #ff1e1e !important;
        }
        
        .blog-post h2 a {
            color: #ff1e1e !important;
        }
        
        .blog-post .post-excerpt {
            color: #cccccc !important;
        }
        
        .blog-post .read-more {
            color: #ff1e1e !important;
        }
        
        .cyberpunk-nav {
            background: linear-gradient(135deg, rgba(17, 17, 17, 0.95) 0%, rgba(10, 10, 10, 0.95) 100%) !important;
        }
        
        .section-bg {
            background: linear-gradient(135deg, #151515 0%, #0d0d0d 100%) !important;
        }
        
        /* Override any WordPress white backgrounds */
        article, main, .wp-block-post, .wp-block-post-template {
            background: transparent !important;
        }
    </style>
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    
    <!-- Navigation -->
    <nav class="fixed w-full z-50 cyberpunk-nav" x-data="{ isOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-logo text-red-500">ATB</a>
                </div>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-8">
                    <a href="/" class="nav-link text-gray-300 hover:text-red-500 transition-colors font-heading uppercase">HOME</a>
                    <a href="/projects.html" class="nav-link text-gray-300 hover:text-red-500 transition-colors font-heading uppercase">PROJECTS</a>
                    <a href="/blog" class="nav-link text-red-500 font-semibold font-heading uppercase">BLOG</a>
                    <a href="/contact.html" class="nav-link text-gray-300 hover:text-red-500 transition-colors font-heading uppercase">CONTACT</a>
                </div>
                
                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button @click="isOpen = !isOpen" class="text-red-500">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                </div>
            </div>
            
            <!-- Mobile Menu -->
            <div x-show="isOpen" x-transition class="md:hidden">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="/" class="block px-3 py-2 text-gray-300 hover:text-red-500 font-heading uppercase">HOME</a>
                    <a href="/projects.html" class="block px-3 py-2 text-gray-300 hover:text-red-500 font-heading uppercase">PROJECTS</a>
                    <a href="/blog" class="block px-3 py-2 text-red-500 font-semibold font-heading uppercase">BLOG</a>
                    <a href="/contact.html" class="block px-3 py-2 text-gray-300 hover:text-red-500 font-heading uppercase">CONTACT</a>
                </div>
            </div>
        </div>
    </nav>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true
        });
        
        // Initialize Lucide icons
        lucide.createIcons();
    </script>
