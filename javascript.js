
// GSAP Animations
document.addEventListener("DOMContentLoaded", function () {
  gsap.set(".fab,.fas", { rotation: 540, x: -1500 });
  gsap.to(".fab,.fas", { rotation: 0, x: 0, duration: 3 });

  gsap.set(".box", { rotation: 540, x: 1500 });
  gsap.to(".box", { rotation: 0, x: 0, duration: 3 });
});  


// Typing Effect
const fullText = [
    { text: "I'm a ", class: "" },
    { text: "Web", class: "cyan" },
    { text: " Developer", class: "cyan" }
  ];

  const container = document.getElementById('autotype');
  let idx = 0;
  let partIdx = 0;
  let isDeleting = false;
  let delay = 100;

  function type() {
    container.innerHTML = '';

    let currentText = fullText.slice(0, partIdx + 1).map((part, i) => {
      let slicedText;
      if (i < partIdx) {
        slicedText = part.text;
      } else {
        slicedText = isDeleting 
          ? part.text.slice(0, idx--)
          : part.text.slice(0, ++idx);
      }
      return `<span class="${part.class}">${slicedText}</span>`;
    }).join('');

    container.innerHTML = currentText;

    const currentPart = fullText[partIdx];
    const fullPartLength = currentPart.text.length;

    if (!isDeleting && idx === fullPartLength) {
      if (partIdx === fullText.length - 1) {
        isDeleting = true;
        delay = 400;
      } else {
        partIdx++;
        idx = 0;
        delay = 150;
      }
    } else if (isDeleting && idx === 0) {
      if (partIdx === 0) {
        isDeleting = false;
        delay = 600;
      } else {
        partIdx--;
        idx = fullText[partIdx].text.length;
        delay = 50;
      }
    } else {
      delay = isDeleting ? 100 : 100;
    }

    setTimeout(type, delay);
  }

  type();

  // Navigation scroll & Intersection Observer
  const navLinks = document.querySelectorAll('.nav-link');

  navLinks.forEach(link => {
    link.addEventListener('click', function (e) {
      e.preventDefault();
      const targetSection = document.querySelector(this.getAttribute('href'));
      if (targetSection) {
        targetSection.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });

        navLinks.forEach(link => link.classList.remove('active'));
        this.classList.add('active');
      }
    });
  });

  const observerOptions = {
    root: null,
    threshold: 0.5
  };

  const navObserver = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      const link = document.querySelector(`.nav-link[href="#${entry.target.id}"]`);
      if (link) {
        if (entry.isIntersecting) {
          link.classList.add('active');
        } else {
          link.classList.remove('active');
        }
      }
    });
  }, observerOptions);

  document.querySelectorAll('section').forEach(section => {
    navObserver.observe(section);
  });

  document.getElementById('homeLink')?.addEventListener('click', function (e) {
    e.preventDefault();
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });

    navLinks.forEach(link => link.classList.remove('active'));
    this.classList.add('active');
  });

  window.addEventListener('scroll', function () {
    const navbar = document.querySelector('.navbar-custom');
    if (window.scrollY > 0) {
      navbar.classList.add('navbar-scrolled');
    } else {
      navbar.classList.remove('navbar-scrolled');
    }
  });

// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>




//   >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>


let scrollScheduled = false;

function onScroll() {
  if (!scrollScheduled) {
    scrollScheduled = true;
    requestAnimationFrame(() => {
      const fadeElements = document.querySelectorAll(
        '.fade-up, .fade-up-1, .fade-up-2, .fade-up-3, .fade-left, .fade-right, .fade-down, .fade-up-slow'
      );

      fadeElements.forEach((element) => {
        const rect = element.getBoundingClientRect();
        const buffer = 50; // trigger slightly earlier

        if (rect.top <= window.innerHeight - buffer && rect.bottom >= -buffer) {
          element.classList.add('visible');
        } else {
          element.classList.remove('visible');
        }
      });

      scrollScheduled = false;
    });
  }
}

window.addEventListener('scroll', onScroll);
