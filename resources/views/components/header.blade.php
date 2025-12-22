@php
use App\Models\Setting;
@endphp

<!-- Top Header Bar - Enhanced -->
<div class="bg-gradient-to-r from-blue-600 via-purple-600 to-blue-600 py-2.5 hidden md:block relative overflow-hidden">
    <div class="absolute inset-0 bg-black/5"></div>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex justify-between items-center text-sm">
            <div class="text-white font-medium flex items-center">
                <i class="fas fa-truck mr-2 text-lg"></i>
                <span>Free shipping on orders over KES 50,000</span>
            </div>
            <div class="flex items-center space-x-6">
                <a href="{{ route('wishlist.index') }}" class="text-white/90 hover:text-white transition-colors font-medium flex items-center">
                    <i class="fas fa-heart mr-1.5"></i>
                    Wishlist
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Main Header - Enhanced -->
<header id="main-header" class="bg-white shadow-lg sticky top-0 z-50 border-b border-gray-100 safe-area-top transition-all duration-300">
    <div class="container mx-auto px-3 sm:px-4 md:px-6 lg:px-8">
        <div id="header-content" class="flex items-center justify-between py-2.5 sm:py-3 md:py-5 transition-all duration-300">
            <!-- Logo - Enhanced -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center space-x-2 sm:space-x-3 group">
                    <div id="header-logo" class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-blue-600 to-purple-600 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-300 transform group-hover:scale-105">
                        <i class="fas fa-home text-white text-lg sm:text-xl transition-all duration-300"></i>
                    </div>
                    <div id="header-site-name" class="hidden sm:block transition-all duration-300">
                        <span class="text-xl sm:text-2xl font-extrabold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent transition-all duration-300">
                            {{ Setting::get('site_name', config('app.name', 'Home & Kitchen')) }}
                        </span>
                    </div>
                </a>
            </div>

            <!-- Center Search - Enhanced -->
            <div id="header-search" class="flex-1 max-w-2xl mx-4 md:mx-8 hidden md:block transition-all duration-300">
                <form action="{{ route('products.index') }}" method="GET" class="flex shadow-xl rounded-xl overflow-hidden border-2 border-gray-200 hover:border-blue-300 transition-all">
                    <div class="relative min-w-[180px]">
                        <select name="category" class="header-search-input bg-gradient-to-br from-gray-50 to-gray-100 border-r-2 border-gray-300 text-gray-900 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 block w-full px-4 py-3 pl-4 pr-10 appearance-none cursor-pointer hover:from-gray-100 hover:to-gray-200 transition-all rounded-l-xl">
                            <option value="">All Categories</option>
                            @foreach(\App\Models\Category::active()->get() as $category)
                                <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <i class="fas fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 pointer-events-none text-sm"></i>
                    </div>
                    <div class="relative flex-1 flex items-center bg-white">
                        <input type="text" name="search" value="{{ request('search') }}" 
                               class="header-search-input bg-white text-gray-900 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 block w-full px-4 py-3 border-0 outline-none transition-all duration-300" 
                               placeholder="Search for products...">
                        <button type="submit" class="absolute right-3 text-gray-400 hover:text-blue-600 transition-colors">
                            <i class="fas fa-search text-lg"></i>
                        </button>
                    </div>
                    <button type="submit" class="header-search-btn bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-3 hover:from-blue-700 hover:to-purple-700 transition-all font-semibold rounded-r-xl shadow-lg hover:shadow-xl">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            <!-- Right Side - Enhanced -->
            <div class="flex items-center space-x-4 md:space-x-6">
                <!-- Desktop Elements -->
                <div class="hidden lg:flex items-center space-x-2 px-4 py-2 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors cursor-pointer">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-phone text-white text-sm"></i>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xs text-gray-500">Call Us</span>
                        <span class="text-sm font-semibold text-gray-900">{{ Setting::get('contact_phone', '+254 700 123 456') }}</span>
                    </div>
                </div>
                
                <a href="{{ route('wishlist.index') }}" class="hidden md:block relative p-2.5 rounded-full bg-gray-50 hover:bg-red-50 transition-all group">
                    <i class="fas fa-heart text-xl text-gray-600 group-hover:text-red-600 transition-colors"></i>
                    <span class="absolute -top-1 -right-1 bg-gradient-to-r from-red-500 to-pink-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center font-bold shadow-lg wishlist-count">0</span>
                </a>

                <!-- Basket with Dropdown - Enhanced -->
                <div class="relative group hidden md:block">
                    <a href="{{ route('cart.index') }}" class="flex items-center space-x-3 relative p-2.5 rounded-xl bg-gradient-to-br from-blue-50 to-purple-50 hover:from-blue-100 hover:to-purple-100 transition-all border-2 border-transparent hover:border-blue-200">
                        <div class="relative">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-purple-600 rounded-full flex items-center justify-center shadow-lg">
                                <i class="fas fa-shopping-basket text-white"></i>
                            </div>
                            <span class="absolute -top-1 -right-1 bg-gradient-to-r from-orange-500 to-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center font-bold shadow-lg cart-count">0</span>
                        </div>
                        <div class="flex flex-col hidden lg:block">
                            <span class="text-xs text-gray-500 font-medium">Total</span>
                            <span class="text-sm font-bold text-gray-900 cart-total">KES 0</span>
                        </div>
                    </a>

                    <!-- Basket Dropdown - Enhanced -->
                    <div class="absolute right-0 top-full mt-3 w-96 bg-white border-2 border-gray-200 rounded-2xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 transform group-hover:translate-y-0 translate-y-2">
                        <div class="p-5 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-purple-50 rounded-t-2xl">
                            <h3 class="text-lg font-bold text-gray-900 flex items-center">
                                <i class="fas fa-shopping-basket text-blue-600 mr-2"></i>
                                Shopping Basket
                            </h3>
                        </div>
                        <div class="cart-dropdown max-h-80 overflow-y-auto">
                            <div class="p-6 text-center text-gray-500">
                                <i class="fas fa-shopping-basket text-4xl text-gray-300 mb-3"></i>
                                <p>Your basket is empty</p>
                            </div>
                        </div>
                        <div class="p-5 border-t border-gray-200 bg-gray-50 rounded-b-2xl">
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-base font-semibold text-gray-700">Total:</span>
                                <span class="text-xl font-bold text-gray-900 cart-dropdown-total">KES 0.00</span>
                            </div>
                            <a href="{{ route('cart.index') }}" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 px-4 rounded-xl text-center block hover:from-blue-700 hover:to-purple-700 transition-all font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                View Basket
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Mobile Menu Button - Compact -->
                <button id="mobile-menu-button" class="md:hidden flex items-center justify-center w-9 h-9 rounded-xl bg-gray-100 active:bg-gray-200 text-gray-700 transition-all">
                    <i class="fas fa-bars text-lg"></i>
                </button>

                <!-- Mobile Search Button - Compact -->
                <button id="mobile-search-button" class="md:hidden flex items-center justify-center w-9 h-9 rounded-xl bg-gradient-to-r from-blue-600 to-purple-600 text-white active:from-blue-700 active:to-purple-700 transition-all shadow-md">
                    <i class="fas fa-search text-base"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Navigation Menu - Enhanced & Standout -->
    <nav id="header-nav" class="bg-gradient-to-r from-blue-600 via-purple-600 to-blue-600 hidden md:block shadow-xl relative overflow-hidden transition-all duration-300">
        <!-- Animated background effect -->
        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent animate-shimmer"></div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex items-center justify-center space-x-1 lg:space-x-2 py-4">
                @php
                  $categories = \App\Models\Category::active()->ordered()->take(8)->get();
                @endphp
                @foreach ($categories as $category)
                    <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                    class="group relative px-4 lg:px-6 py-2.5 rounded-xl text-white font-semibold text-sm lg:text-base transition-all duration-300 transform hover:scale-105 {{ request('category') == $category->slug ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' }}">
                        <span class="relative z-10 flex items-center">
                            <i class="{{ $category->icon }} mr-2 text-lg group-hover:scale-110 transition-transform"></i>
                            <span class="hidden lg:inline">{{ $category->name }}</span>
                            <span class="lg:hidden">{{ \Illuminate\Support\Str::limit($category->name, 8) }}</span>
                        </span>
                        @if(request('category') == $category->slug)
                            <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-8 h-1 bg-white rounded-full"></div>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
    </nav>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const header = document.getElementById('main-header');
    const headerContent = document.getElementById('header-content');
    const headerNav = document.getElementById('header-nav');
    const headerLogo = document.getElementById('header-logo');
    const headerSiteName = document.getElementById('header-site-name');
    const headerSearch = document.getElementById('header-search');
    const searchInputs = document.querySelectorAll('.header-search-input');
    const searchBtn = document.querySelector('.header-search-btn');
    
    // Use buffer zones to prevent rapid toggling
    const scrollThresholdDown = 100; // Start shrinking after 100px
    const scrollThresholdUp = 50;   // Start expanding before reaching top (50px)
    let isScrolled = null; // Use null to force initial check
    
    function setScrolledState(scrolled) {
        // Only update if state actually changed
        if (scrolled === isScrolled) return;
        
        // Prevent rapid state changes
        const previousState = isScrolled;
        isScrolled = scrolled;
        
        // Use requestAnimationFrame to batch DOM updates
        requestAnimationFrame(function() {
            if (scrolled) {
                // Apply scrolled state
                header.classList.add('header-scrolled');
                if (headerContent) {
                    headerContent.className = headerContent.className.replace(/\bpy-[\d.]+/g, '') + ' py-1.5 sm:py-2';
                }
                if (headerLogo) {
                    headerLogo.className = headerLogo.className.replace(/\b(w|h)-[\d.]+/g, '') + ' w-8 h-8 sm:w-10 sm:h-10';
                }
                if (headerSiteName) {
                    const span = headerSiteName.querySelector('span');
                    if (span) {
                        span.className = span.className.replace(/\btext-(xl|2xl|lg|base)/g, '') + ' text-base sm:text-lg';
                    }
                }
                if (headerNav) {
                    headerNav.style.cssText = 'max-height: 0; overflow: hidden; padding-top: 0; padding-bottom: 0;';
                }
                if (headerSearch) {
                    headerSearch.classList.remove('max-w-2xl');
                    headerSearch.classList.add('max-w-xl');
                }
                searchInputs.forEach(input => {
                    input.classList.remove('py-3');
                    input.classList.add('py-2');
                });
                if (searchBtn) {
                    searchBtn.classList.remove('px-6', 'py-3');
                    searchBtn.classList.add('px-4', 'py-2');
                }
            } else {
                // Apply normal state
                header.classList.remove('header-scrolled');
                if (headerContent) {
                    headerContent.className = headerContent.className.replace(/\bpy-[\d.]+/g, '') + ' py-2.5 sm:py-3 md:py-5';
                }
                if (headerLogo) {
                    headerLogo.className = headerLogo.className.replace(/\b(w|h)-[\d.]+/g, '') + ' w-10 h-10 sm:w-12 sm:h-12';
                }
                if (headerSiteName) {
                    const span = headerSiteName.querySelector('span');
                    if (span) {
                        span.className = span.className.replace(/\btext-(xl|2xl|lg|base)/g, '') + ' text-xl sm:text-2xl';
                    }
                }
                if (headerNav) {
                    headerNav.style.cssText = '';
                }
                if (headerSearch) {
                    headerSearch.classList.remove('max-w-xl');
                    headerSearch.classList.add('max-w-2xl');
                }
                searchInputs.forEach(input => {
                    input.classList.remove('py-2');
                    input.classList.add('py-3');
                });
                if (searchBtn) {
                    searchBtn.classList.remove('px-4', 'py-2');
                    searchBtn.classList.add('px-6', 'py-3');
                }
            }
        });
    }
    
    function handleScroll() {
        const currentScroll = window.pageYOffset || document.documentElement.scrollTop;
        
        // Use different thresholds for scrolling up vs down to prevent flickering
        if (currentScroll > scrollThresholdDown) {
            setScrolledState(true);
        } else if (currentScroll < scrollThresholdUp) {
            setScrolledState(false);
        }
        // Between scrollThresholdUp and scrollThresholdDown, maintain current state
    }
    
    // Throttle scroll events more aggressively
    let ticking = false;
    let lastScrollTop = 0;
    
    window.addEventListener('scroll', function() {
        const currentScroll = window.pageYOffset || document.documentElement.scrollTop;
        
        // Only process if scroll position changed significantly (at least 5px)
        if (Math.abs(currentScroll - lastScrollTop) < 5) {
            return;
        }
        lastScrollTop = currentScroll;
        
        if (!ticking) {
            window.requestAnimationFrame(function() {
                handleScroll();
                ticking = false;
            });
            ticking = true;
        }
    }, { passive: true });
    
    // Check initial state
    handleScroll();
});
</script>

