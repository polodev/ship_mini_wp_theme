<?php get_header(); ?>
<?php

echo get_template_part( 'content', 'menu' );
?>

<section>
<?php while(have_posts()): the_post(); ?>
	<h2>single page</h2>

	<p class="lh"> <?php echo get_the_content() ?> </p>

<?php endwhile; ?>
</section>
<?php get_footer(); ?>