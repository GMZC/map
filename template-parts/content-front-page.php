<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Les_Autres_Possibles
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('home-content'); ?>>
<div class="post-thumbnail" style="background-image :url('<?php the_post_thumbnail_url(); ?>');">

</div>


	<div class="entry-content">
		<header class="entry-header">
			<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
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
	<h2>Découvrir le dernier numéro</h2>
	<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
				<path class="cls-1" d="M0,0,50,25,0,50"/>
	</svg>
</div>

	<?php
        $args = array(
            'post_type' => 'numero_du_mois',
            'posts_per_page' => 1 ,
            );
        $loop = new WP_Query($args);
        if ($loop->have_posts()) {
            while ($loop->have_posts()) : $loop->the_post(); ?>
			<?php
            $image = get_field('title_image'); ?>
			<div class="last-issue-background" style="background-image :url('<?php echo $image['url']; ?>') ; ">
				<div class="last-issue-background-overlay" style="background:rgba(255,255,255,.8);">
					<div class="last-issue">
						<div class="last-issue-edito">
							<div class="last-issue-content">
								<h2><?php the_field('title'); ?></h2>
								<div class="sb-title">
								<?php
                                    $sb_title = get_field('title_subtitle');
            $title_add_link = get_field('id_produit');
            if (!empty($sb_title)): ?>

										<p> <?php echo $sb_title; ?> </p>

									<?php endif; ?>
								</div>
								<p>
									<a href="<?php the_permalink(); ?>">Lire l'édito</a>
								</p>
							</div>
							<div class="last-issue-add-to-cart">
								<span class="last-issue-price">2€</span>
								<span>
									<a href="<?php echo $url .'?add-to-cart='.$title_add_link; ?>" class="btn med add_to_cart_button ajax_add_to_cart " data-quantity="1" data-product_id="<?php echo $title_add_link?>" data-product_sku>Ajouter au panier</a>
								</span>
							</div>
						</div>
						<?php if (have_rows('sommaire')): ?>

						<div class="summary">

						<?php while (have_rows('sommaire')): the_row();

            // vars
            $rub = get_sub_field('rubrique');
            $titre = get_sub_field('titre');
            $auteur = get_sub_field('auteur');
            $chapo = get_sub_field('chapo'); ?>

							<div>
									<h5> <?php echo $rub; ?></h5>
									<h4> <?php echo $titre; ?> </h4>
									<blockquote>par : <?php echo $auteur; ?> </blockquote>
							    <p> <?php echo $chapo; ?></p>

							</div>

						<?php endwhile; ?>

						</div>
					<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="last-issue-map">
				<?php
                    $map = get_field('map_image');
            if (!empty($map)):
                ?>
				<div class="map-image" style="background-image :url('<?php echo $map['url']; ?>') ; "></div>
				<?php endif; ?>
				<div class="map-content">
					<?php
            $maptitle = get_field('map_title');
            $artist_title = get_field('artist_title');

            if (!empty($maptitle)): ?>

							<h3>La carte au dos : "<?php echo $maptitle; ?>" illustrée par <?php echo $artist_title; ?></h3>

						<?php endif; ?>
							<?php
                                $map_content = get_field('map_content');
            if (!empty($map_content)): ?>

									<p><?php echo $map_content; ?></p>
									<p> <a href="<?php the_permalink() ?>">Découvrir ce numéro</a></p>

								<?php endif; ?>
				</div>
			</div>
			<?php endwhile;
        } else {
            echo __('No products found');
        }
        wp_reset_postdata();
    ?>
