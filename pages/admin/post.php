<?php

$template = "admin-post";
$file = "post";
$allPosts = loadAllPosts();
$allCategories = loadAllCategories();

require "templates/admin/admin-layout.phtml";

?>