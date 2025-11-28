<?php
  require_once 'db.php';

  if(isset($_POST['search'])) {
    $search_query = $_POST['search'];
    $stmt = $connection->prepare('SELECT id, heading, subheading, img_folder, hero_lg, hero_sm FROM recipes
    WHERE heading LIKE ?
    OR subheading LIKE ?
    OR ingredients LIKE ?
    OR steps LIKE ?
    ');

    $search = "%{$search_query}%";
    $stmt->bind_param("ssss", $search, $search, $search, $search);
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
  <link rel="stylesheet" href="/styles/styles.css">
  <link rel="stylesheet" href="/styles/queries.css">
</head>
<body>
  <header>
    <a id="home-icon" href="index.php">Cookbook</a>
    <div id="search-bar">
      <img id="search-icon" src="/assets/icons/search-icon.svg" alt="Search icon">
      <form method="post">
        <input id="search-input" name="search" placeholder="Find a new recipe..." type="text">
        <input type="submit" hidden />
      </form>
    </div>
  </header>
  <main>
    <div id="search-bar-mobile">
      <img id="search-icon" src="/assets/icons/search-icon.svg" alt="Search icon">
      <form method="post">
        <input id="search-input" name="search" placeholder="Find a new recipe..." type="text">
        <input type="submit" hidden />
      </form>
    </div>
    <aside>
      <h3>Filters</h3>
      <form method="post">
        <button class="filter-button" name="search" value="beef">
          Beef
        </button>
        <button class="filter-button" name="search" value="chicken">
          Chicken
        </button>
        <button class="filter-button" name="search" value="fish">
          Fish
        </button>
        <button class="filter-button" name="search" value="pork">
          Pork
        </button>
        <button class="filter-button" name="search" value="steak">
          Steak
        </button>
        <button class="filter-button" name="search" value="turkey">
          Turkey
        </button>
        <button class="filter-button" name="search" value="vegetarian">
          Vegetarian
        </button>
      </form>
      <?php print_r($stmt->fetch()) ?>
    </aside>
    <div class="recipe-grid">
      <?php
        if(isset($no_results)) {
          echo "<h3>$no_results</h3>";
        }
        while ($stmt->fetch()) : ?>
          <a class='recipe-card-link' href='/recipe.php?id=<?php echo $id ?>'>
            <div class='recipe-card'>
              <picture>
                <source media="(min-width:980px)" srcset="<?php echo "/assets/images/$img_folder/$hero_lg" ?>">
                <img src="<?php echo "/assets/images/$img_folder/$hero_sm"  ?>" alt='Hero image'>
              </picture>
              <div class='recipe-details'>
                <p class='recipe-title'><?php echo $heading ?></p>
                <p class='recipe-title-secondary'><?php echo $subheading ?></p>
              </div>
            </div>
          </a>
      <?php endwhile ?>
    </div>
  </main>
</body>
</html>
