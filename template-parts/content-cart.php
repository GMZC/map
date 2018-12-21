<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Les_Autres_Possibles
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('cart page-content'); ?>>
<div class="post-thumbnail" style="background:url('<?php the_post_thumbnail_url(); ?>') center center no-repeat/cover">

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
