<?php
// Daftar data proyek (hanya Space War), sertifikat (termasuk AppSheet), dan dokumentasi David Welson
$daftarPortofolio = [
    [
        'id' => 1,
        'judul' => 'Space War — Never Ending Battle (2D Browser Game)',
        'kategori' => 'Proyek',
        'tahun' => '2026',
        'gambar' => '',
        'url' => 'https://davidwel89.github.io/spacewar/',
        'deskripsi' => 'Gim aksi 2D interaktif berbasis web dengan algoritma peluru bos kustom, kontrol responsif, dan performa 60 FPS menggunakan HTML5, CSS3, dan Vanilla JavaScript.',
        'tags' => ['HTML5 Canvas', 'Vanilla JS', 'CSS3']
    ],
    [
        'id' => 2,
        'judul' => 'Juara 1 Coding & Robotic Competition (AWS)',
        'kategori' => 'Sertifikat',
        'tahun' => '2024',
        'gambar' => 'assets/img/sertifikat-aws-kompetisi.webp',
        'deskripsi' => 'Meraih Juara 1 pada kompetisi pemrograman dan robotika yang diselenggarakan bersama Amazon Web Services (AWS) & Prestasi Junior Indonesia.',
        'tags' => ['AWS', 'Robotics', 'Coding', 'Juara 1']
    ],
    [
        'id' => 3,
        'judul' => 'Sertifikat Keahlian Pembuatan Aplikasi dengan Google AppSheet',
        'kategori' => 'Sertifikat',
        'tahun' => '2024',
        'gambar' => 'assets/img/sertifikat-appsheet.webp',
        'deskripsi' => 'Sertifikat keahlian perancangan dan pembuatan aplikasi sistem informasi terintegrasi menggunakan platform Google AppSheet.',
        'tags' => ['AppSheet', 'Google Ecosystem', 'No-Code', 'Database']
    ],
    [
        'id' => 4,
        'judul' => 'Penghargaan Lulusan & Murid Terbaik SMK Rosma',
        'kategori' => 'Sertifikat',
        'tahun' => '2025',
        'gambar' => 'assets/img/sertifikat-penghargaan-murid-terbaik.webp',
        'deskripsi' => 'Penghargaan lulusan dan murid terbaik atas dedikasi akademik serta capaian kompetensi kejuruan tingkat sekolah.',
        'tags' => ['Murid Terbaik', 'SMK Rosma', 'Akademik']
    ],
    [
        'id' => 5,
        'judul' => 'Medali Emas Olimpiade Bahasa Nasional Indonesia (OBNI)',
        'kategori' => 'Sertifikat',
        'tahun' => '2024',
        'gambar' => 'assets/img/sertifikat-obni.webp',
        'deskripsi' => 'Peraih Medali Emas tingkat nasional pada ajang Olimpiade Bahasa Nasional Indonesia.',
        'tags' => ['OBNI', 'Medali Emas', 'Nasional']
    ],
    [
        'id' => 6,
        'judul' => 'Penghargaan Juara 2 Government Days',
        'kategori' => 'Sertifikat',
        'tahun' => '2024',
        'gambar' => 'assets/img/sertifikat-government-days.webp',
        'deskripsi' => 'Sertifikat penghargaan terbaik kedua pada kompetisi inovasi dan gagasan Government Days.',
        'tags' => ['Government Days', 'Juara 2', 'Inovasi']
    ],
    [
        'id' => 7,
        'judul' => 'Olimpiade Jaringan MikroTik Tingkat Nasional 2024',
        'kategori' => 'Sertifikat',
        'tahun' => '2024',
        'gambar' => 'assets/img/sertifikat-olimpiade-mikrotik-2024.webp',
        'deskripsi' => 'Delegasi peserta kompetisi konfigurasi dan manajemen jaringan MikroTik tingkat nasional tahun 2024.',
        'tags' => ['MikroTik', 'Networking', '2024']
    ],
    [
        'id' => 8,
        'judul' => 'Olimpiade Jaringan MikroTik Tingkat Nasional 2023',
        'kategori' => 'Sertifikat',
        'tahun' => '2023',
        'gambar' => 'assets/img/sertifikat-olimpiade-mikrotik-2023.webp',
        'deskripsi' => 'Peserta ajang Olimpiade Jaringan MikroTik tingkat nasional tahun 2023 mewakili institusi.',
        'tags' => ['MikroTik', 'Routing', '2023']
    ],
    [
        'id' => 9,
        'judul' => 'Science & Tech Competency (Bagian I & II)',
        'kategori' => 'Sertifikat',
        'tahun' => '2024',
        'gambar' => 'assets/img/sertifikat-smk-rosma-1.webp',
        'gambar_kedua' => 'assets/img/sertifikat-smk-rosma-2.webp',
        'deskripsi' => 'Sertifikat pencapaian kompetensi unggulan serta transkrip evaluasi sains dan teknologi terapan di SMK Rosma.',
        'tags' => ['Science & Tech', 'SMK Rosma', 'Kompetensi']
    ],
    [
        'id' => 10,
        'judul' => 'Sertifikat Partisipasi AWS Coding & Robotic',
        'kategori' => 'Sertifikat',
        'tahun' => '2024',
        'gambar' => 'assets/img/sertifikat-aws-appreciation.webp',
        'deskripsi' => 'Sertifikat apresiasi atas partisipasi aktif dalam program AWS Coding and Robotic Competition.',
        'tags' => ['AWS', 'Teamwork', 'Robotic']
    ],
    [
        'id' => 11,
        'judul' => 'Dokumentasi Kolaborasi Tim Kompetisi AWS',
        'kategori' => 'Dokumentasi',
        'tahun' => '2024',
        'gambar' => 'assets/img/foto-kegiatan-aws.webp',
        'deskripsi' => 'Foto dokumentasi bersama rekan tim dan pembimbing sesudah meraih Juara 1 pada ajang AWS Coding & Robotic Competition.',
        'tags' => ['Dokumentasi', 'Foto Kegiatan', 'AWS', 'Teamwork']
    ]
];

function filterPortofolio(array $items, string $keyword = '', string $kategori = ''): array
{
    $hasil = [];
    $keyword = trim($keyword);
    $kategori = trim($kategori);

    foreach ($items as $item) {
        $cocokKategori = ($kategori === '' || strcasecmp($item['kategori'], $kategori) === 0);
        $cocokKeyword = true;
        if ($keyword !== '') {
            $gabunganTeks = $item['judul'] . ' ' . $item['kategori'] . ' ' . $item['deskripsi'] . ' ' . implode(' ', $item['tags']);
            $cocokKeyword = (stripos($gabunganTeks, $keyword) !== false);
        }
        if ($cocokKategori && $cocokKeyword) {
            $hasil[] = $item;
        }
    }
    return $hasil;
}

function paginasiData(array $items, int $halamanAktif = 1, int $perHalaman = 6): array
{
    $totalItem = count($items);
    $totalHalaman = max(1, (int) ceil($totalItem / $perHalaman));
    $halamanAktif = max(1, min($halamanAktif, $totalHalaman));
    $offset = ($halamanAktif - 1) * $perHalaman;

    return [
        'data' => array_slice($items, $offset, $perHalaman),
        'halaman_aktif' => $halamanAktif,
        'total_halaman' => $totalHalaman,
        'total_item' => $totalItem
    ];
}
