import state from '../state.js';
import { getFocusableElements } from './../utils.js';

const body = document.body;
const toggleSelector = '[data-element="toggle"]';
const navSelector = '[data-element="nav"]';
const toggle = document.querySelector(toggleSelector);
const nav = document.querySelector(navSelector);
const navPane = document.querySelector('[data-element="nav-pane"]')
const focusableElements = getFocusableElements(navPane);

const manageFocus = focusableElements => {
  switch (state.navStatus) {
    case 'open':
      focusableElements.forEach(element => element.removeAttribute('tabindex'));
    break;
    case 'closed':
      [...focusableElements]
        .filter(element => element !== toggle)
        .forEach(element => element.setAttribute('tabindex', '-1'));
    break;
  }
};

const processNavState = (state, oldState = null) => {
  if (state.navStatus === oldState.navStatus) return;

  manageFocus(focusableElements);

  switch (state.navStatus) {
    case 'open':
      nav.dataset.navState = 'open';
      toggle.setAttribute('aria-expanded', 'true');
      toggle.setAttribute('aria-label', 'Close menu');

      if (state.pageWidth === 'small') {
        body.classList.add('disable-scroll');
      }
    break;
    case 'closed':
      nav.dataset.navState = 'closed';
      toggle.setAttribute('aria-expanded', 'false');
      toggle.setAttribute('aria-label', 'Open menu');

      body.classList.remove('disable-scroll');
    break;
  }
};

const initNav = () => {
  window.subscribers.push(processNavState);
  manageFocus(focusableElements);

  document.addEventListener('click', e => {
    if (e.target.closest(toggleSelector)) {
      state.navStatus = state.navStatus === 'closed' ? 'open' : 'closed';
    }

    if (e.target.tagName === 'A' && e.target.closest('.pages')) {
      e.preventDefault();
      state.navStatus = 'closed';
    }

    if (!e.target.closest(navSelector) && !e.target.closest(toggleSelector)) {
      state.navStatus = 'closed';
    }
  });

  document.addEventListener('focusin', () => {
    if (!nav.contains(document.activeElement)) {
      state.navStatus = 'closed';
    }
  });
}

export default initNav;
