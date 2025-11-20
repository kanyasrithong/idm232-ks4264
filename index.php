<?php
  require_once 'db.php';
  
  $stmt = $connection->prepare('SELECT * FROM recipes');
  $stmt->execute();
  $result = $stmt->get_result();
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
        <input id="search-input" placeholder="Find a new recipe..." type="text">
      </form>
    </div>
  </header>
  <main>
    <div id="search-bar-mobile">
      <img id="search-icon" src="/assets/icons/search-icon.svg" alt="Search icon">
      <input id="search-input" placeholder="Find a new recipe..." type="text">
    </div>
    <aside>
      <h3>Filters</h3>
      <label for="beef">
        <input type="checkbox" id="beef" class="filter" name="Beef">
        Beef
      </label>
      <label for="chicken">
        <input type="checkbox" id="chicken" name="Chicken">
        Chicken
      </label>
      <label for="fish">
        <input type="checkbox" id="fish" name="Fish">
        Fish
      </label>
      <label for="pork">
        <input type="checkbox" id="pork" name="Pork">
        Pork
      </label>
      <label for="steak">
        <input type="checkbox" id="steak" name="Steak">
        Steak
      </label>
      <label for="turkey">
        <input type="checkbox" id="turkey" name="Turkey">
        Turkey
      </label>
      <label for="vegetarian">
        <input type="checkbox" id="vegetarian" name="Vegetarian">
        Vegetarian
      </label>
    </aside>
    <div class="recipe-grid">
      <?php
        while($row = mysqli_fetch_assoc($result)) : ?>
          <a class='recipe-card-link' href='recipe.php?id=<?php echo $row['id'] ?>'>
            <div class='recipe-card'>
              <img src="<?php echo '/assets/images/' . $row['img-folder'] . '/' . $row['hero-lg']  ?>" alt='Hero image'>
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
