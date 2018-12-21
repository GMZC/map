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
	<header class="entry-header">
		<?php
        if (is_singular()) : ?>
			<h1><?php the_field('title'); ?></h1>
		<?php else :
            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
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

	<?php

    $image = get_field('title_image');

    if (!empty($image)): ?>

	<div class="post-thumbnail">
			<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
	</div>



	<?php endif; ?>

	<div class="entry-content">
		<?php
            $ss_titre = get_field('title_subtitle');
            if (!empty($ss_titre)): ?>

				<p><?php echo $ss_titre; ?></p>

			<?php endif; ?>
			<?php
                $summary = get_field('title_summary');
                if (!empty($summary)): ?>

					<p><?php echo $summary; ?></p>

				<?php endif; ?>
				<?php
                    $edito = get_field('edito_content');
                    if (!empty($edito)): ?>

						<p><?php echo $edito; ?></p>

					<?php endif; ?>
		<?php
        the_content(sprintf(
            wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'map'),
                array(
                    'span' => array(
                        'class' => array(),
                    ),
                )
            ),
            get_the_title()
        ));

        // wp_link_pages(array(
        //     'before' => '<div class="page-links">' . esc_html__('Pages:', 'map'),
        //     'after'  => '</div>',
        // ));
        ?>
	</div><!-- .entry-content -->

	<div class="entry-content">
		<?php

        $map = get_field('map_image');

        if (!empty($map)): ?>
				<img src="<?php echo $map['url']; ?>" alt="<?php echo $map['alt']; ?>" />
		<?php endif; ?>

		<?php
            $maptitle = get_field('map_title');
            if (!empty($maptitle)): ?>

				<p><?php echo $maptitle; ?></p>

			<?php endif; ?>
			<?php
                $mapsbtitle = get_field('map_subtitle');
                if (!empty($mapsbtitle)): ?>

					<p><?php echo $mapsbtitle; ?></p>

				<?php endif; ?>

				<?php
                    $map_content = get_field('map_content');
                    if (!empty($map_content)): ?>

						<p><?php echo $map_content; ?></p>

					<?php endif; ?>

	</div>

	<footer class="entry-footer">
		<?php
            // map_entry_footer();
        ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
