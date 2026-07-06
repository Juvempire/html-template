(function () {
  const toggle = document.querySelector('.menu-toggle');
  const nav = document.querySelector('.primary-navigation');
  if (toggle && nav) {
    toggle.addEventListener('click', function () {
      const open = nav.classList.toggle('is-open');
      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
  }

  document.querySelectorAll('a[href="#top"]').forEach(function (link) {
    link.addEventListener('click', function (event) {
      event.preventDefault();
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  });
})();
