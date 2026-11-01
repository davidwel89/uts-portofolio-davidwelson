<?php
$judulHalaman = 'My Profile — David Welson';
require_once 'includes/header.php';
require_once 'includes/nav.php';
?>

<main class="flex-grow-1" style="padding-top: 86px;">
    <div id="content" class="container py-4 py-lg-5">
        <article class="cv-profile-wrapper mx-auto">

            <!-- HEADER PROFIL & FOTO DIRI (TANPA TOMBOL KEMBALI) -->
            <div class="p-3 p-sm-4 p-md-5 rounded-4 bg-white border shadow-sm mb-4">
                <div class="d-flex flex-column flex-md-row align-items-center align-items-md-start gap-3 gap-md-4">
                    <div class="cv-photo-box flex-shrink-0">
                        <img src="assets/img/foto-david.webp" alt="Foto Profil David Welson" width="165" height="198" fetchpriority="high" class="alva-grayscale-img previewable">
                    </div>
                    <div class="flex-grow-1 text-center text-md-start cv-break-text">
                        <p class="alva-eyebrow mb-1">MY PROFILE</p>
                        <h1 class="alva-section-title mb-2">David Welson</h1>
                        <p class="fw-bold text-dark mb-2 mb-md-3">
                            Full Stack Web Developer &bull; Mobile App Enthusiast &bull; Chairman of Rosma Publication
                        </p>
                        <p class="text-contrast-muted small mb-3 mb-md-4">
                            Mahasiswa S1 Teknik Informatika di STMIK Rosma Karawang dan lulusan terbaik tingkat sekolah kejuruan (SMK Rosma) dengan fokus pada pengembangan aplikasi web modern, aplikasi Android berbasis Kotlin, ekosistem kerja Google, manajemen jaringan MikroTik, produksi media kreatif, serta kompetisi Esports.
                        </p>

                        <div class="d-flex flex-wrap justify-content-center justify-content-md-start gap-2">
                            <a href="index.html#projects" class="btn-alva-primary py-2 px-4 small">Lihat Karya</a>
                            <a href="kontak.php" class="btn-alva-outline py-2 px-4 small">Hubungi Saya</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- GRID IDENTITAS DIRI & RIWAYAT PENDIDIKAN -->
            <div class="row g-3 g-md-4 mb-4">
                <div class="col-12 col-lg-5">
                    <div class="p-3 p-sm-4 rounded-4 bg-white border shadow-sm h-100 cv-break-text">
                        <h2 class="h5 fw-bold text-dark mb-3">Identitas &amp; Informasi Kontak</h2>
                        <div class="d-flex flex-column gap-3 small">
                            <div class="border-bottom pb-2">
                                <span class="text-contrast-muted d-block">Nama Lengkap</span>
                                <strong class="text-dark">David Welson</strong>
                            </div>
                            <div class="border-bottom pb-2">
                                <span class="text-contrast-muted d-block">Domisili</span>
                                <strong class="text-dark">Karawang, Jawa Barat, Indonesia</strong>
                            </div>
                            <div class="border-bottom pb-2">
                                <span class="text-contrast-muted d-block">Perguruan Tinggi &amp; Program Studi</span>
                                <strong class="text-dark">STMIK Rosma &mdash; S1 Teknik Informatika</strong>
                            </div>
                            <div class="border-bottom pb-2">
                                <span class="text-contrast-muted d-block">Peran Organisasi</span>
                                <strong class="text-dark">Ketua Umum Rosma Publication (2025/2026)</strong>
                            </div>
                            <div class="border-bottom pb-2">
                                <span class="text-contrast-muted d-block">Email</span>
                                <a href="mailto:davidwelson0910@gmail.com" class="fw-bold text-dark text-decoration-underline">davidwelson0910@gmail.com</a>
                            </div>
                            <div>
                                <span class="text-contrast-muted d-block">Tautan Portofolio &amp; Jejaring</span>
                                <div class="d-flex flex-wrap gap-2 mt-1">
                                    <a href="https://github.com/davidwel89" target="_blank" rel="noopener noreferrer" class="mini-tag text-decoration-none">github.com/davidwel89 &#8599;</a>
                                    <a href="https://www.linkedin.com/in/david-welson-142a9b294" target="_blank" rel="noopener noreferrer" class="mini-tag text-decoration-none">LinkedIn Profile &#8599;</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-7">
                    <div class="p-3 p-sm-4 rounded-4 bg-white border shadow-sm h-100 cv-break-text">
                        <h2 class="h5 fw-bold text-dark mb-3">Riwayat Pendidikan</h2>
                        <div class="d-flex flex-column gap-3">
                            <div class="timeline-compact">
                                <span class="timeline-meta">2025 &mdash; Sekarang</span>
                                <h3 class="h6 fw-bold text-dark mb-1">STMIK Rosma Karawang</h3>
                                <p class="small text-dark fw-semibold mb-1">S1 Teknik Informatika (Informatics Engineering)</p>
                                <p class="small text-contrast-muted mb-0">
                                    Sedang mendalami pengembangan aplikasi web (HTML, CSS, JS, PHP), pengembangan aplikasi Mobile Android (Kotlin) dan Basis Data
                                </p>
                            </div>

                            <div class="timeline-compact">
                                <span class="timeline-meta">Lulusan / Murid Terbaik</span>
                                <h3 class="h6 fw-bold text-dark mb-1">SMK Rosma Karawang</h3>
                                <p class="small text-dark fw-semibold mb-1">Teknik Komputer dan Jaringan</p>
                                <p class="small text-contrast-muted mb-0">
                                    Meraih penghargaan lulusan dan murid terbaik tingkat sekolah kejuruan, serta aktif mewakili institusi pada Olimpiade Jaringan MikroTik Tingkat Nasional (2023 &amp; 2024) dan kompetisi robotika AWS.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PENGALAMAN ORGANISASI & KEPEMIMPINAN -->
            <div class="p-3 p-sm-4 rounded-4 bg-white border shadow-sm mb-4 cv-break-text">
                <h2 class="h5 fw-bold text-dark mb-3">Pengalaman Organisasi &amp; Kepemimpinan</h2>
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <div class="timeline-compact h-100">
                            <span class="timeline-meta">2025 / 2026 &bull; STMIK Rosma</span>
                            <h3 class="h6 fw-bold text-dark mb-1">Ketua Umum — Rosma Publication</h3>
                            <p class="small text-contrast-muted mb-0">
                                Merumuskan dan mempresentasikan rencana kerja tahunan organisasi media kampus, menginisiasi produksi konten video pendek &amp; panjang, menyelenggarakan seminar <em>Game of Attention</em>, workshop penyuntingan video <em>CapCut</em>, serta memimpin pelaksanaan <em>Pelatihan Multimedia Rosma Publication</em>.
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="timeline-compact h-100">
                            <span class="timeline-meta">2026 &bull; Rosma Cup Vol. 1</span>
                            <h3 class="h6 fw-bold text-dark mb-1">Divisi Desain Grafis, Media &amp; Livestream — 2026 Rosma Cup Vol. 1</h3>
                            <p class="small text-contrast-muted mb-0">
                                Merancang grafik pembaruan skor langsung (<em>live score updates</em>), templat hasil akhir pertandingan, dan identitas cetak untuk cabang turnamen futsal, bola basket, serta bola voli, sekaligus melakukan Livestream di akun Instagram resmi kampus.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SKILLS & EXPERTISE INTERAKTIF -->
            <div class="p-3 p-sm-4 p-md-5 rounded-4 bg-white border shadow-sm mb-4 cv-break-text">
                <div class="text-center mb-4">
                    <p class="alva-eyebrow mb-1">SKILLS &amp; EXPERTISE</p>
                    <h2 class="h4 fw-bold text-dark mb-1">Technical Domains &amp; Tools</h2>
                    <p class="small text-contrast-muted mb-0">
                        Klik pada salah satu kotak kategori di bawah ini untuk menampilkan <em>Technology Stack</em> yang saya gunakan.
                    </p>
                </div>

                <div class="row g-2 g-sm-3" id="alvaSkillDomainBoxes">
                    <div class="col-6 col-lg-3">
                        <button type="button" class="alva-domain-box w-100 text-start" data-domain="web-mobile" aria-pressed="false">
                            <div class="domain-box-icon mb-2">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="16 18 22 12 16 6"></polyline>
                                    <polyline points="8 6 2 12 8 18"></polyline>
                                </svg>
                            </div>
                            <h3 class="domain-box-title fw-bold mb-1">Web &amp; Mobile Development</h3>
                            <p class="domain-box-desc mb-0 opacity-75">Frontend, backend PHP &amp; Kotlin Android</p>
                        </button>
                    </div>

                    <div class="col-6 col-lg-3">
                        <button type="button" class="alva-domain-box w-100 text-start" data-domain="google-eco" aria-pressed="false">
                            <div class="domain-box-icon mb-2">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="14" width="7" height="7"></rect>
                                    <rect x="3" y="14" width="7" height="7"></rect>
                                </svg>
                            </div>
                            <h3 class="domain-box-title fw-bold mb-1">Google Ecosystem</h3>
                            <p class="domain-box-desc mb-0 opacity-75">AppSheet, Workspace &amp; Apps Script</p>
                        </button>
                    </div>

                    <div class="col-6 col-lg-3">
                        <button type="button" class="alva-domain-box w-100 text-start" data-domain="network-cloud" aria-pressed="false">
                            <div class="domain-box-icon mb-2">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect>
                                    <rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect>
                                    <line x1="6" y1="6" x2="6.01" y2="6"></line>
                                    <line x1="6" y1="18" x2="6.01" y2="18"></line>
                                </svg>
                            </div>
                            <h3 class="domain-box-title fw-bold mb-1">Network, Cloud &amp; Tools</h3>
                            <p class="domain-box-desc mb-0 opacity-75">MikroTik RouterOS, AWS &amp; Dev tools</p>
                        </button>
                    </div>

                    <div class="col-6 col-lg-3">
                        <button type="button" class="alva-domain-box w-100 text-start" data-domain="creative-media" aria-pressed="false">
                            <div class="domain-box-icon mb-2">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polygon points="23 7 16 12 23 17 23 7"></polygon>
                                    <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
                                </svg>
                            </div>
                            <h3 class="domain-box-title fw-bold mb-1">Creative Media</h3>
                            <p class="domain-box-desc mb-0 opacity-75">Canva, Adobe Photoshop &amp; CapCut</p>
                        </button>
                    </div>
                </div>

                <div class="p-3 p-sm-4 rounded-4 bg-light border text-center mt-4 d-none" id="techStackPanel">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3 pb-2 border-bottom">
                        <strong class="small text-dark text-uppercase text-start" id="activeStackLabel" style="letter-spacing: 0.06em;">Technology Stack</strong>
                        <div class="d-flex gap-2 ms-auto">
                            <button type="button" class="btn btn-sm btn-outline-dark py-1 px-3 rounded-pill fw-semibold" id="showAllStackBtn" aria-pressed="false" style="font-size: 0.75rem;">Show All Stack</button>
                            <button type="button" class="btn btn-sm btn-dark py-1 px-3 rounded-pill fw-semibold" id="hideStackBtn" style="font-size: 0.75rem;">Tutup</button>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap justify-content-center gap-2" id="profileTechStackContainer">
                        <span class="tech-pill d-none-stack" data-stack="web-mobile">HTML5 Semantik</span>
                        <span class="tech-pill d-none-stack" data-stack="web-mobile">CSS3 Flexbox</span>
                        <span class="tech-pill d-none-stack" data-stack="web-mobile">Vanilla JavaScript</span>
                        <span class="tech-pill d-none-stack" data-stack="web-mobile">PHP Dasar</span>
                        <span class="tech-pill d-none-stack" data-stack="web-mobile">Bootstrap 5</span>
                        <span class="tech-pill d-none-stack" data-stack="web-mobile">Kotlin Android</span>

                        <span class="tech-pill d-none-stack" data-stack="google-eco">Google AppSheet</span>
                        <span class="tech-pill d-none-stack" data-stack="google-eco">Google Docs</span>
                        <span class="tech-pill d-none-stack" data-stack="google-eco">Google Spreadsheet</span>
                        <span class="tech-pill d-none-stack" data-stack="google-eco">Google Keep</span>
                        <span class="tech-pill d-none-stack" data-stack="google-eco">Google Slide</span>
                        <span class="tech-pill d-none-stack" data-stack="google-eco">Google Apps Script</span>

                        <span class="tech-pill d-none-stack" data-stack="network-cloud">MikroTik RouterOS</span>
                        <span class="tech-pill d-none-stack" data-stack="network-cloud">AWS Cloud &amp; Robotics</span>
                        <span class="tech-pill d-none-stack" data-stack="network-cloud">Git &amp; GitHub Pages</span>
                        <span class="tech-pill d-none-stack" data-stack="network-cloud">Vercel Deployment</span>
                        <span class="tech-pill d-none-stack" data-stack="network-cloud">Windows 11 Atlas OS</span>
                        <span class="tech-pill d-none-stack" data-stack="network-cloud">Android Studio</span>

                        <span class="tech-pill d-none-stack" data-stack="creative-media">Canva</span>
                        <span class="tech-pill d-none-stack" data-stack="creative-media">Adobe Photoshop</span>
                        <span class="tech-pill d-none-stack" data-stack="creative-media">CapCut</span>
                    </div>
                </div>
            </div>

            <!-- SEKSI KHUSUS ESPORTS & COMPETITIVE ACHIEVEMENTS -->
            <div class="p-3 p-sm-4 p-md-5 rounded-4 bg-white border shadow-sm mb-5 cv-break-text">
                <div class="mb-4">
                    <p class="alva-eyebrow mb-1">COMPETITIVE ESPORTS</p>
                    <h2 class="h4 fw-bold text-dark mb-1">Esports Achievements &amp; Tournaments</h2>
                    <p class="small text-contrast-muted mb-0">
                        Rekam jejak prestasi kompetitif selama berkompetisi di Mobile Legends: Bang Bang (MLBB) baik yang Non-Official dan Official by Moonton, serta Honor of Kings (HOK).
                    </p>
                </div>

                <div class="row g-3 g-md-4">
                    <div class="col-12 col-lg-6">
                        <div class="p-3 p-sm-4 rounded-4 bg-light border h-100">
                            <span class="badge text-bg-dark mb-2">Mobile Legends: Bang Bang</span>
                            <h3 class="h6 fw-bold text-dark mb-3">Non-Official by Moonton:</h3>
                            <ul class="list-unstyled d-flex flex-column gap-2 small mb-0">
                                <li class="p-2 rounded-3 bg-white border">🥈#2 IDOY ORGANIZER S119</li>
                                <li class="p-2 rounded-3 bg-white border">🏆#1 FT SPARKCON ORGANIZER</li>
                                <li class="p-2 rounded-3 bg-white border">🥈#2 DG ORGANIZER S15, 14 Jan 2026</li>
                                <li class="p-2 rounded-3 bg-white border">🥈#2 Liga SILENT CROW, 16 Jun s.d 12 Jul 2025</li>
                                <li class="p-2 rounded-3 bg-white border">🥈#2 Tur Online AMS ESPORT, 20 s.d 21 Jun 2025</li>
                                <li class="p-2 rounded-3 bg-white border">🏆#1 FT Hey You Organizer S6, 19 Jun 2025</li>
                                <li class="p-2 rounded-3 bg-white border">🥉#3 FT Hey You Organizer S6, 11 Jun 2025</li>
                                <li class="p-2 rounded-3 bg-white border">🏆#1 MCL Training Tour S3, 2 Mar 2025</li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6 d-flex flex-column gap-3 gap-md-4">
                        <div class="p-3 p-sm-4 rounded-4 bg-light border">
                            <span class="badge text-bg-dark mb-2">Mobile Legends: Bang Bang</span>
                            <h3 class="h6 fw-bold text-dark mb-3">Official by Moonton:</h3>
                            <ul class="list-unstyled d-flex flex-column gap-2 small mb-0">
                                <li class="p-2 rounded-3 bg-white border">
                                    🎟️ Participate on Group Stage Gopay Games Community League Tournament MPL S15, 2 s.d 25 Mei 2025 (mewakili SONIC COMMUNITY)
                                </li>
                                <li class="p-2 rounded-3 bg-white border">
                                    🎗️#16 Garuda Esport Series by RevivalTV, 29 Apr s.d 1 Mei 2025
                                </li>
                                <li class="p-2 rounded-3 bg-white border">
                                    🥉#3 SCS Sonic Community Series, 24 Apr 2025
                                </li>
                            </ul>
                        </div>

                        <div class="p-3 p-sm-4 rounded-4 bg-light border flex-grow-1">
                            <span class="badge text-bg-dark mb-2">Honor of Kings</span>
                            <h3 class="h6 fw-bold text-dark mb-3">Achievements:</h3>
                            <ul class="list-unstyled d-flex flex-column gap-2 small mb-0">
                                <li class="p-2 rounded-3 bg-white border">
                                    TOP 4 FT BEC HOK S1, 30 Sep 2026
                                </li>
                                <li class="p-2 rounded-3 bg-white border">
                                    🥉#3 FT ONL KINGS PROJECT S2, 26 Sep 2026
                                </li>
                                <li class="p-2 rounded-3 bg-white border">
                                    TOP 4 Hok Ace Sulawesi Utara Glory Arena S1, 9 Mei 2026
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BOTTOM CTA PERSIS ALVALENS ("Want something like this? Get In Touch ➔") -->
            <section class="alva-bottom-cta text-center py-5 my-3" aria-label="Call to Action Contact">
                <p class="alva-cta-subtitle mb-2">Want something like this?</p>
                <a href="index.html#contact" class="alva-cta-heading d-inline-flex align-items-center justify-content-center gap-3 text-decoration-none">
                    <span>Get In Touch</span>
                    <span class="alva-cta-arrow-circle" aria-hidden="true">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </span>
                </a>
            </section>

        </article>
    </div>
</main>

<?php require_once 'includes/footer.php'; ?>