<?php

// synchronize wiki and wordpress
// curl data file
// insert or create wp post
// use secret key (wp-config.php)
define('SECRET_DOLEANCES', '122EEAZXswxws2');

if(isset($_GET["sync"])) {
    if($_GET["sync"] == SECRET_DOLEANCES ){
        insert_doleance_post();
    }
    else{
        echo 'false secret key';
    }
}

function insert_doleance_post(){


        $returned_content = get_data('https://gist.githubusercontent.com/Atala/e4f5ceb6d71dacaf21a71b6ebf023486/raw/5210afab450938e853309e06c449900eda7f8565/doleances.json');

        foreach ( $returned_content as $date => $dols ) :
                foreach ( $dols as $dol ) :

                    $my_post = array(
                      'post_date'     => $date,
                      'post_title'    => implode(array_slice(explode($dol, ' '), 3), ' '),
                      'post_content'  => $dol,
                      'post_status'   => 'publish',
                      'post_author'   => 1,
                    );

                    $post_id =  wp_insert_post( $my_post,true );

                    if (is_wp_error($post_id)) {
                        $errors = $post_id->get_error_messages();
                        foreach ($errors as $error) {
                            echo $error;
                        }
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
    return  json_decode($data, true);

}

?>
