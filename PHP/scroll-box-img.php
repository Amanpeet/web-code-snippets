<style>
/* scrolling images */

.scroll-box {
  position: relative;
	height: 300px;
	overflow: hidden;
	margin-bottom: 25px;
	border: 1px solid #ccc;
  border-radius: 4px;
  box-shadow: 0 5px 15px rgba(0,0,0,0.12);
  transition: all 0.5s ease;
}

.scroll-box:hover {
	box-shadow: 0 5px 15px rgba(0,0,0,0.22);
	transform: scale(1.1);
	z-index: 10;
}

.scroll-box .scroll-image {
	height: 300px;
	overflow: scroll;
	overflow-x: hidden;
	width: calc( 100% + 20px );
  /* width: 100%; */
}

.scroll-box .scroll-image img {
  width: calc( 100% - 20px );
	/* width: 100%; */
}

@media all and (max-width: 768px) {
  .scroll-box .scroll-image {
    width: 100%;
  }
  .scroll-box .scroll-image img {
    width: 100%;
  }
}

.scroll-box .scroll-overlay {
  opacity: 0;
	background: #191a1b;
  color: #fff;
  height: 115px;
  width: 115px;
  border-radius: 50%;
  box-shadow: 0 5px 5px rgba(0,0,0,0.5);
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
  padding: 5px;
  transition: all 1s ease;
  pointer-events: none;
}

.scroll-box:hover .scroll-overlay {
  opacity: 0.75;
}

.scroll-box .scroll-overlay .icon {
	font-size: 22px;
  line-height: 1;
}

.scroll-box .scroll-overlay h6 {
	font-size: 11px;
  font-weight: 400;
  text-transform: uppercase;
}

.scroll-works .text-muted a {
	display: inline-block;
	font-weight: 400;
	text-align: center;
	padding: .28rem .7rem;
	font-size: .875rem;
	line-height: 1.5;
	border-radius: .2rem;
	color: #fff;
	background-color: #f206b9;
	border-color: #f206b9;
	text-decoration: none;
}

.scroll-works .text-muted a:hover,
.scroll-works .text-muted a:focus {
	background-color: #c00995;
}

</style>


<div class="scroll-works">
  <div class="row justify-content-center">
    <?php
    // TO SHOW THE PAGE CONTENTS
    $active = 1;
    $args = array(
      'posts_per_page' => 99,
      'post_type' => 'site_projects',
      'orderby' => 'date',
      'order' => 'DESC'
    );
    query_posts($args);
    while (have_posts()) : the_post();
      ?>
      <div class="col-md-4 mb-4 text-center">
        <div class="scroll-box">
          <div class="scroll-overlay">
            <div class="icon">
              <i class="fa fa-caret-up"></i><br> <i class="fa fa-mouse"></i><br> <i class="fa fa-caret-down"></i>
            </div>
            <h6>Scroll for more</h6>
          </div>
          <div class="scroll-image">
            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="<?php the_title(); ?>">
          </div>
        </div>
        <h5 class="text-dark font-light"><?php the_title(); ?></h5>
        <div class="text-muted"><?php the_content(); ?></div>
      </div>
      <?php
      $active++;
    endwhile;
    wp_reset_query();
    ?>
  </div>
</div>