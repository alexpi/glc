import { debounce } from './../utils.js';

const body = document.body;

const setHideRevealState = (state, oldState = null) => {
  if (state.pageWidth === oldState.pageWidth) {
    return;
  }

  if (state.pageWidth === 'small') {
    window.addEventListener('scroll', scrollHandler);
  } else {
    window.removeEventListener('scroll', scrollHandler);
    body.removeAttribute('data-scroll');
  }
}

let lastScroll = 0;

const scrollHandler = () => {
  debounce(() => {
    const currentScroll = window.pageYOffset - 100;

    if (currentScroll <= 0) {
      body.dataset.scroll = 'top';
      return;
    }

    if (currentScroll > lastScroll) {
      body.dataset.scroll = 'down';
    } else if (currentScroll < lastScroll) {
      body.dataset.scroll = 'up';
    }

    lastScroll = currentScroll;
  }, 50)();
}

const headerHideReveal = minWidth => {
  window.subscribers.push(setHideRevealState);
}

export default headerHideReveal;
