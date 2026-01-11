<?php
  $search_query = $_POST['filter'];
  $stmt = $connection->prepare('SELECT id, heading, subheading, img_folder, hero_lg, hero_sm FROM recipes WHERE filter LIKE ?');
  $search = "%{$search_query}%";
  $stmt->bind_param("s", $search);