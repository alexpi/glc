<main id="main"
      class="container margin-right:0"
      data-barba="container"
      data-barba-namespace="items"
      data-type="<?= is_null($page->parent()) ? $page->id() : $page->parent()->id() ?>"
      data-element="main">
  <h1 class="sr-only"><?= $page->title() ?></h1>

  <?php if ($intro = $page->intro()): ?>
    <p class="intro-text t4"><?= $intro ?></p>
  <?php endif ?>

  <nav class="categories" aria-labelledby="<?= $page->title()->lower() ?>" data-element="categories" data-visible="false" data-state="closed">
    <button type="button" class="toggle t1" data-element="category-toggle" aria-label="Open category selector">
      <span id="<?= $page->title()->lower() ?>"><?= $page->title() ?></span>
      <div class="icon">
        <svg class="small-arrow" width="14" height="6" viewBox="0 0 14 6" fill="none">
          <path d="M1 5.2L7 1L13 5.2" />
        </svg>
      </div>
    </button>

    <div class="list t1" data-element="categories-list" data-barba-prevent="all">
      <button class="selected" data-category="all">All <span class="selector"></span></button>
      <?php foreach ($categories as $category): ?>
        <button data-category="<?= str_replace(' ', '-', $category->lower()) ?>">
          <?= $category ?>
          <span class="selector"></span>
        </button>
      <?php endforeach ?>
    </div>
  </nav>

  <div class="items" data-element="items">
    <div class="items-container" data-element="items-container">
      <?php if ($items->isNotEmpty()): ?>
        <?php foreach ($items as $item):
          $photo = $item->featured_photo()->toFile();
        ?>
          <article class="item"
                   data-element="item"
                   data-category="<?= str_replace(' ', '-', $item->category()->lower()) ?>"
                   data-orientation="<?= $photo->o() ?>">

            <a href="<?= $item->url() ?>">
              <div class="mask">
                <img srcset="<?= $photo->srcset([800, 1200, 1600]) ?>"
                     sizes="(max-width: 760px) 100vw, (max-width: 1360px) 50vw, 35vw"
                     src="<?= $photo->resize(1200)->url() ?>"
                     width="<?= $photo->w() ?>"
                     height="<?= $photo->h() ?>"
                     alt="<?= $photo->alt() ?>"
                     loading="<?= e($item->indexOf() > 3, 'lazy', 'auto') ?>">
              </div>

              <span class="heading t1 bold"><?= $item->title() ?></span>
              <span class="subheading t-1"><?= $item->category() ?></span>
            </a>
          </article>
        <?php endforeach ?>
      <?php endif ?>
    </div>
  </div>
</main>