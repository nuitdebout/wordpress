<?php ?>
<div id="global" class="section">
	<?php
	$page_parent = get_field('homepage_global', 'option');
	if($page_parent->ID){
		$parent_id = $page_parent->ID;
		$exclude = false;
		if(is_page_template('page-globaldebout.php') ){
			$title ='Other languages / Autres langues';
			$permalink = '';
			$excerpt = '';
			$exclude = $post->ID;
		}
		else{
			$include = get_pages('include='.$parent_id);
			$title   = apply_filters('the_title',$include[0]->post_title);
			$permalink = get_permalink($include[0]->ID);
			$excerpt   = get_the_excerpt($include[0]->ID);
		}
		$args = array(
			'child_of' => $parent_id,
			'post_type' => 'page',
			'post_status' => 'publish',
			'sort_order' => 'asc',
			'sort_column' => 'menu_order',
			'exclude' => $exclude
		);
		$pages_sub = get_pages($args);
	}
	?>
	<h2 class="section__title"><?php echo $title; ?></h2>
	<div class="section__content">
		<p><?php echo $excerpt; ?></p>
		<ul class="tags-list">
		<?php
		if($pages_sub){
			foreach ( $pages_sub as $p ) :
				if (get_page_template_slug($p->ID) !== 'page-globaldebout.php') :
					continue;
				endif;
				$content = apply_filters('the_content',$p->post_content);
				$title = apply_filters('the_title',$p->post_title);
				$permalink = get_permalink($p->ID);
				$label = $title;
				$page_lang_code = get_field('page_lang_code',$p->ID );
				if($page_lang_code){
					$label = $page_lang_code;
				}
				?>
				<li class="tag with-lang"><a href="<?php echo $permalink; ?>"><?php echo $page_lang_code; ?></a></li>
			<?php endforeach;
		}
		?>
		</ul>
	</div>
</div>
