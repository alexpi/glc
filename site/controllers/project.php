<?php

return function($pages, $page) {
  $description = getFirstSentence($page->intro());
  $social_image = $page->featured_photo()->toFile()->crop(1200, 628)->url();
  $category = kirby()->session()->get('category');
  $children = $page->parent()->children();

  $items_in_category = $children->filter(function($child) use ($category) {
    if ($category == 'all') {
      return true;
    } else {
      return str_replace(' ', '-', $child->category()->lower()) == $category;
    }
  })->published();

  return [
    'description' => $description,
    'social_image' => $social_image,
    'items_in_category' => $items_in_category
  ];
};