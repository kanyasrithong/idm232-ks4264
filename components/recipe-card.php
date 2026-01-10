<a class='recipe-card-link' href='recipe.php?id=<?php echo $id ?>'>
  <div class='recipe-card'>
    <picture>
      <source media="(min-width:980px)" srcset="<?php echo "assets/images/$img_folder/$hero_lg" ?>">
      <img src="<?php echo "assets/images/$img_folder/$hero_sm"  ?>" alt='Hero image'>
    </picture>
    <div class='recipe-details'>
      <p class='recipe-title'><?php echo $heading ?></p>
      <p class='recipe-title-secondary'><?php echo $subheading ?></p>
    </div>
  </div>
</a>