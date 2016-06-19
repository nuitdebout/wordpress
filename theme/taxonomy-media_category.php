<div class="container">
<?php get_template_part('templates/page', 'header'); ?>


<?php while (have_posts()) : the_post(); ?>
<article <?php post_class(); ?>>
<header>
<?php
$attachment_id = get_post_thumbnail_id();
$attachment_page = get_attachment_link( $attachment_id );
?>
<a href="<?php echo $attachment_page; ?>"><?php the_title() ?></a>
  </header>
  <div class="entry-summary">
  <?php the_content(); ?>
  <?php get_template_part('templates/entry-taxonomies'); ?>
  </div>
</article>
<hr/>
<?php endwhile; ?>

<?php the_posts_navigation(); ?>
</div>