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
<div class="post-thumbnail" style="background:url('<?php the_post_thumbnail_url(); ?>') center center no-repeat; background-size : cover;">

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


<?php
  $alt_content = get_field('alt-content');
?>

<?php
    if ($alt_content):?>
	<div class="alt-content">
		<div class="">
			<?php
            echo $alt_content;
            ?>
		</div>
	</div>
	<?php
  endif;
  ?>
<div class="titre-separateur">
	<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
				<path class="cls-1" d="M50,50,0,25,50,0"/>
	</svg>
	<h2>Les événements</h2>
	<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
				<path class="cls-1" d="M0,0,50,25,0,50"/>
	</svg>
</div>
<div class="actusContainer">
<?php
    // Query Arguments
    $args = array(
    'posts_per_page' => 50,
    'order' => 'DESC',
    'category_name' => 'nos-evenements',
    );

    // The Query
    $catPosts = new WP_Query($args);

    // The Loop
    if ($catPosts->have_posts()) {
        while ($catPosts->have_posts()) {
            $catPosts->the_post(); ?>
			<div class="actu">

					<h3> <a href="<?php the_permalink(); ?>"><?php  the_title(); ?>	</a></h3>

				<?php if (has_post_thumbnail()): ?>
				<a href="<?php the_permalink(); ?>"><div class="actu_thumbnail" style="background-image : url('<?php the_post_thumbnail_url(); ?>')"></div></a>
			<?php endif; ?>
				<div class="excerpt">
					<?php the_excerpt(); ?>
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
</div>
