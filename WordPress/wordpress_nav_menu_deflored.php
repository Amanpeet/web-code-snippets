



 <!-- code here -->
<?php
  $menu_name = 'primary';
  $locations = get_nav_menu_locations();
  $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
  $menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );
?>

<nav>
  <ul class="main-nav">
    <?php
    $count = 0;
    $submenu = false;

    foreach($menuitems as $item){
      // set up title and url
      $title = $item->title;
      $link = $item->url;
      // item does not have a parent so menu_item_parent equals 0 (false)
      if (!$item->menu_item_parent){
        // save this id for later comparison with sub-menu items
        $parent_id = $item->ID;
        ?>
          <li class="item">
            <a href="<?php echo $link; ?>" class="title">
              <?php echo $title; ?>
            </a>
        <?php 
      }

      if ( $parent_id == $item->menu_item_parent ) {
        if ( !$submenu ) {
        $submenu = true; 
        ?>
          <ul class="sub-menu">
        <?php 
        } 
        ?>
            <li class="item">
              <a href="<?php echo $link; ?>" class="title"><?php echo $title; ?></a>
            </li>
          <?php 
            if ( $menuitems[ $count + 1 ]->menu_item_parent != $parent_id && $submenu ){
          ?>
        </ul>
      <?php 
        $submenu = false; 
        } 
      ?>

      <?php 
        } 
      ?>
      <?php
        if ( $menuitems[ $count + 1 ]->menu_item_parent != $parent_id ){
      ?>
      </li>
      <?php 
          $submenu = false; 
        }  
        $count++; 
      } 
      ?>

  </ul>
</nav>
