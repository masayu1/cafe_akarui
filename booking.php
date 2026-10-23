<?php
declare(strict_types=1);
date_default_timezone_set('Asia/Jakarta');

$host = 'localhost';
$db   = 'db_cafe_akarui';
$user = 'root';
$pass = ''; // Default XAMPP biasanya kosong. Ubah jika MySQL Anda memakai password.

function kembaliDenganError(string $pesan): never {
    header('Location: index.php?error=' . rawurlencode($pesan) . '#booking');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php#booking');
    exit;
}

$nama = trim($_POST['nama'] ?? '');
$wa = trim($_POST['no_whatsapp'] ?? '');
$tanggal = $_POST['tanggal'] ?? '';
$jam = $_POST['jam'] ?? '';
$jumlah = filter_input(INPUT_POST, 'jumlah_orang', FILTER_VALIDATE_INT);
$idMeja = filter_input(INPUT_POST, 'id_meja', FILTER_VALIDATE_INT);
$catatan = trim($_POST['catatan'] ?? '');

if (mb_strlen($nama) < 2 || mb_strlen($nama) > 100) {
    kembaliDenganError('Nama harus terdiri dari 2–100 karakter.');
}
if (!preg_match('/^[0-9+() -]{9,20}$/', $wa)) {
    kembaliDenganError('Nomor WhatsApp tidak valid.');
}
$dateObj = DateTime::createFromFormat('!Y-m-d', $tanggal);
if (!$dateObj || $dateObj->format('Y-m-d') !== $tanggal || $tanggal < date('Y-m-d')) {
    kembaliDenganError('Tanggal reservasi tidak valid atau sudah lewat.');
}
if (!preg_match('/^(10|11|12|13|14|15|16|17|18|19|20):00$/', $jam)) {
    kembaliDenganError('Jam reservasi tidak valid.');
}
if (!$jumlah || $jumlah < 1 || $jumlah > 6 || !$idMeja) {
    kembaliDenganError('Jumlah pengunjung atau pilihan meja tidak valid.');
}

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8mb4",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );

    $pdo->beginTransaction();

    $stmt = $pdo->prepare('SELECT nomor_meja, kapasitas FROM meja WHERE id_meja = ? FOR UPDATE');
    $stmt->execute([$idMeja]);
    $meja = $stmt->fetch();

    if (!$meja || (int)$meja['kapasitas'] < $jumlah) {
        $pdo->rollBack();
        kembaliDenganError('Meja tidak sesuai dengan jumlah pengunjung. Silakan pilih meja lain.');
    }

    // Mencegah dua booking untuk meja dan jam yang sama.
    $stmt = $pdo->prepare(
        "SELECT COUNT(*) FROM reservasi
         WHERE id_meja = ? AND tanggal = ? AND jam = ?
         AND status IN ('Menunggu', 'Dikonfirmasi')"
    );
    $stmt->execute([$idMeja, $tanggal, $jam]);
    if ((int)$stmt->fetchColumn() > 0) {
        $pdo->rollBack();
        kembaliDenganError('Maaf, meja tersebut sudah dipesan pada jam itu. Silakan pilih meja atau jam lain.');
    }

    $stmt = $pdo->prepare('INSERT INTO pelanggan (nama, no_whatsapp) VALUES (?, ?)');
    $stmt->execute([$nama, $wa]);
    $idPelanggan = (int)$pdo->lastInsertId();

    $kode = 'AKR-' . strtoupper(bin2hex(random_bytes(3)));
    $stmt = $pdo->prepare(
        'INSERT INTO reservasi (kode_booking, id_pelanggan, id_meja, tanggal, jam, jumlah_orang, catatan)
         VALUES (?, ?, ?, ?, ?, ?, ?)'
    );
    $stmt->execute([$kode, $idPelanggan, $idMeja, $tanggal, $jam . ':00', $jumlah, $catatan !== '' ? $catatan : null]);

    $pdo->commit();

    $safeNama = htmlspecialchars($nama, ENT_QUOTES, 'UTF-8');
    $safeWa = htmlspecialchars($wa, ENT_QUOTES, 'UTF-8');
    $safeKode = htmlspecialchars($kode, ENT_QUOTES, 'UTF-8');
    $safeMeja = htmlspecialchars($meja['nomor_meja'], ENT_QUOTES, 'UTF-8');
    $safeTanggal = htmlspecialchars($dateObj->format('d-m-Y'), ENT_QUOTES, 'UTF-8');
    $safeJam = htmlspecialchars($jam, ENT_QUOTES, 'UTF-8');
    $safeCatatan = htmlspecialchars($catatan !== '' ? $catatan : 'Tidak ada', ENT_QUOTES, 'UTF-8');

    echo '<!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Booking Berhasil | Cafe Akarui</title><link rel="stylesheet" href="style.css"></head><body>';
    echo '<main class="booking-section" style="min-height:100vh;display:block;padding-top:60px"><section class="booking-card" style="max-width:650px;margin:auto;text-align:center">';
    echo '<div class="success-icon">✓</div><p class="eyebrow">AKARUI RESERVATION</p><h1 style="font-family:Playfair Display,serif;font-weight:500">Booking berhasil!</h1>';
    echo '<p>Terima kasih, ' . $safeNama . '. Data reservasi sudah tersimpan di database.</p>';
    echo '<div class="confirmation-details">';
    $rows = ['Kode booking' => $safeKode, 'Nama' => $safeNama, 'WhatsApp' => $safeWa, 'Tanggal' => $safeTanggal, 'Jam' => $safeJam, 'Jumlah pengunjung' => $jumlah . ' orang', 'Meja' => $safeMeja, 'Catatan' => $safeCatatan, 'Status' => 'Menunggu konfirmasi'];
    foreach ($rows as $label => $value) {
        echo '<div class="detail-row"><span>' . $label . '</span><strong>' . $value . '</strong></div>';
    }
    echo '</div><a class="button button-dark" href="index.php">Kembali ke halaman utama ↗</a></section></main></body></html>';
} catch (Throwable $e) {
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    error_log($e->getMessage());
    kembaliDenganError('Booking belum dapat disimpan. Pastikan MySQL aktif dan database sudah diimpor.');
}
