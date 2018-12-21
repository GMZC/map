<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Les_Autres_Possibles
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('page-content'); ?>>
<div class="post-thumbnail" style="background:url('<?php the_post_thumbnail_url(); ?>') center center no-repeat/cover">

</div>


	<div class="entry-content">
		<header class="entry-header">
		</header><!-- .entry-header -->
		<?php
        the_content();
        ?>
	</div><!-- .entry-content -->
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
    // Query Arguments
        $args = array(
            'post_type' => array('numero_du_mois'),
            'order' => 'DESC',
            'posts_per_page' => 50
        );

        // The Query
        $numeros = new WP_Query($args);
        $url = get_permalink();

        // The Loop
        if ($numeros->have_posts()) {
            ?>
						<div class="list">
			<?php while ($numeros->have_posts()) {
                ?>
				<?php $numeros->the_post(); ?>
				<div class="list-content ">
					<div class="image">
						<?php
                            $image = get_field('title_image');
                if (!empty($image)): ?>
								<div style="background:url('<?php echo $image['url']; ?>') center center no-repeat/cover">
								<span class="last-issue-price">2€</span>
								</div>
							<?php endif; ?>
					</div>
					<div class="texte">
							<!-- the_title -->
							<h4><?php the_title(); ?></h4>
							<!-- intro -->
							<?php
                                $numtitle = get_field('title');
                if (!empty($numtitle)): ?>
									<h2> <a href="<?php the_permalink(); ?>"><?php echo $numtitle; ?></a></h2>
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

									<?php endif;
                endif;
                // vars
                $title_add_link = get_field('id_produit');
                $out_of_stock = get_field('produit_epuise');
                if (!empty($title_add_link) && empty($out_of_stock)): ?>
									<p><a href="<?php echo $url .'?add-to-cart='.$title_add_link; ?>" class="btn med add_to_cart_button ajax_add_to_cart " data-quantity="1" data-product_id="<?php echo $title_add_link?>" data-product_sku >Ajouter au panier</a> <a href="<?php the_permalink(); ?>">Découvrir ce numéro</a> </p>
								<?php elseif (!empty($out_of_stock)): ?>
									<p><a class="btn med out-of-stock ">Produit épuisé</a> <a href="<?php the_permalink(); ?>">Découvrir ce numéro</a> </p>
									<?php endif; ?>
							</div>
						</div>

				</div>
				<?php
            }
        } else {
            // no posts found
        }
        /* Restore original Post Data */
        wp_reset_postdata();
 ?>
