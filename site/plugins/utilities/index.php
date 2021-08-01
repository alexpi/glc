<?php

function printTitle($page) {
  $title = site()->title();
  return e($page->isHomePage(), $title, $title . ' | ' . $page->title());
};

function getFirstSentence($content) {
  $pos = strpos($content, '.');
  return substr($content, 0, $pos + 1);
}