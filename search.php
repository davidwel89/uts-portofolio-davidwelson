<?php
require_once 'includes/data.php';

$keyword  = isset($_GET['q']) ? trim($_GET['q']) : '';
$kategori = isset($_GET['kategori']) ? trim($_GET['kategori']) : '';
$halaman  = isset($_GET['page']) ? (int) $_GET['page'] : 1;

$hasilFilter = filterPortofolio($daftarPortofolio, $keyword, $kategori);
$paginasi = paginasiData($hasilFilter, $halaman, 6);
$itemTampil = $paginasi['data'];

$judulHalaman = 'Archive — David Welson';
require_once 'includes/header.php';
require_once 'includes/nav.php';
?>

<main class="flex-grow-1" style="padding-top: 86px; min-height: 100vh;">
    <div id="content" class="container py-4 py-lg-5">
        <article class="cv-break-text">
            <div class="mb-4">
                <p class="alva-eyebrow mb-1">PORTFOLIO ARCHIVE</p>
                <h1 class="alva-section-title">Projects, Achievements &amp; Documentation</h1>
                <div class="alva-double-bar mb-3">
                    <span class="bar-main"></span>
                    <span class="bar-sub"></span>
                </div>
                <p class="alva-lead mb-4">
                    Jelajahi arsip proyek pengembangan perangkat lunak, sertifikat penghargaan, serta dokumentasi kegiatan.
                </p>

                <!-- Search Bar -->
                <div class="position-relative">
                    <form action="search.php" method="GET" id="archiveSearchForm" class="p-2.5 rounded-4 bg-white border shadow-sm" autocomplete="off">
                        <div class="d-flex flex-column gap-2">
                            <div class="d-flex align-items-center px-2 py-1 bg-light rounded-3 border">
                                <svg class="text-dark me-2 flex-shrink-0" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                                <label for="searchInputPage" class="visually-hidden">Kata kunci pencarian</label>
                                <input type="text" id="searchInputPage" name="q" value="<?php echo htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8'); ?>" class="form-control border-0 shadow-none p-0 bg-transparent text-dark js-search-index-input" placeholder="Ketik kata kunci (mis: Space War, AppSheet)...">
                            </div>

                            <div class="d-flex align-items-center gap-2">
                                <label for="categorySelectPage" class="visually-hidden">Filter Kategori</label>
                                <select id="categorySelectPage" name="kategori" class="form-select border-0 bg-light text-dark rounded-3 px-3 py-2 small fw-semibold flex-grow-1">
                                    <option value="">All Categories</option>
                                    <option value="Proyek" <?php echo (strcasecmp($kategori, 'Proyek') === 0) ? 'selected' : ''; ?>>Projects</option>
                                    <option value="Sertifikat" <?php echo (strcasecmp($kategori, 'Sertifikat') === 0) ? 'selected' : ''; ?>>Achievements</option>
                                    <option value="Dokumentasi" <?php echo (strcasecmp($kategori, 'Dokumentasi') === 0) ? 'selected' : ''; ?>>Dokumentasi</option>
                                </select>

                                <button type="submit" class="btn-alva-primary py-2 px-4 rounded-3 flex-shrink-0">Explore</button>
                                <?php if ($keyword !== '' || $kategori !== ''): ?>
                                    <a href="search.php" class="btn-alva-outline py-2 px-3 rounded-3 flex-shrink-0 d-flex align-items-center justify-content-center">Reset</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </form>
                    <div class="search-index-dropdown shadow-lg rounded-4 bg-white border" id="archiveSearchSuggestions" aria-live="polite"></div>
                </div>
            </div>

            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                <h2 class="h5 fw-bold text-dark mb-0">
                    Showing <?php echo $paginasi['total_item']; ?> <?php echo ($paginasi['total_item'] === 1) ? 'Result' : 'Results'; ?>
                </h2>
                <?php if ($keyword !== '' || $kategori !== ''): ?>
                    <span class="small text-contrast-muted">
                        Filter: <strong>"<?php echo htmlspecialchars($keyword !== '' ? $keyword : 'All', ENT_QUOTES, 'UTF-8'); ?>"</strong>
                        <?php if ($kategori !== ''): ?> &bull; Kategori: <strong><?php echo htmlspecialchars($kategori, ENT_QUOTES, 'UTF-8'); ?></strong><?php endif; ?>
                    </span>
                <?php endif; ?>
            </div>

            <?php if (empty($itemTampil)): ?>
                <div class="p-4 p-md-5 rounded-4 bg-white border text-center my-3">
                    <h3 class="h5 fw-bold text-dark mb-2">No matching works found</h3>
                    <p class="text-contrast-muted small mb-4">
                        Tidak ditemukan data untuk kata kunci <strong>"<?php echo htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8'); ?>"</strong>. Coba gunakan kata kunci seperti <em>Space War</em>, <em>AppSheet</em>, <em>AWS</em>, atau <em>MikroTik</em>.
                    </p>
                    <a href="search.php" class="btn-alva-primary py-2 px-4">Show All Works</a>
                </div>
            <?php else: ?>
                <div class="d-flex flex-column gap-3">
                    <?php foreach ($itemTampil as $item): ?>
                        <div class="archive-card-row d-flex flex-column flex-md-row align-items-stretch align-items-md-center gap-3 p-3 rounded-4 bg-white border shadow-sm cv-break-text" style="min-height: 195px;">
                            <!-- Kontainer Thumbnail dengan Ukuran Terkunci Mutlak (Mencegah Layout Shift) -->
                            <div class="archive-thumb-col overflow-hidden rounded-3" style="width: 100%; min-width: 100%; height: 160px; min-height: 160px; background: #111827; flex-shrink: 0;">
                                <?php if (!empty($item['url']) && empty($item['gambar'])): ?>
                                    <div class="position-relative w-100 h-100">
                                        <img src="assets/img/space-war.webp" alt="<?php echo htmlspecialchars($item['judul'], ENT_QUOTES, 'UTF-8'); ?>" width="260" height="160" decoding="async" class="w-100 h-100 alva-grayscale-img" style="object-fit: cover; display: block;">
                                        <a href="<?php echo htmlspecialchars($item['url'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer" class="lobby-hover-cta" aria-label="Buka dan Mainkan Space War">
                                            <span class="lobby-cta-pill" style="font-size: 0.78rem; padding: 7px 16px;">Mainkan Space War &#8599;</span>
                                        </a>
                                    </div>
                                <?php elseif (!empty($item['gambar_kedua'])): ?>
                                    <div class="previewable-dual h-100 w-100" style="cursor: zoom-in; height: 160px;"
                                        data-img-top="<?php echo htmlspecialchars($item['gambar'], ENT_QUOTES, 'UTF-8'); ?>"
                                        data-img-bottom="<?php echo htmlspecialchars($item['gambar_kedua'], ENT_QUOTES, 'UTF-8'); ?>"
                                        data-caption="<?php echo htmlspecialchars($item['judul'], ENT_QUOTES, 'UTF-8'); ?>">
                                        <img src="<?php echo htmlspecialchars($item['gambar'], ENT_QUOTES, 'UTF-8'); ?>"
                                            alt="<?php echo htmlspecialchars($item['judul'], ENT_QUOTES, 'UTF-8'); ?>"
                                            width="260" height="160" decoding="async"
                                            class="archive-card-img alva-grayscale-img w-100 h-100" style="object-fit: cover; display: block;">
                                    </div>
                                <?php else: ?>
                                    <img src="<?php echo htmlspecialchars($item['gambar'], ENT_QUOTES, 'UTF-8'); ?>"
                                        alt="<?php echo htmlspecialchars($item['judul'], ENT_QUOTES, 'UTF-8'); ?>"
                                        width="260" height="160" decoding="async"
                                        class="archive-card-img alva-grayscale-img previewable w-100 h-100" style="object-fit: cover; display: block;">
                                <?php endif; ?>
                            </div>
                            <div class="flex-grow-1 cv-break-text">
                                <span class="cert-year">
                                    <?php echo htmlspecialchars($item['kategori'] . ' • ' . $item['tahun'], ENT_QUOTES, 'UTF-8'); ?>
                                </span>
                                <h3 class="h5 fw-bold text-dark mb-1"><?php echo htmlspecialchars($item['judul'], ENT_QUOTES, 'UTF-8'); ?></h3>
                                <p class="text-contrast-muted small mb-2"><?php echo htmlspecialchars($item['deskripsi'], ENT_QUOTES, 'UTF-8'); ?></p>
                                <div class="d-flex flex-wrap align-items-center gap-2">
                                    <?php foreach ($item['tags'] as $tag): ?>
                                        <span class="mini-tag"><?php echo htmlspecialchars($tag, ENT_QUOTES, 'UTF-8'); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php if ($paginasi['total_halaman'] > 1): ?>
                    <nav aria-label="Archive Pagination" class="mt-4">
                        <ul class="pagination justify-content-center mb-0">
                            <?php for ($i = 1; $i <= $paginasi['total_halaman']; $i++): ?>
                                <?php
                                $queryUrl = http_build_query([
                                    'q' => $keyword,
                                    'kategori' => $kategori,
                                    'page' => $i
                                ]);
                                ?>
                                <li class="page-item <?php echo ($i === $paginasi['halaman_aktif']) ? 'active' : ''; ?>">
                                    <a class="page-link" href="search.php?<?php echo htmlspecialchars($queryUrl, ENT_QUOTES, 'UTF-8'); ?>">
                                        <?php echo $i; ?>
                                    </a>
                                </li>
                            <?php endfor; ?>
                        </ul>
                    </nav>
                <?php endif; ?>
            <?php endif; ?>
        </article>
    </div>
</main>

<style>
    @media (min-width: 768px) {
        .archive-thumb-col {
            width: 260px !important;
            min-width: 260px !important;
            height: 160px !important;
            min-height: 160px !important;
        }
    }
</style>

<?php require_once 'includes/footer.php'; ?>