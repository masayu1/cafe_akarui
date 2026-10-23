<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cafe Akarui | Reservasi Meja</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header class="navbar">
    <a class="brand" href="#home"><span class="brand-mark">A</span><span>akarui<small>COFFEE & SLOW LIVING</small></span></a>
    <button class="menu-toggle" id="menuToggle" aria-label="Buka menu">☰</button>
    <nav id="navLinks">
      <a href="#home">Beranda</a><a href="#about">Tentang</a><a href="#menu">Menu</a>
      <a class="nav-book" href="#booking">Reservasi Meja ↗</a>
    </nav>
  </header>

  <main>
    <section class="hero" id="home">
      <div class="hero-content">
        <p class="eyebrow"><span></span> YOUR LITTLE PLACE TO SLOW DOWN</p>
        <h1>Temukan jeda,<br><em>di Cafe Akarui.</em></h1>
        <p class="hero-description">Secangkir kopi, suasana hangat, dan waktu yang terasa lebih pelan. Kami menyiapkan tempat untuk cerita terbaikmu.</p>
        <div class="hero-actions"><a class="button button-dark" href="#booking">Booking Meja <span>↗</span></a><a class="text-link" href="#menu">Jelajahi menu ↓</a></div>
        <div class="hero-note"><span class="note-icon">✳</span><span><strong>A little pause, a better day.</strong><small>Tempat nyaman untuk setiap momen.</small></span></div>
      </div>
      <div class="hero-visual">
        <img src="https://images.unsplash.com/photo-1442512595331-e89e73853f31?auto=format&fit=crop&w=1200&q=85" alt="Suasana kopi di Cafe Akarui">
        <div class="image-label"><span>✦</span><div><strong>Warm moments</strong><small>Made fresh, made for you</small></div></div>
        <div class="vertical-label">COFFEE · CONNECTION · COMFORT</div>
      </div>
    </section>

    <section class="intro-strip" id="about">
      <p>GOOD COFFEE, GOOD COMPANY.</p><span>✳</span>
      <p>Ruang kecil untuk momen besar.</p><span>✳</span>
      <p>STAY A LITTLE LONGER.</p>
    </section>

    <section class="section menu-section" id="menu">
      <div class="section-heading"><div><p class="eyebrow">A TASTE OF AKARUI</p><h2>Favorit untuk<br><em>menemani harimu.</em></h2></div><p class="heading-side">Dibuat dengan bahan pilihan, disajikan dengan sepenuh hati.</p></div>
      <div class="menu-grid">
        <article class="menu-card"><img src="https://images.unsplash.com/photo-1461023058943-07fcbe16d735?auto=format&fit=crop&w=700&q=80" alt="Iced latte"><div><h3>Akarui Iced Latte</h3><p>Espresso, susu creamy, dan sentuhan manis.</p><strong>Rp28.000</strong></div></article>
        <article class="menu-card"><img src="https://images.unsplash.com/photo-1517701604599-bb29b565090c?auto=format&fit=crop&w=700&q=80" alt="Kopi hitam"><div><h3>Slow Drip Coffee</h3><p>Kopi pilihan dengan karakter rasa yang lembut.</p><strong>Rp24.000</strong></div></article>
        <article class="menu-card"><img src="https://images.unsplash.com/photo-1509365465985-25d11c17e812?auto=format&fit=crop&w=700&q=80" alt="Pastry"><div><h3>Butter Croissant</h3><p>Pastry renyah untuk teman minum kopi.</p><strong>Rp22.000</strong></div></article>
      </div>
    </section>

    <section class="booking-section" id="booking">
      <div class="booking-intro">
        <p class="eyebrow"><span></span> SAVE YOUR SEAT</p>
        <h2>Mejamu sudah<br><em>menunggu.</em></h2>
        <p>Isi detail reservasi di samping dan biarkan kami menyiapkan tempat terbaik untukmu.</p>
        <div class="booking-perk"><span>01</span><div><strong>Pilih waktu yang nyaman</strong><small>Atur tanggal dan jam kedatanganmu.</small></div></div>
        <div class="booking-perk"><span>02</span><div><strong>Tentukan tempat duduk</strong><small>Pilih meja sesuai jumlah pengunjung.</small></div></div>
        <div class="booking-perk"><span>03</span><div><strong>Konfirmasi reservasi</strong><small>Simpan kode booking setelah selesai.</small></div></div>
      </div>
      <div class="booking-card">
        <div class="form-heading"><div><p class="eyebrow">AKARUI RESERVATION</p><h3>Booking meja</h3></div><span class="step-pill">1 / 2</span></div>
        <form id="bookingForm" action="booking.php" method="POST">
          <div class="field-row">
            <label>Nama lengkap<input id="customerName" name="nama" type="text" placeholder="Nama kamu" required minlength="2"></label>
            <label>Nomor WhatsApp<input id="customerPhone" name="no_whatsapp" type="tel" placeholder="08xxxxxxxxxx" required pattern="[0-9+ -]{9,16}"></label>
          </div>
          <div class="field-row">
            <label>Tanggal reservasi<input id="bookingDate" name="tanggal" type="date" required></label>
            <label>Jam kedatangan<select id="bookingTime" name="jam" required><option value="">Pilih jam</option><option>10:00</option><option>11:00</option><option>12:00</option><option>13:00</option><option>14:00</option><option>15:00</option><option>16:00</option><option>17:00</option><option>18:00</option><option>19:00</option><option>20:00</option></select></label>
          </div>
          <label>Jumlah pengunjung<select id="guestCount" name="jumlah_orang" required><option value="">Pilih jumlah orang</option><option value="1">1 orang</option><option value="2">2 orang</option><option value="3">3 orang</option><option value="4">4 orang</option><option value="5">5 orang</option><option value="6">6 orang</option></select></label>
          <div class="table-title"><span>Pilih meja</span><small id="tableHint">Pilih sesuai kebutuhanmu</small></div>
          <input type="hidden" id="tableId" name="id_meja" required><div class="table-options" id="tableOptions">
            <button type="button" class="table-option" data-table="A1" data-id="1" data-seats="2"><span class="table-icon">▦</span><strong>Meja A1</strong><small>2 orang</small></button>
            <button type="button" class="table-option" data-table="A2" data-id="2" data-seats="2"><span class="table-icon">▦</span><strong>Meja A2</strong><small>2 orang</small></button>
            <button type="button" class="table-option" data-table="B1" data-id="3" data-seats="4"><span class="table-icon">▦</span><strong>Meja B1</strong><small>4 orang</small></button>
            <button type="button" class="table-option" data-table="B2" data-id="4" data-seats="4"><span class="table-icon">▦</span><strong>Meja B2</strong><small>4 orang</small></button>
            <button type="button" class="table-option" data-table="C1" data-id="5" data-seats="6"><span class="table-icon">▦</span><strong>Meja C1</strong><small>6 orang</small></button>
          </div>
          <label>Catatan tambahan <span class="optional">(opsional)</span><textarea id="bookingNote" name="catatan" rows="2" placeholder="Contoh: meja dekat jendela"></textarea></label>
          <p class="form-error" id="formError" role="alert"></p>
          <button class="button button-dark submit-button" type="submit">Konfirmasi Booking <span>↗</span></button>
          <p class="privacy-note">Dengan melanjutkan, kamu menyetujui detail reservasi di atas.</p>
        </form>
        <div class="success-panel" id="successPanel" hidden>
          <div class="success-icon">✓</div><p class="eyebrow">RESERVASI TERCATAT</p><h3>Terima kasih!</h3>
          <p>Reservasi kamu berhasil diproses.</p>
          <div class="confirmation-details" id="confirmationDetails"></div>
          <p class="demo-note">Simpan kode booking ini. Konfirmasi akhir tetap mengikuti kebijakan Cafe Akarui.</p>
          <button type="button" class="button button-dark submit-button" id="newBooking">Buat reservasi baru</button>
        </div>
      </div>
    </section>

    <section class="visit-section">
      <div><p class="eyebrow">WE'LL SAVE YOU A SEAT</p><h2>Ketemu di <em>Akarui, ya.</em></h2></div><a class="button button-light" href="#booking">Reservasi sekarang ↗</a>
    </section>
  
    <?php if (isset($_GET["error"])): ?>
      <div class="server-message error-message"><?php echo htmlspecialchars($_GET["error"], ENT_QUOTES, "UTF-8"); ?></div>
    <?php endif; ?>
</main>
  <footer><a class="brand footer-brand" href="#home"><span class="brand-mark">A</span><span>akarui<small>COFFEE & SLOW LIVING</small></span></a><p>© 2026 Cafe Akarui. Made for slow moments.</p><a href="#home">Kembali ke atas ↑</a></footer>
  <script src="script.js"></script>
</body>
</html>
