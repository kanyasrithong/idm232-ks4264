<?php
  require_once 'db.php';

  if(isset($_POST['filter']) or isset($_POST['search'])) {
    if (isset($_POST['filter'])) {
      $search_query = $_POST['filter'];
      $stmt = $connection->prepare('SELECT id, heading, subheading, img_folder, hero_lg, hero_sm FROM recipes WHERE filter LIKE ?');
      $search = "%{$search_query}%";
      $stmt->bind_param("s", $search);
    } else {
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
    }

    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows === 0) {
        $no_results = "No results found, try again.";
    } else {
      $stmt->bind_result( $id,$heading, $subheading, $img_folder, $hero_lg, $hero_sm);
    }
  } else {
    $stmt = $connection->prepare('SELECT id, heading, subheading, img_folder, hero_lg, hero_sm FROM recipes');
    $stmt->execute();
    $stmt->bind_result( $id, $heading, $subheading, $img_folder, $hero_lg, $hero_sm);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cookbook</title>
  <link rel="icon" href="assets/favicon.jpg">
  <link rel="stylesheet" href="styles/styles.css">
  <link rel="stylesheet" href="styles/queries.css">
</head>
<body>
  <?php include 'components/header.php'; ?>
  <main>
    <div id="search-bar-mobile">
      <img id="search-icon" src="assets/icons/search-icon.svg" alt="Search icon">
      <form method="post">
        <input id="search-input" name="search" placeholder="Find a new recipe..." type="text">
        <input type="submit" hidden />
      </form>
    </div>
    <aside>
      <h3>Filters</h3>
      <form method="post">
        <button class="filter-button" name="filter" value="beef">
          Beef
        </button>
        <button class="filter-button" name="filter" value="pork">
          Pork
        </button>
        <button class="filter-button" name="filter" value="poultry">
          Poultry
        </button>
        <button class="filter-button" name="filter" value="seafood">
          Seafood
        </button>
        <button class="filter-button" name="filter" value="vegetarian">
          Vegetarian
        </button>
      </form>
    </aside>
    <div class="recipe-grid">
      <?php
        if(isset($no_results)) {
          echo "<h3>$no_results</h3>";
        }
        while ($stmt->fetch()) : ?>
          <?php include 'components/recipe-card.php'; ?>
      <?php endwhile ?>
    </div>
  </main>
</body>
</html>
