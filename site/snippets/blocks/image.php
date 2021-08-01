<?php
  $first_block_id = $page->main_content()->toBlocks()->first()->id();
  $block_id = $block->id();
  $image   = $block->image()->toFile();
  $alt     = $block->alt();
  $caption = $block->caption();
  $src     = $image->resize(1200)->url();
  $width   = $block->width();
  $sizes_l = null;
  $sizes_p = "(min-width: 500px) 50vw, (min-width: 1360px) 35vw, 100vw";

  switch ($width) {
    case "full":
      $sizes_l = "100vw";
      break;
    case "normal":
      $sizes_l = "(min-width: 1360px) 60vw, 100vw";
      break;
    case "small":
      $sizes_l = "(min-width: 1360px) 40vw, 100vw";
      break;
  }
?>

<?php if ($src): ?>
  <figure
    class="<?= $width ?>"
    data-orientation="<?= $image->o() ?>">
    <img srcset="<?= $image->srcset([800, 1200, 1600, 2000, 2800]) ?>"
         sizes="<?= e($image->o() == 'landscape', $sizes_l, $sizes_p) ?>"
         src="<?= $src ?>"
         width="<?= $image->w() ?>"
         height="<?= $image->h() ?>"
         alt="<?= $alt ?>"
         <?= e($block_id != $first_block_id, 'loading="lazy"') ?>>

    <?php if ($caption->isNotEmpty()): ?>
      <figcaption><?= $caption ?></figcaption>
    <?php endif ?>
  </figure>
<?php endif ?>