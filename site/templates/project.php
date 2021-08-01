<?php snippet('header') ?>

<main id="main"
      data-barba="container"
      data-barba-namespace="item"
      data-type="<?= $page->parent()->id() ?>"
      data-element="main">
  <a href="<?= $page->parent()->url() ?>" class="back" data-element="back">
    <span class="t0 bold">back</span>
  </a>

  <div class="container">
    <section class="item-intro">
      <h1 class="t6 bold"><?= $page->title() ?></h1>

      <?php if ($intro = $page->intro()): ?>
        <p class="description t2"><?= $intro ?></p>
      <?php endif ?>

      <dl class="data">
        <div>
          <dt class="t0">Location</dt>
          <dd class="t1 bold"><?= $page->location() ?></dd>
        </div>

        <div>
          <dt class="t0">Date</dt>
          <dd class="t1 bold"><?= $page->date() ?></dd>
        </div>

        <div>
          <dt class="t0">Type</dt>
          <dd class="t1 bold"><?= $page->category() ?></dd>
        </div>
      </dl>
    </section>
  </div>

  <div class="blocks">
    <?php foreach ($page->main_content()->toBlocks() as $block): ?>
      <div class="block block-type-<?= $block->type() ?> <?= $block->images()->isNotEmpty() ? $block->images()->toFiles()->first()->orientation() : '' ?>">
        <?= $block ?>
      </div>
    <?php endforeach ?>
  </div>

  <?php snippet('pagination') ?>
</main>

<?php snippet('footer') ?>