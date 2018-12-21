<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Les_Autres_Possibles
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('page-content boutique'); ?>>
	<?php
                $args = array(
                                            'post_type' => array('numero_du_mois'),
                                            'order' => 'DESC',
                                            'posts_per_page' => 1
                        );
                $loop = new WP_Query($args);
                if ($loop->have_posts()) {
                    while ($loop->have_posts()) : $loop->the_post();
                    $title_add_link = get_field('id_produit');
                    $image = get_field('title_image');
                    if (!empty($image) && !empty($title_add_link)):
                        ?>
						<div class="post-thumbnail" style="background:url('<?php echo $image['url']; ?>') center center no-repeat/cover">

						</div>
						<?php endif; ?>
							<div class="entry-content">
								<header class="entry-header">
									<?php the_title('<h4 class="entry-title">', '</h4>'); ?>
								</header><!-- .entry-header -->
								<?php
                                    $numtitle = get_field('title');
                    if (!empty($numtitle)): ?>
										<h2> <a href="<?php the_permalink(); ?>"><?php echo $numtitle; ?></a></h2>
									<?php endif; ?>
								<?php if (have_rows('sommaire')): ?>

								<div class="issue-summary">
								<h4>Au sommaire : </h4>
								<ul>
								<?php while (have_rows('sommaire')): the_row();
                    // vars
                    $rub = get_sub_field('rubrique');
                    $titre = get_sub_field('titre'); ?>
									<li>
											 <strong><?php echo $rub; ?></strong> : <?php echo $titre; ?>
									</li>
									<?php endwhile; ?>
									</ul>
								</div>
								<?php
                        $maptitle = get_field('map_title');
                    $artist_title = get_field('artist_title');

                    if (!empty($maptitle)): ?>

										<p class="carto"> <strong> + une cartographie </strong>: "<?php echo $maptitle; ?>" illustrée par <?php echo $artist_title; ?></p>

									<?php endif; ?>
									<?php endif; ?>
								<p><span class="price">2€</span><a href="<?php echo $url .'?add-to-cart='.$title_add_link; ?>" class="btn med add_to_cart_button ajax_add_to_cart " data-quantity="1" data-product_id="<?php echo $loop->post->ID?>" data-product_sku >Ajouter au panier</a></p>
							</div><!-- .entry-content -->
						<?php endwhile;
                } else {
                    echo __('No products found');
                }
                    wp_reset_postdata();
                    ?>
</article><!-- #post-<?php the_ID(); ?> -->
<div class="titre-separateur">
	<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
				<path class="cls-1" d="M50,50,0,25,50,0"/>
	</svg>

			<h2><?php the_title(); ?></h2>

	<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
				<path class="cls-1" d="M0,0,50,25,0,50"/>
	</svg>
</div>
<?php
                            $args = array(
                                            'post_type' => 'product',
                                            'posts_per_page' => 20 ,
                                            'product_cat' => 'packs'
                                            );
                            $loop = new WP_Query($args);
                            if ($loop->have_posts()) {
                                while ($loop->have_posts()) : $loop->the_post(); ?>
					<div class="last-issue-map">
						<div class="map-image" style="background-image :url('<?php the_post_thumbnail_url(); ?>') ; "></div>
						<div class="map-content">
							<h3><?php the_title(); ?></h3>
              <p> <?php the_content(); ?></p>
							<p> <?php the_excerpt(); ?></p>
							<?php
                                $product = wc_get_product($loop->post->ID);
                                $price = $product->get_price(); ?>
							<p><span class="price"><?php echo $price; ?> €</span><a href="<?php echo $url .'?add-to-cart='.$loop->post->ID; ?>" class="btn small add_to_cart_button ajax_add_to_cart " data-quantity="1" data-product_id="<?php echo $loop->post->ID?>" data-product_sku >Ajouter au panier</a></p>
						</div>
					</div>
					<?php endwhile;
                            } else {
                                echo __('No products found');
                            }
                            wp_reset_postdata();
            ?>
<div class="titre-separateur">
	<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
				<path class="cls-1" d="M50,50,0,25,50,0"/>
	</svg>

			<h2>La collection</h2>

	<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
				<path class="cls-1" d="M0,0,50,25,0,50"/>
	</svg>
