<?php
  $search_query = $_POST['search'];
  $stmt = $connection->prepare('SELECT id, heading, subheading, img_folder, hero_lg, hero_sm
  FROM recipes
  WHERE heading LIKE ?
  OR subheading LIKE ?
  OR ingredients LIKE ?
  OR steps LIKE ?
  ');
  $search = "%{$search_query}%";
  $stmt->bind_param("ssss", $search, $search, $search, $search);