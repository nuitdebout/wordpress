<?php

require __DIR__.'/../vendor/autoload.php';

use Goutte\Client;

if (php_sapi_name() !== 'cli') {
	exit(1);
}

if (!$args[0]) {
	echo "need arg blog_id\n";
	exit(1);
}
if (!$args[1]) {
	echo "need arg cat_id\n";
	exit(1);
}
$blog_id = $args[0];
$cat_id = $args[1];

$client = new Client();
$client->request('GET', 'https://gist.githubusercontent.com/Atala/e4f5ceb6d71dacaf21a71b6ebf023486/raw/5210afab450938e853309e06c449900eda7f8565/doleances.json');

switch_to_blog($blog_id);
echo sprintf('Inserting doleances into site : "%s"', get_bloginfo('name'))."\n";

$cat = get_the_category_by_ID($cat_id);
echo sprintf('Inserting into category "%s"', $cat)."\n";
$doleances = json_decode($client->getResponse()->getContent(), true);

foreach ($doleances as $date => $doleances_by_date) {
	foreach ($doleances_by_date as $doleance) {

		$post_title = implode(array_slice(explode(' ', $doleance), 0, 5), ' ').'…';
		// echo($post_title);
        $post_params = array(
          'post_date'     => $date,
          'post_title'    => $post_title,
          'post_content'  => $doleance,
          'post_status'   => 'publish',
          'post_author'   => 1,
        );
        $post = wp_insert_post($post_params, true);

        if (is_wp_error($post)) {
        	echo "Error while creating post:\n";
            foreach ($post->get_error_messages() as $error) {
                echo "{$error}\n";
            }
            continue;
        }
        else{
        	wp_set_object_terms($post,5,'category');
        	echo "Post \"{$post_title}\" created.\n";

        }

    }
}
restore_current_blog();

