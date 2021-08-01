import anime from 'animejs/lib/anime.es.js';

const startIntro = () => {
  const intro = document.querySelector('[data-element="intro"]');
  const graphic = document.querySelector('[data-element="graphic"]');

  if (!intro) return;

  const tl = anime.timeline({
    easing: 'easeInQuad',
  });

  const polygon = graphic.firstElementChild;
  const delay = 200;

  tl.add({
    targets: graphic,
    opacity: 1,
    duration: 200,
    begin() {
      document.body.classList.add('fixed');
    }
  });

  tl.add({
    targets: polygon,
    keyframes: [
      { points: polygon.dataset.shape2, delay: 1400 },
      { points: polygon.dataset.shape3, delay },
      { points: polygon.dataset.shape4, delay },
      { points: polygon.dataset.shape5, delay },
    ],
    duration: 1400,
    easing: 'easeInOutQuad',
  });

  tl.add({
    targets: intro,
    opacity: 0,
    duration: 300,
    delay: 1000,
    begin() {
      document.body.classList.remove('fixed');
    }
  });

  tl.finished.then(() => {
    intro.style.display = 'none';
  });
}

export default startIntro;
