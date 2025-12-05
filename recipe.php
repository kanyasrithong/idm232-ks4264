<?php
  require_once 'db.php';

  if(isset($_GET['id'])) {
    $search_query = $_GET['id'];
    $stmt = $connection->prepare('SELECT id, heading, subheading, description, ingredients, steps, img_folder, hero_lg, hero_sm FROM recipes WHERE id = ?');
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
  <link rel="icon" href="assets/favicon.jpg">
  <link rel="stylesheet" href="styles/styles.css">
  <link rel="stylesheet" href="styles/queries.css">
  <link rel="stylesheet" href="styles/recipe.css">
</head>
<body>
  <?php include 'components/header.php'; ?>
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
            <?php
              $ingredients_array = explode("*", $ingredients);
              foreach ($ingredients_array as $num => $value) : ?>
              <li><?php echo $value?></li>
            <?php endforeach ?>
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