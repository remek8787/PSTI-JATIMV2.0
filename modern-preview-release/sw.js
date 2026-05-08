const CACHE_NAME = 'psti-jatim-pwa-v1';
const APP_SHELL = [
  './',
  './blog.php',
  './tracer-atlet.php',
  './tracer-pelatih.php',
  './anggota.php',
  './kompetisi.php',
  './agenda-jadwal.php',
  './galeri.php',
  './assets/css/style.css?v=20260508',
  './assets/js/main.js?v=20260508',
  './assets/logo.png'
];
self.addEventListener('install', event => {
  event.waitUntil(caches.open(CACHE_NAME).then(cache => cache.addAll(APP_SHELL)).catch(() => null));
  self.skipWaiting();
});
self.addEventListener('activate', event => {
  event.waitUntil(caches.keys().then(keys => Promise.all(keys.filter(k => k !== CACHE_NAME).map(k => caches.delete(k)))));
  self.clients.claim();
});
self.addEventListener('fetch', event => {
  if (event.request.method !== 'GET') return;
  event.respondWith(fetch(event.request).then(response => {
    const copy = response.clone();
    caches.open(CACHE_NAME).then(cache => cache.put(event.request, copy)).catch(() => null);
    return response;
  }).catch(() => caches.match(event.request).then(cached => cached || caches.match('./'))));
});