<!-- Mobile Search Form - Enhanced -->
<div id="mobile-search" class="fixed inset-0 z-50 hidden bg-black/60 backdrop-blur-sm">
    <div class="absolute top-0 left-0 right-0 bg-white p-4 shadow-2xl rounded-b-2xl">
        <div class="flex items-center space-x-3">
            <button id="mobile-search-close" class="w-10 h-10 flex items-center justify-center rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-600 hover:text-gray-800 transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
            <form action="{{ route('products.index') }}" method="GET" class="flex-1 flex shadow-lg rounded-xl overflow-hidden">
                <input type="text" name="search" value="{{ request('search') }}" 
                       class="flex-1 px-4 py-3 border-0 focus:ring-2 focus:ring-blue-500 bg-gray-50" 
                       placeholder="Search products...">
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white hover:from-blue-700 hover:to-purple-700 transition-all font-semibold">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Mobile Drawer Menu - Enhanced -->
<div id="mobile-drawer" class="fixed inset-0 z-[60] hidden">
    <!-- Backdrop -->
    <div id="mobile-drawer-backdrop" class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>

    <!-- Drawer Content -->
    <div class="absolute right-0 top-0 h-full w-80 md:w-96 bg-white shadow-2xl transform translate-x-full transition-transform duration-300">
        <!-- Header - Enhanced -->
        <div class="flex items-center justify-between p-5 border-b-2 border-gray-200 bg-gradient-to-r from-blue-600 to-purple-600">
            <h2 class="text-xl font-bold text-white flex items-center">
                <i class="fas fa-bars mr-2"></i>
                Menu
            </h2>
            <button id="mobile-drawer-close" class="w-10 h-10 flex items-center justify-center rounded-lg bg-white/20 hover:bg-white/30 text-white transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <!-- Navigation - Enhanced -->
        <div class="p-5 h-full overflow-y-auto bg-gray-50">
            <div class="space-y-6">
                <!-- Main Navigation -->
                <div>
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4 px-2">Navigation</h3>
                    <div class="space-y-2">
                        <a href="{{ route('home') }}" class="flex items-center space-x-4 p-4 rounded-xl hover:bg-white transition-all {{ request()->routeIs('home') ? 'bg-gradient-to-r from-blue-50 to-purple-50 border-2 border-blue-200' : 'bg-white hover:shadow-md' }}">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-500 rounded-lg flex items-center justify-center">
                                <i class="fas fa-home text-white"></i>
                            </div>
                            <span class="font-semibold text-gray-800">Home</span>
                        </a>
                        <a href="{{ route('products.index') }}" class="flex items-center space-x-4 p-4 rounded-xl hover:bg-white transition-all {{ request()->routeIs('products.*') ? 'bg-gradient-to-r from-blue-50 to-purple-50 border-2 border-blue-200' : 'bg-white hover:shadow-md' }}">
                            <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-teal-500 rounded-lg flex items-center justify-center">
                                <i class="fas fa-shopping-bag text-white"></i>
                            </div>
                            <span class="font-semibold text-gray-800">Products</span>
                        </a>
                        <a href="{{ route('pages.about') }}" class="flex items-center space-x-4 p-4 rounded-xl bg-white hover:shadow-md transition-all">
                            <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center">
                                <i class="fas fa-info-circle text-white"></i>
                            </div>
                            <span class="font-semibold text-gray-800">About</span>
                        </a>
                        <a href="{{ route('pages.contact') }}" class="flex items-center space-x-4 p-4 rounded-xl bg-white hover:shadow-md transition-all">
                            <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-red-500 rounded-lg flex items-center justify-center">
                                <i class="fas fa-envelope text-white"></i>
                            </div>
                            <span class="font-semibold text-gray-800">Contact</span>
                        </a>
                        <a href="{{ route('pages.faq') }}" class="flex items-center space-x-4 p-4 rounded-xl bg-white hover:shadow-md transition-all">
                            <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-blue-500 rounded-lg flex items-center justify-center">
                                <i class="fas fa-question-circle text-white"></i>
                            </div>
                            <span class="font-semibold text-gray-800">FAQ</span>
                        </a>
                    </div>
                </div>

                <!-- Categories - Enhanced -->
                <div>
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4 px-2">Categories</h3>
                    <div class="grid grid-cols-2 gap-3">
                        @foreach(\App\Models\Category::active()->take(8)->get() as $category)
                            <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="flex flex-col items-center p-4 rounded-xl bg-white hover:shadow-lg transition-all border-2 border-transparent hover:border-blue-200 transform hover:-translate-y-1">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full flex items-center justify-center mb-2">
                                    <i class="{{ $category->icon }} text-blue-600 text-lg"></i>
                                </div>
                                <span class="text-xs font-semibold text-gray-800 text-center">{{ $category->name }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Account & Cart - Enhanced -->
                <div>
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4 px-2">Account</h3>
                    <div class="space-y-2">
                        @auth
                            <a href="{{ route('dashboard') }}" class="flex items-center space-x-4 p-4 rounded-xl bg-white hover:shadow-md transition-all">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-500 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                                <span class="font-semibold text-gray-800">My Account</span>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="flex items-center space-x-4 p-4 rounded-xl bg-white hover:shadow-md transition-all">
                                <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-teal-500 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-sign-in-alt text-white"></i>
                                </div>
                                <span class="font-semibold text-gray-800">Login</span>
                            </a>
                        @endauth
                        <a href="{{ route('cart.index') }}" class="flex items-center justify-between p-4 rounded-xl bg-gradient-to-r from-blue-50 to-purple-50 border-2 border-blue-200 hover:shadow-md transition-all">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-purple-600 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-shopping-cart text-white"></i>
                                </div>
                                <span class="font-semibold text-gray-800">Cart</span>
                            </div>
                            <span class="bg-gradient-to-r from-blue-600 to-purple-600 text-white text-sm font-bold rounded-full px-3 py-1 cart-count">0</span>
                        </a>
                        <a href="{{ route('wishlist.index') }}" class="flex items-center justify-between p-4 rounded-xl bg-gradient-to-r from-red-50 to-pink-50 border-2 border-red-200 hover:shadow-md transition-all">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-pink-500 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-heart text-white"></i>
                                </div>
                                <span class="font-semibold text-gray-800">Wishlist</span>
                            </div>
                            <span class="bg-gradient-to-r from-red-500 to-pink-500 text-white text-sm font-bold rounded-full px-3 py-1 wishlist-count">0</span>
                        </a>
                    </div>
                </div>

                <!-- Contact Info - Enhanced -->
                <div>
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4 px-2">Contact</h3>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-4 p-4 rounded-xl bg-white">
                            <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-teal-500 rounded-lg flex items-center justify-center">
                                <i class="fas fa-phone text-white"></i>
                            </div>
                            <span class="font-semibold text-gray-800">{{ Setting::get('contact_phone', '+254 700 123 456') }}</span>
                        </div>
                        <div class="flex items-center space-x-4 p-4 rounded-xl bg-white">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-500 rounded-lg flex items-center justify-center">
                                <i class="fas fa-envelope text-white"></i>
                            </div>
                            <span class="font-semibold text-gray-800 text-sm">{{ Setting::get('contact_email', 'hello@homekitchen.com') }}</span>
                        </div>
                        <div class="flex items-center space-x-4 p-4 rounded-xl bg-white">
                            <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-red-500 rounded-lg flex items-center justify-center">
                                <i class="fas fa-map-marker-alt text-white"></i>
                            </div>
                            <span class="font-semibold text-gray-800 text-sm">{{ Setting::get('contact_address', 'Westlands, Nairobi') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

