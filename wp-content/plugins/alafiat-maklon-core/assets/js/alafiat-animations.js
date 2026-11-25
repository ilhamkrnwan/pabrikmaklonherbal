/**
 * Alafiat Maklon Herbal - GSAP Smooth Entrances & ScrollTrigger Animations
 */
(function () {
  'use strict';

  function initAlafiatAnimations() {
    if (typeof window.gsap === 'undefined') {
      return;
    }

    var gsap = window.gsap;
    var ScrollTrigger = window.ScrollTrigger;
    if (ScrollTrigger) {
      gsap.registerPlugin(ScrollTrigger);
    }

    var mm = gsap.matchMedia();

    mm.add('(prefers-reduced-motion: no-preference)', function () {
      var clearAll = 'transform,opacity,visibility';

      function revealElements(trigger, targets, opts) {
        var nodes = gsap.utils.toArray(targets).filter(function (el) {
          return el && !el.hidden && !el.classList.contains('hidden');
        });
        if (!nodes.length) {
          return null;
        }

        var triggerEl = typeof trigger === 'string' ? document.querySelector(trigger) : trigger;
        if (!triggerEl) {
          return null;
        }

        var config = Object.assign(
          {
            y: 22,
            autoAlpha: 0,
            duration: 0.58,
            ease: 'power2.out',
            stagger: 0.08,
            clearProps: clearAll
          },
          opts || {}
        );

        if (ScrollTrigger) {
          config.scrollTrigger = {
            trigger: triggerEl,
            start: 'top 86%',
            once: true
          };
        }

        return gsap.from(nodes, config);
      }

      // 1. Header & Hero Timeline
      var header = document.querySelector('.alafiat-wrapper > header');
      if (header) {
        gsap.from(header, {
          y: -10,
          autoAlpha: 0,
          duration: 0.45,
          ease: 'power2.out',
          clearProps: clearAll
        });
      }

      var hero = document.querySelector('#top, [data-alafiat-anchor="top"]');
      if (hero) {
        var heroTl = gsap.timeline({
          defaults: { duration: 0.6, ease: 'power3.out', clearProps: clearAll }
        });

        var heroHeading = hero.querySelector('h1');
        var heroCopy = hero.querySelector('> div:first-child p');
        var heroActions = hero.querySelectorAll('> div:first-child a');
        var heroBadges = hero.querySelectorAll('> div:first-child > div:first-child > div span');
        var heroMedia = hero.querySelector('> div:last-child img');
        var heroCaption = hero.querySelector('> div:last-child > div');

        if (heroHeading) heroTl.from(heroHeading, { y: 22, autoAlpha: 0 }, 0.05);
        if (heroCopy) heroTl.from(heroCopy, { y: 18, autoAlpha: 0 }, '-=0.42');
        if (heroActions.length) heroTl.from(heroActions, { y: 14, autoAlpha: 0, stagger: 0.08 }, '-=0.4');
        if (heroBadges.length) heroTl.from(heroBadges, { y: 10, autoAlpha: 0, stagger: 0.06, duration: 0.45 }, '-=0.35');
        if (heroMedia) heroTl.from(heroMedia, { scale: 1.04, autoAlpha: 0, duration: 0.75 }, 0.08);
        if (heroCaption) heroTl.from(heroCaption, { y: 12, autoAlpha: 0, duration: 0.45 }, '-=0.4');
      }

      // 2. Landing Sections Scroll Reveals
      revealElements('#sediaan', '#sediaan .sediaan-card', { stagger: 0.07 });
      revealElements('#jalur-maklon', '#jalur-maklon > div', { y: 24, stagger: 0.12 });
      revealElements('#proses', '#proses .alafiat-process-intro, #proses .alafiat-process-step', {
        y: 18,
        stagger: 0.08
      });
      revealElements('#sertifikat', '#sertifikat .alafiat-cert-card', { y: 18, stagger: 0.06 });
      revealElements('#mitra', '#mitra .alafiat-partner-card', { y: 16, stagger: 0.05 });
      revealElements('#testimoni', '#testimoni .alafiat-portfolio-card', { y: 18, stagger: 0.07 });
      revealElements('#faq', '#faq .faq-trigger', {
        y: 14,
        stagger: 0.06,
        duration: 0.45
      });
      revealElements('footer.alafiat-site-footer', 'footer.alafiat-site-footer', {
        y: 16,
        stagger: 0
      });

      // 3. Smooth Filter & FAQ Micro-Interactions
      var sediaanGrid = document.getElementById('sediaan-grid');
      if (sediaanGrid) {
        document.querySelectorAll('.tab-btn').forEach(function (btn) {
          btn.addEventListener('click', function () {
            window.requestAnimationFrame(function () {
              var visibleCards = Array.from(sediaanGrid.querySelectorAll('.sediaan-card')).filter(function (card) {
                return !card.hidden && !card.classList.contains('hidden');
              });
              if (visibleCards.length) {
                gsap.fromTo(
                  visibleCards,
                  { autoAlpha: 0, y: 12 },
                  {
                    autoAlpha: 1,
                    y: 0,
                    duration: 0.34,
                    stagger: 0.05,
                    ease: 'power2.out',
                    overwrite: 'auto',
                    clearProps: clearAll
                  }
                );
              }
            });
          });
        });
      }

      document.querySelectorAll('.faq-trigger').forEach(function (trigger) {
        trigger.addEventListener('click', function () {
          window.requestAnimationFrame(function () {
            var panelId = trigger.getAttribute('aria-controls');
            var panel = panelId ? document.getElementById(panelId) : null;
            if (panel && trigger.getAttribute('aria-expanded') === 'true') {
              gsap.fromTo(
                panel,
                { autoAlpha: 0, y: -6 },
                {
                  autoAlpha: 1,
                  y: 0,
                  duration: 0.28,
                  ease: 'power2.out',
                  overwrite: 'auto',
                  clearProps: clearAll
                }
              );
            }
          });
        });
      });

      // 4. Product Archive & Single Product Pages
      var archivePage = document.querySelector('.alafiat-product-archive');
      if (archivePage) {
        revealElements(archivePage, '.alafiat-archive-heading, .alafiat-archive-grid > li', {
          y: 18,
          stagger: 0.07
        });
        revealElements('.alafiat-archive-consultation', '.alafiat-archive-consultation', {
          y: 16,
          stagger: 0
        });
      }

      var singleProduct = document.querySelector('.alafiat-single-product');
      if (singleProduct) {
        gsap.from('.alafiat-product-media, .alafiat-single-info', {
          y: 18,
          autoAlpha: 0,
          duration: 0.55,
          stagger: 0.1,
          ease: 'power2.out',
          clearProps: clearAll
        });
        revealElements('.alafiat-catalog-details', '.alafiat-catalog-details', { y: 16, stagger: 0 });
        revealElements('.alafiat-product-consultation', '.alafiat-product-consultation', { y: 16, stagger: 0 });
        revealElements('.alafiat-product-related', '.alafiat-product-related .alafiat-archive-grid > li', {
          y: 18,
          stagger: 0.07
        });
      }

      if (ScrollTrigger) {
        window.addEventListener('load', function () {
          ScrollTrigger.refresh();
        }, { once: true });
      }
    });
  }

  function initAlafiatLightbox() {
    var selector = '.alafiat-wrapper img, .alafiat-product-page img, .alafiat-single-product img';
    var images = Array.from(document.querySelectorAll(selector)).filter(function (img) {
      return !img.closest('a, button, .alafiat-landing-logo, #preview-thumbs, .alafiat-zoom-modal');
    });

    if (!images.length) {
      return;
    }

    var modal = document.createElement('div');
    modal.id = 'alafiat-zoom-modal';
    modal.className = 'alafiat-zoom-modal';
    modal.setAttribute('role', 'dialog');
    modal.setAttribute('aria-modal', 'true');
    modal.setAttribute('aria-labelledby', 'alafiat-zoom-caption');
    modal.hidden = true;

    var closeBtn = document.createElement('button');
    closeBtn.type = 'button';
    closeBtn.className = 'alafiat-zoom-btn alafiat-zoom-close';
    closeBtn.setAttribute('aria-label', 'Tutup gambar');
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

    var stage = document.createElement('div');
    stage.className = 'alafiat-zoom-stage';

    var zoomImg = document.createElement('img');
    zoomImg.className = 'alafiat-zoom-img';
    zoomImg.alt = '';

    var caption = document.createElement('p');
    caption.id = 'alafiat-zoom-caption';
    caption.className = 'alafiat-zoom-caption';

    stage.appendChild(zoomImg);
    modal.append(closeBtn, prevBtn, stage, nextBtn, caption);
    document.body.appendChild(modal);

    var activeTrigger = null;
    var activeList = [];
    var activeIndex = 0;
    var prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var gsapRef = typeof window.gsap !== 'undefined' && !prefersReduced ? window.gsap : null;

    function getVisibleImages() {
      return images.filter(function (img) {
        return !img.closest('[hidden], .hidden');
      });
    }

    function showImageAt(idx) {
      if (!activeList.length) return;
      activeIndex = (idx + activeList.length) % activeList.length;
      var target = activeList[activeIndex];
      var src = target.currentSrc || target.getAttribute('src') || '';
      var alt = target.getAttribute('alt') || '';
      zoomImg.classList.remove('is-zoomed');
      zoomImg.src = src;
      zoomImg.alt = alt;
      caption.textContent = alt;
      caption.hidden = alt === '';
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
      closeBtn.focus();

      if (gsapRef) {
        gsapRef.fromTo(modal, { opacity: 0 }, { opacity: 1, duration: 0.2, ease: 'power2.out' });
        gsapRef.fromTo(
          zoomImg,
          { scale: 0.94, opacity: 0 },
          { scale: 1, opacity: 1, duration: 0.28, ease: 'power2.out', clearProps: 'transform,opacity' }
        );
      }
    }

    function closeLightbox() {
      if (modal.hidden) return;
      var finish = function () {
        modal.hidden = true;
        zoomImg.classList.remove('is-zoomed');
        document.body.style.overflow = '';
        if (activeTrigger && typeof activeTrigger.focus === 'function') {
          activeTrigger.focus();
        }
      };

      if (gsapRef) {
        gsapRef.to(modal, { opacity: 0, duration: 0.18, ease: 'power2.in', onComplete: finish });
      } else {
        finish();
      }
    }

    images.forEach(function (img) {
      img.setAttribute('data-alafiat-zoomable', 'true');
      img.setAttribute('role', 'button');
      img.setAttribute('tabindex', '0');
      if (!img.getAttribute('aria-label')) {
        img.setAttribute('aria-label', 'Perbesar gambar' + (img.alt ? ': ' + img.alt : ''));
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
      zoomImg.classList.toggle('is-zoomed');
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
      if (e.target === modal || e.target === stage) {
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

  function initAll() {
    initAlafiatAnimations();
    initAlafiatLightbox();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initAll);
  } else {
    initAll();
  }
})();
