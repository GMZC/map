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
	<h2>Les points de vente</h2>
	<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
	      <path class="cls-1" d="M0,0,50,25,0,50"/>
	</svg>
</div>

<aside id="secondary" class="map widget-area">
	<div class="map-bg">
		<div class="map-embed">
			<iframe width="100%" height="100%" frameBorder="0" allowfullscreen src="https://umap.openstreetmap.fr/fr/map/lieu-distribution-map_107814?scaleControl=false&miniMap=false&scrollWheelZoom=false&zoomControl=true&allowEdit=false&moreControl=true&searchControl=null&tilelayersControl=null&embedControl=null&datalayersControl=true&onLoadPanel=undefined&captionBar=false"></iframe>
		</div>
		<div class="map-text">
		<?php dynamic_sidebar('sidebar-2'); ?>
		</div>

	</div>
</aside><!-- #secondary -->
