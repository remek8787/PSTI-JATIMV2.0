document.addEventListener('click', (event) => {
  const btn = event.target.closest('[data-nav-toggle]');
  if (!btn) return;
  const nav = document.querySelector('[data-nav]');
  if (nav) nav.classList.toggle('open');
});


// PWA service worker registration
if ('serviceWorker' in navigator) {
  window.addEventListener('load', () => {
    const swUrl = new URL('sw.js', window.location.href).href;
    navigator.serviceWorker.register(swUrl).catch(() => null);
  });
}

// Lightweight PWA install prompt
let deferredPstiInstallPrompt = null;
window.addEventListener('beforeinstallprompt', (event) => {
  event.preventDefault();
  deferredPstiInstallPrompt = event;
  const toast = document.querySelector('[data-install-toast]');
  if (toast && !localStorage.getItem('psti-install-dismissed')) toast.hidden = false;
});
document.addEventListener('click', async (event) => {
  if (event.target.closest('[data-install-close]')) {
    localStorage.setItem('psti-install-dismissed', '1');
    const toast = document.querySelector('[data-install-toast]');
    if (toast) toast.hidden = true;
  }
  if (event.target.closest('[data-install-accept]') && deferredPstiInstallPrompt) {
    deferredPstiInstallPrompt.prompt();
    await deferredPstiInstallPrompt.userChoice.catch(() => null);
    deferredPstiInstallPrompt = null;
    const toast = document.querySelector('[data-install-toast]');
    if (toast) toast.hidden = true;
  }
});
