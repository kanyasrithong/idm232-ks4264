<?php
  require_once 'db.php';

  if(isset($_GET['id'])) {
    $search_query = $_GET['id'];
    $stmt = $connection->prepare('SELECT * FROM recipes WHERE id = ?');
    $stmt->bind_param("i", $search_query);
    $stmt->execute();
    $stmt->bind_result($id, $heading, $subheading, $description, $ingredients, $steps, $img_folder, $hero_lg, $hero_sm);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recipe</title>
  <link rel="stylesheet" href="styles/styles.css">
  <link rel="stylesheet" href="styles/queries.css">
  <link rel="stylesheet" href="styles/recipe.css">
</head>
<body>
  <header>
    <a id="home-icon" href="index.php">Cookbook</a>
    <div id="search-bar">
      <img id="search-icon" src="assets/icons/search-icon.svg" alt="Search icon">
      <input id="search-input" placeholder="Find a new recipe..." type="text">
    </div>
  </header>
  <?php
    while ($stmt->fetch()) : ?>
      <div id="hero">
        <div id="details">
          <div id="recipe-title">
            <h1><?php echo $heading ?></h1>
            <h2><?php echo $subheading ?></h2>
          </div>
          <p><?php echo $description ?></p>
        </div>
        <picture>
          <source media="(min-width:980px)" srcset="<?php echo "assets/images/$img_folder/$hero_lg" ?>">
          <img src="<?php echo "assets/images/$img_folder/$hero_sm" ?>" alt="Chicken and rice">
        </picture>
      </div>
      <div id="recipe-content">
        <aside>
          <h2>Ingredients</h2>
          <ul>
            <li>2 Boneless, Skinless Chicken Breasts</li>
            <li>2 Carrots</li>
            <li>1 Red Onion</li>
            <li>2 cloves Garlic</li>
            <li>1/2 cup French Green Lentils</li>
            <li>1 bunch Collard Greens</li>
            <li>2 Tbsps Tomato Paste</li>
            <li>1/4 tsp Crushed Red Pepper Flakes</li>
            <li>1 Tbsp Capers</li>
            <li>1 Tbsp Apple Cider Vinegar</li>
            <li>2 Tbsps Crumbled Goat Cheese</li>
            <li>1 Tbsp Tuscan Spice Blend (Ground Fennel Seeds, Whole Fennel Seeds, Ground Rosemary, & Ground Sage)</li>
          </ul>
          <img src="<?php echo "assets/images/{$img_folder}/ingredients.png" ?>" alt="Ingredients">
        </aside>
        <main>
          <?php
            $steps_array = explode("*", $steps);
            foreach ($steps_array as $step => $value) : ?>
            <?php $step++ ?>
              <div class="recipe-step">
                <h1>Step <?php echo $step ?></h1>
                <p><?php echo $value ?></p>
                <picture>
                  <source media="(min-width:980px)" srcset="<?php echo "assets/images/{$img_folder}/step{$step}-lg.jpg" ?>">
                  <img src="<?php echo "assets/images/{$img_folder}/step{$step}-sm.jpg" ?>" alt="Step image">
                </picture>
              </div>
          <?php endforeach ?>
        </main>
      </div>
  <?php endwhile ?>
</body>
</html>