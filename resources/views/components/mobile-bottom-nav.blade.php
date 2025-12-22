<!-- Mobile Bottom Navigation - App-Like -->
<nav class="fixed bottom-0 left-0 right-0 bg-white/95 backdrop-blur-lg border-t-2 border-gray-200 shadow-2xl z-[9999] md:hidden safe-area-bottom mobile-bottom-nav">
    <div class="flex items-center justify-around h-14 px-1">
        <!-- Home -->
        <a href="{{ route('home') }}" class="flex flex-col items-center justify-center flex-1 py-1.5 rounded-xl transition-all {{ request()->routeIs('home') ? 'text-blue-600 bg-blue-50' : 'text-gray-600' }} active:bg-gray-100">
            <i class="fas fa-home text-lg mb-0.5 {{ request()->routeIs('home') ? 'scale-110' : '' }} transition-transform"></i>
            <span class="text-[10px] font-semibold leading-tight">{{ request()->routeIs('home') ? 'Home' : 'Home' }}</span>
        </a>

        <!-- Products -->
        <a href="{{ route('products.index') }}" class="flex flex-col items-center justify-center flex-1 py-1.5 rounded-xl transition-all {{ request()->routeIs('products.*') ? 'text-blue-600 bg-blue-50' : 'text-gray-600' }} active:bg-gray-100">
            <i class="fas fa-shopping-bag text-lg mb-0.5 {{ request()->routeIs('products.*') ? 'scale-110' : '' }} transition-transform"></i>
            <span class="text-[10px] font-semibold leading-tight">Shop</span>
        </a>

        <!-- Cart -->
        <a href="{{ route('cart.index') }}" class="flex flex-col items-center justify-center flex-1 py-1.5 rounded-xl transition-all relative {{ request()->routeIs('cart.*') ? 'text-blue-600 bg-blue-50' : 'text-gray-600' }} active:bg-gray-100">
            <div class="relative">
                <i class="fas fa-shopping-cart text-lg mb-0.5 {{ request()->routeIs('cart.*') ? 'scale-110' : '' }} transition-transform"></i>
                <span class="absolute -top-1 -right-1 bg-gradient-to-r from-blue-600 to-purple-600 text-white text-[10px] font-bold rounded-full w-4 h-4 flex items-center justify-center shadow-lg cart-count-mobile">0</span>
            </div>
            <span class="text-[10px] font-semibold leading-tight">Cart</span>
        </a>

        <!-- Wishlist -->
        <a href="{{ route('wishlist.index') }}" class="flex flex-col items-center justify-center flex-1 py-1.5 rounded-xl transition-all relative {{ request()->routeIs('wishlist.*') ? 'text-red-600 bg-red-50' : 'text-gray-600' }} active:bg-gray-100">
            <div class="relative">
                <i class="fas fa-heart text-lg mb-0.5 {{ request()->routeIs('wishlist.*') ? 'scale-110' : '' }} transition-transform"></i>
                <span class="absolute -top-1 -right-1 bg-gradient-to-r from-red-500 to-pink-500 text-white text-[10px] font-bold rounded-full w-4 h-4 flex items-center justify-center shadow-lg wishlist-count-mobile">0</span>
            </div>
            <span class="text-[10px] font-semibold leading-tight">Saved</span>
        </a>

        <!-- Account -->
        @auth
            <a href="{{ route('profile.edit') }}" class="flex flex-col items-center justify-center flex-1 py-1.5 rounded-xl transition-all {{ request()->routeIs('profile.*') || request()->routeIs('dashboard') ? 'text-blue-600 bg-blue-50' : 'text-gray-600' }} active:bg-gray-100">
                <i class="fas fa-user text-lg mb-0.5 {{ request()->routeIs('profile.*') || request()->routeIs('dashboard') ? 'scale-110' : '' }} transition-transform"></i>
                <span class="text-[10px] font-semibold leading-tight">Account</span>
            </a>
        @else
            <a href="{{ route('login') }}" class="flex flex-col items-center justify-center flex-1 py-1.5 rounded-xl transition-all {{ request()->routeIs('login') ? 'text-blue-600 bg-blue-50' : 'text-gray-600' }} active:bg-gray-100">
                <i class="fas fa-sign-in-alt text-lg mb-0.5 {{ request()->routeIs('login') ? 'scale-110' : '' }} transition-transform"></i>
                <span class="text-[10px] font-semibold leading-tight">Login</span>
            </a>
        @endauth
    </div>
</nav>

