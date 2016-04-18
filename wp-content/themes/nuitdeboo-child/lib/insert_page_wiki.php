<?php


add_action('query_vars', 'register_my_query_vars' );
function register_my_query_vars( $qvars ){
  if($_GET["syncc"]) {
  		insert_page_wiki();

  }
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
function get_page_by_name($pagename)
{
	$pages = get_pages();
	foreach ($pages as $page) if ($page->post_name == $pagename) return $page;
	return false;
}



function insert_page_wiki(){
	$returned_content = get_data('https://raw.githubusercontent.com/nuitdebout/nuitdebout.github.io/master/data/cities.json');

	foreach ( $returned_content as $p ) :

	print_r($p);
		$t =wp_strip_all_tags($p['slug']);
		$c =$p['slug'];
		$links =$p['links'];

				foreach ( $links as $l ) :
					echo $l;
					endforeach;


	$page = get_page_by_name($t);
	if (!empty($page)) {

	echo '<pre> no create '.$t.'<br/></pre>';

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
	// Insert the post into the database
	//wp_insert_post( $my_post );
	}
	endforeach;
}
?>