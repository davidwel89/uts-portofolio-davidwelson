document.addEventListener('DOMContentLoaded', () => {
    // 1. MENU OVERLAY TOGGLE
    const burgerBtn = document.getElementById('burgerBtn');
    const menuOverlay = document.getElementById('menuOverlay');

    const toggleMenu = (forceState) => {
        const isOpen = typeof forceState === 'boolean'
            ? document.body.classList.toggle('menu-open', forceState)
            : document.body.classList.toggle('menu-open');
        if (burgerBtn) burgerBtn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        if (menuOverlay) menuOverlay.setAttribute('aria-hidden', isOpen ? 'false' : 'true');
    };

    if (burgerBtn) {
        burgerBtn.addEventListener('click', () => toggleMenu());
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && document.body.classList.contains('menu-open')) {
            toggleMenu(false);
        }
    });

    // 2. ASSET HYDRATION
    const hydrateSectionAssets = (sectionEl, includeIframe = false) => {
        if (!sectionEl) return;
        sectionEl.querySelectorAll('img[data-src]').forEach((img) => {
            if (img.dataset.src) {
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
            }
        });

        if (includeIframe) {
            sectionEl.querySelectorAll('iframe[data-src]').forEach((frame) => {
                if (frame.dataset.src && !frame.getAttribute('src')) {
                    frame.setAttribute('src', frame.dataset.src);
                }
            });
        }
    };

    const hydrateAllImages = () => {
        document.querySelectorAll('img[data-src]').forEach((img) => {
            if (img.dataset.src) {
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
            }
        });
    };

    ['wheel', 'touchstart', 'pointerdown', 'keydown'].forEach((evt) => {
        window.addEventListener(evt, hydrateAllImages, { once: true, passive: true });
    });

    // 3. FULLPAGE ENGINE (Hanya aktif jika bodi memiliki kelas .fullpage-deck)
    const isFullpageDeck = document.body.classList.contains('fullpage-deck');
    const sectionList = isFullpageDeck ? Array.from(document.querySelectorAll('#home, #about, #projects, #achievements, #contact')) : [];
    const sideIcons = document.querySelectorAll('.side-icon-link');
    let currentSectionIndex = 0;
    let isGliding = false;
    let lastScrollTriggerTime = 0;
    let glideRafId = null;

    if (sectionList.length > 0 && 'scrollRestoration' in history) {
        history.scrollRestoration = 'manual';
    }

    const easeInOutQuart = (t) => (t < 0.5 ? 8 * t * t * t * t : 1 - Math.pow(-2 * t + 2, 4) / 2);

    const saveCurrentSectionToStorage = (sectionId) => {
        if (!sectionId) return;
        const normalizedHash = sectionId.startsWith('#') ? sectionId : `#${sectionId}`;
        try {
            sessionStorage.setItem('alvaLastSection', normalizedHash);
        } catch (e) {}
    };

    const setActiveSection = (index, updateUrlHash = true, isUserNavigation = false) => {
        if (index < 0 || index >= sectionList.length) return;
        currentSectionIndex = index;
        const activeSec = sectionList[index];
        const sectionId = activeSec.id;

        // Simpan seksi aktif ke sessionStorage setiap kali slide aktif berubah
        saveCurrentSectionToStorage(sectionId);

        hydrateSectionAssets(activeSec, isUserNavigation && sectionId === 'projects');

        sectionList.forEach((sec, idx) => {
            sec.classList.toggle('section-active', idx === index);
        });

        sideIcons.forEach((icon) => {
            icon.classList.toggle('active', icon.dataset.section === sectionId);
        });

        if (updateUrlHash && window.location.hash !== `#${sectionId}`) {
            history.replaceState(null, '', `#${sectionId}`);
        }
    };

    const syncScrollPosition = () => {
        if (sectionList.length === 0) return;
        const activeEl = sectionList[currentSectionIndex];
        if (!activeEl) return;

        if (glideRafId) {
            window.cancelAnimationFrame(glideRafId);
            glideRafId = null;
        }
        isGliding = false;
        window.scrollTo(0, activeEl.offsetTop);
    };

    if (isFullpageDeck) {
        window.addEventListener('resize', syncScrollPosition, { passive: true });
        window.addEventListener('orientationchange', syncScrollPosition, { passive: true });
    }

    const glideToIndex = (targetIndex, duration = 700) => {
        if (targetIndex < 0 || targetIndex >= sectionList.length) return;
        if (glideRafId) window.cancelAnimationFrame(glideRafId);

        isGliding = true;
        document.body.classList.add('js-scroll-ready');
        hydrateAllImages();

        const targetEl = sectionList[targetIndex];
        setActiveSection(targetIndex, true, true);

        const startY = window.scrollY;
        const targetY = targetEl.offsetTop;
        const distance = targetY - startY;
        let startTime = null;

        const step = (timestamp) => {
            if (!startTime) startTime = timestamp;
            const elapsed = timestamp - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const eased = easeInOutQuart(progress);

            window.scrollTo(0, startY + distance * eased);

            if (progress < 1) {
                glideRafId = window.requestAnimationFrame(step);
            } else {
                window.scrollTo(0, targetEl.offsetTop);
                glideRafId = null;
                setTimeout(() => { isGliding = false; }, 80);
            }
        };

        glideRafId = window.requestAnimationFrame(step);
    };

    if (isFullpageDeck) {
        window.addEventListener('wheel', (e) => {
            if (document.body.classList.contains('menu-open') || document.body.classList.contains('modal-open')) return;
            e.preventDefault();

            const now = Date.now();
            if (isGliding || now - lastScrollTriggerTime < 750) return;
            if (Math.abs(e.deltaY) < 10) return;

            if (e.deltaY > 0 && currentSectionIndex < sectionList.length - 1) {
                lastScrollTriggerTime = now;
                glideToIndex(currentSectionIndex + 1);
            } else if (e.deltaY < 0 && currentSectionIndex > 0) {
                lastScrollTriggerTime = now;
                glideToIndex(currentSectionIndex - 1);
            } else {
                syncScrollPosition();
            }
        }, { passive: false });

        let touchStartY = 0;
        let touchStartX = 0;

        window.addEventListener('touchstart', (e) => {
            if (!e.touches[0]) return;
            touchStartY = e.touches[0].clientY;
            touchStartX = e.touches[0].clientX;
        }, { passive: true });

        window.addEventListener('touchend', (e) => {
            if (document.body.classList.contains('menu-open') || document.body.classList.contains('modal-open') || !e.changedTouches[0]) return;

            const now = Date.now();
            if (isGliding || now - lastScrollTriggerTime < 700) return;

            const diffY = touchStartY - e.changedTouches[0].clientY;
            const diffX = Math.abs(touchStartX - e.changedTouches[0].clientX);

            if (Math.abs(diffY) > 36 && Math.abs(diffY) > diffX) {
                if (diffY > 0 && currentSectionIndex < sectionList.length - 1) {
                    lastScrollTriggerTime = now;
                    glideToIndex(currentSectionIndex + 1, 650);
                } else if (diffY < 0 && currentSectionIndex > 0) {
                    lastScrollTriggerTime = now;
                    glideToIndex(currentSectionIndex - 1, 650);
                }
            }
        }, { passive: true });
    }

    const internalAnchors = document.querySelectorAll('a[href^="#"]');
    internalAnchors.forEach((anchor) => {
        anchor.addEventListener('click', (e) => {
            const targetHash = anchor.getAttribute('href');
            if (!targetHash || targetHash === '#') return;

            const targetIdx = sectionList.findIndex((s) => `#${s.id}` === targetHash);
            if (targetIdx !== -1) {
                e.preventDefault();
                if (document.body.classList.contains('menu-open')) toggleMenu(false);
                glideToIndex(targetIdx);
            }
        });
    });

    // INISIALISASI SAAT HALAMAN UTAMA DIMUAT & RESTORASI SEKSI TERAKHIR
    if (sectionList.length > 0) {
        const resolveInitialSectionIndex = () => {
            // 1. Cek apakah pengguna baru saja menekan tombol Back dari sub-page
            let targetHash = '';
            try {
                const pendingReturn = sessionStorage.getItem('alvaReturnToSection');
                if (pendingReturn) {
                    targetHash = pendingReturn;
                    sessionStorage.removeItem('alvaReturnToSection');
                }
            } catch (e) {}

            // 2. Jika tidak ada flag khusus, gunakan hash pada URL saat ini
            if (!targetHash && window.location.hash) {
                targetHash = window.location.hash;
            }

            const cleanId = targetHash.replace('#', '');
            if (!cleanId) return 0;

            const foundIdx = sectionList.findIndex((s) => s.id === cleanId);
            return foundIdx !== -1 ? foundIdx : 0;
        };

        const targetStartIdx = resolveInitialSectionIndex();

        const lockToStartSection = () => {
            hydrateAllImages();
            setActiveSection(targetStartIdx, true, true);
            const targetEl = sectionList[targetStartIdx];
            if (targetEl) {
                window.scrollTo(0, targetEl.offsetTop);
                window.requestAnimationFrame(() => {
                    window.scrollTo(0, targetEl.offsetTop);
                });
                setTimeout(() => {
                    window.scrollTo(0, targetEl.offsetTop);
                }, 100);
            }
        };

        lockToStartSection();
        window.addEventListener('load', lockToStartSection, { once: true });
        window.addEventListener('pageshow', (e) => {
            if (e.persisted) lockToStartSection();
        });

        // Pastikan seksi aktif selalu tersimpan tepat ketika pengguna klik link atau submit form keluar dari index.html
        document.addEventListener('click', (e) => {
            const link = e.target.closest('a[href]');
            if (!link) return;
            const href = link.getAttribute('href') || '';
            if (href.includes('profile.php') || href.includes('search.php') || href.includes('kontak.php')) {
                const parentSec = link.closest('.alva-section');
                if (parentSec && parentSec.id) {
                    saveCurrentSectionToStorage(parentSec.id);
                } else if (sectionList[currentSectionIndex]) {
                    saveCurrentSectionToStorage(sectionList[currentSectionIndex].id);
                }
            }
        }, true);

        document.querySelectorAll('form').forEach((formEl) => {
            formEl.addEventListener('submit', () => {
                const parentSec = formEl.closest('.alva-section');
                if (parentSec && parentSec.id) {
                    saveCurrentSectionToStorage(parentSec.id);
                } else if (sectionList[currentSectionIndex]) {
                    saveCurrentSectionToStorage(sectionList[currentSectionIndex].id);
                }
            });
        });

        window.addEventListener('pagehide', () => {
            if (sectionList[currentSectionIndex]) {
                saveCurrentSectionToStorage(sectionList[currentSectionIndex].id);
            }
        });
    }

    // 4. SEARCH INDEXING ENGINE
    const portfolioSearchIndex = [
        { judul: 'Space War — Never Ending Battle (2D Browser Game)', kategori: 'Proyek', tahun: '2026', tags: 'HTML5 Canvas, Vanilla JS, CSS3', keyword: 'Space War' },
        { judul: 'Juara 1 Coding & Robotic Competition (AWS)', kategori: 'Sertifikat', tahun: '2024', tags: 'AWS, Robotics, Coding, Juara 1', keyword: 'AWS' },
        { judul: 'Sertifikat Keahlian Pembuatan Aplikasi dengan Google AppSheet', kategori: 'Sertifikat', tahun: '2024', tags: 'AppSheet, Google Ecosystem, No-Code', keyword: 'AppSheet' },
        { judul: 'Penghargaan Lulusan & Murid Terbaik SMK Rosma', kategori: 'Sertifikat', tahun: '2025', tags: 'Murid Terbaik, SMK Rosma, Akademik', keyword: 'Murid Terbaik' },
        { judul: 'Medali Emas Olimpiade Bahasa Nasional Indonesia (OBNI)', kategori: 'Sertifikat', tahun: '2024', tags: 'OBNI, Medali Emas, Nasional', keyword: 'OBNI' },
        { judul: 'Penghargaan Juara 1 Government Days', kategori: 'Sertifikat', tahun: '2024', tags: 'Government Days, Juara 1, Inovasi', keyword: 'Government Days' },
        { judul: 'Olimpiade Jaringan MikroTik Tingkat Nasional 2024', kategori: 'Sertifikat', tahun: '2024', tags: 'MikroTik, Networking, 2024', keyword: 'MikroTik 2024' },
        { judul: 'Olimpiade Jaringan MikroTik Tingkat Nasional 2023', kategori: 'Sertifikat', tahun: '2023', tags: 'MikroTik, Routing, 2023', keyword: 'MikroTik 2023' },
        { judul: 'Science & Tech Competency (Bagian I & II)', kategori: 'Sertifikat', tahun: '2024', tags: 'Science & Tech, SMK Rosma, Kompetensi', keyword: 'Science' },
        { judul: 'Sertifikat Partisipasi AWS Coding & Robotic', kategori: 'Sertifikat', tahun: '2024', tags: 'AWS, Teamwork, Robotic', keyword: 'Partisipasi AWS' },
        { judul: 'Dokumentasi Kolaborasi Tim Kompetisi AWS', kategori: 'Dokumentasi', tahun: '2024', tags: 'Dokumentasi, Foto Kegiatan, AWS', keyword: 'Dokumentasi' }
    ];

    const searchInputs = document.querySelectorAll('.js-search-index-input');
    searchInputs.forEach((inputEl) => {
        const wrapper = inputEl.closest('.position-relative');
        const dropdown = wrapper ? wrapper.querySelector('.search-index-dropdown') : null;
        const formEl = inputEl.closest('form');
        const categorySelect = formEl ? formEl.querySelector('select[name="kategori"]') : null;

        if (!dropdown) return;

        const renderSuggestions = (queryText) => {
            const cleanQuery = queryText.trim().toLowerCase();
            const activeCat = categorySelect ? categorySelect.value.trim().toLowerCase() : '';

            const matches = portfolioSearchIndex.filter((item) => {
                const matchCat = !activeCat || item.kategori.toLowerCase() === activeCat;
                const combined = `${item.judul} ${item.kategori} ${item.tags} ${item.tahun}`.toLowerCase();
                const matchText = !cleanQuery || combined.includes(cleanQuery);
                return matchCat && matchText;
            }).slice(0, 6);

            if (matches.length === 0) {
                dropdown.innerHTML = `<div class="p-3 text-center small text-contrast-muted">Tidak ditemukan referensi untuk <strong>"${queryText}"</strong></div>`;
                dropdown.classList.add('show');
                return;
            }

            dropdown.innerHTML = matches.map((item) => {
                const targetUrl = `search.php?q=${encodeURIComponent(item.keyword)}&kategori=${encodeURIComponent(item.kategori)}`;
                return `
                    <a href="${targetUrl}" class="search-suggestion-item">
                        <div class="cv-break-text">
                            <span class="search-suggestion-title">${item.judul}</span>
                            <span class="search-suggestion-meta">${item.tags} &bull; ${item.tahun}</span>
                        </div>
                        <span class="search-suggestion-badge">${item.kategori}</span>
                    </a>
                `;
            }).join('');
            dropdown.classList.add('show');
        };

        inputEl.addEventListener('input', (e) => renderSuggestions(e.target.value));
        inputEl.addEventListener('focus', (e) => renderSuggestions(e.target.value));

        document.addEventListener('click', (e) => {
            if (!wrapper.contains(e.target)) dropdown.classList.remove('show');
        });
    });

    const archiveCategorySelect = document.getElementById('categorySelectPage');
    if (archiveCategorySelect) {
        archiveCategorySelect.addEventListener('change', function () {
            if (this.form) this.form.submit();
        });
    }

    // 5. INTERACTIVE SKILL DOMAIN BOXES DI PROFILE.PHP
    const domainBoxes = document.querySelectorAll('.alva-domain-box');
    const techStackPanel = document.getElementById('techStackPanel');
    const stackPills = document.querySelectorAll('#profileTechStackContainer .tech-pill');
    const activeStackLabel = document.getElementById('activeStackLabel');
    const showAllStackBtn = document.getElementById('showAllStackBtn');
    const hideStackBtn = document.getElementById('hideStackBtn');

    const domainTitles = {
        'web-mobile': 'Technology Stack — Web & Mobile Development',
        'google-eco': 'Technology Stack — Google Ecosystem',
        'network-cloud': 'Technology Stack — Network, Cloud & Tools',
        'creative-media': 'Technology Stack — Creative Media'
    };

    let lastSelectedDomain = 'web-mobile';
    let isShowingAllStack = false;

    const resetShowAllButtonStyle = () => {
        if (!showAllStackBtn) return;
        showAllStackBtn.classList.remove('btn-dark', 'text-white');
        showAllStackBtn.classList.add('btn-outline-dark');
        showAllStackBtn.setAttribute('aria-pressed', 'false');
    };

    const activateDomainBox = (domainKey) => {
        isShowingAllStack = false;
        lastSelectedDomain = domainKey;
        resetShowAllButtonStyle();

        domainBoxes.forEach((b) => {
            const isMatch = b.dataset.domain === domainKey;
            b.classList.toggle('active', isMatch);
            b.setAttribute('aria-pressed', isMatch ? 'true' : 'false');
        });

        if (activeStackLabel && domainTitles[domainKey]) {
            activeStackLabel.textContent = domainTitles[domainKey];
        }

        stackPills.forEach((pill) => {
            if (pill.dataset.stack === domainKey) {
                pill.classList.remove('d-none-stack');
            } else {
                pill.classList.add('d-none-stack');
            }
        });

        if (techStackPanel) techStackPanel.classList.remove('d-none');
    };

    const closeTechStackPanel = () => {
        isShowingAllStack = false;
        resetShowAllButtonStyle();
        domainBoxes.forEach((b) => {
            b.classList.remove('active');
            b.setAttribute('aria-pressed', 'false');
        });
        if (techStackPanel) techStackPanel.classList.add('d-none');
        stackPills.forEach((pill) => pill.classList.add('d-none-stack'));
    };

    if (domainBoxes.length > 0 && stackPills.length > 0) {
        domainBoxes.forEach((box) => {
            box.addEventListener('click', () => {
                const isAlreadyActive = box.classList.contains('active') && !isShowingAllStack;
                if (isAlreadyActive) {
                    closeTechStackPanel();
                    return;
                }
                activateDomainBox(box.dataset.domain);
            });
        });

        if (showAllStackBtn) {
            showAllStackBtn.addEventListener('click', () => {
                if (!isShowingAllStack) {
                    isShowingAllStack = true;
                    domainBoxes.forEach((b) => {
                        b.classList.remove('active');
                        b.setAttribute('aria-pressed', 'false');
                    });
                    if (activeStackLabel) activeStackLabel.textContent = 'Technology Stack — All Domains';
                    stackPills.forEach((pill) => pill.classList.remove('d-none-stack'));
                    showAllStackBtn.classList.remove('btn-outline-dark');
                    showAllStackBtn.classList.add('btn-dark', 'text-white');
                    showAllStackBtn.setAttribute('aria-pressed', 'true');
                    if (techStackPanel) techStackPanel.classList.remove('d-none');
                } else {
                    activateDomainBox(lastSelectedDomain || 'web-mobile');
                }
            });
        }

        if (hideStackBtn) {
            hideStackBtn.addEventListener('click', closeTechStackPanel);
        }
    }

    // 6. MODAL PREVIEW GAMBAR
    const modalElement = document.getElementById('imagePreviewModal');
    const previewableImages = document.querySelectorAll('.previewable');
    const previewableDualCards = document.querySelectorAll('.previewable-dual');
    const previewTriggerBtns = document.querySelectorAll('.preview-trigger-btn');

    const openSingleModal = (src, captionText) => {
        if (!modalElement) return;
        const modalBody = modalElement.querySelector('.modal-body');
        if (modalBody) {
            modalBody.innerHTML = `
                <img id="modalPreviewImg" src="${src}" alt="${captionText || 'Pratinjau Dokumen'}" width="700" height="500" class="img-fluid rounded-3 mx-auto d-block">
                <p id="modalPreviewCaption" class="small text-contrast-muted mt-3 mb-0 fw-semibold">${captionText || ''}</p>
            `;
        }
        if (typeof bootstrap !== 'undefined') {
            bootstrap.Modal.getOrCreateInstance(modalElement).show();
        }
    };

    const openDualModal = (imgTopSrc, imgBottomSrc, captionText) => {
        if (!modalElement) return;
        const modalBody = modalElement.querySelector('.modal-body');
        if (modalBody) {
            modalBody.innerHTML = `
                <div class="dual-preview-container d-flex flex-column gap-3 align-items-center text-center w-100">
                    <div class="w-100">
                        <span class="badge text-bg-dark mb-1">Bagian I (Atas)</span>
                        <img src="${imgTopSrc}" alt="Science & Tech Competency Part I" class="img-fluid rounded-3 shadow-sm mx-auto d-block" style="max-height: 42vh; object-fit: contain;">
                    </div>
                    <div class="w-100">
                        <span class="badge text-bg-dark mb-1">Bagian II (Bawah)</span>
                        <img src="${imgBottomSrc}" alt="Science & Tech Competency Part II" class="img-fluid rounded-3 shadow-sm mx-auto d-block" style="max-height: 42vh; object-fit: contain;">
                    </div>
                </div>
                <p id="modalPreviewCaption" class="small text-contrast-muted mt-3 mb-0 fw-semibold">${captionText || ''}</p>
            `;
        }
        if (typeof bootstrap !== 'undefined') {
            bootstrap.Modal.getOrCreateInstance(modalElement).show();
        }
    };

    previewableImages.forEach((img) => {
        img.addEventListener('click', () => {
            openSingleModal(img.getAttribute('data-src') || img.src, img.alt);
        });
    });

    previewableDualCards.forEach((card) => {
        card.addEventListener('click', () => {
            openDualModal(card.dataset.imgTop, card.dataset.imgBottom, card.dataset.caption);
        });
    });

    previewTriggerBtns.forEach((btn) => {
        btn.addEventListener('click', () => openSingleModal(btn.dataset.img, btn.dataset.caption));
    });

    // 7. SMART BACK BUTTON (DI HALAMAN PROFILE.PHP, SEARCH.PHP, KONTAK.PHP)
    if (!isFullpageDeck) {
        let savedHash = '';
        try {
            savedHash = sessionStorage.getItem('alvaLastSection') || '';
        } catch (e) {}

        // Fallback dari referrer jika sessionStorage kosong
        if (!savedHash && document.referrer) {
            try {
                const refUrl = new URL(document.referrer);
                if (refUrl.hash) {
                    savedHash = refUrl.hash;
                    sessionStorage.setItem('alvaLastSection', savedHash);
                }
            } catch (e) {}
        }

        const targetHash = savedHash || '#home';
        const backElements = document.querySelectorAll('.alva-back-chevron, #smartBackBtn, #smartBackBrand, .js-smart-back, a[href="index.html"]');

        backElements.forEach((el) => {
            el.setAttribute('href', `index.html${targetHash}`);
            el.addEventListener('click', (e) => {
                e.preventDefault();
                try {
                    sessionStorage.setItem('alvaReturnToSection', targetHash);
                } catch (err) {}
                window.location.href = `index.html${targetHash}`;
            });
        });
    }
});