<?php

/************************************************************************\
|                           Access Control List                          |
\************************************************************************/

// route => [authorized roles] 
// route = route which need controled access
// authorized roles = user's code
// 0 -> user
// 1 -> administrator


$controlList = [
  // Routes/Backoffice/main
  'backoffice-main-home' => ['1'],
  // Routes/Backoffice/category
  'backoffice-category-list' => ['1'],
  'backoffice-category-add' => ['1'],
  'backoffice-category-add-post' => ['1'],
  'backoffice-category-update' => ['1'],
  'backoffice-category-update-post' => ['1'],
  'backoffice-category-delete' => ['1'],
  'backoffice-category-delete-post' => ['1'],
  // Routes/Backoffice/user
  'backoffice-user-list' => ['1'],
  'backoffice-user-update' => ['1'],
  'backoffice-user-update-post' => ['1'],
  // Routes/Frontoffice/user
];