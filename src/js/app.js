import initBarba from './barba.js';
import startIntro from './components/intro.js';
import headerHideReveal from './components/header.js';
import initNav from './components/nav.js';
import itemBack from './components/back.js';
import state from './state.js';

const logoLink = document.querySelector('[data-element="logo"]');
const origin = window.location.origin;

logoLink.addEventListener('click', e => {
  if (window.location.origin === origin) e.preventDefault();
})

const observePageSize = minWidth => {
  const observer = new ResizeObserver(observedItems => {
    const { contentRect } = observedItems[0];

    state.pageWidth = contentRect.width < minWidth ? 'small' : 'large';
  });

  observer.observe(document.body);
}

observePageSize(1360);
initBarba();
startIntro();
headerHideReveal();
initNav();
itemBack();

const items = document.querySelector('[data-element="items-container"]');
if (items) state.items = items;

// initCategories();
