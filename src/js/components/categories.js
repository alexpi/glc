import state from '../state.js';
import { getFocusableElements } from './../utils.js';
import anime from 'animejs/lib/anime.es.js';

const categoriesSelector = '[data-element="categories"]';
const categoriesListSelector = '[data-element="categories-list"]';
const toggleSelector = '[data-element="category-toggle"]';

const manageFocus = categories => {
  const focusableElements = getFocusableElements(categories);
  const toggle = document.querySelector(toggleSelector);

  switch (state.categoriesStatus) {
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

const showCategories = () => {
  const categories = document.querySelector(categoriesSelector);
  const itemsEl = document.querySelector('[data-element="items"]');

  const observer = new IntersectionObserver(entries => {
    if (entries[0].intersectionRatio > 0) {
      categories.dataset.visible = true;
      if (state.pageWidth === 'large') state.categoriesStatus = 'open';
    } else {
      categories.dataset.visible = false;
      if (state.pageWidth === 'small') state.categoriesStatus = 'closed';
    }
  }, { rootMargin: '-150px' })

  observer.observe(itemsEl);
}

const setSelectedCategory = () => {
  const categories = document.querySelector(categoriesListSelector);
  const buttons = [...categories.children];
  const currentCategoryButton = categories.querySelector(`[data-category="${state.category}"]`);

  buttons.forEach(button => button.classList.remove('selected'));
  currentCategoryButton.classList.add('selected');

  fetch('/category', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({'category': state.category})
  });
}

const processCategoriesState = (state, oldState = null) => {
  if (state.categoriesStatus === oldState.categoriesStatus) return;

  const categories = document.querySelector(categoriesSelector);
  const toggle = document.querySelector(toggleSelector);

  switch (state.categoriesStatus) {
    case 'open':
      categories.dataset.state = 'open';
      toggle.setAttribute('aria-expanded', 'true');
      toggle.setAttribute('aria-label', 'Close category selector');
      break;
    case 'closed':
      categories.dataset.state = 'closed';
      toggle.setAttribute('aria-expanded', 'false');
      toggle.setAttribute('aria-label', 'Open category selector');
      break;
  }

  manageFocus(categories);
}

const processCategorySelection = (state, oldState = null) => {
  if (state.category === oldState.category) return;

  setSelectedCategory();
  showCategory();
}

const showCategory = () => {
  const itemsEl = document.querySelector('[data-element="items"]');
  const itemsContainer = itemsEl.querySelector('[data-element="items-container"]');
  const itemsY = itemsEl.getBoundingClientRect().top;
  const itemsStyles = window.getComputedStyle(itemsContainer);
  const itemsMargin = itemsStyles.getPropertyValue('margin-top');
  const clonedItems = state.items.cloneNode(true);

  const filterItems = items => {
    items = [...items.children];
    if (state.category === 'all') return items;
    return items.filter(item => item.dataset.category === state.category);
  }

  const filteredItems = filterItems(clonedItems);
  const newContainer = document.createElement('div');
  const fragment = new DocumentFragment();

  newContainer.className = 'items-container';
  newContainer.dataset.element = 'items-container';

  filteredItems.forEach(item => fragment.appendChild(item));
  newContainer.appendChild(fragment);

  const animateFilter = (currentContainer, newContainer) => {
    newContainer.style.opacity = 0;

    const tl = anime.timeline({ duration: 200, easing: 'easeInOutQuad' });

    tl.add({
      targets: currentContainer,
      opacity: 0,
      complete() {
        itemsEl.appendChild(newContainer);
        window.scrollTo({
          top: itemsY + window.scrollY - parseInt(itemsMargin) + 2,
          behavior: 'auto'
        });
      }
    });

    tl.add({
      targets: newContainer,
      opacity: 1,

      begin() {
        currentContainer.remove();
      }
    });
  }

  if (state.itemsTransition) {
    animateFilter(itemsContainer, newContainer);
  } else {
    itemsEl.append(newContainer);
    itemsContainer.remove();
  }
}

const clickHandler = e => {
  if (e.target.closest(toggleSelector)) {
    state.categoriesStatus = state.categoriesStatus === 'open' ? 'closed' : 'open';
  }

  if (e.target.closest(categoriesListSelector)) {
    const button = e.target;
    const category = button.dataset.category;
    state.category = category;
  }
}

const focusHandler = () => {
  const categories = document.querySelector('[data-element="categories"]');

  if (categories
      && state.pageWidth === 'small'
      && !categories.contains(document.activeElement)) {
    state.categoriesStatus = 'closed';
  }
}

const initCategories = () => {
  const categories = document.querySelector(categoriesSelector);

  if (!categories) return;

  const subscribers = [processCategoriesState, processCategorySelection];

  subscribers.forEach(subscriber => {
    const subscribers = window.subscribers;
    if (!subscribers.includes(subscriber)) subscribers.push(subscriber);
  })

  showCategories();
  showCategory();
  setSelectedCategory();
  manageFocus(categories);

  document.addEventListener('click', clickHandler);
  document.addEventListener('focusin', focusHandler);
}

export default initCategories;
