<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GLC & Partners</title>

  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">

  <link rel="preload" href="<?= url('/assets/PFBagueSansPro-Regular.woff2') ?>" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="<?= url('/assets/PFBagueSansPro-Bold.woff2') ?>" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="<?= url('/assets/index.css') ?>" as="style">
  
  <?= css('/assets/index.css') ?>

  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 2rem;
    }
    
    .main {
      position: relative;
    }

    .text {
      margin-top: 1rem;
      
    }

    h1 {
      line-height: 0.85 !important;
    }

    p {
      margin-top: 0.3em;
      max-width: 40ch;
    }

    @media (min-width: 1200px) {
      .main {
        margin-right: 5vw;
      }

      .text {
        width: 150%;
        margin-top: 0;
        position: absolute;
        bottom: 15%;
        left: 50%;
      }
    }

    @media (min-width: 1880px) {
      .text {
        bottom: 13%;
      }
    }
  </style>
</head>
<body>
  <div class="main">
    <img src="<?= url('/assets/lockup.svg') ?>" alt="GLC logo plus blueprint shape">
    <div class="text">
      <h1 class="t4 bold"><?= $page->heading() ?></h1>
      <p class="t1"><?= $page->text()->kti() ?></p>
    </div>
  </div>
</body>
</html>
