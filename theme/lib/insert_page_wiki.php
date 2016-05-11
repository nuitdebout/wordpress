<?php

// synchronize wiki and wordpress
// curl data file
// insert or create wp post
// use secret key (wp-config.php)


if(isset($_GET["sync"])) {
		if($_GET["sync"] == SECRET_SYNC_WIKI ){
			insert_page_doleances();
		}
		else{
			echo 'false secret key';
		}
}

function insert_page_doleances(){
	$returned_content = get_data('https://raw.githubusercontent.com/nuitdebout/nuitdebout.github.io/master/data/cities.json');
    $pageville = get_page_by_name('Liste des villes');

	foreach ( $returned_content as $date => $p ) :

		foreach ( $dols as $dol ) :
			$my_post = array(
			  'post_date'     =>  $date,
			  'post_title'    =>  implode(' ', array_slice(explode(' ', $dol), 3)),
			  'post_content'  => $dol,
			  'post_status'   => 'publish',
			  'post_author'   => 1,
			  'comment_status' => 1,
			);

			$post_id =  wp_insert_post( $my_post,true );

			if (is_wp_error($post_id)) {
				$errors = $post_id->get_error_messages();
				foreach ($errors as $error) {
					echo $error;
				}
			}
			else{
				add_post_meta( $post_id, '_wp_page_template', 'page-ville.php' );
			}

			echo $t.' created <br/><br/>';

		endforeach;
	endforeach;
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
	foreach ($pages as $page) if ($page->post_title == $pagename) return $page;
	return false;
}
?>
