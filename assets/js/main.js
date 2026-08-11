(() => {
  const nav = document.querySelector(".main-nav");
  const toggle = document.querySelector(".nav-toggle");

  if (nav && toggle) {
    toggle.addEventListener("click", () => {
      const open = nav.classList.toggle("is-open");
      toggle.setAttribute("aria-expanded", open ? "true" : "false");
      toggle.setAttribute("aria-label", open ? "Close menu" : "Open menu");
    });

    nav.querySelectorAll(".nav-list a").forEach((link) => {
      link.addEventListener("click", () => {
        nav.classList.remove("is-open");
        toggle.setAttribute("aria-expanded", "false");
        toggle.setAttribute("aria-label", "Open menu");
      });
    });
  }

  const sections = document.querySelectorAll(
    ".feature-grid, .triple-cols, .rrb-grid, .states, .qualify, .about-strip, .info-blocks, .about-faq"
  );
  sections.forEach((el) => el.classList.add("reveal"));

  if ("IntersectionObserver" in window) {
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("is-visible");
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.12, rootMargin: "0px 0px -40px 0px" }
    );
    sections.forEach((el) => observer.observe(el));
  } else {
    sections.forEach((el) => el.classList.add("is-visible"));
  }
})();
