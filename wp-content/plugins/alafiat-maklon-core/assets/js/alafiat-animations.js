/**
 * Alafiat Maklon Herbal - CSS-Native Scroll Reveals, Sticky Nav & Contextual Image Detail Modal
 */
(function () {
  'use strict';

  function initScrollAndUiAnimations() {
    var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var header = document.querySelector('.alafiat-wrapper > header');

    // 1. Sticky Desktop Header & Active Section Nav Tracking
    if (header) {
      var updateHeaderScroll = function () {
        header.classList.toggle('is-scrolled', window.scrollY > 24);
      };
      updateHeaderScroll();
      window.addEventListener('scroll', updateHeaderScroll, { passive: true });

      var navLinks = Array.from(header.querySelectorAll('nav a[href^="#"]'));
      var trackedSections = navLinks
        .map(function (link) {
          var id = link.getAttribute('href').slice(1);
          var section = id ? document.getElementById(id) : null;
          return section ? { link: link, section: section } : null;
        })
        .filter(Boolean);

      if (trackedSections.length && 'IntersectionObserver' in window) {
        var visibleSections = new Set();
        var setActiveNav = function () {
          var activeItem = trackedSections.find(function (item) {
            return visibleSections.has(item.section);
          });
          navLinks.forEach(function (link) {
            var isCurrent = activeItem && activeItem.link === link;
            if (isCurrent) {
              link.setAttribute('aria-current', 'true');
            } else {
              link.removeAttribute('aria-current');
            }
          });
        };

        var navObserver = new IntersectionObserver(
          function (entries) {
            entries.forEach(function (entry) {
              if (entry.isIntersecting) {
                visibleSections.add(entry.target);
              } else {
                visibleSections.delete(entry.target);
              }
            });
            setActiveNav();
          },
          { rootMargin: '-22% 0px -58% 0px', threshold: 0 }
        );

        trackedSections.forEach(function (item) {
          navObserver.observe(item.section);
        });
      }
    }

    if (reducedMotion) {
      return;
    }

    // 2. Hero Entrance (CSS keyframes via --alafiat-delay)
    var hero = document.querySelector('#top, [data-alafiat-anchor="top"]');
    if (hero) {
      var heroTargets = [
        hero.querySelector('h1'),
        hero.querySelector(':scope > div:first-child p'),
        hero.querySelector(':scope > div:first-child > div:last-child'),
        hero.querySelector(':scope > div:first-child > div:first-child > div')
      ].filter(Boolean);

      heroTargets.forEach(function (el, idx) {
        el.style.setProperty('--alafiat-delay', String(idx));
        el.classList.add('alafiat-hero-enter');
      });

      var heroImg = hero.querySelector(':scope > div:last-child img');
      if (heroImg) {
        heroImg.classList.add('alafiat-hero-media-enter');
      }
    }

    // 3. Scroll Reveal via IntersectionObserver + CSS custom property --alafiat-stagger
    var revealGroups = [
      '#sediaan > div:first-child',
      '#sediaan .sediaan-card',
      '#jalur-maklon > div',
      '#proses .alafiat-process-intro, #proses .alafiat-process-step',
      '#sertifikat .alafiat-certificates-head',
      '#sertifikat .alafiat-cert-card',
      '#mitra .alafiat-partners-head',
      '#mitra .alafiat-partner-card',
      '#testimoni .alafiat-portfolio-head',
      '#testimoni .alafiat-portfolio-card',
      '#faq > div:first-child',
      '#faq .faq-trigger',
      'footer.alafiat-site-footer',
      '.alafiat-product-hub > header, .alafiat-product-page > header',
      '.alafiat-product-view > div',
      '.alafiat-single-specs > div',
      '.alafiat-archive-grid > li',
      '.alafiat-catalog-detail-list > li',
      '.alafiat-product-consultation, .alafiat-archive-consultation',
      '.alafiat-catalog-details',
      '.alafiat-product-related',
      'main .wp-block-post-content > .wp-block-group'
    ];

    var revealTargets = [];
    revealGroups.forEach(function (selector) {
      var items = Array.from(document.querySelectorAll(selector)).filter(function (el) {
        return !el.hidden && !el.classList.contains('hidden');
      });
      items.forEach(function (el, idx) {
        el.setAttribute('data-alafiat-reveal', '');
        el.style.setProperty('--alafiat-stagger', String(idx % 6));
        revealTargets.push(el);
      });
    });

    if (revealTargets.length && 'IntersectionObserver' in window) {
      document.documentElement.classList.add('alafiat-anim-ready');

      var revealObserver = new IntersectionObserver(
        function (entries, observer) {
          entries.forEach(function (entry) {
            if (entry.isIntersecting) {
              entry.target.setAttribute('data-alafiat-reveal', 'visible');
              observer.unobserve(entry.target);
            }
          });
        },
        { rootMargin: '0px 0px -8% 0px', threshold: 0.05 }
      );

      revealTargets.forEach(function (el) {
        revealObserver.observe(el);
      });
    } else {
      revealTargets.forEach(function (el) {
        el.setAttribute('data-alafiat-reveal', 'visible');
      });
    }

    // 4. Scroll-Driven Progress Line & Active Step Highlight in #proses
    var processSection = document.getElementById('proses');
    var processSteps = processSection ? Array.from(processSection.querySelectorAll('.alafiat-process-step')) : [];
    if (processSection && processSteps.length) {
      var processTicking = false;
      var updateProcessProgress = function () {
        processTicking = false;
        var viewportMid = window.innerHeight * 0.68;
        var activeCount = 0;

        processSteps.forEach(function (step) {
          var rect = step.getBoundingClientRect();
          var isReached = rect.top <= viewportMid;
          step.classList.toggle('is-reached', isReached);
          if (isReached) activeCount++;
        });

        var progress = Math.min(1, Math.max(0, activeCount / processSteps.length));
        processSection.style.setProperty('--alafiat-process-progress', progress.toFixed(3));
      };

      var onProcessScroll = function () {
        if (!processTicking) {
          processTicking = true;
          window.requestAnimationFrame(updateProcessProgress);
        }
      };

      updateProcessProgress();
      window.addEventListener('scroll', onProcessScroll, { passive: true });
      window.addEventListener('resize', onProcessScroll, { passive: true });
    }

    // 5. Smooth Filter Micro-Transitions
    var sediaanGrid = document.getElementById('sediaan-grid');
    if (sediaanGrid) {
      document.querySelectorAll('.tab-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
          window.requestAnimationFrame(function () {
            var visibleCards = Array.from(sediaanGrid.querySelectorAll('.sediaan-card')).filter(function (card) {
              return !card.hidden && !card.classList.contains('hidden');
            });
            visibleCards.forEach(function (card, idx) {
              card.setAttribute('data-alafiat-reveal', 'visible');
              card.style.setProperty('--alafiat-stagger', String(idx));
              card.classList.remove('alafiat-soft-enter');
              void card.offsetWidth;
              card.classList.add('alafiat-soft-enter');
            });
          });
        });
      });
    }
  }

  function extractImageDetail(img) {
    var src = img.currentSrc || img.getAttribute('src') || '';
    var alt = img.getAttribute('alt') || '';
    var detail = {
      src: src,
      alt: alt,
      badge: '',
      title: '',
      description: alt,
      actionLabel: '',
      actionUrl: '',
      actionExternal: false
    };

    var certCard = img.closest('.alafiat-cert-card');
    if (certCard) {
      var certBadge = certCard.querySelector('.alafiat-cert-meta');
      var certTitle = certCard.querySelector('h3');
      var certDetail = certCard.querySelector('.alafiat-cert-detail');
      var certLink = certCard.querySelector('.alafiat-cert-link a');
      detail.badge = certBadge ? certBadge.textContent.trim() : 'Sertifikat Pabrik';
      detail.title = certTitle ? certTitle.textContent.trim() : alt;
      detail.description = certDetail ? certDetail.textContent.trim() : alt;
      if (certLink && certLink.getAttribute('href')) {
        detail.actionUrl = certLink.getAttribute('href');
        detail.actionLabel = 'Buka dokumen resmi ↗';
        detail.actionExternal = true;
      }
      return detail;
    }

    var sediaanCard = img.closest('.sediaan-card');
    if (sediaanCard) {
      var sMeta = sediaanCard.querySelector('.alafiat-card-meta');
      var sTitle = sediaanCard.querySelector('h3');
      var sDesc = sediaanCard.querySelector('.alafiat-card-info p:not(.alafiat-card-meta)');
      var sLink = sediaanCard.querySelector('.alafiat-card-arrow');
      detail.badge = sMeta ? sMeta.textContent.trim() : 'Sediaan Maklon';
      detail.title = sTitle ? sTitle.textContent.trim() : alt;
      detail.description = sDesc ? sDesc.textContent.trim() : alt;
      if (sLink && sLink.getAttribute('href')) {
        detail.actionUrl = sLink.getAttribute('href');
        detail.actionLabel = 'Lihat detail sediaan →';
      }
      return detail;
    }

    var archiveItem = img.closest('.alafiat-archive-grid > li');
    if (archiveItem) {
      var aMeta = archiveItem.querySelector('.alafiat-archive-meta');
      var aTitle = archiveItem.querySelector('.alafiat-archive-title');
      var aDesc = archiveItem.querySelector('.alafiat-archive-excerpt');
      var aLink = archiveItem.querySelector('.alafiat-archive-arrow') || archiveItem.querySelector('.alafiat-archive-title a');
      detail.badge = aMeta ? aMeta.textContent.trim() : 'Produk Maklon';
      detail.title = aTitle ? aTitle.textContent.trim() : alt;
      detail.description = aDesc ? aDesc.textContent.trim() : alt;
      if (aLink && aLink.getAttribute('href')) {
        detail.actionUrl = aLink.getAttribute('href');
        detail.actionLabel = 'Lihat halaman produk →';
      }
      return detail;
    }

    var portfolioCard = img.closest('.alafiat-portfolio-card');
    if (portfolioCard) {
      var pMeta = portfolioCard.querySelector('.alafiat-portfolio-meta');
      var pTitle = portfolioCard.querySelector('h3');
      var pQuote = portfolioCard.querySelector('.alafiat-portfolio-quote p');
      var pCite = portfolioCard.querySelector('.alafiat-portfolio-quote cite');
      detail.badge = pMeta ? pMeta.textContent.trim() : 'Portofolio Mitra';
      detail.title = pTitle ? pTitle.textContent.trim() : alt;
      detail.description = pQuote
        ? '“' + pQuote.textContent.trim() + '”' + (pCite ? ' — ' + pCite.textContent.trim() : '')
        : alt;
      return detail;
    }

    var singleProduct = img.closest('.alafiat-single-product');
    if (singleProduct) {
      var spTitle = document.querySelector('.alafiat-product-page .wp-block-post-title');
      var spCaption = document.getElementById('preview-caption');
      var spDesc = singleProduct.querySelector('.alafiat-single-description');
      detail.badge = 'Galeri Sediaan';
      detail.title = spTitle ? spTitle.textContent.trim() : alt;
      detail.description = (spCaption && spCaption.textContent.trim()) || (spDesc ? spDesc.textContent.trim() : alt);
      return detail;
    }

    var heroSection = img.closest('#top, [data-alafiat-anchor="top"]');
    if (heroSection) {
      var hCaption = heroSection.querySelector(':scope > div:last-child > div');
      detail.badge = 'Fasilitas & Produk Maklon';
      detail.title = 'CV. Al Afiat Sehat Alami';
      detail.description = (hCaption && hCaption.textContent.trim()) || alt;
      return detail;
    }

    var processSection = img.closest('#proses, [data-alafiat-anchor="proses"]');
    if (processSection) {
      detail.badge = 'Proses Produksi CPOTB';
      detail.title = 'Fasilitas Produksi Al Afiat';
      detail.description = alt;
      return detail;
    }

    detail.title = alt;
    detail.description = '';
    return detail;
  }

  function initAlafiatImageDetailModal() {
    // Scope: content images across landing, product hub/archive, single product, and standard WP pages.
    var selector = '.alafiat-wrapper img, .alafiat-product-page img, .alafiat-product-hub img, .alafiat-single-product img, main .wp-block-image img, .wp-block-post-content img';
    var images = Array.from(document.querySelectorAll(selector)).filter(function (img) {
      return !img.closest('a, button, header, footer, .alafiat-landing-logo, .alafiat-partner-logo, #preview-thumbs, .alafiat-zoom-modal, .custom-logo-link');
    });

    if (!images.length) {
      return;
    }

    var modal = document.createElement('div');
    modal.id = 'alafiat-zoom-modal';
    modal.className = 'alafiat-zoom-modal';
    modal.setAttribute('role', 'dialog');
    modal.setAttribute('aria-modal', 'true');
    modal.setAttribute('aria-labelledby', 'alafiat-zoom-title');
    modal.hidden = true;

    var closeBtn = document.createElement('button');
    closeBtn.type = 'button';
    closeBtn.className = 'alafiat-zoom-btn alafiat-zoom-close';
    closeBtn.setAttribute('aria-label', 'Tutup detail gambar');
    closeBtn.textContent = '✕';

    var prevBtn = document.createElement('button');
    prevBtn.type = 'button';
    prevBtn.className = 'alafiat-zoom-btn alafiat-zoom-prev';
    prevBtn.setAttribute('aria-label', 'Gambar sebelumnya');
    prevBtn.textContent = '←';

    var nextBtn = document.createElement('button');
    nextBtn.type = 'button';
    nextBtn.className = 'alafiat-zoom-btn alafiat-zoom-next';
    nextBtn.setAttribute('aria-label', 'Gambar berikutnya');
    nextBtn.textContent = '→';

    var dialog = document.createElement('div');
    dialog.className = 'alafiat-zoom-dialog';

    var stage = document.createElement('div');
    stage.className = 'alafiat-zoom-stage';

    var zoomImg = document.createElement('img');
    zoomImg.className = 'alafiat-zoom-img';
    zoomImg.alt = '';

    var zoomControls = document.createElement('div');
    zoomControls.className = 'alafiat-zoom-controls';

    var zoomOutBtn = document.createElement('button');
    zoomOutBtn.type = 'button';
    zoomOutBtn.className = 'alafiat-zoom-ctrl-btn';
    zoomOutBtn.setAttribute('aria-label', 'Perkecil gambar');
    zoomOutBtn.textContent = '−';

    var zoomLevelLabel = document.createElement('span');
    zoomLevelLabel.className = 'alafiat-zoom-level';
    zoomLevelLabel.textContent = '100%';

    var zoomInBtn = document.createElement('button');
    zoomInBtn.type = 'button';
    zoomInBtn.className = 'alafiat-zoom-ctrl-btn';
    zoomInBtn.setAttribute('aria-label', 'Perbesar gambar');
    zoomInBtn.textContent = '+';

    var zoomResetBtn = document.createElement('button');
    zoomResetBtn.type = 'button';
    zoomResetBtn.className = 'alafiat-zoom-ctrl-btn';
    zoomResetBtn.setAttribute('aria-label', 'Reset zoom');
    zoomResetBtn.textContent = 'Reset';

    zoomControls.append(zoomOutBtn, zoomLevelLabel, zoomInBtn, zoomResetBtn);
    stage.append(zoomImg, zoomControls);

    var panel = document.createElement('aside');
    panel.className = 'alafiat-zoom-panel';

    var badgeEl = document.createElement('p');
    badgeEl.className = 'alafiat-zoom-badge';

    var titleEl = document.createElement('h3');
    titleEl.id = 'alafiat-zoom-title';
    titleEl.className = 'alafiat-zoom-title';

    var captionEl = document.createElement('p');
    captionEl.id = 'alafiat-zoom-caption';
    captionEl.className = 'alafiat-zoom-caption';

    var actionEl = document.createElement('a');
    actionEl.className = 'alafiat-zoom-action';

    var hintEl = document.createElement('p');
    hintEl.className = 'alafiat-zoom-hint';
    hintEl.textContent = 'Klik gambar, scroll mouse, atau gunakan tombol +/− untuk zoom';

    panel.append(badgeEl, titleEl, captionEl, actionEl, hintEl);
    dialog.append(stage, panel);
    modal.append(closeBtn, prevBtn, dialog, nextBtn);
    document.body.appendChild(modal);

    var activeTrigger = null;
    var activeList = [];
    var activeIndex = 0;
    var zoomScale = 1;

    function applyZoom(scale, originX, originY) {
      zoomScale = Math.min(3, Math.max(1, Math.round(scale * 100) / 100));
      if (typeof originX === 'number' && typeof originY === 'number') {
        zoomImg.style.setProperty('--zoom-x', originX.toFixed(1) + '%');
        zoomImg.style.setProperty('--zoom-y', originY.toFixed(1) + '%');
      } else if (zoomScale === 1) {
        zoomImg.style.setProperty('--zoom-x', '50%');
        zoomImg.style.setProperty('--zoom-y', '50%');
      }
      zoomImg.style.setProperty('--zoom-scale', String(zoomScale));
      zoomImg.classList.toggle('is-zoomed', zoomScale > 1);
      zoomLevelLabel.textContent = Math.round(zoomScale * 100) + '%';
    }

    function getVisibleImages() {
      return images.filter(function (img) {
        return !img.closest('[hidden], .hidden');
      });
    }

    function showImageAt(idx) {
      if (!activeList.length) return;
      activeIndex = (idx + activeList.length) % activeList.length;
      var info = extractImageDetail(activeList[activeIndex]);

      applyZoom(1);
      zoomImg.src = info.src;
      zoomImg.alt = info.alt;

      badgeEl.textContent = info.badge;
      badgeEl.hidden = !info.badge;

      titleEl.textContent = info.title;
      titleEl.hidden = !info.title;

      captionEl.textContent = info.description;
      captionEl.hidden = !info.description || info.description === info.title;

      if (info.actionUrl && info.actionLabel) {
        actionEl.href = info.actionUrl;
        actionEl.textContent = info.actionLabel;
        if (info.actionExternal) {
          actionEl.target = '_blank';
          actionEl.rel = 'noopener noreferrer';
        } else {
          actionEl.removeAttribute('target');
          actionEl.removeAttribute('rel');
        }
        actionEl.hidden = false;
      } else {
        actionEl.hidden = true;
      }

      var hasDetails = !badgeEl.hidden || !titleEl.hidden || !captionEl.hidden || !actionEl.hidden;
      panel.hidden = !hasDetails;
      dialog.classList.toggle('is-media-only', !hasDetails);

      prevBtn.hidden = activeList.length < 2;
      nextBtn.hidden = activeList.length < 2;
    }

    function openLightbox(targetImg) {
      activeTrigger = targetImg;
      activeList = getVisibleImages();
      var idx = activeList.indexOf(targetImg);
      if (idx === -1) {
        activeList = [targetImg];
        idx = 0;
      }

      showImageAt(idx);
      modal.hidden = false;
      document.body.style.overflow = 'hidden';
      window.requestAnimationFrame(function () {
        modal.classList.add('is-open');
        closeBtn.focus();
      });
    }

    function closeLightbox() {
      if (modal.hidden) return;
      modal.classList.remove('is-open');
      applyZoom(1);

      var finish = function () {
        modal.hidden = true;
        document.body.style.overflow = '';
        if (activeTrigger && typeof activeTrigger.focus === 'function') {
          activeTrigger.focus();
        }
      };

      if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        finish();
      } else {
        window.setTimeout(finish, 280);
      }
    }

    images.forEach(function (img) {
      img.setAttribute('data-alafiat-zoomable', 'true');
      img.setAttribute('role', 'button');
      img.setAttribute('tabindex', '0');
      if (!img.getAttribute('aria-label')) {
        img.setAttribute('aria-label', 'Lihat detail gambar' + (img.alt ? ': ' + img.alt : ''));
      }

      img.addEventListener('click', function (e) {
        e.preventDefault();
        openLightbox(img);
      });

      img.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' || e.key === ' ') {
          e.preventDefault();
          openLightbox(img);
        }
      });
    });

    zoomImg.addEventListener('click', function (e) {
      e.stopPropagation();
      var rect = zoomImg.getBoundingClientRect();
      var xPct = rect.width ? ((e.clientX - rect.left) / rect.width) * 100 : 50;
      var yPct = rect.height ? ((e.clientY - rect.top) / rect.height) * 100 : 50;
      if (zoomScale > 1) {
        applyZoom(1);
      } else {
        applyZoom(2, Math.min(100, Math.max(0, xPct)), Math.min(100, Math.max(0, yPct)));
      }
    });

    zoomImg.addEventListener('mousemove', function (e) {
      if (zoomScale <= 1) return;
      var rect = stage.getBoundingClientRect();
      if (!rect.width || !rect.height) return;
      var xPct = ((e.clientX - rect.left) / rect.width) * 100;
      var yPct = ((e.clientY - rect.top) / rect.height) * 100;
      zoomImg.style.setProperty('--zoom-x', Math.min(100, Math.max(0, xPct)).toFixed(1) + '%');
      zoomImg.style.setProperty('--zoom-y', Math.min(100, Math.max(0, yPct)).toFixed(1) + '%');
    });

    stage.addEventListener('wheel', function (e) {
      e.preventDefault();
      var delta = e.deltaY < 0 ? 0.35 : -0.35;
      var rect = zoomImg.getBoundingClientRect();
      var xPct = rect.width ? ((e.clientX - rect.left) / rect.width) * 100 : 50;
      var yPct = rect.height ? ((e.clientY - rect.top) / rect.height) * 100 : 50;
      applyZoom(zoomScale + delta, Math.min(100, Math.max(0, xPct)), Math.min(100, Math.max(0, yPct)));
    }, { passive: false });

    zoomInBtn.addEventListener('click', function (e) {
      e.stopPropagation();
      applyZoom(zoomScale + 0.5);
    });

    zoomOutBtn.addEventListener('click', function (e) {
      e.stopPropagation();
      applyZoom(zoomScale - 0.5);
    });

    zoomResetBtn.addEventListener('click', function (e) {
      e.stopPropagation();
      applyZoom(1);
    });

    closeBtn.addEventListener('click', closeLightbox);
    prevBtn.addEventListener('click', function (e) {
      e.stopPropagation();
      showImageAt(activeIndex - 1);
    });
    nextBtn.addEventListener('click', function (e) {
      e.stopPropagation();
      showImageAt(activeIndex + 1);
    });

    modal.addEventListener('click', function (e) {
      if (e.target === modal || e.target === dialog || e.target === stage) {
        closeLightbox();
      }
    });

    document.addEventListener('keydown', function (e) {
      if (modal.hidden) return;
      if (e.key === 'Escape') {
        closeLightbox();
      } else if (e.key === 'ArrowLeft' && activeList.length > 1) {
        showImageAt(activeIndex - 1);
      } else if (e.key === 'ArrowRight' && activeList.length > 1) {
        showImageAt(activeIndex + 1);
      }
    });
  }

  function initFloatingDock() {
    if (document.querySelector('.alafiat-floating-dock')) return;

    var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var dock = document.createElement('div');
    dock.className = 'alafiat-floating-dock';

    // 1. Arrow Up Button with Progressive SVG Border
    var radius = 22;
    var circumference = 2 * Math.PI * radius;

    var scrollTopBtn = document.createElement('button');
    scrollTopBtn.type = 'button';
    scrollTopBtn.className = 'alafiat-float-btn alafiat-scroll-top';
    scrollTopBtn.setAttribute('aria-label', 'Kembali ke atas');
    scrollTopBtn.setAttribute('title', 'Kembali ke atas');
    scrollTopBtn.innerHTML =
      '<svg class="alafiat-scroll-top-svg" viewBox="0 0 52 52" aria-hidden="true">' +
      '<circle class="alafiat-scroll-top-track" cx="26" cy="26" r="' + radius + '"></circle>' +
      '<circle class="alafiat-scroll-top-ring" cx="26" cy="26" r="' + radius + '" ' +
      'stroke-dasharray="' + circumference.toFixed(2) + '" ' +
      'stroke-dashoffset="' + circumference.toFixed(2) + '"></circle>' +
      '</svg>' +
      '<svg class="alafiat-scroll-top-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' +
      '<path d="M12 19V5"></path><path d="m5 12 7-7 7 7"></path>' +
      '</svg>';

    var ringCircle = scrollTopBtn.querySelector('.alafiat-scroll-top-ring');

    scrollTopBtn.addEventListener('click', function () {
      window.scrollTo({
        top: 0,
        behavior: reducedMotion ? 'auto' : 'smooth'
      });
    });

    // 2. Floating WhatsApp Button
    var rawNumber = (window.ALFIAT_CONFIG && window.ALFIAT_CONFIG.whatsappNumber) || '6281234567890';
    var cleanNumber = rawNumber.replace(/[^\dX]/gi, '');
    var waMessage = 'Halo Tim Konsultan Maklon Al Afiat, saya ingin konsultasi maklon herbal.';
    var waLink = document.createElement('a');
    waLink.className = 'alafiat-float-btn alafiat-float-wa';
    waLink.setAttribute('data-wa-cta', 'floating_wa');
    waLink.setAttribute('data-wa-message', waMessage);
    waLink.href = 'https://wa.me/' + cleanNumber + '?text=' + encodeURIComponent(waMessage);
    waLink.target = '_blank';
    waLink.rel = 'noopener noreferrer';
    waLink.setAttribute('aria-label', 'Konsultasi via WhatsApp');
    waLink.setAttribute('title', 'Chat WhatsApp Konsultan Maklon');
    waLink.innerHTML =
      '<svg viewBox="0 0 24 24" aria-hidden="true">' +
      '<path d="M20.52 3.48A11.86 11.86 0 0 0 12.06 0C5.49 0 .16 5.33.16 11.9c0 2.1.55 4.15 1.6 5.95L0 24l6.33-1.66a11.86 11.86 0 0 0 5.73 1.46h.01c6.57 0 11.9-5.33 11.9-11.9 0-3.18-1.24-6.17-3.45-8.42ZM12.07 21.8h-.01a9.87 9.87 0 0 1-5.03-1.38l-.36-.21-3.76.99 1-3.66-.24-.38a9.86 9.86 0 0 1-1.51-5.26c0-5.45 4.44-9.89 9.9-9.89 2.64 0 5.13 1.03 7 2.9a9.82 9.82 0 0 1 2.9 7c0 5.46-4.44 9.89-9.89 9.89Zm5.43-7.41c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.94 1.17-.17.2-.35.22-.65.07-.3-.15-1.26-.46-2.4-1.48-.89-.79-1.49-1.77-1.66-2.07-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.08-.15-.67-1.62-.92-2.22-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.07-.79.37-.27.3-1.04 1.02-1.04 2.48 0 1.46 1.06 2.88 1.21 3.08.15.2 2.09 3.19 5.06 4.47.71.31 1.26.49 1.69.63.71.22 1.36.19 1.87.12.57-.09 1.76-.72 2.01-1.41.25-.7.25-1.29.17-1.41-.07-.13-.27-.2-.57-.35Z"/>' +
      '</svg>';

    dock.append(scrollTopBtn, waLink);
    document.body.appendChild(dock);

    var scrollTicking = false;
    function updateScrollProgress() {
      scrollTicking = false;
      var scrollTop = window.scrollY || window.pageYOffset || 0;
      var docHeight = Math.max(
        document.documentElement.scrollHeight,
        document.body.scrollHeight
      );
      var maxScroll = Math.max(0, docHeight - window.innerHeight);

      var isVisible = scrollTop > 40;
      scrollTopBtn.classList.toggle('is-visible', isVisible);

      var progress = maxScroll > 0 ? Math.min(1, Math.max(0, scrollTop / maxScroll)) : 0;
      var isAtBottom = maxScroll > 0 && (scrollTop >= maxScroll - 2 || progress >= 0.995);
      if (isAtBottom) progress = 1;

      if (ringCircle) {
        ringCircle.style.strokeDashoffset = (circumference * (1 - progress)).toFixed(2);
      }
      scrollTopBtn.classList.toggle('is-complete', isAtBottom);
    }

    function onScrollOrResize() {
      if (!scrollTicking) {
        scrollTicking = true;
        window.requestAnimationFrame(updateScrollProgress);
      }
    }

    updateScrollProgress();
    window.addEventListener('scroll', onScrollOrResize, { passive: true });
    window.addEventListener('resize', onScrollOrResize, { passive: true });
  }

  function initPageTransitions() {
    var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (reducedMotion) return;

    var hasNativeMpaTransitions = 'onpagereveal' in window;

    if (!hasNativeMpaTransitions) {
      document.documentElement.classList.add('alafiat-page-entering');
      window.setTimeout(function () {
        document.documentElement.classList.remove('alafiat-page-entering');
      }, 320);
    }

    window.addEventListener('pageshow', function () {
      document.documentElement.classList.remove('alafiat-page-leaving');
    });

    if (hasNativeMpaTransitions) {
      return;
    }

    document.addEventListener('click', function (e) {
      if (e.defaultPrevented || e.button !== 0 || e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) {
        return;
      }

      var link = e.target.closest('a[href]');
      if (!link) return;

      var rawHref = link.getAttribute('href') || '';
      if (!rawHref || rawHref.charAt(0) === '#' || link.hasAttribute('download')) return;
      if (link.target && link.target !== '_self') return;

      var url;
      try {
        url = new URL(link.href, window.location.href);
      } catch (err) {
        return;
      }

      if (url.origin !== window.location.origin) return;
      if (/\/wp-(admin|login\.php)/.test(url.pathname)) return;
      if (url.pathname === window.location.pathname && url.search === window.location.search && url.hash) return;

      e.preventDefault();
      document.documentElement.classList.add('alafiat-page-leaving');
      window.setTimeout(function () {
        window.location.href = url.href;
      }, 180);
    });
  }

  function initAll() {
    initPageTransitions();
    initScrollAndUiAnimations();
    initAlafiatImageDetailModal();
    initFloatingDock();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initAll);
  } else {
    initAll();
  }
})();
