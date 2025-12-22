<!-- Floating Cart Button - Mobile Only -->
<a href="{{ route('cart.index') }}" 
   class="fixed bottom-20 right-4 md:hidden z-[9998] bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-full shadow-2xl hover:shadow-3xl transition-all transform hover:scale-110 active:scale-95 w-14 h-14 flex items-center justify-center group floating-cart-btn"
   style="display: none;">
    <div class="relative">
        <i class="fas fa-shopping-cart text-xl"></i>
        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center shadow-lg cart-count-floating">0</span>
    </div>
    <div class="absolute right-full mr-3 bg-gray-900 text-white text-xs font-semibold px-3 py-1.5 rounded-lg whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none">
        <span class="cart-total-floating">KES 0</span>
        <div class="absolute right-0 top-1/2 transform translate-x-1 -translate-y-1/2 w-0 h-0 border-l-4 border-l-gray-900 border-t-4 border-t-transparent border-b-4 border-b-transparent"></div>
    </div>
</a>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Show/hide floating cart button based on cart count
    function updateFloatingCartButton() {
        fetch('/cart/data')
            .then(response => response.json())
            .then(data => {
                const floatingBtn = document.querySelector('.floating-cart-btn');
                const cartCountFloating = document.querySelector('.cart-count-floating');
                const cartTotalFloating = document.querySelector('.cart-total-floating');
                
                if (floatingBtn && cartCountFloating && cartTotalFloating) {
                    cartCountFloating.textContent = data.cart_count;
                    cartTotalFloating.textContent = 'KES ' + data.cart_total.toLocaleString('en-KE', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                    
                    // Show button if cart has items
                    if (data.cart_count > 0) {
                        floatingBtn.style.display = 'flex';
                    } else {
                        floatingBtn.style.display = 'none';
                    }
                }
            })
            .catch(error => {
                console.error('Error fetching cart data:', error);
            });
    }
    
    // Update on page load
    updateFloatingCartButton();
    
    // Update when cart changes (listen for custom events)
    document.addEventListener('cartUpdated', updateFloatingCartButton);
    
    // Also update periodically (every 2 seconds) to catch changes from other tabs
    setInterval(updateFloatingCartButton, 2000);
});
</script>

