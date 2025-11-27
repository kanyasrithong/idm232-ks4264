<?php
  require_once 'db.php';

  if(isset($_GET['search'])) {
    $stmt = $connection->prepare('SELECT * FROM recipes WHERE heading, subheading, steps');

  } else {
    $stmt = $connection->prepare('SELECT * FROM recipes');
    $stmt->execute();
    $result = $stmt->get_result();
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
      <form action="/index.php" method="post">
        <input id="search-input" placeholder="Find a new recipe..." type="text">
      </form>
    </div>
  </header>
  <main>
    <div id="search-bar-mobile">
      <img id="search-icon" src="/assets/icons/search-icon.svg" alt="Search icon">
      <form method="post">
        <input id="search-input" placeholder="Find a new recipe..." type="text">
      </form>
    </div>
    <aside>
      <h3>Filters</h3>
      <a class="filter-button" href="/index.php?search=beef">
        Beef
      </a>
      <a class="filter-button" href="/index.php?search=chicken">
        Chicken
      </a>
      <a class="filter-button" href="/index.php?search=fish">
        Fish
      </a>
      <a class="filter-button" href="/index.php?search=pork">
        Pork
      </a>
      <a class="filter-button" href="/index.php?search=steak">
        Steak
      </a>
      <a class="filter-button" href="/index.php?search=turkey">
        Turkey
      </a>
      <a class="filter-button" href="/index.php?search=vegetarian">
        Vegetarian
      </a>
    </aside>
    <div class="recipe-grid">
      <?php
        while($row = mysqli_fetch_assoc($result)) : ?>
          <a class='recipe-card-link' href='/recipe.php?id=<?php echo $row['id'] ?>'>
            <div class='recipe-card'>
              <img src="<?php echo '/assets/images/' . $row['img_folder'] . '/' . $row['hero_lg']  ?>" alt='Hero image'>
              <div class='recipe-details'>
                <p class='recipe-title'><?php echo $row['heading'] ?></p>
                <p class='recipe-title-secondary'><?php echo $row['subheading'] ?></p>
              </div>
            </div>
          </a>
      <?php endwhile ?>
    </div>
  </main>
</body>
</html>
