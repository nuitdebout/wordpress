<?php

if(isset($_GET["syncc"]) && $_GET["syncc"] == "secret" ) {
  	insert_page_wiki();

}

function get_data($url) {
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$data = curl_exec($ch);
	curl_close($ch);
	return 	json_decode($data, true);

}
function get_page_by_name($pagename){
	$pages = get_pages();
	foreach ($pages as $page) if ($page->post_name == $pagename) return $page;
	return false;
}


function insert_page_wiki(){
	$returned_content = get_data('https://raw.githubusercontent.com/nuitdebout/nuitdebout.github.io/master/data/cities.json');

	foreach ( $returned_content as $p ) :

		//print_r($p);
		$t = wp_strip_all_tags($p['name']);
		$c = '';
		$links =$p['links'];
		if($t == 'paris'){
			$c = $c. ' <p><iframe style="margin-top:20px" width="100%" height="500px" frameBorder="0" src="https://umap.openstreetmap.fr/en/map/nuit-debout-paris-plan-de-la-republique_80910?scaleControl=false&miniMap=false&scrollWheelZoom=false&zoomControl=true&allowEdit=false&moreControl=true&datalayersControl=true&onLoadPanel=databrowser&captionBar=false"></iframe><p><a href="https://umap.openstreetmap.fr/en/map/nuit-debout-paris-plan-de-la-republique_80910">See full screen</a></p>';
		}
		$c = $c. '<ul>';
		foreach ( $links as $l ) :
			$c = $c.'<li><a href="'.$l.'">'.$l.'</a></li>';
		endforeach;
		$c = $c.'</ul>';
		$c = $c. '<p>Vous voulez compléter cette page, ajouter des liens ? Venez sur le <a href="'.$p['wiki_url'].'">wiki</a></p>';
		echo $c;

		$page = get_page_by_name($t);
		if (!empty($page)) {

		$pageville = get_page_by_name('ville');


		$my_post = array(
		    'ID'           => $page->ID,
		    'post_content' => $c,
		    'post_parent' =>  $pageville->ID,
		    'post_title'  =>  $t
		  );
		//print_r($my_post);
		// Update the post into the database
	  wp_update_post( $my_post );
		echo 'p updated';
	} else {

		$my_post = array(
		  'post_title'    =>  $t,
		  'post_content'  => $c,
		  'post_status'   => 'publish',
		  'post_author'   => 1,
		  'post_type' => 'page',
		  'post_parent' => 0
		);
		echo 'create '.$t;
		wp_insert_post( $my_post );
	}
	endforeach;
}
?>