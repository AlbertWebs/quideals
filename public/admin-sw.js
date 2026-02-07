// Admin Panel Service Worker
const CACHE_NAME = 'admin-panel-v1';
const urlsToCache = [
  '/admin',
  '/admin/dashboard',
  '/admin/products',
  '/admin/categories',
  '/admin/brands',
  '/admin/orders',
  '/admin/login',
  '/css/app.css',
  '/js/app.js'
];

// Install event - cache resources
self.addEventListener('install', function(event) {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(function(cache) {
        console.log('Admin PWA: Opened cache');
        return cache.addAll(urlsToCache);
      })
      .catch(function(error) {
        console.log('Admin PWA: Cache failed', error);
      })
  );
  self.skipWaiting();
});

// Activate event - clean up old caches
self.addEventListener('activate', function(event) {
  event.waitUntil(
    caches.keys().then(function(cacheNames) {
      return Promise.all(
        cacheNames.map(function(cacheName) {
          if (cacheName !== CACHE_NAME) {
            console.log('Admin PWA: Deleting old cache', cacheName);
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
  return self.clients.claim();
});

// Fetch event - serve from cache, fallback to network
self.addEventListener('fetch', function(event) {
  // Only cache GET requests
  if (event.request.method !== 'GET') {
    return;
  }

  // Skip caching for API requests and form submissions
  if (event.request.url.includes('/api/') || 
      event.request.url.includes('_token') ||
      event.request.url.includes('csrf')) {
    return;
  }

  event.respondWith(
    caches.match(event.request)
      .then(function(response) {
        // Return cached version or fetch from network
        return response || fetch(event.request).then(function(response) {
          // Don't cache if not a valid response
          if (!response || response.status !== 200 || response.type !== 'basic') {
            return response;
          }

          // Clone the response
          const responseToCache = response.clone();

          caches.open(CACHE_NAME)
            .then(function(cache) {
              cache.put(event.request, responseToCache);
            });

          return response;
        });
      })
      .catch(function(error) {
        console.log('Admin PWA: Fetch failed', error);
        // Return offline page if available
        return caches.match('/admin');
      })
  );
});

// Background sync for offline actions (optional)
self.addEventListener('sync', function(event) {
  if (event.tag === 'sync-forms') {
    event.waitUntil(syncOfflineForms());
  }
});

function syncOfflineForms() {
  // Implement offline form sync logic here
  return Promise.resolve();
}

// Push notifications (optional)
self.addEventListener('push', function(event) {
  const options = {
    body: event.data ? event.data.text() : 'New update available',
    icon: '/images/icon-192x192.png',
    badge: '/images/icon-96x96.png',
    vibrate: [200, 100, 200],
    tag: 'admin-notification'
  };

  event.waitUntil(
    self.registration.showNotification('Admin Panel', options)
  );
});

// Notification click handler
self.addEventListener('notificationclick', function(event) {
  event.notification.close();
  event.waitUntil(
    clients.openWindow('/admin')
  );
});
