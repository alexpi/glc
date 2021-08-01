<?php if ($items_in_category): ?>
  <nav aria-label="pagination" class="pagination" data-element="pagination">
    <?php if ($page->hasPrev($items_in_category)): ?>
      <a class="t4 bold link prev" href="<?= $page->prev($items_in_category)->url() ?>">
        <svg role="presentation" class="arrow" width="36" height="75" viewBox="0 0 36 75" fill="none">
          <path d="M32 72L6 37.5L32 3" />
        </svg>
        <span><?= $page->prev($items_in_category)->title() ?></span>
      </a>
    <?php endif ?>

    <?php if ($page->hasNext($items_in_category)): ?>
      <a class="t4 bold link next" href="<?= $page->next($items_in_category)->url() ?>">
        <span><?= $page->next($items_in_category)->title() ?></span>
        <svg role="presentation" class="arrow" width="36" height="75" viewBox="0 0 36 75" fill="none">
          <path d="M4 72L30 37.5L4 3" />
        </svg>
      </a>
    <?php endif ?>
  </nav>
<?php endif ?>
