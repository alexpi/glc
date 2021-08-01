const showButton = backButton => {
  const blocks = document.querySelector('.blocks');
  const pagination = document.querySelector('[data-element="pagination"]');

  const blocksObserver = new IntersectionObserver(entries => {
    if (entries[0].intersectionRatio > 0) {
      backButton.setAttribute('data-visible', true);
    } else {
      backButton.removeAttribute('data-visible');
    }
  })

  blocksObserver.observe(blocks);

  const paginationObserver = new IntersectionObserver(entries => {
    if (entries[0].intersectionRatio > 0) {
      backButton.removeAttribute('data-visible');
    } else {
      backButton.setAttribute('data-visible', true);
    }
  })

  paginationObserver.observe(pagination);
}

const itemBack = () => {
  const backButton = document.querySelector('[data-element="back"]');

  if (!backButton) return;

  showButton(backButton);
}

export default itemBack;
