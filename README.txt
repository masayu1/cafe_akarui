CAFE AKARUI — FRONTEND + PHP + MYSQL

ISI:
- index.php      : halaman utama Cafe Akarui (sebelumnya HTML, sekarang .php agar pesan error bisa tampil)
- style.css      : desain
- script.js      : interaksi dan pemilihan meja
- booking.php    : validasi dan penyimpanan reservasi dengan PDO prepared statements
- database.sql   : database dan tabel yang perlu diimpor

CARA MEMASANG:
1. Pastikan XAMPP terpasang.
2. Salin folder cafe-akarui-full ke C:\xampp\htdocs\cafe-akarui
   (nama folder tujuan boleh cafe-akarui; pastikan semua file berada di dalamnya).
3. Buka XAMPP Control Panel, klik Start pada Apache dan MySQL.
4. Buka http://localhost/phpmyadmin
5. Klik tab Import, pilih file database.sql, lalu klik Import/Go.
6. Buka http://localhost/cafe-akarui/
7. Isi form booking, pilih meja, lalu klik Konfirmasi Booking.
8. Cek phpMyAdmin > db_cafe_akarui > tabel reservasi untuk melihat data yang tersimpan.

KONFIGURASI:
- booking.php menggunakan host localhost, database db_cafe_akarui, user root, password kosong.
- Jika MySQL Anda menggunakan password, ubah nilai $pass di booking.php.
- Jangan jalankan dengan membuka file secara langsung (file:///...). Gunakan alamat localhost.

CATATAN PENTING:
- Ini adalah versi belajar/lokal. Pastikan tanggal, kapasitas meja, dan aturan durasi booking
  disesuaikan dengan kebutuhan cafe.
- Pengecekan bentrok memakai transaksi dan penguncian baris meja. Untuk trafik tinggi/multi-server,
  gunakan strategi penguncian dan constraint database yang lebih kuat.
- Akun admin belum dibuat; tabel admin hanya disiapkan untuk tahap dashboard selanjutnya.
- Untuk produksi, tambahkan CSRF protection, rate limiting, kebijakan privasi, validasi waktu operasional,
  serta proses konfirmasi oleh pihak cafe.
