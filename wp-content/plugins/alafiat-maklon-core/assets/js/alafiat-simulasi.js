/**
 * Alafiat Maklon Herbal - Landing Page & Simulation Scripts
 */
(function () {
  'use strict';

  function getUtmTag() {
    if (!window.ALFIAT_CONFIG || !window.ALFIAT_CONFIG.appendUtm) return '';
    var params = new URLSearchParams(window.location.search);
    var source = params.get('utm_source');
    var campaign = params.get('utm_campaign');
    if (!source && !campaign) return '';
    return '\n\n[Ref: ' + [source, campaign].filter(Boolean).join(' / ') + ']';
  }

  function buildWhatsAppUrl(message) {
    var rawNumber = (window.ALFIAT_CONFIG && window.ALFIAT_CONFIG.whatsappNumber) || '6281234567890';
    var cleanNumber = rawNumber.replace(/[^\dX]/gi, '');
    var fullMessage = message + getUtmTag();
    return 'https://wa.me/' + cleanNumber + '?text=' + encodeURIComponent(fullMessage);
  }

  function trackWhatsAppEvent(sourceLabel) {
    if (typeof window.fbq === 'function') {
      window.fbq('track', 'Contact', { content_name: sourceLabel });
    }
    if (Array.isArray(window.dataLayer)) {
      window.dataLayer.push({ event: 'whatsapp_cta_click', cta_source: sourceLabel });
    }
  }

  document.addEventListener('DOMContentLoaded', function () {
    // 1. FILTER KATALOG SEDIAAN
    var tabButtons = Array.from(document.querySelectorAll('.tab-btn'));
    var sediaanCards = Array.from(document.querySelectorAll('.sediaan-card'));
    var sediaanGrid = document.getElementById('sediaan-grid');
    var emptyBox = document.getElementById('sediaan-empty');
    var resetFilterBtn = document.getElementById('reset-sediaan-filter');
    var initialTab = tabButtons.find(function (btn) {
      return btn.getAttribute('aria-pressed') === 'true' || btn.getAttribute('aria-selected') === 'true';
    }) || tabButtons[0];

    // Beranda lama masih menyimpan markup filter dengan semantik tab.
    if (initialTab && initialTab.parentElement.getAttribute('role') === 'tablist') {
      initialTab.parentElement.setAttribute('role', 'group');
      initialTab.parentElement.setAttribute('aria-label', 'Filter bentuk sediaan');
    }

    function applyTabFilter(filterKey) {
      var visibleCount = 0;
      tabButtons.forEach(function (btn) {
        var isActive = btn.dataset.tabFilter === filterKey;
        btn.removeAttribute('aria-selected');
        btn.setAttribute('aria-pressed', isActive ? 'true' : 'false');
        btn.classList.toggle('border-[1.5px]', isActive);
        btn.classList.toggle('border', !isActive);
        btn.classList.toggle('border-pine', isActive);
        btn.classList.toggle('text-ink', isActive);
        btn.classList.toggle('border-subtle', !isActive);
        btn.classList.toggle('text-inkMuted', !isActive);
      });

      sediaanCards.forEach(function (card) {
        var match = filterKey === 'all' || card.dataset.category === filterKey;
        card.hidden = !match;
        card.classList.toggle('hidden', !match);
        if (match) visibleCount += 1;
      });

      if (!emptyBox && sediaanGrid && visibleCount === 0) {
        emptyBox = document.createElement('p');
        emptyBox.id = 'sediaan-empty';
        emptyBox.setAttribute('role', 'status');
        emptyBox.textContent = 'Belum ada sediaan dalam kategori ini.';
        sediaanGrid.after(emptyBox);
      }

      if (emptyBox) {
        var hasResults = visibleCount > 0;
        emptyBox.hidden = hasResults;
        emptyBox.classList.toggle('hidden', hasResults);
      }
    }

    tabButtons.forEach(function (btn, idx) {
      if (sediaanGrid) btn.setAttribute('aria-controls', sediaanGrid.id);
      btn.addEventListener('click', function () {
        applyTabFilter(btn.dataset.tabFilter);
      });
      btn.addEventListener('keydown', function (e) {
        if (e.key === 'ArrowRight' || e.key === 'ArrowLeft') {
          e.preventDefault();
          var nextIdx = e.key === 'ArrowRight'
            ? (idx + 1) % tabButtons.length
            : (idx - 1 + tabButtons.length) % tabButtons.length;
          tabButtons[nextIdx].focus();
          applyTabFilter(tabButtons[nextIdx].dataset.tabFilter);
        }
      });
    });

    if (initialTab) applyTabFilter(initialTab.dataset.tabFilter);

    document.querySelectorAll('[data-jump-tab]').forEach(function (jumpLink) {
      jumpLink.addEventListener('click', function () {
        var targetTab = jumpLink.dataset.jumpTab;
        if (targetTab) applyTabFilter(targetTab);
      });
    });

    if (resetFilterBtn) {
      resetFilterBtn.addEventListener('click', function () {
        applyTabFilter('all');
      });
    }

    // 2. SIMULATOR MAKLON 3-KLIK
    var simDefault = {
      jalur: 'Take Over Produk Siap Edar',
      sediaan: 'Madu & Sirup Herbal',
      qty: '250 pcs (MOQ Starter)'
    };
    var simState = Object.assign({}, simDefault);

    var jalurEstimasiMap = {
      'Take Over Produk Siap Edar': 'MOU, desain kemasan, dan izin edar cepat 1-2 bulan.',
      'Variasi Minor atau Mayor': 'Sampel variasi sekitar 1 sampai 2 minggu.',
      'Custom Formulasi Baru': 'Riset R&D laboratorium hingga uji stabilitas 3-6 bulan.',
      'Pindah Produksi Pabrik': 'Alih produksi ke lini fasilitas CPOTB CV Al Afiat.'
    };

    var outJalur = document.getElementById('out-jalur');
    var outSediaan = document.getElementById('out-sediaan');
    var outQty = document.getElementById('out-qty');
    var outEstimasi = document.getElementById('out-estimasi');
    var simWaCta = document.getElementById('sim-wa-cta');
    var simResetBtn = document.getElementById('sim-reset-btn');
    var simOptionButtons = Array.from(document.querySelectorAll('.sim-opt'));
    var simSummary = outJalur && outJalur.closest('dl');

    if (simSummary) simSummary.setAttribute('aria-live', 'polite');

    function renderSimulator() {
      if (!outJalur || !outSediaan || !outQty || !outEstimasi || !simWaCta) return;
      outJalur.textContent = simState.jalur;
      outSediaan.textContent = simState.sediaan;
      outQty.textContent = simState.qty;
      outEstimasi.textContent = jalurEstimasiMap[simState.jalur] || jalurEstimasiMap['Take Over Produk Siap Edar'];

      simOptionButtons.forEach(function (btn) {
        var group = btn.dataset.simGroup;
        var val = btn.dataset.simValue;
        var selected = simState[group] === val;
        btn.setAttribute('aria-pressed', selected ? 'true' : 'false');
        if (selected) {
          btn.classList.remove('border', 'border-subtle', 'bg-panel', 'text-ink');
          btn.classList.add('border-[1.5px]', 'border-pine', 'bg-pineTint', 'text-pine');
        } else {
          btn.classList.remove('border-[1.5px]', 'border-pine', 'bg-pineTint', 'text-pine');
          btn.classList.add('border', 'border-subtle', 'bg-panel', 'text-ink');
        }
      });

      var simMessage =
        'Halo Tim Konsultan Maklon Al Afiat, saya sudah menyusun konsep maklon di halaman website:\n' +
        '- Jalur: ' + simState.jalur + '\n' +
        '- Sediaan: ' + simState.sediaan + '\n' +
        '- Perkiraan Kuantitas: ' + simState.qty + '\n\n' +
        'Mohon info alur detail dan estimasi biayanya.';
      simWaCta.dataset.waMessage = simMessage;
      simWaCta.setAttribute('href', buildWhatsAppUrl(simMessage));
    }

    simOptionButtons.forEach(function (btn) {
      btn.addEventListener('click', function () {
        var group = btn.dataset.simGroup;
        var val = btn.dataset.simValue;
        if (group && val) {
          simState[group] = val;
          renderSimulator();
        }
      });
    });

    if (simResetBtn) {
      simResetBtn.addEventListener('click', function () {
        simState = Object.assign({}, simDefault);
        renderSimulator();
      });
    }

    // 3. FAQ ACCORDION
    var faqTriggers = Array.from(document.querySelectorAll('.faq-trigger'));
    faqTriggers.forEach(function (trigger) {
      var icon = trigger.querySelector('span + span');
      if (icon) icon.setAttribute('aria-hidden', 'true');
      trigger.addEventListener('click', function () {
        var isExpanded = trigger.getAttribute('aria-expanded') === 'true';
        var panelId = trigger.getAttribute('aria-controls');
        var panel = document.getElementById(panelId);
        trigger.setAttribute('aria-expanded', isExpanded ? 'false' : 'true');
        if (panel) {
          panel.classList.toggle('hidden', isExpanded);
        }
      });
    });

    // 4. WHATSAPP CTA SYNC
    function syncAllWaLinks() {
      var waLinks = document.querySelectorAll('a[data-wa-cta]');
      waLinks.forEach(function (link) {
        var savedMessage = new URLSearchParams(link.search).get('text');
        var msg = link.dataset.waMessage || savedMessage || 'Halo Tim Konsultan Maklon Al Afiat, saya ingin konsultasi maklon herbal.';
        link.setAttribute('href', buildWhatsAppUrl(msg));
        link.setAttribute('target', '_blank');
        link.setAttribute('rel', 'noopener noreferrer');
      });
    }

    document.addEventListener('click', function (e) {
      var waLink = e.target.closest('a[data-wa-cta]');
      if (!waLink) return;
      var source = waLink.dataset.waCta || 'cta_button';
      trackWhatsAppEvent(source);
    });

    // 5. THEME TOGGLE
    var toggleBtns = document.querySelectorAll('.theme-toggle-btn');
    if (toggleBtns.length) {
      var applyTheme = function (isDark) {
        document.documentElement.classList.toggle('dark', isDark);
        try {
          localStorage.setItem('alafiat_theme', isDark ? 'dark' : 'light');
        } catch (err) {}
        toggleBtns.forEach(function (b) {
          b.setAttribute('aria-pressed', isDark ? 'true' : 'false');
          b.setAttribute('title', isDark ? 'Beralih ke mode terang' : 'Beralih ke mode gelap');
        });
      };
      var isCurrentDark = document.documentElement.classList.contains('dark');
      toggleBtns.forEach(function (btn) {
        btn.setAttribute('aria-pressed', isCurrentDark ? 'true' : 'false');
        btn.addEventListener('click', function () {
          var nextDark = !document.documentElement.classList.contains('dark');
          applyTheme(nextDark);
        });
      });
    }

    renderSimulator();
    syncAllWaLinks();
  });
})();