</div>
<div class="boutique-widget">
  <ul class="products">
  	<?php
          $args = array(
                        'post_type' => array('numero_du_mois'),
                        'order' => 'DESC',
                        'posts_per_page' => 50
              );
          $loop = new WP_Query($args);
          if ($loop->have_posts()) {
              while ($loop->have_posts()) : $loop->the_post(); ?>
              	<li class="product">
									<h4><?php the_title(); ?></h4>
									<div class="image">
										<?php
                              $title_add_link = get_field('id_produit');
              $image = get_field('title_image');
              if (!empty($image) && !empty($title_add_link)):
                    ?>
												<div class="popUp" style="background:url('<?php echo $image['url']; ?>') center center no-repeat/cover">
													<span class="last-issue-price">2€</span>
													<div class="popUpContent">
														<div class="texte">
																<!-- the_title -->
																<!-- intro -->
																<?php
                                                                    $numtitle = get_field('title');
              if (!empty($numtitle)): ?>
																		<h3><?php echo $numtitle; ?></h3>
																	<?php endif; ?>
																<div class="image-subtitle">
																	<?php if (have_rows('sommaire')): ?>

																	<div class="issue-summary">
																	<h4>Au sommaire : </h4>
																	<ul>
																	<?php while (have_rows('sommaire')): the_row();
              // vars
              $rub = get_sub_field('rubrique');
              $titre = get_sub_field('titre'); ?>
																		<li>
																				 <strong><?php echo $rub; ?></strong> : <?php echo $titre; ?>
																		</li>
																		<?php endwhile; ?>
																		</ul>
																	</div>
																	<?php
                                                            $maptitle = get_field('map_title');
              $artist_title = get_field('artist_title');

              if (!empty($maptitle)): ?>

																			<p class="carto"> <strong> + une cartographie </strong>: "<?php echo $maptitle; ?>" illustrée par <?php echo $artist_title; ?></p>

																		<?php endif; ?>
																		<?php endif; ?>
																		<!-- <p><a href="<?php echo $url .'?add-to-cart='.$title_add_link; ?>" class="btn med add_to_cart_button ajax_add_to_cart " data-quantity="1" data-product_id="<?php echo $title_add_link?>" data-product_sku >Ajouter au panier</a> <a href="<?php the_permalink(); ?>">Découvrir ce numéro</a> </p> -->
																</div>
													</div>
												</div>
											<?php endif; ?>
									</div>
								</div>
								<?php
                                // vars
                                $out_of_stock = get_field('produit_epuise');
              if (!empty($title_add_link) && empty($out_of_stock)): ?>
										<a href="<?php echo $url .'?add-to-cart='.$title_add_link; ?>" class="btn small add_to_cart_button ajax_add_to_cart " data-quantity="1" data-product_id="<?php echo $title_add_link?>" data-product_sku >Ajouter au panier</a>
								<?php elseif (!empty($out_of_stock)): ?>
										<a class="btn small out-of-stock ">Produit épuisé</a>
									<?php endif; ?>
              	</li>
              <?php endwhile;
          } else {
              echo __('No products found');
          }
          wp_reset_postdata();
      ?>
  </ul>
</div>
<div class="titre-separateur">
	<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
				<path class="cls-1" d="M50,50,0,25,50,0"/>
	</svg>

			<h2>Les accessoires</h2>

	<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
				<path class="cls-1" d="M0,0,50,25,0,50"/>
	</svg>
</div>
<div class="goodies">
<?php
                            $args = array(
                                            'post_type' => 'product',
                                            'posts_per_page' => 20 ,
                                            'product_cat' => 'accessoires'
                                            );
                            $loop = new WP_Query($args);
                            if ($loop->have_posts()) {
                                while ($loop->have_posts()) : $loop->the_post(); ?>
					<div class="last-issue-map">
						<div class="map-image" style="background-image :url('<?php the_post_thumbnail_url(); ?>') ; "></div>
						<div class="map-content">
							<h3><?php the_title(); ?></h3>
              <p> <?php the_content(); ?></p>
							<p> <?php the_excerpt(); ?></p>
							<?php
                                $product = wc_get_product($loop->post->ID);
                                $price = $product->get_price(); ?>
							<p><span class="price"><?php echo $price; ?> €</span><a href="<?php echo $url .'?add-to-cart='.$loop->post->ID; ?>" class="btn small add_to_cart_button ajax_add_to_cart " data-quantity="1" data-product_id="<?php echo $loop->post->ID?>" data-product_sku >Ajouter au panier</a></p>
						</div>
					</div>
					<?php endwhile;
                            } else {
                                echo __('No products found');
                            }
                            wp_reset_postdata();
            ?>
</div>
