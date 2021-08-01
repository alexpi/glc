<?php

return function($site, $page) {
  $description = getFirstSentence($page->about());
  $social_image = $site->social_image();

  if ($social_image->isNotEmpty()) {
    $social_image = $social_image->toFile()->crop(1200, 628)->url();
  }

  return [
    'description' => $description,
    'social_image' => $social_image,
  ];
};