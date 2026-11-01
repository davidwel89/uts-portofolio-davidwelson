<?php
if (!isset($judulHalaman)) {
    $judulHalaman = 'David Welson — Portfolio';
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portofolio resmi David Welson — Mahasiswa S1 Teknik Informatika STMIK Rosma Karawang, Full Stack Developer, dan Ketua Umum Rosma Publication.">
    <title><?php echo htmlspecialchars($judulHalaman, ENT_QUOTES, 'UTF-8'); ?></title>

    <!-- Preconnect Domain Eksternal (Tanpa Crossorigin pada jsDelivr agar CSS Langsung Terhubung) -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Preload Gambar LCP untuk Halaman Profil -->
    <link rel="preload" as="image" href="assets/img/foto-david.webp" type="image/webp" fetchpriority="high">

    <!-- Bootstrap 5.3 CSS Resmi & Custom Alvalens Style (Sinkron untuk Mencegah Layout Shift / CLS = 0) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css">

    <!-- Non-Blocking Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Jost:wght@400;500;600;700&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <noscript>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Jost:wght@400;500;600;700&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
    </noscript>
</head>

<body class="d-flex flex-column min-vh-100">