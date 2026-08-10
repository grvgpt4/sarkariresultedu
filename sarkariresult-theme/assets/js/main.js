/**
 * Sarkari Result Theme — minimal vanilla JS
 * Mobile menu, search toggle, TOC, back-to-top.
 */
(function () {
	'use strict';

	var doc = document;
	var i18n = (window.sreData && window.sreData.i18n) || {};

	function qs(sel, ctx) {
		return (ctx || doc).querySelector(sel);
	}

	function qsa(sel, ctx) {
		return Array.prototype.slice.call((ctx || doc).querySelectorAll(sel));
	}

	/* Mobile menu */
	function initMenu() {
		var toggle = qs('[data-sre-menu-toggle]');
		var nav = qs('[data-sre-nav]');
		if (!toggle || !nav) return;

		function setOpen(open) {
			nav.classList.toggle('is-open', open);
			toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
			toggle.setAttribute(
				'aria-label',
				open ? (i18n.menuClose || 'Close menu') : (i18n.menuOpen || 'Open menu')
			);
		}

		toggle.addEventListener('click', function () {
			setOpen(!nav.classList.contains('is-open'));
		});

		doc.addEventListener('keydown', function (e) {
			if (e.key === 'Escape' && nav.classList.contains('is-open')) {
				setOpen(false);
				toggle.focus();
			}
		});

		/* Close when clicking a link on mobile */
		nav.addEventListener('click', function (e) {
			var t = e.target;
			if (t && t.tagName === 'A' && window.matchMedia('(max-width: 959px)').matches) {
				setOpen(false);
			}
		});
	}

	/* Search panel */
	function initSearch() {
		var toggle = qs('[data-sre-search-toggle]');
		var panel = qs('[data-sre-search-panel]');
		if (!toggle || !panel) return;

		toggle.addEventListener('click', function () {
			var open = panel.hasAttribute('hidden');
			if (open) {
				panel.removeAttribute('hidden');
				toggle.setAttribute('aria-expanded', 'true');
				var input = qs('input[type="search"]', panel);
				if (input) input.focus();
			} else {
				panel.setAttribute('hidden', '');
				toggle.setAttribute('aria-expanded', 'false');
			}
		});

		doc.addEventListener('keydown', function (e) {
			if (e.key === 'Escape' && !panel.hasAttribute('hidden')) {
				panel.setAttribute('hidden', '');
				toggle.setAttribute('aria-expanded', 'false');
				toggle.focus();
			}
		});
	}

	/* TOC toggle */
	function initToc() {
		qsa('[data-sre-toc-toggle]').forEach(function (btn) {
			var nav = btn.closest('.sre-toc');
			if (!nav) return;
			btn.addEventListener('click', function () {
				var collapsed = nav.classList.toggle('is-collapsed');
				btn.setAttribute('aria-expanded', collapsed ? 'false' : 'true');
				btn.textContent = collapsed ? 'Show' : 'Hide';
			});
		});
	}

	/* Back to top */
	function initBackTop() {
		var btn = qs('[data-sre-back-top]');
		if (!btn) return;

		function onScroll() {
			if (window.scrollY > 600) {
				btn.removeAttribute('hidden');
			} else {
				btn.setAttribute('hidden', '');
			}
		}

		window.addEventListener('scroll', onScroll, { passive: true });
		btn.addEventListener('click', function () {
			window.scrollTo({ top: 0, behavior: 'smooth' });
		});
		onScroll();
	}

	/* Sticky submenu keyboard: already CSS focus-within */

	doc.addEventListener('DOMContentLoaded', function () {
		initMenu();
		initSearch();
		initToc();
		initBackTop();
	});
})();
