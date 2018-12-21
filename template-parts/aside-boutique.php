<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Les_Autres_Possibles
 */

?>

<div class="titre-separateur">
	<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
	      <path class="cls-1" d="M50,50,0,25,50,0"/>
	</svg>
	<h2>La boutique</h2>
	<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
	      <path class="cls-1" d="M0,0,50,25,0,50"/>
	</svg>
</div>
<div class="boutique-widget">
  <ul class="products">
  	<?php
          $args = array(
              'post_type' => 'product',
              'posts_per_page' => 3 ,
              'product_cat' => 'packs'
              );
          $loop = new WP_Query($args);
          if ($loop->have_posts()) {
              while ($loop->have_posts()) : $loop->the_post();
              wc_get_template_part('content', 'product');
              endwhile;
          } else {
              echo __('No products found');
          }
          wp_reset_postdata();
      ?>
  </ul>
  <p><a href="<?php the_permalink('52'); ?>" class="btn med">Visiter la boutique</a></p>
</div>
