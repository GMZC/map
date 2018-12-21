<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Les_Autres_Possibles
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<div class="intro-numero">
	<?php
    $image = get_field('title_image');
    if (!empty($image)):?>
<div class="left-container">
	<div class="post-thumbnail" style="background:url('<?php echo $image['url']; ?>') center center no-repeat/cover">
		<div class="image-content">
			<span class="last-issue-price">2€</span>
		</div>
	</div>
</div>


	<?php endif; ?>
	<div class="content">
		<header class="entry-header">
			<h2><?php the_title(); ?></h2>
			<?php
            if (is_singular()) : ?>
				<h1><?php the_field('title'); ?></h1>
			<?php else :
                // the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            endif;

            if ('post' === get_post_type()) :
                ?>
				<div class="entry-meta">
					<?php
                    map_posted_on();
                    map_posted_by();
                    ?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->
		<div class="entry-content">
			<?php
                $ss_titre = get_field('title_subtitle');
                if (!empty($ss_titre)): ?>

					<p><?php echo $ss_titre; ?></p>

				<?php endif; ?>
					<?php
                        $edito = get_field('edito_content');
                        if (!empty($edito)): ?>

							<p><?php echo $edito; ?></p>

						<?php endif; ?>
						<?php
                $title_add_link = get_field('id_produit');
                $out_of_stock = get_field('produit_epuise');
                if (!empty($title_add_link) && empty($out_of_stock)):
            ?>
							<p><a href="<?php echo the_permalink() .'?add-to-cart='.$title_add_link; ?>" class="btn small add_to_cart_button ajax_add_to_cart " data-quantity="1" data-product_id="<?php echo $title_add_link?>" data-product_sku >Ajouter au panier</a></p>
						<?php elseif (!empty($out_of_stock)): ?>
							<p><a class="btn small out-of-stock ">Produit épuisé</a></p>
						<?php endif; ?>
		</div><!-- .entry-content -->
	</div>
	</div>
<div class="sommaire">
		<div class="titre-separateur">
			<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
						<path class="cls-1" d="M50,50,0,25,50,0"/>
			</svg>
					<h2>Sommaire</h2>
			<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
						<path class="cls-1" d="M0,0,50,25,0,50"/>
			</svg>
		</div>
	<?php if (have_rows('sommaire')): ?>

	<div class="summary">
		<?php while (have_rows('sommaire')): the_row();
        // vars
        $rub = get_sub_field('rubrique');
        $titre = get_sub_field('titre');
        $auteur = get_sub_field('auteur');
        $chapo = get_sub_field('chapo');
        ?>
		<div>
				<h4> <?php echo $rub; ?></h4>
				<h3> <?php echo $titre; ?> </h3>
				<blockquote>par : <?php echo $auteur; ?> </blockquote>
		    <p> <?php echo $chapo; ?></p>
		</div>
		<?php endwhile; ?>
	</div>
	<?php
    elseif (!have_rows('sommaire') && !empty(the_field('title_summary'))):?>
		<div class="summary">
			<?php get_field('title_summary'); ?>
		</div>
		<?php endif; ?>
</div>



	<div class="entry-content">
			<div class="titre-separateur">
				<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
							<path class="cls-1" d="M50,50,0,25,50,0"/>
				</svg>
				<?php
                    $maptitle = get_field('map_title');
                    if (!empty($maptitle)): ?>

						<h2>La carte au dos : <?php echo $maptitle; ?></h2>

					<?php endif; ?>
				<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
							<path class="cls-1" d="M0,0,50,25,0,50"/>
				</svg>
			</div>
			<div class="last-issue-map">
				<?php
                    $map = get_field('map_image');
                    if (!empty($map)):
                ?>
				<div class="map-image" style="background:url('<?php echo $map['url']; ?>') center center no-repeat/cover"></div>
				<?php endif; ?>
				<div class="map-content">
							<?php
                                $map_content = get_field('map_content');
                                if (!empty($map_content)): ?>
									<p><?php echo $map_content; ?></p>
								<?php endif; ?>
								<div class="issue-artist">
									<?php
                                        $artist = get_field('artist_image');
                                        if (!empty($artist)):
                                    ?>
									<div class="image-container">
											<div class="artist-image" style="background:url('<?php echo $artist['url']; ?>') center center no-repeat/cover"></div>
									</div>

									<?php endif; ?>
									<div class="artist-info">
										<?php
                                            $artist_title = get_field('artist_title');
                                            if (!empty($artist_title)): ?>
												<h3><?php echo $artist_title; ?></h3>
										<?php endif; ?>
										<?php
                                            $artist_content = get_field('artist_content');
                                            if (!empty($artist_content)): ?>
												<p><?php echo $artist_content; ?></p>
										<?php endif; ?>
									</div>
								</div>
				</div>
			</div>
	</div>

	<footer class="entry-footer">
		<!-- <?php map_entry_footer(); ?> -->
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
