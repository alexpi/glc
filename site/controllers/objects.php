<?php

return function($site, $page) {
  $description = getFirstSentence($page->intro());
  $social_image = $site->social_image();

  if ($social_image->isNotEmpty()) {
    $social_image = $social_image->toFile()->crop(1200, 628)->url();
  }
  
  $categories = $page->children()->published()->pluck('category', null, true);
  $items = $page->children()->published();

  return [
    'description' => $description,
    'social_image' => $social_image,
    'categories' => $categories,
    'items' => $items
  ];
};