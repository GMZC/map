<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Les_Autres_Possibles
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('boutique-abonnements'); ?>>
	<header class="entry-header">
		<div class="post-thumbnail" style="background:url('<?php echo the_post_thumbnail_url(); ?>') center center no-repeat; background-size : cover;">
		</div>
		<div class="titre-separateur">
			<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
						<path class="cls-1" d="M50,50,0,25,50,0"/>
			</svg>

					<h2><?php the_title(); ?></h2>

			<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
						<path class="cls-1" d="M0,0,50,25,0,50"/>
			</svg>
		</div>
	</header><!-- .entry-header -->

	<div class="portail-boutique entry-content">
		<div class="abonnements">
			<div class="text">
				<svg class="icon">
					<use xlink:href="#enveloppe"></use>
				</svg>
				<?php
              $texte_sabonner = get_field('texte_sabonner');
              if ($texte_sabonner):?>
					<div class="alt-content">
						<div class="">
							<?php
                echo $texte_sabonner;
              ?>
						</div>
					</div>
					<?php
            endif;
          ?>
				<p><a href="<?php the_permalink(2149); ?>" class="btn big">S'abonner</a></p>
			</div>
		</div>
		<div class="boutique">
			<div class="text">
				<svg class="icon">
					<use xlink:href="#map-8"></use>
				</svg>
				<?php
              $texte_boutique = get_field('texte_boutique');
              if ($texte_boutique):?>
					<div class="alt-content">
						<div class="">
							<?php
                echo $texte_boutique;
              ?>
						</div>
					</div>
					<?php
            endif;
          ?>
				<p><a href="<?php the_permalink(2621);?>" class="btn big">La boutique</a></p>
			</div>
		</div>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
