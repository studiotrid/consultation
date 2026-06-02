const CACHE_NAME = 'consultation-shell-v1';

self.addEventListener('install', event => {
  // Activate immediately to ensure the page is controlled and install prompt can appear
  self.skipWaiting();
});

self.addEventListener('activate', event => {
  event.waitUntil(self.clients.claim());
});

self.addEventListener('fetch', event => {
  // Passthrough fetch; fallback to cache if available (no pre-cache defined)
  if (event.request.method !== 'GET') {
    return;
  }
  event.respondWith(
    fetch(event.request).catch(() => caches.match(event.request))
  );
});
