<?php
  $first_block_id = $page->main_content()->toBlocks()->first()->id();
  $block_id = $block->id();
?>

<figure>
  <ul>
    <?php foreach ($block->images()->toFiles() as $image): ?>
    <li>
      <img srcset="<?= $image->srcset([800, 1200, 1600]) ?>"
          sizes="(min-width: 500px) 50vw, (min-width: 1360px) <?= $image->o() == 'landscape' ? '35vw' : '30vw' ?>, 100vw"
          src="<?= $image->resize(1200)->url() ?>"
          width="<?= $image->w() ?>"
          height="<?= $image->h() ?>"
          alt="<?= $image->alt() ?>"
          <?= e($block_id != $first_block_id, 'loading="lazy"') ?>>
    </li>
    <?php endforeach ?>
  </ul>
</figure>