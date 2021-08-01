import barba from '@barba/core';
import barbaRouter from '@barba/core';
import anime from 'animejs/lib/anime.es.js';
import state from './state.js';
import initCategories from './components/categories.js';
import itemBack from './components/back.js';

const fadeTransition = async (page, opacity) => {
  return await anime({
    targets: page.container,
    opacity,
    duration: 200,
    easing: 'linear',
  }).finished
}

const routes = [{
  path: '/projects/:id',
  name: 'project'
}, {
  path: '/objects/:id',
  name: 'object'
}];

barba.use(barbaRouter, { routes });

barba.hooks.beforeEnter(({ current }) => {
  window.scrollTo({ top: 0, behavior: 'instant' });
  if (current.container) current.container.remove();
});

const initBarba = () => {
  barba.init({
    timeout: 5000,
    cacheIgnore: ['/projects/:id', '/objects/:id'],
    prefetchIgnore: true,
    views: [
      {
        namespace: 'items',
        beforeEnter({ current, next }) {
          state.items = next.container.querySelector('[data-element="items-container"]');

          if (current.namespace === 'item') {
            window.scrollTo({ top: state.itemsScroll, behavior: 'instant' })
          }

          if (current.namespace !== 'item') {
            state.itemsTransition = false;
            state.category = 'all';
          }

          if (current.container) {
            let currentItemsType = current.container.dataset.type;
            let nextItemsType = next.container.dataset.type;

            if (currentItemsType !== nextItemsType) {
              window.scrollTo({ top: 0, behavior: 'instant' });
              state.category = 'all';
            }
          }

          initCategories();
          state.itemsTransition = true;
        },
        beforeLeave() {
          state.itemsScroll = window.scrollY;
        },
      },
      {
        namespace: 'item',
        beforeEnter() {
          itemBack();
        },
        afterLeave({ next }) {
          if (next.namespace === 'items') state.itemsTransition = false;
        }
      }
    ],
    transitions: [{
      name: 'default-transition',
      async leave({ current }) {
        await fadeTransition(current, 0);
      },
      async enter({ next }) {
        await fadeTransition(next, [0, 1]);
      }
    }]
  });
}

export default initBarba;
