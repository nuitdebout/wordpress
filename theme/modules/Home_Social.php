<?php

namespace Nuitdebout\modules;

/**
 * Module Home Social
 * Display a line with all the social network
 */
class Home_Social extends Module
{
	protected $templatePath = 'templates/module-home-social.php';

	public function __construct() {
		return parent::__construct([
			'description' => __('Affichez une ligne avec vos réseaux sociaux')
		]);
	}

	protected function get_template_params($instance) {
		$displayedSocials = [];
		$sc = get_social_array();
		foreach ( $sc as $key => $socialConfig ) {
			if( is_page_template('page-ville.php') ){
				$key_name = $key.'_page_url';
				$val_key  = get_field($key_name);
			}
			else{
				$key_name = 'social_'.$key;
				$val_key  = get_field($key_name, 'option');
			}

			if( $val_key ) {
				$socialConfig['url'] = $val_key;
				$displayedSocials[$key] = $socialConfig;
			} elseif ($key === 'nuitdebout' && !is_page_template('page-ville.php') ) {
				$displayedSocials[$key] = $socialConfig;
			}
		}
		return [
			'displayedSocials' => $displayedSocials
		];
	}


    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'New title', 'text_domain' );
        }
        ?>
        <p>
        <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

        return $instance;
    }
}
