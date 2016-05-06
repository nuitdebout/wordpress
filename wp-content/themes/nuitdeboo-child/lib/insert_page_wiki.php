<?php

// synchronize wiki and wordpress
// curl data file
// insert or create wp post
// use secret key (wp-config.php)
// Need to require these files
if ( !function_exists('media_handle_upload') ) {
		require_once(ABSPATH . "wp-admin" . '/includes/image.php');
		require_once(ABSPATH . "wp-admin" . '/includes/file.php');
		require_once(ABSPATH . "wp-admin" . '/includes/media.php');
}

if(isset($_GET["sync"])) {
		if($_GET["sync"] == SECRET_SYNC_WIKI ){
			if($_GET["action"] == 'insert'){



				insert_page_wiki();
			}
			else if($_GET["action"] == 'delete'){
				delete_page_wiki();
			}
			else{
					echo 'no action provided';
			}

		}
		else{
			echo 'false secret key';
		}
}
function delete_page_wiki(){

    	$pageville = get_page_by_name('Liste des villes');
		$pages_sub = get_pages(['child_of' => $pageville->ID, 'post_type' => 'page', 'post_status' => 'publish']);
		foreach ( $pages_sub  as $p ) :
			echo 'deleting '.$p->post_title;
			wp_delete_post($p->ID);
		endforeach;
}

function insert_page_wiki(){
	$returned_content = get_data(get_stylesheet_directory_uri() . '/data/cities.json');

    $pageville = get_page_by_name('Liste des villes');

	foreach ( $returned_content as $p ) :

		//print_r($p);
		$t = wp_strip_all_tags($p['name']);
		/*
		$m = '';

		if($t == 'Paris'){
			// $m = $m. ' <p><iframe style="margin-top:20px" width="100%" height="500px" frameBorder="0" src="https://umap.openstreetmap.fr/en/map/nuit-debout-paris-plan-de-la-republique_80910?scaleControl=false&miniMap=false&scrollWheelZoom=false&zoomControl=true&allowEdit=false&moreControl=true&datalayersControl=true&onLoadPanel=databrowser&captionBar=false"></iframe><p><a href="https://umap.openstreetmap.fr/en/map/nuit-debout-paris-plan-de-la-republique_80910">See full screen</a></p>';
		}
		if($p['map'] !== ''){
			$m = $m. ' <p><iframe style="margin-top:20px" width="100%" height="500px" frameBorder="0" src="'.$p['map'].'">See full screen</a></p>';
		}
		*/
		$c = $p['raw'];
		//echo $m;

		$page = get_page_by_name($t);

		if (!empty($page)) {

		$keep_sync = '1';
		//get_post_meta( $page->ID, 'keep_sync',true);

		if($keep_sync && $keep_sync == '1'){
			$my_post = array(
			    'ID'         => $page->ID,
			    'post_content' => $c,
			    'post_parent' =>  $pageville->ID,
			    'post_title'  =>  $t
			);


				$post_id = $page->ID;
				// wp_update_post( $my_post, true );
				if (is_wp_error($post_id)) {
					$errors = $post_id->get_error_messages();
					foreach ($errors as $error) {
						echo $error;
					}
				}
				else{
						add_post_meta( $post_id, 'chat_page_url', $p['linksChat'][0] );
						add_post_meta( $post_id, 'wiki_page_url', $p['wiki_url'] );
						add_post_meta( $post_id, '_wp_page_template', 'page-ville.php' );
						//echo $t.' updated <br/><br/>';

						/*
						if( $p['image']){


							$url = $p['image'][0];
							$tmp = download_url( $url );
							if( is_wp_error( $tmp ) ){
								// download failed, handle error
							}
							else{
								$desc = "image du wiki ".$t;
								$file_array = array();

								// Set variables for storage
								// fix file filename for query strings
								preg_match('/[^\?]+\.(jpg|jpe|jpeg|gif|png)/i', $url, $matches);
								$file_array['name'] = basename($matches[0]);
								$file_array['tmp_name'] = $tmp;

								// If error storing temporarily, unlink
								if ( is_wp_error( $tmp ) ) {
									@unlink($file_array['tmp_name']);
									$file_array['tmp_name'] = '';
								}
								else{
									// print_r($file_array);
								}

								// do the validation and storage stuff
								$id = media_handle_sideload( $file_array, $post_id, $desc );

								// If error storing permanently, unlink
								if ( is_wp_error($id) ) {
									@unlink($file_array['tmp_name']);
									return $id;
								}
								else{
									$src = wp_get_attachment_url( $id );
									echo $src;

								}



							}
						}
						*/

				}
			}
			else{
				add_post_meta( $post_id, 'keep_sync', '1' );
				add_post_meta( $post_id, 'chat_page_url', $p['linksChat'][0] );
				add_post_meta( $post_id, 'wiki_page_url', $p['wiki_url'] );

				echo $t.' not updated (keepsync off) <br/><br/>';
			}

		} else {

		$my_post = array(
		  'post_title'    =>  $t,
		  'post_content'  => $c,
		  'post_status'   => 'publish',
		  'post_author'   => 1,
		  'post_type' => 'page',
		  'post_parent' =>  $pageville->ID,
		);

		$post_id =  wp_insert_post( $my_post,true );
		if (is_wp_error($post_id)) {
			$errors = $post_id->get_error_messages();
			foreach ($errors as $error) {
				echo $error;
			}
		}
		else{
			add_post_meta( $post_id, 'keep_sync', '1' );
			add_post_meta( $post_id, '_wp_page_template', 'page-ville.php' );
			add_post_meta( $post_id, 'chat_page_url', $p['linksChat'][0] );
			add_post_meta( $post_id, 'wiki_page_url', $p['wiki_url'] );
		}

		echo $t.' created <br/><br/>';

	}
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
