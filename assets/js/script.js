document.addEventListener('DOMContentLoaded', () => {
  // --- DOM Elements ---
  const body = document.body;
  const welcomeScreen = document.getElementById('welcome-screen');
  const btnOpen = document.getElementById('btn-open');
  const bgAudio = document.getElementById('bg-audio');
  const musicControl = document.getElementById('music-control');
  const lightbox = document.getElementById('lightbox');
  const lightboxImg = lightbox.querySelector('.lightbox-image');
  const lightboxClose = lightbox.querySelector('.lightbox-close');
  const galleryItems = document.querySelectorAll('.gallery-item');
  const rsvpForm = document.getElementById('rsvp-form');
  const wishesList = document.querySelector('.wishes-list');
  const wishesCountEl = document.querySelector('.wishes-count');
  const copyButtons = document.querySelectorAll('.btn-copy');
  const copiedToast = document.getElementById('copied-toast');

  // --- Scroll Lock on Load ---
  body.classList.add('scroll-locked');

  // --- Welcome Screen Logic ---
  if (btnOpen) {
    btnOpen.addEventListener('click', () => {
      // Fade out welcome screen
      welcomeScreen.classList.add('fade-out');
      body.classList.remove('scroll-locked');
      
      // Attempt to play music
      if (bgAudio) {
        bgAudio.play()
          .then(() => {
            musicControl.classList.add('playing');
          })
          .catch(error => {
            console.log('Audio autoplay blocked or failed:', error);
          });
      }

      // Initialize Scroll Reveal after opening
      initScrollReveal();
    });
  }

  // --- Background Music Controls ---
  if (musicControl && bgAudio) {
    musicControl.addEventListener('click', () => {
      if (bgAudio.paused) {
        bgAudio.play();
        musicControl.classList.add('playing');
      } else {
        bgAudio.pause();
        musicControl.classList.remove('playing');
      }
    });
  }

  // --- Countdown Timer ---
  // Set wedding date (dynamic target or fixed)
  const targetDateStr = document.getElementById('countdown-timer')?.dataset.date || 'October 10, 2026 09:00:00';
  const weddingDate = new Date(targetDateStr).getTime();

  function updateCountdown() {
    const now = new Date().getTime();
    const distance = weddingDate - now;

    if (distance < 0) {
      document.getElementById('countdown-timer').innerHTML = '<div class="countdown-item" style="width:100%"><div class="countdown-number" style="font-size:1.3rem;">Acara Sedang / Telah Berlangsung</div></div>';
      return;
    }

    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById('days').innerText = String(days).padStart(2, '0');
    document.getElementById('hours').innerText = String(hours).padStart(2, '0');
    document.getElementById('minutes').innerText = String(minutes).padStart(2, '0');
    document.getElementById('seconds').innerText = String(seconds).padStart(2, '0');
  }

  if (document.getElementById('countdown-timer')) {
    updateCountdown();
    setInterval(updateCountdown, 1000);
  }

  // --- Gallery Lightbox ---
  galleryItems.forEach(item => {
    item.addEventListener('click', () => {
      const imgSrc = item.querySelector('.gallery-image').src;
      lightboxImg.src = imgSrc;
      lightbox.classList.add('active');
    });
  });

  const closeLightbox = () => {
    lightbox.classList.remove('active');
  };

  if (lightboxClose) lightboxClose.addEventListener('click', closeLightbox);
  if (lightbox) {
    lightbox.addEventListener('click', (e) => {
      if (e.target === lightbox || e.target.classList.contains('lightbox-content')) {
        closeLightbox();
      }
    });
  }

  // --- Copy Account/Address Button ---
  copyButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      const textToCopy = btn.getAttribute('data-copy');
      
      navigator.clipboard.writeText(textToCopy).then(() => {
        // Show Toast
        copiedToast.classList.add('show');
        setTimeout(() => {
          copiedToast.classList.remove('show');
        }, 2000);
      }).catch(err => {
        console.error('Failed to copy: ', err);
      });
    });
  });

  // --- RSVP & Wishes Form Handler via AJAX ---
  if (rsvpForm) {
    rsvpForm.addEventListener('submit', (e) => {
      e.preventDefault();
      
      const submitBtn = rsvpForm.querySelector('button[type="submit"]');
      const originalBtnText = submitBtn.innerHTML;
      submitBtn.disabled = true;
      submitBtn.innerHTML = 'Mengirim...';

      const formData = new FormData(rsvpForm);
      
      fetch('ajax.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalBtnText;

        if (data.status === 'success') {
          // Alert user
          alert(data.message || 'Terima kasih atas konfirmasi dan ucapan Anda!');
          
          // Clear wish input
          rsvpForm.querySelector('textarea[name="wish"]').value = '';
          
          // Update wishes list UI
          renderWishes(data.wishes);
        } else {
          alert('Terjadi kesalahan: ' + data.message);
        }
      })
      .catch(error => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalBtnText;
        console.error('Error submitting RSVP:', error);
        alert('Terjadi kesalahan koneksi. Silakan coba lagi.');
      });
    });
  }

  function renderWishes(wishes) {
    if (!wishesList || !wishes) return;
    
    wishesList.innerHTML = '';
    wishesCountEl.innerText = wishes.length;

    wishes.forEach(wish => {
      const item = document.createElement('div');
      item.className = 'wish-item';
      
      const isHadir = wish.status === 'Hadir';
      const statusClass = isHadir ? 'status-hadir' : 'status-tidak';
      const statusText = isHadir ? 'Hadir' : 'Tidak Hadir';

      // Clean variables
      const cleanName = escapeHTML(wish.name);
      const cleanText = escapeHTML(wish.wish);
      
      item.innerHTML = `
        <div class="wish-item-header">
          <span class="wish-sender">${cleanName}</span>
          <span class="wish-status ${statusClass}">${statusText}</span>
        </div>
        <p class="wish-text">${cleanText}</p>
        <div class="wish-time">${wish.timestamp}</div>
      `;
      wishesList.appendChild(item);
    });
  }

  // --- Scroll Reveal Animation ---
  function initScrollReveal() {
    const reveals = document.querySelectorAll('.reveal');
    
    const revealOnScroll = () => {
      for (let i = 0; i < reveals.length; i++) {
        const windowHeight = window.innerHeight;
        const elementTop = reveals[i].getBoundingClientRect().top;
        const elementVisible = 100; // Trigger when element is 100px visible in screen
        
        if (elementTop < windowHeight - elementVisible) {
          reveals[i].classList.add('active');
        }
      }
    };

    window.addEventListener('scroll', revealOnScroll);
    revealOnScroll(); // Trigger initial check
  }

  // Helper function to escape HTML entities
  function escapeHTML(str) {
    return str.replace(/[&<>'"]/g, 
      tag => ({
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        "'": '&#39;',
        '"': '&quot;'
      }[tag] || tag)
    );
  }
});
