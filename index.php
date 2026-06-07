<?php
// Determine guest name from URL parameter 'to'
$guestName = isset($_GET['to']) ? htmlspecialchars(trim($_GET['to'])) : '';

// Read wishes from database JSON file
$wishesFile = __DIR__ . '/data/wishes.json';
$wishes = [];
if (file_exists($wishesFile)) {
    $wishes = json_decode(file_get_contents($wishesFile), true) ?: [];
}

// Wedding date for countdown (Format: Month Day, Year Hour:Minute:Second)
$weddingDate = 'June 26, 2026 09:00:00';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Undangan Pernikahan Vino & Sisca</title>
  <meta name="description" content="Undangan Pernikahan Vino & Sisca - Jumat, 26 Juni 2026">
  
  <!-- CSS Stylesheet -->
  <link rel="stylesheet" href="assets/css/style.css?v=1.1">
</head>
<body class="scroll-locked">

  <!-- ================= WELCOME SCREEN ================= -->
  <div id="welcome-screen">
    <div class="welcome-header">
      <p>The Wedding of</p>
      <h1 class="welcome-couple">Vino & Sisca</h1>
    </div>

    <div class="welcome-center">
      <?php if (!empty($guestName)): ?>
      <div class="welcome-guest">
        <span>Kepada Yth. Bapak/Ibu/Saudara/i:</span>
        <h3><?php echo $guestName; ?></h3>
        <p style="font-size: 0.75rem; color: rgba(255, 255, 255, 0.8); margin-top: 10px; font-style: italic;">
          *Mohon maaf apabila ada kesalahan penulisan nama/gelar
        </p>
      </div>
      <?php else: ?>
      <div class="welcome-guest" style="padding: 20px;">
        <p style="font-size: 0.95rem; font-style: italic; color: #f5f2eb; line-height: 1.6; margin: 0; font-family: var(--font-sans);">
          Tanpa Mengurangi Rasa Hormat, Kami Mengundang Bapak/Ibu/Saudara/i untuk Hadir di Acara Kami.
        </p>
      </div>
      <?php endif; ?>
      
      <button id="btn-open" class="btn-open">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
        Buka Undangan
      </button>
    </div>
    
    <div class="welcome-footer">
      <p style="font-size: 0.8rem; letter-spacing: 1px;">KAMI MENGUNDANG ANDA UNTUK BERBAGI KEBAHAGIAAN</p>
    </div>
  </div>

  <!-- ================= BACKGROUND AUDIO ================= -->
  <!-- Beautiful romantic piano royalty free track -->
  <audio id="bg-audio" loop>
    <source src="assets/audio/wedding-bgm.mp3" type="audio/mpeg">
    Browser Anda tidak mendukung elemen audio.
  </audio>

  <!-- FLOATING MUSIC BUTTON -->
  <button id="music-control" class="music-control" aria-label="Toggle Music">
    <svg viewBox="0 0 24 24">
      <path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/>
    </svg>
  </button>

  <!-- ================= MAIN WEB WRAPPER ================= -->
  <main>
    
    <!-- SECTION 1: HERO / BANNER -->
    <section id="hero">
      <div class="hero-bg-container">
        <img class="hero-image" src="assets/images/img_8548.jpg" alt="Vino & Sisca Wedding Cover">
        <!-- SVG wave decoration for a elegant look -->
        <svg class="hero-wave" viewBox="0 0 1440 320" preserveAspectRatio="none">
          <path d="M0,160L80,176C160,192,320,224,480,218.7C640,213,800,171,960,165.3C1120,160,1280,192,1360,208L1440,224L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path>
        </svg>
      </div>
      
      <div class="hero-content">
        <span class="hero-subtitle">Walimatul 'Ursy</span>
        <h2 class="hero-title">Vino & Sisca</h2>
        <p class="hero-invite-text">
          Dengan penuh rasa hormat dan syukur, kami mengundang Anda untuk menghadiri Tasyakuran pernikahan kami.
        </p>
        
        <span class="hero-date">26 . 06 . 2026</span>
        
        <!-- COUNTDOWN TIMER -->
        <div class="countdown-section" id="countdown-timer" data-date="<?php echo $weddingDate; ?>">
          <div class="countdown-item">
            <div id="days" class="countdown-number">00</div>
            <div class="countdown-label">Hari</div>
          </div>
          <div class="countdown-item">
            <div id="hours" class="countdown-number">00</div>
            <div class="countdown-label">Jam</div>
          </div>
          <div class="countdown-item">
            <div id="minutes" class="countdown-number">00</div>
            <div class="countdown-label">Menit</div>
          </div>
          <div class="countdown-item">
            <div id="seconds" class="countdown-number">00</div>
            <div class="countdown-label">Detik</div>
          </div>
        </div>
      </div>
    </section>

    <!-- SECTION 2: DATA DIRI PASANGAN -->
    <section id="couples" class="reveal">
      <div class="section-title">Mempelai</div>
      <div class="section-subtitle">The Happy Couple</div>
      <div class="section-divider">
        <svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
      </div>
      
      <p class="text-center" style="font-size: 0.85rem; color: var(--color-text-muted); margin-bottom: 30px; font-style: italic; padding: 0 15px;">
        "Maha suci Allah yang telah menciptakan mahluk-Nya berpasang-pasangan. Ya Allah semoga Engkau meridhoi pernikahan kami."
      </p>

      <div class="couple-container">
        <!-- Mempelai Pria -->
        <div class="couple-card">
          <div class="couple-photo-wrapper">
            <img class="couple-photo" src="assets/images/biru_cowo.jpg" alt="Groom Photo">
          </div>
          <h3 class="couple-name">Alvino Rian Siregar</h3>
          <p class="couple-fullname">Vino</p>
          <p class="couple-parents">
            Anak putra pertama dari pasangan <br>
            <strong>Bapak Sidik Purnomo</strong> <br>
            & <strong>Ibu Catur Esti Wibawati (almh)</strong>
          </p>
        </div>

        <div class="couple-divider">&</div>

        <!-- Mempelai Wanita -->
        <div class="couple-card">
          <div class="couple-photo-wrapper">
            <img class="couple-photo" src="assets/images/biru_cewe.jpg" alt="Bride Photo">
          </div>
          <h3 class="couple-name">Princessa Sisca Maharani</h3>
          <p class="couple-fullname">Sisca</p>
          <p class="couple-parents">
            Anak putri pertama dari pasangan <br>
            <strong>Bapak Suyanto</strong> <br>
            & <strong>Ibu Eny Rahayu</strong>
          </p>
        </div>
      </div>
    </section>

    <!-- SECTION 2.5: CERITA CINTA (LOVE STORY) -->
    <section id="story" class="reveal">
      <div class="section-title">Cerita Cinta</div>
      <div class="section-subtitle">Our Love Story</div>
      <div class="section-divider">
        <svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
      </div>

      <div class="timeline">
        <div class="timeline-item">
          <div class="timeline-dot"></div>
          <div class="timeline-image-wrapper" style="width: 100%; height: 200px; overflow: hidden; border-radius: 12px; margin-bottom: 12px; border: 1px solid rgba(184, 146, 106, 0.15);">
            <img class="timeline-image" src="assets/images/ls2.jpeg" alt="Awal Bertemu" style="width: 100%; height: 100%; object-fit: cover;">
          </div>
          <div class="timeline-content">
            <h3>Awal Bertemu</h3>
            <p>Pertemuan pertama kami bermula dari sebuah ketidaksengajaan di Yogyakarta. Dari sekadar sapaan biasa, tumbuh ketertarikan yang mendalam di antara kami berdua.</p>
          </div>
        </div>

        <div class="timeline-item">
          <div class="timeline-dot"></div>
          <div class="timeline-image-wrapper" style="width: 100%; height: 200px; overflow: hidden; border-radius: 12px; margin-bottom: 12px; border: 1px solid rgba(184, 146, 106, 0.15);">
            <img class="timeline-image" src="assets/images/ls1.jpeg" alt="Lamaran" style="width: 100%; height: 100%; object-fit: cover;">
          </div>
          <div class="timeline-content">
            <h3>Lamaran</h3>
            <p>Di hadapan keluarga besar, kami mengikat janji suci pertama kami dalam ikatan lamaran yang hangat dan penuh khidmat, bersiap menuju gerbang pernikahan.</p>
          </div>
        </div>

        <div class="timeline-item">
          <div class="timeline-dot"></div>
          <div class="timeline-image-wrapper" style="width: 100%; height: 200px; overflow: hidden; border-radius: 12px; margin-bottom: 12px; border: 1px solid rgba(184, 146, 106, 0.15);">
            <img class="timeline-image" src="assets/images/img_8620.jpg" alt="Menikah" style="width: 100%; height: 100%; object-fit: cover;">
          </div>
          <div class="timeline-content">
            <h3>Menikah</h3>
            <p>Langkah awal kehidupan baru kami akan dimulai di hari pernikahan ini. Hari di mana dua hati disatukan dalam janji suci selamanya.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- SECTION 3: TANGGAL DAN LOKASI -->
    <section id="event" class="reveal">
      <div class="section-title">Acara</div>
      <div class="section-subtitle">Date & Location</div>
      <div class="section-divider">
        <svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
      </div>

      <p class="event-intro">
        Dengan memohon rahmat Allah SWT, kami bermaksud menyelenggarakan acara akad dan tasyakuran pernikahan kami pada:
      </p>

      <!-- Akad Nikah -->
      <div class="event-card">
        <div class="event-card-header">Akad Nikah</div>
        <div class="event-details">
          <div class="event-detail-item">
            <div class="event-icon-box">
              <svg viewBox="0 0 24 24"><path d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm2-7h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11z"/></svg>
            </div>
            <div class="event-info-text">
              <h4>Hari / Tanggal</h4>
              <p>Jumat, 26 Juni 2026</p>
            </div>
          </div>
          <div class="event-detail-item">
            <div class="event-icon-box">
              <svg viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/></svg>
            </div>
            <div class="event-info-text">
              <h4>Waktu</h4>
              <p>09:00 WIB - Selesai</p>
            </div>
          </div>
          <div class="event-detail-item">
            <div class="event-icon-box">
              <svg viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
            </div>
            <div class="event-info-text">
              <h4>Tempat</h4>
              <p>KUA Mantrijeron, Yogyakarta</p>
            </div>
          </div>
        </div>
        
        <!-- Google Maps Button Akad -->
        <a href="https://www.google.com/maps/search/KUA+Mantrijeron+Yogyakarta" target="_blank" class="btn-action">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="3 6 9 3 15 6 21 3 21 18 15 21 9 18 3 21"></polygon><line x1="9" y1="3" x2="9" y2="18"></line><line x1="15" y1="6" x2="15" y2="21"></line></svg>
          Petunjuk Lokasi (Google Maps)
        </a>
      </div>

      <!-- Tasyakuran Nikah -->
      <div class="event-card">
        <div class="event-card-header">Tasyakuran Pernikahan</div>
        <div class="event-details">
          <div class="event-detail-item">
            <div class="event-icon-box">
              <svg viewBox="0 0 24 24"><path d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm2-7h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11z"/></svg>
            </div>
            <div class="event-info-text">
              <h4>Hari / Tanggal</h4>
              <p>Jumat, 26 Juni 2026</p>
            </div>
          </div>
          <div class="event-detail-item">
            <div class="event-icon-box">
              <svg viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/></svg>
            </div>
            <div class="event-info-text">
              <h4>Waktu</h4>
              <p>13:00 - 15:00 WIB</p>
            </div>
          </div>
          <div class="event-detail-item">
            <div class="event-icon-box">
              <svg viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
            </div>
            <div class="event-info-text">
              <h4>Tempat</h4>
              <p>Zukaria Resto Pleret, Jl. Pleret Km 2, Potorono, Banguntapan, Bantul, Yogyakarta</p>
            </div>
          </div>
        </div>
        
        <!-- Google Maps Button -->
        <a href="https://www.google.com/maps/search/Zukaria+Resto+Pleret+Bantul" target="_blank" class="btn-action">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="3 6 9 3 15 6 21 3 21 18 15 21 9 18 3 21"></polygon><line x1="9" y1="3" x2="9" y2="18"></line><line x1="15" y1="6" x2="15" y2="21"></line></svg>
          Petunjuk Lokasi (Google Maps)
        </a>
        
        <!-- Google Calendar "Add Event" -->
        <a href="https://calendar.google.com/calendar/render?action=TEMPLATE&text=Pernikahan+Vino+dan+Sisca&dates=20260626T020000Z/20260626T080000Z&details=Selamat+datang+di+pernikahan+kami&location=Zukaria+Resto+Pleret,+Bantul" target="_blank" class="btn-action btn-secondary">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
          Simpan Tanggal ke Kalender
        </a>

        <!-- Custom Maps Iframe for high fidelity UI -->
        <div class="map-embed">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.5694200673415!2d110.41018867440409!3d-7.83531479217833!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a57a55ec2fcfd%3A0x6bde355ce0e8a716!2sZukaria%20Resto%20(Kedung%20Bumbu)!5e0!3m2!1sid!2sid!4v1716901234567!5m2!1sid!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </section>



    <!-- EXTRA VALUE ADD: DIGITAL GIFT / WEDDING ENVELOPE -->
    <section id="gift" class="reveal">
      <div class="section-title">Kado Digital</div>
      <div class="section-subtitle">Wedding Gift</div>
      <div class="section-divider">
        <svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
      </div>

      <p class="gift-text">
        Doa restu Anda adalah karunia terindah bagi kami. Namun, apabila Anda ingin memberikan tanda kasih berupa kado digital, Anda dapat mentransfer melalui rekening berikut:
      </p>

      <!-- Bank Card 1 -->
      <div class="gift-card">
        <div class="bank-logo bank-bni">BNI</div>
        <div class="bank-number" id="bni-num">2060547414</div>
        <div class="bank-owner">a.n Alvino Rian Siregar</div>
        <button class="btn-copy" data-copy="2060547414">
          <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
          Salin Rekening
        </button>
      </div>

      <!-- Bank Card 2 -->
      <div class="gift-card">
        <div class="bank-logo bank-bca">BCA</div>
        <div class="bank-number" id="bca-num">0374799254</div>
        <div class="bank-owner">a.n Princessa Sisca Maharani</div>
        <button class="btn-copy" data-copy="0374799254">
          <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
          Salin Rekening
        </button>
      </div>

      <!-- Gift Address -->
      <div class="gift-card">
        <div style="font-weight: 600; margin-bottom: 8px; color: var(--color-primary-dark);">Kirim Kado Fisik</div>
        <p style="font-size: 0.85rem; color: var(--color-text-main); margin-bottom: 12px;">
          jl. Bawuran II, Bawuran, Kec. Pleret, Kabupaten Bantul, Daerah Istimewa Yogyakarta 55791 (U.P. Sisca)
        </p>
        <button class="btn-copy" data-copy="jl. Bawuran II, Bawuran, Kec. Pleret, Kabupaten Bantul, Daerah Istimewa Yogyakarta 55791 (U.P. Sisca)">
          <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
          Salin Alamat
        </button>
      </div>
    </section>

    <!-- SECTION 5: GALLERY -->
    <section id="gallery" class="reveal">
      <div class="section-title">Galeri</div>
      <div class="section-subtitle">Our Love Story</div>
      <div class="section-divider">
        <svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
      </div>

      <div class="gallery-grid">
        <!-- Gallery Item 1 -->
        <div class="gallery-item">
          <img class="gallery-image" src="assets/images/img_8555.jpg" alt="Prewedding 1">
          <div class="gallery-overlay"></div>
        </div>
        <!-- Gallery Item 2 -->
        <div class="gallery-item">
          <img class="gallery-image" src="assets/images/img_8556.jpg" alt="Prewedding 2">
          <div class="gallery-overlay"></div>
        </div>
        <!-- Gallery Item 3 -->
        <div class="gallery-item">
          <img class="gallery-image" src="assets/images/img_8600.jpg" alt="Prewedding 3">
          <div class="gallery-overlay"></div>
        </div>
        <!-- Gallery Item 4 -->
        <div class="gallery-item">
          <img class="gallery-image" src="assets/images/img_8577.jpg" alt="Prewedding 4">
          <div class="gallery-overlay"></div>
        </div>
        <!-- Gallery Item 5 -->
        <div class="gallery-item">
          <img class="gallery-image" src="assets/images/img_8579.jpg" alt="Prewedding 5">
          <div class="gallery-overlay"></div>
        </div>
        <!-- Gallery Item 6 -->
        <div class="gallery-item">
          <img class="gallery-image" src="assets/images/img_8575.jpg" alt="Prewedding 6">
          <div class="gallery-overlay"></div>
        </div>
      </div>
    </section>

    <!-- LIGHTBOX MODAL -->
    <div id="lightbox">
      <div class="lightbox-content">
        <button class="lightbox-close">&times;</button>
        <img class="lightbox-image" src="" alt="Lightbox Zoom">
      </div>
    </div>

    <!-- SECTION 6: RSVP & WISHES (BUKU TAMU) -->
    <section id="rsvp-wishes" class="reveal">
      <div class="section-title">Konfirmasi & Ucapan</div>
      <div class="section-subtitle">RSVP & Guestbook</div>
      <div class="section-divider">
        <svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
      </div>

      <div class="rsvp-form-container">
        <form id="rsvp-form" action="ajax.php" method="POST">
          <!-- Hidden default name input dynamically loaded, can be changed -->
          <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Ketik nama Anda di sini" value="<?php echo $guestName; ?>" required>
          </div>

          <div class="form-group">
            <label>Konfirmasi Kehadiran</label>
            <div class="form-radio-group">
              <label class="radio-container">
                <input type="radio" name="attendance" value="hadir" checked>
                <span class="radio-btn">Saya Hadir</span>
              </label>
              <label class="radio-container">
                <input type="radio" name="attendance" value="tidak_hadir">
                <span class="radio-btn">Maaf, Tidak Hadir</span>
              </label>
            </div>
          </div>

          <div class="form-group">
            <label for="guests">Jumlah Tamu</label>
            <select id="guests" name="guests" class="form-control">
              <option value="1">1 Orang</option>
              <option value="2">2 Orang</option>
              <option value="3">3 Orang</option>
              <option value="4">4 Orang</option>
            </select>
          </div>

          <div class="form-group">
            <label for="wish">Ucapan & Doa Restu</label>
            <textarea id="wish" name="wish" class="form-control" placeholder="Tulis ucapan selamat dan doa restu Anda..." required></textarea>
          </div>

          <button type="submit" class="btn-action">Kirim Ucapan / RSVP</button>
        </form>
      </div>

      <!-- Guest wishes scroll wall -->
      <div class="wishes-wall-container">
        <div class="wishes-header">
          <span>Ucapan Hangat</span>
          <span class="wishes-count"><?php echo count($wishes); ?></span>
        </div>
        
        <div class="wishes-list">
          <?php if (empty($wishes)): ?>
            <p class="text-center" style="font-size: 0.85rem; color: var(--color-text-muted); padding: 20px;">Belum ada ucapan. Jadilah yang pertama memberikan doa restu!</p>
          <?php else: ?>
            <?php foreach ($wishes as $item): ?>
              <?php 
                $isHadir = (isset($item['status']) && $item['status'] === 'Hadir');
                $statusClass = $isHadir ? 'status-hadir' : 'status-tidak';
                $statusText = $isHadir ? 'Hadir' : 'Tidak Hadir';
              ?>
              <div class="wish-item">
                <div class="wish-item-header">
                  <span class="wish-sender"><?php echo htmlspecialchars($item['name']); ?></span>
                  <span class="wish-status <?php echo $statusClass; ?>"><?php echo $statusText; ?></span>
                </div>
                <p class="wish-text"><?php echo htmlspecialchars($item['wish']); ?></p>
                <div class="wish-time"><?php echo htmlspecialchars($item['timestamp']); ?></div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <!-- ================= FOOTER ================= -->
    <footer>
      <div class="footer-couple">Vino & Sisca</div>
      <p style="font-style: italic; margin-bottom: 10px;">Sampai jumpa di hari bahagia kami</p>
      <p>&copy; 2026 Vino & Sisca. All Rights Reserved.</p>
      <div class="watermark">
        Dibuat dengan cinta untuk menyatukan hati
      </div>
    </footer>

  </main>

  <!-- Floating toast notifications for copies -->
  <div id="copied-toast" class="copied-toast">Salin ke papan klip berhasil!</div>

  <!-- JavaScript Behavior File -->
  <script src="assets/js/script.js"></script>
</body>
</html>
