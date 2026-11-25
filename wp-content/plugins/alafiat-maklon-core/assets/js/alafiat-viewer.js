/**
 * Alafiat Maklon Herbal - Interactive Product Detail Viewer Scripts
 */
(function () {
  'use strict';

  var PRODUCT_DATA = {
    madu: {
      tabLabel: 'Madu & Sirup',
      groupLabel: 'Cairan Obat Dalam',
      title: 'Maklon Madu & Sirup Herbal',
      summary: 'Madu murni dan sirup ekstrak rempah.',
      specs: [
        { label: 'Izin', value: 'BPOM TR & Halal', accent: true },
        { label: 'MOQ', value: 'Mulai 250 botol', accent: true },
        { label: 'Kemasan', value: 'Botol kaca atau plastik', accent: false },
        { label: 'Jalur', value: 'Take Over & Custom', accent: false }
      ],
      gallery: [
        {
          src: '/wp-content/uploads/alafiat/sediaan-madu.png',
          alt: 'Produk maklon madu herbal CV Al Afiat',
          caption: 'Contoh botol kaca.'
        },
        {
          src: '/wp-content/uploads/alafiat/preview-madu-produk.webp',
          alt: 'Contoh produk jadi madu herbal CV Al Afiat',
          caption: 'Contoh produk jadi.'
        },
        {
          src: '/wp-content/uploads/alafiat/preview-madu-bahan.jpg',
          alt: 'Bahan baku madu murni Al Afiat',
          caption: 'Penyortiran madu.'
        }
      ],
      concepts: [
        { title: 'Daya tahan tubuh', desc: 'Madu dan ekstrak herbal harian segmen keluarga.' },
        { title: 'Lambung & pencernaan', desc: 'Formula alami kenyamanan cerna dan nafsu makan.' },
        { title: 'Madu khusus wanita', desc: 'Varian pendamping ASI dan kenyamanan haid.' },
        { title: 'Formula khusus R&D', desc: 'Racikan rasa, botol, dan merek sesuai konsep Anda.' }
      ],
      details: [
        { title: 'Wadah & segel kemasan', desc: 'Botol kaca atau plastik, segel, dan dus.' },
        { title: 'Kelayakan izin BPOM TR', desc: 'Kajian keamanan bahan dan klaim.' },
        { title: 'Uji sampel fisik', desc: 'Cek rasa, warna, dan kekentalan.' },
        { title: 'Penentu biaya batch', desc: 'Madu, ekstrak, volume, dan jumlah pesanan.' }
      ]
    },
    kapsul: {
      tabLabel: 'Kapsul Herbal',
      groupLabel: 'Sediaan Kapsul',
      title: 'Maklon Kapsul Herbal',
      summary: 'Kapsul ekstrak kering atau isian minyak.',
      specs: [
        { label: 'Izin', value: 'BPOM TR & Halal', accent: true },
        { label: 'MOQ', value: 'Mulai 250 botol', accent: true },
        { label: 'Kemasan', value: 'Botol HDPE, amber, blister', accent: false },
        { label: 'Jalur', value: 'Take Over & Custom', accent: false }
      ],
      gallery: [
        {
          src: '/wp-content/uploads/alafiat/sediaan-kapsul.png',
          alt: 'Ilustrasi kapsul ekstrak herbal',
          caption: 'Kapsul ekstrak serbuk dan herbal.'
        },
        {
          src: '/wp-content/uploads/alafiat/preview-kapsul-produk.jpg',
          alt: 'Produk jadi kapsul herbal Al Afiat',
          caption: 'Botol amber dan dus.'
        },
        {
          src: '/wp-content/uploads/alafiat/fasilitas-cpotb.jpg',
          alt: 'Mesin produksi kapsul CPOTB',
          caption: 'Mesin pengisian kapsul.'
        }
      ],
      concepts: [
        { title: 'Kapsul serbuk ekstrak', desc: 'Isian ekstrak kering rempah tunggal maupun formula majemuk.' },
        { title: 'Kapsul minyak herbal', desc: 'Habbatussauda, minyak ikan gabus, garlic, atau salmon.' },
        { title: 'Metabolisme & kolesterol', desc: 'Pendamping metabolisme tubuh sesuai pedoman klaim BPOM.' },
        { title: 'Stamina & kebugaran', desc: 'Kebugaran harian praktis dalam botol segel rapat.' }
      ],
      details: [
        { title: 'Cangkang & botol', desc: 'Gelatin halal atau vegetarian, HDPE atau blister.' },
        { title: 'Mesin pengisian CPOTB', desc: 'Cek keseragaman bobot kapsul.' },
        { title: 'Uji stabilitas & disintegrasi', desc: 'Cek stabilitas dan waktu hancur kapsul.' },
        { title: 'Penentu biaya batch', desc: 'Bahan aktif, isi botol, dan jumlah pesanan.' }
      ]
    },
    susu: {
      tabLabel: 'Susu & Serbuk',
      groupLabel: 'Serbuk Oral',
      title: 'Maklon Susu Etawa & Serbuk Herbal',
      summary: 'Susu etawa dan serbuk jahe, temulawak, atau kurma.',
      specs: [
        { label: 'Izin', value: 'BPOM TR & Halal', accent: true },
        { label: 'MOQ', value: 'Mulai 250 box', accent: true },
        { label: 'Kemasan', value: 'Pouch, sachet, box karton', accent: false },
        { label: 'Jalur', value: 'Siap Edar & Custom', accent: false }
      ],
      gallery: [
        {
          src: '/wp-content/uploads/alafiat/sediaan-susu.png',
          alt: 'Konsep kemasan susu etawa',
          caption: 'Contoh pouch susu etawa.'
        },
        {
          src: '/wp-content/uploads/alafiat/preview-susu-produk.webp',
          alt: 'Produk jadi susu etawa Al Afiat',
          caption: 'Contoh kemasan dus.'
        },
        {
          src: '/wp-content/uploads/alafiat/preview-qc-kemasan.jpg',
          alt: 'Kontrol mutu pengemasan box',
          caption: 'Pemeriksaan segel dan dus.'
        }
      ],
      concepts: [
        { title: 'Susu etawa original', desc: 'Susu kambing murni minim bau prengus untuk segmen keluarga.' },
        { title: 'Jahe & temulawak', desc: 'Paduan kehangatan jahe merah atau temulawak pencernaan.' },
        { title: 'Kurma & madu bubuk', desc: 'Rasa manis alami tanpa pemanis buatan berlebih.' },
        { title: 'Varian siap edar', desc: 'Formula teruji yang siap langsung cetak kemasan merek Anda.' }
      ],
      details: [
        { title: 'Bobot & kemasan lengkap', desc: 'Isi 200 g, 250 g, 500 g, atau sachet.' },
        { title: 'Izin BPOM TR (Obat Tradisional)', desc: 'Registrasi kategori obat tradisional.' },
        { title: 'Keseragaman rasa & kelarutan', desc: 'Homogenisasi agar serbuk mudah larut.' },
        { title: 'Penentu biaya batch', desc: 'Kadar susu etawa, pemanis, dan kemasan.' }
      ]
    },
    minyak: {
      tabLabel: 'Minyak & VCO',
      groupLabel: 'Minyak Konsumsi & Obat Luar',
      title: 'Maklon Minyak Herbal & VCO',
      summary: 'VCO, zaitun, habbatussauda, dan minyak oles.',
      specs: [
        { label: 'Izin', value: 'BPOM TR & Halal', accent: true },
        { label: 'MOQ', value: 'Mulai 250 botol', accent: true },
        { label: 'Kemasan', value: 'Botol segel, pipet, roll-on', accent: false },
        { label: 'Jalur', value: 'Take Over & Custom', accent: false }
      ],
      gallery: [
        {
          src: '/wp-content/uploads/alafiat/sediaan-minyak.jpg',
          alt: 'Lini kemasan VCO Al Afiat',
          caption: 'Pengemasan VCO.'
        },
        {
          src: '/wp-content/uploads/alafiat/preview-minyak-produk.webp',
          alt: 'Produk jadi botol pipet minyak herbal',
          caption: 'Botol pipet dan dus.'
        },
        {
          src: '/wp-content/uploads/alafiat/preview-qc-kemasan.jpg',
          alt: 'Inspeksi kualitas segel botol',
          caption: 'Pemeriksaan tutup botol.'
        }
      ],
      concepts: [
        { title: 'Virgin Coconut Oil (VCO)', desc: 'Minyak kelapa murni tanpa pemanasan untuk konsumsi atau oles.' },
        { title: 'Minyak zaitun & habbatus', desc: 'Minyak tunggal atau racikan herbal thibbun nabawi.' },
        { title: 'Minyak gosok hangat', desc: 'Cairan obat luar minyak atsiri, cengkeh, dan rempah sendi.' },
        { title: 'Minyak tetes pipet', desc: 'Botol pipet amber untuk konsentrat herbal oral maupun luar.' }
      ],
      details: [
        { title: 'Wadah anti bocor & pipet', desc: 'Botol amber, segel aluminium, atau roll-on.' },
        { title: 'Pilah obat dalam & oles', desc: 'Registrasi sesuai penggunaan produk.' },
        { title: 'Kontrol kejernihan & aroma', desc: 'Uji kejernihan, aroma, dan asam lemak bebas.' },
        { title: 'Penentu biaya batch', desc: 'Bahan baku, volume, dan aplikator.' }
      ]
    },
    lainnya: {
      tabLabel: 'Rajangan & Semi Padat',
      groupLabel: 'Sediaan Khusus CPOTB',
      title: 'Maklon Teh Rajangan & Semi Padat',
      summary: 'Teh celup, krim, salep, dan gel herbal.',
      specs: [
        { label: 'Izin', value: 'BPOM TR & Halal', accent: true },
        { label: 'MOQ', value: 'Menyesuaikan bahan', accent: true },
        { label: 'Kemasan', value: 'Kantong celup, pouch, pot, tube', accent: false },
        { label: 'Jalur', value: 'Custom R&D Formulasi', accent: false }
      ],
      gallery: [
        {
          src: '/wp-content/uploads/alafiat/preview-bahan-herbal.jpg',
          alt: 'Sortir simplisia herbal rajangan',
          caption: 'Penyortiran simplisia.'
        },
        {
          src: '/wp-content/uploads/alafiat/hero-maklon-alafiat.png',
          alt: 'Contoh wadah kemasan private label',
          caption: 'Contoh wadah produk.'
        },
        {
          src: '/wp-content/uploads/alafiat/fasilitas-cpotb.jpg',
          alt: 'Mesin lini produksi CPOTB',
          caption: 'Lini produksi CPOTB.'
        }
      ],
      concepts: [
        { title: 'Teh herbal rajangan celup', desc: 'Simplisia daun kelor, jati cina, atau rimpang seduh higienis.' },
        { title: 'Krim & salep herbal oles', desc: 'Sediaan oles herbal untuk perawatan kulit atau relaksasi otot.' },
        { title: 'Gel herbal cepat meresap', desc: 'Tekstur dingin menyegarkan tanpa residu lengket.' },
        { title: 'Riset formula kustom', desc: 'Pengembangan formula baru sesuai target pasar khusus Anda.' }
      ],
      details: [
        { title: 'Wadah kedap udara', desc: 'Kantong teh, pouch aluminium, pot, atau tube.' },
        { title: 'Sortir & kadar air simplisia', desc: 'Periksa kadar air dan risiko kapang.' },
        { title: 'Evaluasi sampel fisik', desc: 'Cek rasa seduhan atau tekstur krim.' },
        { title: 'Penentu biaya batch', desc: 'Bahan baku, kantong celup, dan wadah.' }
      ]
    }
  };

  document.addEventListener('DOMContentLoaded', function () {
    var stageEl = document.getElementById('preview-stage');
    var mainImgEl = document.getElementById('preview-main-img');
    var captionEl = document.getElementById('preview-caption');
    var thumbsContainer = document.getElementById('preview-thumbs');
    var groupLabelEl = document.getElementById('preview-group-label');
    var titleEl = document.getElementById('preview-title');
    var summaryEl = document.getElementById('preview-summary');
    var specsEl = document.getElementById('preview-specs');
    var conceptPickerEl = document.getElementById('preview-concept-picker');
    var conceptDescriptionEl = document.getElementById('preview-concept-description');
    var detailsListEl = document.getElementById('preview-details-list');
    var whatsappCtas = document.querySelectorAll('#preview-wa-cta, .alafiat-product-consultation .alafiat-product-cta');
    var tabButtons = Array.from(document.querySelectorAll('.cat-tab'));
    var singleViewer = document.querySelector('[data-alafiat-product-category]');

    if (!stageEl || !mainImgEl || (!titleEl && !singleViewer)) return;

    var activeConceptIdx = 0;

    function buildWhatsAppUrl(message) {
      var rawNumber = (window.ALFIAT_CONFIG && window.ALFIAT_CONFIG.whatsappNumber) || '6281234567890';
      var cleanNumber = rawNumber.replace(/[^\dX]/gi, '');
      return 'https://wa.me/' + cleanNumber + '?text=' + encodeURIComponent(message);
    }

    function setMainPhoto(photo) {
      if (!photo) return;
      if (mainImgEl.src !== new URL(photo.src, location.href).href) {
        mainImgEl.removeAttribute('srcset');
        mainImgEl.removeAttribute('sizes');
      }
      mainImgEl.src = photo.src;
      mainImgEl.alt = photo.alt;
      if (captionEl) captionEl.textContent = photo.caption || '';
    }

    function updateWaLinks(data) {
      var conceptTitle = (data.concepts[activeConceptIdx] || data.concepts[0]).title;
      var mainMsg =
        'Halo Tim Konsultan Maklon Al Afiat, saya sedang melihat katalog produk ' + data.title +
        ' (konsep: ' + conceptTitle + '). Mohon info detail sediaan, sampel, dan estimasi biaya maklonnya.';
      var url = buildWhatsAppUrl(mainMsg);
      whatsappCtas.forEach(function (cta) {
        cta.setAttribute('href', url);
        cta.setAttribute('target', '_blank');
        cta.setAttribute('rel', 'noopener noreferrer');
      });
    }

    function renderConceptPicker(data) {
      if (!conceptPickerEl) return;
      conceptPickerEl.innerHTML = '';
      data.concepts.forEach(function (concept, idx) {
        var btn = document.createElement('button');
        btn.type = 'button';
        btn.setAttribute('aria-pressed', idx === activeConceptIdx ? 'true' : 'false');
        btn.textContent = concept.title;
        btn.addEventListener('click', function () {
          activeConceptIdx = idx;
          Array.from(conceptPickerEl.children).forEach(function (option, index) {
            option.setAttribute('aria-pressed', index === idx ? 'true' : 'false');
          });
          if (conceptDescriptionEl) conceptDescriptionEl.textContent = concept.desc;
          updateWaLinks(data);
        });
        conceptPickerEl.appendChild(btn);
      });
      if (conceptDescriptionEl) conceptDescriptionEl.textContent = data.concepts[activeConceptIdx].desc;
    }

    function renderSpecs(data) {
      if (!specsEl) return;
      specsEl.innerHTML = '';
      data.specs.forEach(function (spec) {
        var div = document.createElement('div');
        div.className = 'py-3 border-b border-subtle flex flex-col justify-center';
        div.innerHTML =
          '<dt class="text-xs text-inkMuted">' + spec.label + '</dt>' +
          '<dd class="text-sm font-semibold mt-0.5 ' + (spec.accent ? 'text-oliveDark' : 'text-ink') + '">' + spec.value + '</dd>';
        specsEl.appendChild(div);
      });
    }

    function renderDetails(data) {
      if (!detailsListEl) return;
      detailsListEl.replaceChildren();
      data.details.forEach(function (detail) {
        var item = document.createElement('li');
        var title = document.createElement('h3');
        var description = document.createElement('p');
        title.textContent = detail.title;
        description.textContent = detail.desc;
        item.append(title, description);
        detailsListEl.appendChild(item);
      });
    }

    function switchCategory(key) {
      var data = PRODUCT_DATA[key];
      if (!data) return;
      if (singleViewer) {
        var productTitle = document.querySelector('.alafiat-product-page .wp-block-post-title');
        var gallery = data.gallery;
        if (mainImgEl.src !== new URL(gallery[0].src, location.href).href) {
          gallery = [{ src: mainImgEl.src, alt: mainImgEl.alt, caption: '' }].concat(gallery);
        }
        data = Object.assign({}, data, {
          title: productTitle ? productTitle.textContent.trim() : data.title,
          gallery: gallery
        });
      }
      activeConceptIdx = 0;

      tabButtons.forEach(function (btn) {
        var isActive = btn.dataset.categoryTab === key;
        btn.setAttribute('aria-pressed', isActive ? 'true' : 'false');
      });

      if (groupLabelEl) groupLabelEl.textContent = data.groupLabel;
      if (titleEl) titleEl.textContent = data.title.replace(/^Maklon /, '');
      if (summaryEl) summaryEl.textContent = data.summary;

      setMainPhoto(data.gallery[0]);

      if (thumbsContainer) {
        thumbsContainer.innerHTML = '';
        data.gallery.forEach(function (photo, idx) {
          var btn = document.createElement('button');
          btn.type = 'button';
          var selected = idx === 0;
          btn.setAttribute('aria-pressed', selected ? 'true' : 'false');
          btn.className = selected
            ? 'thumb-btn min-h-[64px] aspect-[4/3] rounded-[14px] overflow-hidden border-[2px] border-pine bg-soft transition-colors'
            : 'thumb-btn min-h-[64px] aspect-[4/3] rounded-[14px] overflow-hidden border border-subtle hover:border-pine bg-soft transition-colors';
          var img = document.createElement('img');
          img.src = photo.src;
          img.alt = photo.alt;
          img.className = 'w-full h-full object-cover';
          btn.appendChild(img);
          btn.addEventListener('click', function () {
            setMainPhoto(photo);
            thumbsContainer.querySelectorAll('.thumb-btn').forEach(function (t) {
              t.className = 'thumb-btn min-h-[64px] aspect-[4/3] rounded-[14px] overflow-hidden border border-subtle hover:border-pine bg-soft transition-colors';
              t.setAttribute('aria-pressed', t === btn ? 'true' : 'false');
            });
            btn.className = 'thumb-btn min-h-[64px] aspect-[4/3] rounded-[14px] overflow-hidden border-[2px] border-pine bg-soft transition-colors';
          });
          thumbsContainer.appendChild(btn);
        });
      }

      renderSpecs(data);
      renderConceptPicker(data);
      renderDetails(data);
      updateWaLinks(data);
      if (singleViewer) {
        singleViewer.querySelectorAll('div#varian-produk[hidden], .alafiat-catalog-details[hidden]').forEach(function (section) {
          section.hidden = false;
        });
      }
    }

    if (singleViewer) {
      switchCategory(singleViewer.dataset.alafiatProductCategory);
      return;
    }

    tabButtons.forEach(function (btn) {
      btn.addEventListener('click', function () {
        switchCategory(btn.dataset.categoryTab);
      });
    });

    // Preserve the legacy viewer when its shortcode is embedded on other pages.
    var urlParams = new URLSearchParams(window.location.search);
    var initCat = urlParams.get('sediaan');
    if (initCat && PRODUCT_DATA[initCat]) {
      switchCategory(initCat);
    } else {
      switchCategory('madu');
    }
  });
})();
