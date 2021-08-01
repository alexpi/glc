<?php $photo = $page->photo()->toFile(); ?>

<?php snippet('header') ?>

<main id="main" data-barba="container" data-barba-namespace="office">
  <div class="container grid-2-col max-width-medium">
    <section class="about">
      <h1 class="sr-only">The company</h1>

      <p class="t3"><?= $page->about() ?></p>

      <img class="office"
           srcset="<?= $photo->srcset([800, 1200, 1600]) ?>"
           sizes="(min-width: 960px) 50vw, (min-width: 1360px) 35vw, (min-width: 2100px) 30vw, 100vw"
           src="<?= $photo->url() ?>"
           width="<?= $photo->w() ?>"
           height="<?= $photo->h() ?>"
           alt="<?= $photo->alt() ?>">
    </section>

    <div>
      <section class="expertise">
        <h2 class="t3 bold">Our expertise</h2>

        <div class="t1">
          <?= $page->expertise()->kirbytext() ?>
        </div>
      </section>

      <section class="services">
        <h2 class="t3 bold">Services</h2>

        <div>
          <?php foreach($page->services()->toStructure() as $service): ?>
            <article class="service">
              <h3 class="t1"><?= $service->service() ?></h3>
              <p class="t0"><?= $service->description() ?></p>
            </article>
          <?php endforeach ?>
        </div>
      </section>
    </div>
  </div>

  <section class="team container max-width-medium">
    <h2 class="t5 bold">The team</h2>

    <div class="content">
      <?php foreach ($page->team()->toStructure() as $person):
        $photo = $person->photo()->toFile() ?>
        <article class="person">
          <?php if ($photo): ?>
            <div>
              <img class="photo"
                  srcset="<?= $photo->srcset([800, 1200, 1600]) ?>"
                  sizes="(min-width: 465px) 50vw, (min-width: 725px) 33vw, (min-width: 1176px) 28vw, (min-width: 1360px) 22vw, (min-width: 1600px) 14vw, 100vw"
                  src="<?= $photo->url() ?>"
                  width="<?= $photo->w() ?>"
                  height="<?= $photo->h() ?>"
                  alt="<?= $photo->alt() ?>"
                  loading="lazy">
            </div>
          <?php endif ?>

          <div class="info">
            <h3 class="t1 bold name"><?= $person->name() ?></h3>
            <p class="t0 role"><?= $person->role() ?></p>
          </div>
        </article>
      <?php endforeach ?>
    </div>
  </section>

  <section class="cta container max-width-medium">
    <div class="info">
      <div>
        <h2 class="t5 bold"><?= $page->contact_headline() ?></h2>
        <p class="t0"><?= $page->contact_text() ?></p>
      </div>
    </div>

    <div class="module first">
      <a class="t0 bold" href="mailto:<?= $site->email() ?>"><?= $site->email() ?></a>
    </div>

    <div class="module">
      <a class="t0 bold" href="tel:<?= str_replace(' ', '', $site->phone()) ?>"><?= $site->phone() ?></a>
    </div>
  </section>
</main>

<?php snippet('footer') ?>