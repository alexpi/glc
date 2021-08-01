window.subscribers = [];

const defaultState = {
  introPlayed: false,
  pageWidth: document.body.clientWidth < 1360 ? 'small' : 'large',
  navStatus: 'closed',
  categoriesStatus: 'closed',
  category: 'all',
  items: null,
  itemsTransition: true
}

const state = new Proxy(typeof defaultState !== 'undefined' ? defaultState : {}, {
  set(state, key, value) {
    const oldState = {...state};

    state[key] = value;

    window.subscribers.forEach(callback => callback(state, oldState));

    return state;
  }
});

export default state;
