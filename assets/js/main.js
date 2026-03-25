const menuToggle = document.getElementById('menuToggle');
const mobileMenu = document.getElementById('mobileMenu');
if (menuToggle && mobileMenu) {
  menuToggle.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));
}

const contactForm = document.getElementById('contactForm');
if (contactForm) {
  contactForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const status = document.getElementById('contactStatus');
    const formData = new FormData(contactForm);
    const payload = Object.fromEntries(formData.entries());
    try {
      const res = await fetch('/api/contact.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
      });
      const data = await res.json();
      status.textContent = data.message;
      status.className = 'text-green-600 text-sm mt-3';
      contactForm.reset();
    } catch (err) {
      status.textContent = 'Gagal mengirim pesan.';
      status.className = 'text-red-600 text-sm mt-3';
    }
  });
}
