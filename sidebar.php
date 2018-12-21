<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Les_Autres_Possibles
 */

if (! is_active_sidebar('sidebar-1')) {
    return;
}
?>
<div class="titre-separateur qsnHeading">
	<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
	      <path class="cls-1" d="M50,50,0,25,50,0"/>
	</svg>
	<h2>Qui sommes-nous ?</h2>
	<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
	      <path class="cls-1" d="M0,0,50,25,0,50"/>
	</svg>
</div>

<aside id="secondary" class="qsn widget-area">
	<div class="qsn-bg">
		<?php dynamic_sidebar('sidebar-1'); ?>
	</div>
</aside><!-- #secondary -->
<?php
  get_template_part('template-parts/aside', 'boutique');
  get_template_part('template-parts/aside', 'map');
 ?>
