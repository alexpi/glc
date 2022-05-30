<?php if (page('maintenance')->active()->toBool() && !$kirby->user() && $page->uid() != 'maintenance') { go('maintenance');} ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= printTitle($page) ?></title>

  <meta name="title" content="<?= printTitle($page) ?>">
  <meta name="description" content="<?= $description ?>">

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?= $page->url() ?>">
  <meta property="og:title" content="<?= printTitle($page) ?>">
  <meta property="og:description" content="<?= $description ?>">
  <meta property="og:image" content="<?= $social_image ?>">

  <!-- Twitter -->
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:url" content="<?= $page->url() ?>">
  <meta property="twitter:title" content="<?= printTitle($page) ?>">
  <meta property="twitter:description" content="<?= $description ?>">
  <meta property="twitter:image" content="<?= $social_image ?>">

  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">

  <link rel="preload" href="<?= url('/assets/PFBagueSansPro-Regular.woff2') ?>" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="<?= url('/assets/PFBagueSansPro-Bold.woff2') ?>" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="<?= Bnomei\Fingerprint::url('/assets/index.css') ?>" as="style">
  <link rel="preload" href="<?= Bnomei\Fingerprint::url('/assets/app.js') ?>" as="script">

  <link href="<?= Bnomei\Fingerprint::url('/assets/index.css') ?>" rel="stylesheet">
  <script src="<?= Bnomei\Fingerprint::url('/assets/app.js') ?>" defer></script>
</head>
<body data-barba="wrapper" data-scroll>
  <a href="#main" class="skip-link">Skip to content</a>

  <div class="wrapper">
    <?php if ($page->isHomePage()): ?>
      <div class="intro" data-element="intro">
        <svg class="graphic" data-element="graphic" viewBox="0 0 800 480" fill="none">
          <polygon
            stroke="#EF3340"
            points="248,79 356,79 465,79 574,79 574,187 574,296 574,405 465,405 356,405 248,405 248,296 248,187"
            data-shape2="152,161 430,161 430,42 647,42 647,174 647,136 647,438 480,438 327,438 327,363 152,363 152,262"
            data-shape3="98,210 450,210 450,41 702,41 702,162 702,283 702,405 584,405 584,340 269,340 203,439 98,439"
            data-shape4="98,41 264,41 383,162 702,162 702,206 702,251 702,295 702,340 552,340 383,340 383,439 98,439"
            data-shape5="102,66 268,66 516,66 698,66 698,182 698,298 698,414 499,414 499,245 300,245 300,414 102,414"
          />
        </svg>
      </div>
    <?php endif ?>

    <header class="header" data-element="header">
      <div class="logo-container">
        <a href="/" class="logo" data-element="logo">
          <img src="<?= url('assets/logo.svg') ?>" width="197" height="178" alt="GLC & Partners logo">
        </a>

        <a class="espa" href="<?= url('assets/glc.pdf') ?>" target="_blank" rel="noopener noreferrer">
          <img src="<?= url('assets/espa.jpg') ?>" alt="ESPA graphic">
        </a>
      </div>
      

      <nav class="nav" role="navigation" data-element="nav" data-nav-state="closed">
        <button type="button" class="nav-toggle" data-element="toggle">
          <div class="bar"></div>
          <div class="bar"></div>
          <div class="menu">menu</div>
        </button>

        <div class="nav-pane" data-element="nav-pane">
          <ul class="t5 bold pages">
            <?php foreach ($pages->listed() as $page): ?>
              <li><a href="<?= $page->url() ?>"><?= $page->title() ?></a></li>
            <?php endforeach ?>
          </ul>

          <address>
            <ul class="t1 bold contact">
              <li><a href="mailto:<?= $site->email() ?>"><?= $site->email() ?></a></li>
              <li><a href="tel:<?= str_replace(' ', '', $site->phone()) ?>"><?= $site->phone() ?></a></li>
              <li><?= $site->address() ?></li>
            </ul>

            <a class="t-1 bold map" href="<?= $site->google_map() ?>" target="_blank" rel="noopener noreferrer">view on map</a>
          </address>

          <ul class="t1 bold social">
            <li><a href="<?= $site->facebook() ?>" target="_blank" rel="noopener noreferrer">facebook</a></li>
            <li><a href="<?= $site->instagram() ?>" target="_blank" rel="noopener noreferrer">instagram</a></li>
          </ul>
        </div>
      </nav>
    </header>